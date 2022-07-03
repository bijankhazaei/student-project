<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller {

	/**
	 * @param Request $request
	 *
	 * @return Application|Factory|View
	 */
	public function productList( Request $request ) {
		$products = Product::all();
		$pathInfo = $request->getPathInfo();

		return view( 'dashboard.products.list' )->with( [
			'pathInfo' => $pathInfo,
			'products' => $products
		] );
	}

	/**
	 * @param Request $request
	 *
	 * @return Application|Factory|View
	 */
	public function createProduct( Request $request ) {
		$pathInfo = $request->getPathInfo();

		return view( 'dashboard.products.create' )->with( [ 'pathInfo' => $pathInfo ] );
	}

	/**
	 * @param Request $request
	 *
	 * @return Application|RedirectResponse|Redirector
	 */
	public function storeProduct( Request $request ) {
		$request->validate( [
			'name' => 'required|max:255',
			'price' => 'required',
			'quantity' => 'required',
			'description' => 'required'
		] );

		$product = new Product();

		$product->name        = $request->name;
		$product->price       = $request->price;
		$product->quantity    = $request->quantity;
		$product->description = $request->description;

		if ( $request->has( 'image' ) ) {
			if ( $product->image ) {
				Storage::delete( $product->image );
			}
			$file     = $request->file( 'image' );
			$fileName = date( 'YmdHis' ) . $file->getClientOriginalName();
			$file->move( public_path( 'public/images' ), $fileName );

			$product->image = $fileName;
		}

		$product->save();

		return redirect( '/dashboard/products' );
	}

	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return Application|Factory|View
	 */
	public function viewProduct( Request $request, $id ) {
		$pathInfo = $request->getPathInfo();
		$product  = Product::query()->find( $id );

		return view( 'dashboard.products.edit' )->with( [
			'pathInfo' => $pathInfo,
			'product' => $product
		] );
	}

	/**
	 * @param Request $request
	 * @param $id
	 *
	 * @return Application|RedirectResponse|Redirector
	 */
	public function updateProduct( Request $request, $id ) {

		$request->validate( [
			'name' => 'required|max:255',
			'price' => 'required',
			'quantity' => 'required',
			'description' => 'required'
		] );

		$product = Product::find( $id );

		$product->name        = $request->name;
		$product->description = $request->description;
		$product->quantity    = $request->quantity;
		$product->price       = $request->price;

		if ( $request->has( 'image' ) ) {
			if ( $product->image ) {
				Storage::delete( $product->image );
			}
			$file     = $request->file( 'image' );
			$fileName = date( 'YmdHis' ) . $file->getClientOriginalName();
			$file->move( public_path( 'public/images' ), $fileName );

			$product->image = $fileName;
		}

		$product->save();

		return redirect( '/dashboard/products' );
	}

	public function ordersList( Request $request ) {
		$user = Auth::user();

		if ( $user->is_admin ) {
			$orders = Order::with( 'user' )->get();
		} else {
			$orders = Order::with( 'user' )->where( 'user_id', $user->id )->get();
		}

		$pathInfo = $request->getPathInfo();

		return \view( 'dashboard.orders.list' )->with( [
			'orders' => $orders,
			'pathInfo' => $pathInfo
		] );
	}

	public function viewOrder( Request $request, $id ) {
		$order    = Order::with( 'products', 'user' )->find( $id );
		$pathInfo = $request->getPathInfo();

		return \view( 'dashboard.orders.edit' )->with( [
			'order' => $order,
			'pathInfo' => $pathInfo
		] );
	}

	public function updateOrder( Request $request, $id ) {
		$request->validate( [
			'status' => 'required',
		] );

		$status = $request->get( 'status' );

		$order = Order::find( $id );

		$order->status = $status;
		$order->save();

		return redirect( '/dashboard/orders/' . $order->id );
	}

	public function usersList( Request $request ) {
		$users    = User::with( 'orders' )->get();
		$pathInfo = $request->getPathInfo();

		return view( 'dashboard.users.list' )->with( [
			'users' => $users,
			'pathInfo' => $pathInfo
		] );
	}

	public function viewUser( Request $request, $id ) {
		$user     = User::with( 'orders' )->find( $id );
		$pathInfo = $request->getPathInfo();

		return view( 'dashboard.users.view' )->with( [
			'user' => $user,
			'pathInfo' => $pathInfo
		] );
	}
}
