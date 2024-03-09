<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $all_category = Category::get();
        return view('admin.product_management.category_management.Parent_category.index', compact('all_category'));
    }
    public function create()
    {
        return view('admin.product_management.category_management.Parent_category.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
        ]);


        $slug = Str::slug($request->name, '-');

        // return  $slug;
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);


        return redirect()->route('category.index')->with('message', 'Category created successfully!');
    }
    public function edit_page($id)
    {
        $category = Category::find($id);


        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Category not found!');
        }
        return view('admin.product_management.category_management.Parent_category.edit', compact('category'));
        // return $id;
    }
    public function update(Request $request, $id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);


        // Update the category's name
        $category->name = $request->input('name');
        $category->save();
        return redirect()->route('category.index')->with('message', 'Category Updated successfully!');
    }
    public function delete($id)
    {
        $category = Category::find($id);


        if (!$category) {
            return redirect()->route('category.index')->with('error', 'Category not found!');
        }


        $category->delete();


        return redirect()->route('category.index')->with('message', 'Category Deleted Successfully!');
    }
}
