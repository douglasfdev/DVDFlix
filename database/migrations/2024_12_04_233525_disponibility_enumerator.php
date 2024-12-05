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
        Schema::create('disponibility_enumerator', function (Blueprint $table) {
            $table->unsignedTinyInteger('id')->autoIncrement();
            $table->string('status')->default(Disponibility::AVAILABLE->label())->comment('The disponibility status of the DVD');
            $table->timestamps();
            $table->softDeletes();
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

        Schema::dropIfExists('disponibility_enumerator');
    }
};
