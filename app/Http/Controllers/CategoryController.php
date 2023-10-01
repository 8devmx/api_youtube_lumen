<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required|string",
            "color" => "max:6",
            "type" => "required|digits:1",
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->color = $request->color;
        $category->icon = $request->icon;
        $category->type = $request->type;
        $category->save();

        return response()->json($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::where('id', $id)->get();
        if (count($category) < 1) {
            return response()->json(["error" => "Category not found"]);
        }
        return response($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name" => "required|string",
            "color" => "max:6",
            "type" => "required|digits:1",
        ]);

        $category = Category::where('id', $id)->first();
        $category->name = $request->name;
        $category->color = $request->color;
        $category->icon = $request->icon;
        $category->type = $request->type;
        $category->save();

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id)->first();
        if (!$category) {
            return response()->json(["error" => "Category not found"]);
        }
        $category->delete();
        return response()->json(["data" => "Category with id $id deleted successfully"]);
    }
}
