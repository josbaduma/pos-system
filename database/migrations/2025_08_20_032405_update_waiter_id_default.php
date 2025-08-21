<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateWaiterIdDefault extends Migration
{
    public function up(): void
    {
        // Buscar o crear un usuario con el rol de "waiter"
        $defaultWaiter = DB::table('users')->where('role', 'waiter')->first();

        if (! $defaultWaiter) {
            $defaultWaiterId = DB::table('users')->insertGetId([
                'name' => 'Mesero Predeterminado',
                'email' => 'default_waiter@example.com',
                'password' => bcrypt('password'), // Contraseña genérica
                'role' => 'waiter',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $defaultWaiterId = $defaultWaiter->id;
        }

        // Modificar la columna waiter_id para que tenga un valor predeterminado
        Schema::table('accounts', function (Blueprint $table) use ($defaultWaiterId) {
            $table->unsignedBigInteger('waiter_id')->default($defaultWaiterId)->change();
        });
    }

    public function down(): void
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('waiter_id')->nullable(false)->default(null)->change();
        });

        // Eliminar el usuario predeterminado si existe
        DB::table('users')->where('email', 'default_waiter@example.com')->delete();
    }
}
