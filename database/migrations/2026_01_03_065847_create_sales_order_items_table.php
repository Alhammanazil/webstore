<?php

use App\Models\SalesOrder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SalesOrder::class)->constrained('sales_orders')->onDelete('cascade');

            $table->string('name');
            $table->integer('short_dec');
            $table->integer('sku');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('cover_url');
            $table->integer('quantity');
            $table->decimal('price', 11, 2);
            $table->decimal('total', 11, 2);
            $table->integer('weight');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_order_items');
    }
};
