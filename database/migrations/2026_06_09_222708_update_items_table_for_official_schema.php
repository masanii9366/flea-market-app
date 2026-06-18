<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateItemsTableForOfficialSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
          $table->foreignId('condition_id')->nullable()->after('user_id')->constrained()->nullOnDelete();

          $table->dropForeign(['category_id']);
          $table->dropColumn('category_id');

          $table->dropColumn('condition');
          $table->dropColumn('sold_flg');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
          $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
          $table->string('condition');
          $table->boolean('sold_flg')->default(false);

          $table->dropForeign(['condition_id']);
          $table->dropColumn('condition_id');
        });
    }
}
