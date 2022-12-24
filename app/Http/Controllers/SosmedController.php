<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SosmedController extends Controller
{
    protected $htmlBuilder;
    public function __construct(Builder $htmlBuilder)
    {
        $this->htmlBuilder = $htmlBuilder;
    }
    public function index()
    {
        $sosmed = Sosmed::where('partner_id', session()->get('id-partner'))->get();
        if (request()->ajax()) {
            return DataTables::of($sosmed)
                ->addIndexColumn()
                ->addColumn('action', 'pageBackEnd.pageBackEndPartner.sosmed.include.action')
                ->toJson();
        }
        $columns = [
            ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'title' => '#',],
            ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            ['data' => 'link_sosmed', 'name' => 'link_sosmed', 'title' => 'Link'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action']
        ];
        $html = $this->htmlBuilder->columns($columns);
        return view('pageBackEnd.pageBackEndPartner.sosmed.index', compact('html'));
    }

    public function create()
    {
        return view('pageBackEnd.pageBackEndPartner.sosmed.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|min:1|max:100',
            'partner_id' => 'required|string',
            'link' => 'required|string|min:1',
        ]);
        try {
            $sosmed = new Sosmed();
            $sosmed->partner_id = $request->partner_id;
            $sosmed->name = $request->name;
            $sosmed->link_sosmed = $request->link;
            $sosmed->save();
            Alert::toast('Berhasil input data sosial media', 'success');
            return to_route('custom.link.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function edit($id)
    {
        $sosmed = Sosmed::firstWhere('id', $id);
        return view('pageBackEnd.pageBackEndPartner.sosmed.edit', compact('sosmed'));
    }
    public function update(Request $request, $id)
    {
        $sosmed = Sosmed::findOrFail($id);
        $sosmed->name = $request->name;
        $sosmed->link_sosmed = $request->link;
        $sosmed->save();
        Alert::toast('Data berhasil diupdate', 'success');
        return to_route('custom.link.index');
    }

    public function destroy($id)
    {
        $sosmed = Sosmed::findOrFail($id);
        $sosmed->delete();
        Alert::toast('Data berhasil dihapus', 'success');
        return to_route('custom.link.index');
    }
}
