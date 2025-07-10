<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int                             $id
 * @property int                             $table_id
 * @property string                          $name
 * @property string                          $total
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereUpdatedAt($value)
 *
 * @property int $active
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubAccount whereActive($value)
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DetailSubAccount> $details
 * @property-read int|null $details_count
 *
 * @mixin \Eloquent
 */
class SubAccount extends Model
{
    protected $table = 'sub_accounts';

    protected $fillable = [
        'table_id',
        'name',
        'total',
        'active',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(DetailSubAccount::class, 'sub_accounts_id', 'id');
    }
}
