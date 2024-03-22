<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Add this at the top of your controller

class ProductContoller extends Controller
{
    //
    public function index()
    {
        $all_products = Product::all();
        return view('admin.product_management.Product.index', compact('all_products'));
    }
    public function create()
    {
        $category = Category::all();
        return view('admin.product_management.Product.create', compact('category'));
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'product_price' => 'required|numeric',
            'product_description' => 'required',
            'product_quantity' => 'required|numeric',
            'product_category' => 'nullable|numeric',
            // 'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for an image
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($validatedData);


        // Create a new product
        $product = new Product();
        $product->name = $validatedData['product_name'];
        $product->price = $validatedData['product_price'];
        $product->description = $validatedData['product_description'];
        $product->quantity = $validatedData['product_quantity'];
        $product->discount = $request->input('product_discount') ?? 0;
        $product->category_id = $validatedData['product_category'];
        // $product->image = $imagePath; // Save the path to the image

        // Handle image upload
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = time() . '_' . mt_rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('product_images', $imageName, 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('product.index')->with('message', 'Product created successfully');
    }
    public function edit_page($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Category not found!');
        }
        return view('admin.product_management.Product.edit', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'product_price' => 'required|numeric',
            'product_description' => 'required',
            'product_quantity' => 'required|numeric',
            'product_category' => 'nullable|numeric',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the product by ID
        $product = Product::findOrFail($id);

        // Update the product with the validated data
        $product->name = $validatedData['product_name'];
        $product->price = $validatedData['product_price'];
        $product->description = $validatedData['product_description'];
        $product->quantity = $validatedData['product_quantity'];
        $product->discount = $request->input('product_discount') ?? 0;
        $product->category_id = $validatedData['product_category'];

        // Handle image upload if a new image is provided
        if ($request->hasFile('product_image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            // Store the new image
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $product->image = $imagePath;
        }
        // Save the updated product
        $product->save();

        return redirect()->route('product.index')->with('message', 'Product Updated successfully');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found!');
        }

        // Delete the product image from storage if it exists
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('product.index')->with('message', 'Product Deleted Successfully!');
    } 
}
