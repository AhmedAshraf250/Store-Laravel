<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('parent_id');
            $table->foreignId('parent_id')->nullable()->constrained('categories', 'id')
                // ->restrictOnDelete()
                // ->cascadeOnDelete()
                // ->cascadeOnUpdate()
                ->nullOnDelete(); // foreignId just make unsignedBigInteger column only
            // if there an column foreign key to other column (relations) .. must these columns be same type

            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'archived']);
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
        Schema::dropIfExists('categories');
    }
};
