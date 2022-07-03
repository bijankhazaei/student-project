<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller {
	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function index() {
		$cart = Session::get( 'cart' );

		$cartArray = [];
		$total     = 0;
		if ( is_array( $cart ) ) {
			foreach ( $cart as $key => $item ) {
				$product     = Product::find( $key );
				$cartArray[] = [
					'id' => $product->id,
					'name' => $product->name,
					'image' => $product->image,
					'price' => $product->price,
					'quantity' => $item['quantity'] ?? 0
				];

				$total += $product->price;
			}
		}

		return view( 'cart.list' )->with( [
			'cartArray' => $cartArray,
			'total' => $total
		] );
	}

	public function checkout() {
		$user = Auth::user();

		$cart = Session::get( 'cart' );

		$order = new Order();

		$syncArray = [];
		$total     = 0;
		foreach ( $cart as $key => $item ) {
			$product         = Product::find( $key );
			$currentQuantity = $product->quantity;
			if ( $currentQuantity > $item['quantity'] ) {
				$product->quantity = $currentQuantity - $item['quantity'];
				$product->save();
				$syncArray[ $key ] = [
					'price' => $product->price,
					'quantity' => $item['quantity'] ?? 0
				];

				$total += $product->price;
			}
		}

		$order->total   = $total;
		$order->user_id = $user->id;
		$order->status  = 1;

		$order->save();

		$order->products()->sync( $syncArray );

		Session::flash( 'cart' );

		Session::flash( 'order-submitted', 'Your Order has been submitted' );

		return redirect( 'order/' . $order->id );
	}
}
