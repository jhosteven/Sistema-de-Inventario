<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('cliente');
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('producto_venta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad');
            $table->decimal('subtotal', 10, 2);

            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('producto_venta');
        Schema::dropIfExists('ventas');
    }
};
