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
        Schema::create('costumes', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("job");
            $table->string("img");
            $table->decimal("price", 8, 2);
            $table->unsignedBigInteger("region_id");
            $table->timestamps();

            $table->foreign("region_id")->references("id")->on("regions")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costumes');
    }
};
