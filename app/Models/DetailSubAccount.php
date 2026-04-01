<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int                             $id
 * @property int                             $sub_accounts_id
 * @property int                             $product_id
 * @property int                             $quantity
 * @property string                          $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount whereSubAccountsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount whereUpdatedAt($value)
 *
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\SubAccount|null $subAccount
 *
 * @mixin \Eloquent
 */
class DetailSubAccount extends Model
{
    protected $fillable = ['sub_accounts_id', 'product_id', 'quantity', 'subtotal'];

    public function subAccount(): BelongsTo
    {
        return $this->belongsTo(SubAccount::class);
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
