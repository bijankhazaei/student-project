<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CretaeOrdersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'orders', function ( Blueprint $table ) {
			$table->id();
			$table->unsignedBigInteger( 'total' );
			$table->unsignedBigInteger( 'user_id' );
			$table->unsignedBigInteger( 'status' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'orders' );
	}
}
