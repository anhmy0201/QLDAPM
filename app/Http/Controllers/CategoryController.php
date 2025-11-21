<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $category = Category::all();
        return view('category.index', compact('category'));
    }
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('category.create');
    }
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        $obj = new Category();
        $obj->name = $request->name;
        $obj->order = $request->order;
        $obj->save();
        return redirect()->route('category');
    }
    /**
    * Display the specified resource.
    */
    public function show($id)
    {
        $category = Category::find($id);
        return view('category.detail', compact('category'));
    }
    /**
    * Show the form for editing the specified resource.
    */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }
    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, $id)
    {
        $obj = Category::find($id);
        $obj->name = $request->name;
        $obj->order = $request->order;
        $obj->save();
        return redirect()->route('category');
    }
    /**
    * Remove the specified resource from storage.
    */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }
        return redirect()->route('category');
    }
}
