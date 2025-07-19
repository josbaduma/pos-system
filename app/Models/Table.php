<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereUpdatedAt($value)
 *
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubAccount> $subAccounts
 * @property-read int|null $sub_accounts_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereStatus($value)
 *
 * @mixin \Eloquent
 */
class Table extends Model
{
    protected $table = 'tables';

    /**
     * @return HasMany<SubAccount>
     */
    public function subAccounts(): HasMany
    {
        return $this->hasMany(SubAccount::class);
    }
}
