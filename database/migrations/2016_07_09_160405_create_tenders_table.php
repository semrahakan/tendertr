 <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('name');
            $table->string('type');
            $table->string('date');
            $table->string('method');
            $table->string('agreement');
            $table->string('priority');
            $table->text('state');
            $table->text('details');
            $table->integer('municipality_id')->nullable()->unsigned();
            $table->integer('user_id2');
            $table->integer('updated_user_id');
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
        Schema::drop('tenders');
    }
}
