<?php

use App\Http\Enums\Disponibility;
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
        Schema::create('dvds', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('The title of the DVD');
            $table->string('genre')->comment('The genre of the DVD');
            $table->tinyInteger('disponibility')
                ->unsigned()
                ->default(Disponibility::AVAILABLE->value())
                ->comment('The disponibility status of the DVD');
            $table->foreign('disponibility')
                ->references('id')
                ->on('disponibility_enumerator')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('price', false, true)->comment('The price of the DVD');
            $table->string('description');
            $table->string('image');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['id', 'title', 'disponibility']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dvds', function (Blueprint $table) {
            $table->dropForeign(['disponibility']);
            $table->dropIndex(['id', 'title', 'disponibility']);
        });

        Schema::dropIfExists('dvds');
    }
};
