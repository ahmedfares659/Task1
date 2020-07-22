<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // 

        $categories = Category::where('category_id', '=', 0)->get();


        return view('Category.index')->with(['parents' => $categories]);
    }
    public function MainPage(Request $request)
    {
        // if ($data) {
        // } else {
        //     $categories = Category::where('category_id', '=', 0)->get();


        //     return view('Category.index')->with(['category' => Category::all(), 'parents' => $categories]);
        // }
        // $msg = "This is a simple message.";
        // return response()->json(array('msg'=> 'hi'), 200);
        $parent_Child = Category::where('category_id', '=', $request->id)->get();
        // return redirect('/category/childs')->with($parent_Child);
        // $returnHTML = view('Category.children')->with('sub', $parent_Child)->render();
        // return response()->json(array('success' => true, 'html' => $returnHTML));

        $parent_Child->map(function ($item, $key) {
            return $item['childs'] = $item->SubCategory()->count();
        });
        return response()->json(array($parent_Child), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Category.create')->withCategory(Category::all()->sortBy('C_Name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $checkdata = validator($request->all(), [
        //     'name' => 'required',
        //     'description' => 'required'
        // ]);
        // $st = "";
        // $data = explode("-", $request->name);
        // $len = count($data);
        // $x = 0;
        // $st = "Group: " . $data[$x];
        // for ($x = 1; $x < $len; $x++) {
        //     $st .= ",\n Son:" . $data[$x];
        // }
        // if ($len <= 2) {
        //     return $len . "False";
        // } else {
        //     return $len . " true";
        // }
        if ($request->parent) {
            $cat = Category::create([
                'C_Name' => $request->name,
                'C_Description' => $request->description,
                'category_id' => (int)$request->parent
            ]);
        } elseif ($request->parent == "parent") {
            $cat = Category::create([
                'C_Name' => $request->name,
                'C_Description' => $request->description
            ]);
        }
        return redirect(route('category.index'));
        // dd($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // dd($id);
        // $st = "";
        // $data = explode("-", $id);
        // $len = count($data);
        // $x = 0;
        // $st = "Group: " . $data[$x];
        // for ($x = 1; $x < $len; $x++) {
        //     $st .= ",\n Son:" . $data[$x];
        // }
        // return $st;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        //
        $selected_category = Category::where('id', $category)->first();
        return view('Category.create')->with('EditCategory', $selected_category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        // dd($request);
        $category = Category::where('id', $request->ddd)->first();
        $category->update([
            'C_Name' => $request->name,
            'C_Description' => $request->description
        ]);
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        //
        $data_destroy = Category::where('id', $category)->first();
        return $data_destroy->delete();
    }
}
