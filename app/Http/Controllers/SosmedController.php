<?php

namespace App\Http\Controllers;

use App\Models\Sosmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class SosmedController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $sosmed = Sosmed::where('partner_id', session()->get('id-partner'));

            return DataTables::of($sosmed)
                ->addIndexColumn()
                ->addColumn('action', 'pageBackEnd.pageBackEndPartner.sosmed.include.action')
                ->toJson();
        }

        return view('pageBackEnd.pageBackEndPartner.sosmed.index');
    }

    public function create()
    {
        return view('pageBackEnd.pageBackEndPartner.sosmed.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'icon' => 'required|string|min:1|',
            'name' => 'required|string|min:1|max:100',
            'partner_id' => 'required|string',
            'link' => 'required|string|min:1',
        ]);
        try {
            $sosmed = new Sosmed();
            $sosmed->partner_id = $request->partner_id;
            $sosmed->icon = $request->icon;
            $sosmed->name = $request->name;
            $sosmed->link_sosmed = $request->link;
            $sosmed->save();
            Alert::toast('Berhasil input data sosial media', 'success');
            return to_route('sosmed.index');
        } catch (\Throwable $th) {
            //throw $th;
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
        $sosmed->icon = $request->icon;
        $sosmed->link_sosmed = $request->link;
        $sosmed->save();
        Alert::toast('Data berhasil diupdate', 'success');
        return to_route('sosmed.index');
    }

    public function destroy($id)
    {
        $sosmed = Sosmed::findOrFail($id);
        $sosmed->delete();
        Alert::toast('Data berhasil dihapus', 'success');
        return to_route('sosmed.index');
    }
}
