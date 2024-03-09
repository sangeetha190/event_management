<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $all_sub_category = SubCategory::get();
        return view('admin.product_management.category_management.Sub_category.index', compact('all_sub_category'));
    }
    public function create()
    {
        $all_category = Category::get();
        return view('admin.product_management.category_management.Sub_category.create', compact('all_category'));
    }
    public function store(Request $request)
    {
        // return $request;

        // Validate the request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'sub_name' => 'required|string|max:255',
        ]);

        $slug = Str::slug($request->input('sub_name'), '-');
        // If validation fails, return back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new sub-category
        SubCategory::create([
            'category_id' => $request->input('category_id'),
            'sub_category_name' => $request->input('sub_name'),
            'slug' => $slug,
        ]);

        // Redirect back with success message
        return redirect()->route('sub_category.index')->with('success', 'Sub Category created successfully!');
    }


    public function edit_page($id)
    {
        $sub_category = SubCategory::find($id);
        $all_category = Category::get();

        if (!$sub_category) {
            return redirect()->route('sub_category.index')->with('message', 'Category not found!');
        }
        return view('admin.product_management.category_management.Sub_category.edit', compact('sub_category', 'all_category'));
        // return $id;
    }
}
