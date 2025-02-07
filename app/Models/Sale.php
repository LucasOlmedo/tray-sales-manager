<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \App\Models\Sale findOrNew(?int $id)
 *
 * @property int $id
 * @property ?int $seller_id
 * @property float $amount
 * @property string $date
 * @property float $applied_commission
 *
 * @property Seller $seller
 */
class Sale extends Model
{
    protected $fillable = [
        'seller_id',
        'amount',
        'date',
        'applied_commission',
    ];

    /**
     * @return BelongsTo<Seller, covariant Sale>
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
