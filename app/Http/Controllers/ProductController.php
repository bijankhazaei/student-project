<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function session;

class ProductController extends Controller {

	public function __construct() {
		$this->middleware( 'auth' )->except( 'index' );
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function store( Request $request ) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 *
	 * @return Application|Factory|View
	 */
	public function show( $id ) {
		$product      = Product::find( $id );
		$cart         = session()->get( 'cart' );
		$cartQuantity = 0;
		if ( $cart ) {
			foreach ( $cart as $item ) {
				$cartQuantity += $item['quantity'];
			}
		}

		return view( 'products.single' )->with( [
			'product' => $product,
			'cartQuantity' => $cartQuantity
		] );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function edit( $id ) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param int $id
	 *
	 * @return Response
	 */
	public function update( Request $request, $id ) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 *
	 * @return Response
	 */
	public function destroy( $id ) {
		//
	}

	/**
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 */
	public function addToCart( Request $request, $id ) {
		$cart = session()->get( 'cart' );

		$cart[ $id ]['quantity'] = $request->quantity;

		session()->put( 'cart', $cart );
		session()->flash( 'cart-message', 'Cart Updated' );

		return redirect( 'product/' . $id );
	}

	public function removeFromCart( $id ) {
		$cart = Session::get( 'cart' );

		foreach ( $cart as $key => $item ) {
			if ( $key == $id ) {
				unset( $cart[ $key ] );
			}
		}

		Session::put( 'cart', $cart );

		return redirect( 'cart' );
	}
}
