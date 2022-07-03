<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {
	public function __construct() {
		$this->middleware( 'auth' );
	}

	public function viewOrder( $id ) {
		$order = Order::with( 'products' )->find( $id );

		return view( 'order.user.view' )->with( [ 'order' => $order ] );
	}
}
