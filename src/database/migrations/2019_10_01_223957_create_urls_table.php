<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Contracts\Source\AllInterface;
use App\Contracts\Source\Table\NamesInterface as TableNameInterface;

class CreateUrlsTable extends Migration
{
    private const TABLE_NAME = TableNameInterface::URLS;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url',AllInterface::MAX_URL_LENGTH)->unique();
            $table->string('code')->nullable()->unique();
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
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
