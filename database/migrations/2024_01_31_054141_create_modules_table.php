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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained('menus');
            $table->enum('type',['1','2'])->comment("1=divider,2=module");
            $table->string('module_name')->nullable();
            $table->string('divider_title')->nullable();
            $table->string('icon_class')->nullable();
            $table->string('url')->unique();
            $table->integer('order')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->enum('target',['_self','_blank'])->default("_self");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
