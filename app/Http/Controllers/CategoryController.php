<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('adminLayouts.categoryLayouts.index', ['categories' => $categories]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
        ]);

        if ($validator->passes()) {
            $result = Category::create([
                'name' => $request->name
            ]);
            return redirect()->route('category.index')->with(['message' => 'category created!']);
        } else {
            return back()->withErrors(['message' => $validator->errors()->first()])->withInput();
        }


    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','max:255', Rule::unique('categories', 'name')->ignore($category->id)],
        ]);

        if($validator->passes()){
            $result = $category->update($request->all());
            return redirect()->route('allUsers')->with(['message' => 'The category has been updated properly']);
        }else{
            return back()->withErrors(['message' => $validator->errors()->first()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with(['message' => 'The category has been deleted properly']);
    }
}
