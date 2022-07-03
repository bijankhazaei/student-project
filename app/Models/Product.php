<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed $name
 * @property mixed $price
 * @property mixed $description
 * @property mixed $image
 * @property mixed $quantity
 */
class Product extends Model {
	use HasFactory;

	protected $table = 'products';

	protected $fillable = [
		'name',
		'price',
		'description',
		'quantity',
		'image'
	];

	public function orders(): BelongsToMany {
		return $this->belongsToMany( Order::class )->withPivot( 'price', 'quantity' )->withTimestamps();
	}
}
