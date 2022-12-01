<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\Categories\{StoreCategoryRequest, UpdateCategoryRequest};
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:category_show')->only('index');
        $this->middleware('permission:category_create')->only('create', 'store');
        $this->middleware('permission:category_update')->only('edit', 'update');
        $this->middleware('permission:category_delete')->only('delete');
        $this->middleware('permission:category_detail')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $categories = Category::query();

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', 'pageBackEnd.categories.include.action')
                ->toJson();
        }

        return view('pageBackEnd.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pageBackEnd.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        Alert::toast('Data berhasil disimpan', 'success');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('pageBackEnd.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('pageBackEnd.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        Alert::toast('Data berhasil diupdate', 'success');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            Alert::toast('Data berhasil dihapus', 'success');

            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            Alert::toast('Data gagal dihapus', 'error');

            return redirect()->route('categories.index');
        }
    }
}
