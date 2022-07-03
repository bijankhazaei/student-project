<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int|mixed $total
 * @property mixed $user_id
 * @property int|mixed $status
 */
class Order extends Model {
	use HasFactory;

	protected $table = 'orders';

	protected $fillable = [
		'total',
		'user_id',
		'status',
	];

	public function user() {
		return $this->belongsTo( User::class, 'user_id', 'id' );
	}

	public function products(): BelongsToMany {
		return $this->belongsToMany( Product::class )->withPivot( 'price', 'quantity' )->withTimestamps();
	}
}
