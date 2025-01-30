<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $customer_id
 * @property int $waiter_id
 * @property string $sub_total
 * @property string $discount
 * @property string $taxes
 * @property string $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereSubTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Account whereWaiterId($value)
 * @mixin \Eloquent
 */
class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';
}
