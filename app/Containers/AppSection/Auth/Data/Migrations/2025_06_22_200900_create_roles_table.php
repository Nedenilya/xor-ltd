<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Schema::create('roles', static function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name')->unique();
        //     $table->string('guard_name');
        //     $table->timestamps();
        // });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
}; 