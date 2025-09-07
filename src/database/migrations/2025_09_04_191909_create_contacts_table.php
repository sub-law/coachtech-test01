<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('first_name'); 
            $table->string('last_name');  
            $table->tinyInteger('gender'); 
            $table->string('email'); 
            $table->string('tel')->nullable(); 
            $table->string('address')->nullable(); 
            $table->string('building')->nullable(); 
            $table->text('detail')->nullable(); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
}
