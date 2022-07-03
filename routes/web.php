<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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

Route::get( '/', function () {
	$products = Product::all();

	return view( 'shop' )->with( [ 'products' => $products ] );
} );

Auth::routes();

Route::get( '/home', [ App\Http\Controllers\HomeController::class, 'index' ] )->name( 'home' );

Route::prefix( 'dashboard' )
     ->controller( App\Http\Controllers\DashboardController::class )
     ->middleware( 'auth' )
     ->name( 'dashboard' )
     ->group( function () {
	     Route::get( '/', 'index' );
	     Route::get( 'products', 'productList' )->name( '.products' );
	     Route::get( 'products/create', 'createProduct' )->name( '.products.create' );
	     Route::post( 'products/create', 'storeProduct' )->name( '.products.store' );
	     Route::get( 'products/{id}', 'viewProduct' )->name( '.products.view' );
	     Route::post( 'products/{id}', 'updateProduct' )->name( '.products.update' );
	     Route::delete( 'products/{id}', 'destroyProduct' )->name( '.products.destroy' );

	     Route::get( 'orders', 'ordersList' )->name( '.orders' );
	     Route::get( 'orders/{id}', 'viewOrder' )->name( '.orders.view' );
	     Route::post( 'orders/{id}', 'updateOrder' )->name( '.orders.update' );

	     Route::get( 'users', 'usersList' )->name( '.users' );
	     Route::get( 'users/{id}', 'viewUser' )->name( '.users.view' );
     } );

Route::resource( 'product', ProductController::class );

Route::post( 'add_to_cart/{id}', [ ProductController::class, 'addToCart' ] );

Route::get( 'remove_from_cart/{id}', [ ProductController::class, 'removeFromCart' ] );

Route::get( 'cart', [ CartController::class, 'index' ] )->name( 'cart.list' );

Route::get( 'checkout', [ CartController::class, 'checkout' ] )->name( 'cart.checkout' );

Route::get( 'order/{id}', [ OrderController::class, 'viewOrder' ] )->name( 'order.view' );
