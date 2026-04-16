<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int                             $id
 * @property int|null                        $inventory_category_id
 * @property int                             $category_id
 * @property string                          $name
 * @property string                          $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int                             $is_active
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\InventoryCategory|null $inventoryCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereInventoryCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Product extends Model
{
    public $fillable = [
        'category_id',
        'inventory_category_id',
        'name',
        'price',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function inventoryCategory(): BelongsTo
    {
        return $this->belongsTo(InventoryCategory::class);
    }
}
