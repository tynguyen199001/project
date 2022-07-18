<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('view_category');
        $categories = Categories::all();
        $paginate = Categories::latest()->paginate(5);  
       // dd($categories);    
        return view('admin.categories.index',compact('categories','paginate'));
    }
    public function active($id)
    {
        Categories::findOrFail($id)->update(['status' => 0]);
        return redirect()->route('categories.index');
    }

    public function unactive($id)
    {
        Categories::findOrFail($id)->update(['status' => 1]);
        return redirect()->route('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //  echo 123;die;   
        $categories = Categories::orderBy('name', 'ASC')->get();
        $recusives = new Recusive($categories);
        $data = $recusives->showCategories($parent_id = '');
        return view('admin.categories.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'status' => $request->status,
            'slug' => Str::slug($request->name)
        ];
        Categories::create($input);
        Session::flash('success', 'Tạo mới danh mục thành công');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $data = Categories::all();
        $recusives = new Recusive($data);
        $categories = Categories::findOrFail($id);
        $data = $recusives->showCategories($categories->parent_id);
        return view('admin.categories.edit', compact('categories', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoriesRequest  $request
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Categories::findOrFail($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        Session::flash('success', 'Cập nhật danh mục thành công');
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('delete_category');
        Categories::findOrFail($id)->delete();
        return redirect()->route('categories.index');
    }
}
