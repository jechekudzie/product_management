<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SubCategoryController extends Controller
{
    //
    public function index(Category $category)
    {
        return view('admin.sub_categories.index', compact('category'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.sub_categories.create', compact('categories'));
    }

    public function store(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

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
                $path = $file->move('images/sub_categories', $file_name);

                $validatedData['image'] = $path;

            }
        }

        $category->add_sub_categories($validatedData);
        return redirect('/admin/sub_categories/' . $category->slug . '/index')->with('success', 'Products created successfully.');
    }


    public function show(Product $product)
    {
        return view('admin.sub_categories.show', compact('product'));
    }

    public function edit(SubCategory $subCategory)
    {
        return view('admin.sub_categories.edit', compact('subCategory'));
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        // Handle the uploaded image
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
                $product = $file->move('images/sub_categories', $file_name);

                $validatedData['image'] = $product;

            }
        }

        $subCategory->update($validatedData);

        return back()->with('success', 'Sub Category updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('sub_categories.index')
            ->with('success', 'Product deleted successfully.');
        // ...
    }


}
