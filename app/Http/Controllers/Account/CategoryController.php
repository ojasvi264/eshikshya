<?php

namespace App\Http\Controllers\Account;

use App\Models\AccountCategory;
use App\Http\Requests\AccountCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(){
        $categories = AccountCategory::all();
        return view('account.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        $categories = AccountCategory::all();
        return view('account.create', compact('categories'));
    }

    /**
     * @param AccountCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function store(AccountCategoryRequest $request){
        $category = AccountCategory::create($request->all());
        if($category){
            return redirect()->route('account.category.index')->with('success', 'Created successfully');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id){
        $category = AccountCategory::find($id);
        return view('account.edit', compact('category'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(Request $request){
        $category = AccountCategory::find($request->id);
        if($category->update($request->all())){
            return redirect()->route('account.category.index')->with('success', 'Updated successfully');
        }
    }
}
