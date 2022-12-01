<?php

namespace App\Http\Controllers\Backend\partner;

use App\Http\Controllers\Controller;
use App\Models\RequestQr;
use App\Http\Requests\RequestQrs\{StoreRequestQrRequest, UpdateRequestQrRequest};
use App\Http\Requests\UploadBuktiPembayaranRequest;
use App\Models\HistoryRequest;
use App\Models\Product;
use App\Models\TypeQr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class RequestQrController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:request_qr_show')->only('index');
        // $this->middleware('permission:request_qr_create')->only('create', 'store');
        // $this->middleware('permission:request_qr_update')->only('edit', 'update');
        // $this->middleware('permission:request_qr_delete')->only('delete');
        // $this->middleware('permission:request_qr_detail')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $requestQrs = RequestQr::with('product:id,code,name', 'type_qr:id,name')->where('partner_id', session()->get('id-partner'));

            return Datatables::of($requestQrs)
                ->addIndexColumn()
                ->addColumn('product', function ($row) {
                    return $row->product ? $row->product->name : '';
                })->addColumn('type_qr', function ($row) {
                    return $row->type_qr ? $row->type_qr->name : '';
                })
                ->addColumn('action', 'pageBackEnd.pageBackEndPartner.request-qrs.include.action')
                ->toJson();
        }

        return view('pageBackEnd.pageBackEndPartner.request-qrs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::select('id', 'code', 'name')->where('partner_id', session()->get('id-partner'))->limit(500)->get();
        $typeQrs = TypeQr::select('id', 'name')->limit(500)->get();
        $kode_request = $this->generateRandomString();

        return view('pageBackEnd.pageBackEndPartner.request-qrs.create', compact('products', 'typeQrs', 'kode_request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequestQrRequest $request)
    {
        $attr = $request->validated();
        $typeQr = TypeQr::select('id', 'price')->find($request->type_qr_id);
        $attr['amount_price'] = $typeQr->price * $request->qty;
        $attr['tanggal_request'] = now()->toDateTimeString();
        $attr['harga_satuan'] = $typeQr->price;
        $attr['status'] = 'Waiting Payment';
        $attr['partner_id'] = session()->get('id-partner');

        $requestQr = RequestQr::create($attr);

        HistoryRequest::create(
            [
                'status' => $attr['status'],
                'request_qr_id' => $requestQr->id
            ]
        );

        Alert::toast('Data berhasil disimpan', 'success');

        return redirect()->route('request-qrs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestQr $requestQr
     * @return \Illuminate\Http\Response
     */
    public function show(RequestQr $requestQr)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $requestQr->partner_id);
        abort_if(session()->get('id-partner') != $requestQr->partner_id, Response::HTTP_FORBIDDEN);

        $requestQr->load('product:id,code,name', 'type_qr:id,name,price', 'histories:id,request_qr_id,status,created_at');

        return view('pageBackEnd.pageBackEndPartner.request-qrs.show', compact('requestQr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestQr $requestQr
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestQr $requestQr)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $requestQr->partner_id);
        abort_if(session()->get('id-partner') != $requestQr->partner_id, Response::HTTP_FORBIDDEN);

        if(!in_array($requestQr->status, ['Waiting Payment', 'Pending Payment'])){
            Alert::error('Data tidak dapat diubah', 'error');

            return redirect()->route('request-qrs.index');
        }

        $requestQr->load('product:id,code,name', 'type_qr:id,name,price');

        $products = Product::select('id', 'code', 'name')->limit(500)->get();
        $typeQrs = TypeQr::select('id', 'name')->limit(500)->get();

        return view('pageBackEnd.pageBackEndPartner.request-qrs.edit', compact('products', 'typeQrs', 'requestQr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestQr $requestQr
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequestQrRequest $request, RequestQr $requestQr)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $requestQr->partner_id);
        abort_if(session()->get('id-partner') != $requestQr->partner_id, Response::HTTP_FORBIDDEN);

        $attr = $request->validated();
        $typeQr = TypeQr::select('id', 'price')->find($request->type_qr_id);
        $attr['amount_price'] = $typeQr->price * $request->qty;
        $attr['harga_satuan'] = $typeQr->price;

        $requestQr->update($attr);

        Alert::toast('Data berhasil diupdate', 'success');

        return redirect()->route('request-qrs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestQr $requestQr
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestQr $requestQr)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $requestQr->partner_id);
        abort_if(session()->get('id-partner') != $requestQr->partner_id, Response::HTTP_FORBIDDEN);

        if(!in_array($requestQr->status, ['Waiting Payment', 'Pending Payment'])){
            Alert::error('Data gagal dihapus', 'error');

            return redirect()->route('request-qrs.index');
        }

        try {
            $path = '/public/uploads/bukti-pembayaran/';

            if ($requestQr->bukti_pembayaran != null && file_exists($path . $requestQr->bukti_pembayaran)) {
                unlink($path . $requestQr->bukti_pembayaran);
            }

            $requestQr->delete();

            Alert::toast('Data berhasil dihapus', 'success');

            return redirect()->route('request-qrs.index');
        } catch (\Throwable $th) {
            Alert::error('Data gagal dihapus', 'error');

            return redirect()->route('request-qrs.index');
        }
    }

    /**
     * Download file from storage.
     *
     * @param string $filename
     * @return string
     */
    public function download(string $filename)
    {
        // Gate::allowIf(fn () => session()->get('id-partner') == $requestQr->partner_id);
        // abort_if(session()->get('id-partner') != $requestQr->partner_id, Response::HTTP_FORBIDDEN);

        $path = storage_path("app/public/uploads/bukti-pembayaran/");

        if (file_exists($path . $filename)) {
            $fullpath = $path . $filename;

            $extension = \File::extension($fullpath);

            $headers = array(
                // type sesuai extension file
                'Content-Type: application/' . $extension,
            );

            /**
             * params
             * 1: document file,
             * 2: nama file ketika didownload,
             * 3:header(optional, default: pdf)
             */
            return response()->download($fullpath, $filename, $headers);
        } else {
            abort(404, 'Bukti pembayaran tidak ditemukan!');
        }
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return str($randomString)->upper();
    }

    public function uploadView(int $id){
        $requestQr = RequestQr::findOrFail($id);

        // Gate::allowIf(fn () => session()->get('id-partner') == $requestQr->partner_id);
        abort_if(session()->get('id-partner') != $requestQr->partner_id, Response::HTTP_FORBIDDEN);

        if(!in_array($requestQr->status, ['Waiting Payment', 'Pending Payment'])){
            Alert::error('Tidak dapat upload bukti pembayaran', 'error');

            return redirect()->route('request-qrs.index');
        }

        return view('pageBackEnd.pageBackEndPartner.request-qrs.upload', compact('requestQr'));
    }

    public function upload(int $id, UploadBuktiPembayaranRequest $request){
        $requestQr = RequestQr::findOrFail($id);

        // Gate::allowIf(fn () => session()->get('id-partner') == $requestQr->partner_id);
        abort_if(session()->get('id-partner') != $requestQr->partner_id, Response::HTTP_FORBIDDEN);

        if(!in_array($requestQr->status, ['Waiting Payment', 'Pending Payment'])){
            Alert::error('Tidak dapat upload bukti pembayaran', 'error');

            return redirect()->route('request-qrs.index');
        }

        $attr = $request->validated();

        if (
            $request->file('bukti_pembayaran') &&
            $request->file('bukti_pembayaran')->isValid() &&
            in_array($requestQr->status, ['Waiting Payment', 'Pending Payment'])
        ) {

            $path = '/public/uploads/bukti-pembayaran/';
            $filename = $request->file('bukti_pembayaran')->hashName();

            // if (!file_exists($path)) {
            //     mkdir($path, 0777, true);
            // }

            // delete old bukti_pembayaran from storage
            if ($requestQr->bukti_pembayaran != null && file_exists($path . $requestQr->bukti_pembayaran)) {
                unlink($path . $requestQr->bukti_pembayaran);
            }

            $request->bukti_pembayaran->storeAs($path, $filename);

            $attr['bukti_pembayaran'] = $filename;
            $attr['tgl_upload_bukti_bayar'] = now()->toDateTimeString();
            $attr['status'] = 'Pending Payment';
            $attr['tgl_upload_bukti_bayar'] = date('Y-m-d H:i:s');

            $requestQr->update($attr);

            HistoryRequest::create(
                [
                    'status' => $attr['status'],
                    'request_qr_id' => $requestQr->id
                ]
            );

            Alert::toast('Bukti pembayaran berhasil diupload', 'success');

            return redirect()->route('request-qrs.index');
        }

        Alert::error('Bukti pembayaran gagal diupload', 'error');

        return redirect()->route('request-qrs.index');
    }
}
