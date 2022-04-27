<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_operations', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id');
            $table->enum('type', ['increment', 'decrement']);
            $table->integer('sum');
            $table->text('reason');
            $table->timestamp('executed_at')->default(now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_operations');
    }
}
