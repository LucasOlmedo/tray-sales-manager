<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \App\Models\Seller findOrNew(?int $id)
 * @method static \App\Models\Seller findOrFail(?int $id)
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property float $commission_percentage
 */
class Seller extends Model
{
    protected $fillable = [
        'name',
        'email',
        'commission_percentage',
    ];
}
