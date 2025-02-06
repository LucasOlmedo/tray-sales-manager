<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \App\Models\Sale findOrNew(?int $id)
 *
 * @property int $id
 * @property ?int $seller_id
 * @property float $amount
 * @property string $date
 * @property float $applied_commission
 */
class Sale extends Model
{
    protected $fillable = [
        'seller_id',
        'amount',
        'date',
        'applied_commission',
    ];
}
