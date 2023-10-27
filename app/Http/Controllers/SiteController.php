<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //


    public function welcome()
    {
        $categories = Category::all();

        $category = Category::find(1);
        return view('welcome', compact('categories'));
    }


    public function sub_categories(Category $category)
    {

        return view('sub_categories', compact('category'));
    }

    public function sub_category_details(SubCategory $subCategory)
    {

      //  dd($subCategory->products);
        return view('sub_category_details', compact('subCategory'));
    }


    public function product(Product  $product)
    {

        return view('product_detail', compact('product'));
    }

    public function products()
    {
        $categories = Category::all();

        return view('products', compact('categories'));
    }



    public function about_us()
    {
        $about_us = About::find(1);
        $customer_orientation = About::find(2);
        return view('about_us', compact('about_us','customer_orientation'));
    }

    public function services(Service $service)
    {
        return view('services',compact('service'));
    }

    public function contact_us()
    {

        return view('contact_us');
    }


}
