<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory_category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('inventory_category_id')
                ->nullable()
                ->after('id')
                ->constrained('inventory_category')
                ->cascadeOnDelete();
        });

        Schema::create('weekly_inventory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_category_id')->constrained('inventory_category')->cascadeOnDelete();
            $table->date('week_start');
            $table->date('week_end');
            $table->integer('units_in')->default(0);
            $table->integer('units_used')->default(0);
            $table->timestamps();

            $table->unique(['inventory_category_id', 'week_start']);
        });

        Schema::create('product_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->date('sale_date');
            $table->integer('quantity_sold');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sales');

        Schema::dropIfExists('weekly_inventory');

        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['inventory_category_id']);
            $table->dropColumn('inventory_category_id');
        });

        Schema::dropIfExists('inventory_category');
    }
};
