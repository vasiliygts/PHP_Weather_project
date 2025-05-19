<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('subscriptions', function (Blueprint $table) {
        $table->id();
        $table->string('email');
        $table->string('city');
        $table->enum('frequency', ['daily', 'hourly']);
        $table->boolean('confirmed')->default(false);
        $table->uuid('confirmation_token')->unique();
        $table->uuid('unsubscribe_token')->unique();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
