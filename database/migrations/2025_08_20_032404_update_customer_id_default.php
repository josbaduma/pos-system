<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateCustomerIdDefault extends Migration
{
    public function up(): void
    {
        // Buscar o crear un usuario con el rol de "customer"
        $defaultCustomer = DB::table('users')->where('role', 'customer')->where('name', 'Cliente Predeterminado')->first();

        if (! $defaultCustomer) {
            $defaultCustomerId = DB::table('users')->insertGetId([
                'name' => 'Cliente Predeterminado',
                'email' => 'default_customer@example.com',
                'password' => bcrypt('password'),
                'role' => 'customer',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $defaultCustomerId = $defaultCustomer->id;
        }

        // Modificar la columna customer_id para que tenga un valor predeterminado
        Schema::table('accounts', function (Blueprint $table) use ($defaultCustomerId) {
            $table->unsignedBigInteger('customer_id')->default($defaultCustomerId)->change();
        });
    }

    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable(false)->default(null)->change();
        });

        // Eliminar el usuario predeterminado si existe
        DB::table('users')->where('email', 'default_customer@example.com')->delete();
    }
}
