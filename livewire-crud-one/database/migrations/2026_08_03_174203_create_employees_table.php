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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->unique();
            $table->string('name', 150)->nullable();
            $table->string('email', 150)->unique();
            $table->string('phone', 20);
            $table->date('joining_date')->nullable();
            $table->decimal('salary', 10, 2);
            $table->tinyInteger('gender')->default(1)->comment('1=>male,2=>female,3=>other');
            $table->string('department',50)->nullable();
            $table->string('designation',50)->nullable();
            $table->string('photo',255)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
