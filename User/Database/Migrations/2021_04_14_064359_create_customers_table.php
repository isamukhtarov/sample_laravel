<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('full_name')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('avatar')->default('default.png');
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('SET NULL');
            $table->text('note')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->json('contacts')->nullable();
            $table->json('email_notify_info');
            $table->json('sms_notify_info');
            $table->boolean('is_blocked')->default(false);
            $table->timestamp('last_login')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
