<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
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
                $path = $file->move('images/categories', $file_name);

                $validatedData['image'] = $path;

            }
        }

        Category::create($validatedData);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
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
                $product = $file->move('images/categories', $file_name);

                $validatedData['image'] = $product;

            }
        }

        $category->update($validatedData);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
