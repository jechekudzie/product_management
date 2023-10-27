<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\SubCategory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(SubCategory $subCategory)
    {
        return view('admin.products.index', compact('subCategory'));
    }

    public function store(Request $request, SubCategory $subCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'nullable',
            'original_size' => 'nullable|string',
            'other_sizes' => 'nullable|array',
            'other_sizes.*' => 'string',
            'image.*' => 'nullable|image',
        ]);


        if (isset($validatedData['other_sizes'])) {
            $validatedData['other_sizes'] = json_encode($validatedData['other_sizes']);
        }

        // Handle the uploaded images
        if (request()->hasfile('image')) {

            //get the file field data and name field from form submission
            $uploadedFiles = request()->file('image');

            foreach ($uploadedFiles as $file) {
                //get file original name
                $name = $file->getClientOriginalName();

                $fileNameWithoutExtension = pathinfo($name, PATHINFO_FILENAME);

                //create a unique file name using the time variable plus the name
                $file_name = time() . $name;


                //upload the file to a directory in Public folder
                $path = $file->move('images/products', $file_name);

                $validatedData['image'] = $path;


            }
        }

        $subCategory->add_products($validatedData);

        return back()->with('success', 'Product added successfully.');
        //return redirect('/admin/products/' . $subCategory->id . '/index')->with('success', 'Product added successfully.');

    }


    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'nullable',
            'original_size' => 'nullable|string',
            'other_sizes' => 'nullable|array',
            'image.*' => 'nullable|image',
        ]);


        if (isset($validatedData['other_sizes'])) {
            $validatedData['other_sizes'] = json_encode($validatedData['other_sizes']);
        }

        // Handle the uploaded images
        if (request()->hasfile('image')) {

            //get the file field data and name field from form submission
            $uploadedFiles = request()->file('image');

            foreach ($uploadedFiles as $file) {
                //get file original name
                $name = $file->getClientOriginalName();

                $fileNameWithoutExtension = pathinfo($name, PATHINFO_FILENAME);

                //create a unique file name using the time variable plus the name
                $file_name = time() . $name;


                //upload the file to a directory in Public folder
                $path = $file->move('images/products', $file_name);

                if ($product->image !== null) {
                    if (File::exists(public_path($product->image))) {

                        File::delete(public_path($product->image));
                    }

                }
                $validatedData['image'] = $path;

            }
        }

        $product->update($validatedData);

        return redirect('admin/products/' . $product->sub_category->slug . '/index')
            ->with('success', 'Product updated successfully.');
    }

    // Delete the previous image if it exists

    public function destroy(Product $product)
    {

        $id = $product->sub_category_id;

        $product->delete();

        return redirect('admin/products/' . $id . '/index')
            ->with('success', 'Product updated successfully.');
    }
}
