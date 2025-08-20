<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int                             $id
 * @property int                             $customer_id
 * @property int                             $waiter_id
 * @property string                          $sub_total
 * @property string                          $discount
 * @property string                          $taxes
 * @property string                          $total
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
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int                             $id
 * @property string                          $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereUpdatedAt($value)
 * @property int $is_active
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Category whereIsActive($value)
 * @mixin \Eloquent
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int                             $id
 * @property int                             $sub_accounts_id
 * @property int                             $product_id
 * @property int                             $quantity
 * @property string                          $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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
 * @property-read \App\Models\Product|null $product
 * @property-read \App\Models\SubAccount|null $subAccount
 * @property int|null $food_id
 * @property-read \App\Models\Food|null $food
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailSubAccount whereFoodId($value)
 * @mixin \Eloquent
 */
	class DetailSubAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int                             $id
 * @property string                          $name
 * @property string|null                     $unit
 * @property string|null                     $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Food whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Food extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int                             $id
 * @property int                             $food_id
 * @property int                             $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inventory whereFoodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inventory whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Inventory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Inventory extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int                             $id
 * @property int                             $category_id
 * @property string                          $name
 * @property string                          $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @property int $is_active
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereIsActive($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Food> $foods
 * @property-read int|null $foods_count
 * @property-read \App\Models\Inventory|null $inventory
 * @mixin \Eloquent
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int                             $id
 * @property string                          $name
 * @property string|null                     $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DetailSubAccount> $details
 * @property-read int|null $details_count
 * @mixin \Eloquent
 */
	class SubAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int                             $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereUpdatedAt($value)
 * @property string $status
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubAccount> $subAccounts
 * @property-read int|null $sub_accounts_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Table whereStatus($value)
 * @mixin \Eloquent
 */
	class Table extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int                             $id
 * @property string                          $name
 * @property string                          $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string                          $password
 * @property string|null                     $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string                          $role
 * @property string|null                     $phone
 * @property string|null                     $address
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory                    factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

