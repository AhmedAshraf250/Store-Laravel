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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('store_id')->references('id')->on('stores')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->float('price')->default(0);
            $table->float('compare_price')->nullable();
            $table->json('options')->nullable();
            $table->float('rating')->default(0);
            $table->boolean('features')->default(0);
            $table->enum('status', ['active', 'draft', 'archived'])->default('active');
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('store_id');
            $table->dropConstrainedForeignId('category_id');
            $table->dropColumn('name');
            $table->dropColumn('slug');
            $table->dropColumn('description');
            $table->dropColumn('image');
            $table->dropColumn('price');
            $table->dropColumn('compare_price');
            $table->dropColumn('options');
            $table->dropColumn('rating');
            $table->dropColumn('features');
            $table->dropColumn('status');
            $table->dropSoftDeletes();
        });
    }
};
