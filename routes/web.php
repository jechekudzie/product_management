<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Admin Web Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/admin', [AdminController::class,'index']);

// Routes for CategoryController
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/admin/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');


// Display all products
Route::get('/admin/sub_categories/{category}/index', [SubCategoryController::class, 'index'])->name('sub_categories.index');
// store products
Route::post('/admin/sub_categories/{category}/store', [SubCategoryController::class, 'store'])->name('sub_categories.store');
// Display the form to edit a specific product
Route::get('/admin/sub_categories/{subCategory}/edit', [SubCategoryController::class, 'edit'])->name('sub_categories.edit');
// Delete a specific product
Route::delete('/admin/sub_categories/{subCategory}', [SubCategoryController::class, 'destroy'])->name('sub_categories.destroy');
//Update a specific sub category
Route::put('/admin/sub_categories/{subCategory}', [SubCategoryController::class, 'update'])->name('sub_categories.update');


// Display all products
Route::get('/admin/products/{subCategory}/index', [ProductController::class, 'index'])->name('products.index');
// store products
Route::post('/admin/products/{subCategory}/store', [ProductController::class, 'store'])->name('products.store');
// Display the form to edit a specific product
Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Delete a specific product
Route::delete('/admin/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
//Update a specific product
Route::put('/admin/products/{product}', [ProductController::class, 'update'])->name('products.update');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
