<?php

use App\Models\Tour;
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
        Schema::create('plan_tours', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Tour::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date_start');
            $table->date('date_finish');
            $table->integer('seat_cnt');
            $table->string('status')->default('запланирован');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_tours');
    }
};
