<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int                             $id
 * @property int                             $table_id
 * @property string                          $name
 * @property string                          $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereUpdatedAt($value)
 * @property int $active
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereActive($value)
 * @mixin \Eloquent
 */
class SubAccount extends Model
{
    protected $table = 'sub_accounts';
}
