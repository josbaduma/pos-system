<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Models\InventoryCategory|null $inventoryCategory
 * @property int    $inventory_category_id
 * @property string $week_start
 * @property string $week_end
 * @property int    $units_in
 * @property int    $units_used
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyInventory whereInventoryCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyInventory whereUnitsIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyInventory whereUnitsUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyInventory whereWeekEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyInventory whereWeekStart($value)
 *
 * @mixin \Eloquent
 */
class WeeklyInventory extends Model
{
    protected $table = 'weekly_inventory';

    protected $fillable = [
        'inventory_category_id',
        'week_start',
        'week_end',
        'units_in',
        'units_used',
    ];

    public function inventoryCategory(): BelongsTo
    {
        return $this->belongsTo(InventoryCategory::class);
    }
}
