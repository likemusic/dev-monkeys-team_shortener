<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\Source\Table\NamesInterface as TableNameInterface;

class CreateVisitorsTable extends Migration
{
    private const TABLE_NAME = TableNameInterface::VISITORS;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('url_id');
            $table->ipAddress('ip')->nullable();
            $table->string('region')->nullable();
            $table->string('browser_name')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('platform')->nullable();
            $table->timestamps();

            $table->foreign('url_id')
                ->references('id')
                ->on(TableNameInterface::URLS)
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
