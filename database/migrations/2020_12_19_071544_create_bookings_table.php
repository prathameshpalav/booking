<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('booking_id', 30)->unique();
            $table->foreignId('show_id')->constrained('shows');
            $table->smallInteger('no_of_tickets')->default(1);
            $table->unsignedDecimal('total_amount', 8, 2); 
            $table->enum('booking_status', ['pending', 'confirmed', 'cancelled'])->default('pending'); 
            $table->datetime('cancelled_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
