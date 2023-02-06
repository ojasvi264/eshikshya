<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryCreate()
    {
        return redirect()->route('teacher.category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function categoryStore(StoreCategoryRequest $request)
    {
        $category = Category::where('category_name', '=', $request->category_name)->first();
        if ($category === null) {
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->save();
            return redirect()->back()->with('success', 'Created successfully');
        }
        else{
            return redirect()->back()->with('error', 'Data already exists.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function dropDownShow(Category $category)
    {
        $category = Category::all();
        return view ('superadmin.academics.category.index', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function categoryEdit($id)
    {
        $cat = Category::all();
        $category = Category::find($id);
        return view('superadmin/academics/category/edit', ['cat' => $cat, 'category' => $category]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function categoryUpdate(UpdateCategoryRequest $request)
    {
        $category = Category::where('category_name', '=', $request->category_name)->first();
        if ($category === null) {
            $category = Category::find($request->id);
            $category->category_name = $request->category_name;
            $category->update();
            return redirect()->route('teacher.category')->with('success', 'Updated successfully');
        }
        else{
            return redirect()->route('teacher.category')->with('error', 'Data already exists.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function categoryDestroy(Category $category, $id)
    {
        $category = Category::findOrFail($id);
        $category ->delete();
        return redirect()->back()->with('success', 'Deleted successfully.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category= DB::table('categories')
            ->join('eclasses', 'eclasses.id', '=', 'categories.eclasses_id')
            ->join('sections', 'sections.id', '=', 'categories.sections_id')
            ->join('groups', 'groups.id', '=', 'categories.groups_id')
            ->select('categories.id as category_id','categories.name as category_name' ,'eclasses.name as class_name','sections.name as section_name', 'groups.name as group_name')
            ->get();
        return response()->json($category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->eclasses_id = $request->eclasses_id;
        $category->sections_id = $request->sections_id;
        $category->groups_id = $request->groups_id;
        $category->save();
        return response()->json([
            'success' => true,
            'message'=>'Successfully created.',
            'data'=>$category,
        ],Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {
        $category = Category::findOrFail($id);
        $category ->delete();
        return $category;
    }
}
