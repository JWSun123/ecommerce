<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);
Route::get('category', [App\Http\Controllers\Frontend\FrontendController::class, 'category']);
Route::get('view-category/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewCategory']);
Route::get('view-product/{id}', [App\Http\Controllers\Frontend\FrontendController::class, 'productView']);
Route::post('view-product/select-size', [App\Http\Controllers\Frontend\FrontendController::class, 'selectSize']);
Route::post('view-product/get-quantity',[App\Http\Controllers\Frontend\FrontendController::class, 'getQuantity']);

Route::post('add-to-cart', [App\Http\Controllers\Frontend\CartController::class, 'addProduct']);
Route::post('delete-cart-item', [App\Http\Controllers\Frontend\CartController::class, 'deleteProduct']);
Route::post('update-cart', [App\Http\Controllers\Frontend\CartController::class, 'updateCart']);




Route::middleware(['auth'])->group(function () {
    Route:: get('cart', [App\Http\Controllers\Frontend\CartController::class, 'viewCart']);
    Route::get('checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::post('place-order', [App\Http\Controllers\Frontend\CheckoutController::class, 'placeOrder']);
    Route::get('order-history', [App\Http\Controllers\Frontend\UserController::class, 'index']);
    Route::get('view-order/{id}', [App\Http\Controllers\Frontend\UserController::class, 'viewOrder']);
    Route::post('show-payment', [App\Http\Controllers\Frontend\CheckoutController::class, 'showPayment']);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin:
Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\FrontendController::class, 'index']);

    //About us:
    Route::get('about-us', [App\Http\Controllers\Admin\DescriptionController::class, 'show']);
    Route::post('description', [App\Http\Controllers\Admin\DescriptionController::class, 'about']);

    //Order:
    Route::get('orders', [App\Http\Controllers\Admin\OrderController::class, 'index']);
    Route::get('admin/view-order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'editOrder']);
    Route::put('update-order/{id}', [App\Http\Controllers\Admin\OrderController::class, 'updateOrder']);

    //User:
    Route::get('users', [App\Http\Controllers\Admin\DashboardController::class, 'users']);
    Route::get('view-user/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'viewUser']);

    //Category:
    Route::get('categories', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('add-category', [App\Http\Controllers\Admin\CategoryController::class, 'add']);
    Route::post('insert-category', [App\Http\Controllers\Admin\CategoryController::class, 'insert']);
    Route::get('edit-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit']);
    Route::put('update-category/{id}',[App\Http\Controllers\Admin\CategoryController::class, 'update']);
    Route::get('delete-category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete']);

    //Products:
    Route:: get('products',[App\Http\Controllers\Admin\ProductController::class, 'index']);
    Route::get('add-product', [App\Http\Controllers\Admin\ProductController::class, 'add']);
    Route::post('insert-product', [App\Http\Controllers\Admin\ProductController::class, 'insert']);
    Route::get('edit-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'edit']);
    Route::put('update-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'update']);
    Route::get('delete-product/{id}', [App\Http\Controllers\Admin\ProductController::class, 'delete']);

    //Attributes:
    Route::get('attributes', [App\Http\Controllers\Admin\AttributeController::class, 'index']);
    Route::post('add-size', [App\Http\Controllers\Admin\AttributeController::class, 'addSize']);
    Route::post('add-color', [App\Http\Controllers\Admin\AttributeController::class, 'addColor']);
    Route::get('delete-size/{id}', [App\Http\Controllers\Admin\AttributeController::class, 'deleteSize']);
    Route::get('delete-color/{id}', [App\Http\Controllers\Admin\AttributeController::class, 'deleteColor']);
    Route::get('view-entry/{id}', [App\Http\Controllers\Admin\AttributeController::class, 'viewEntry']);
    Route::post('add-entry',[App\Http\Controllers\Admin\AttributeController::class, 'addEntry']);
    Route::get('delete-entry/{id}',[App\Http\Controllers\Admin\AttributeController::class, 'deleteEntry']);

 });
