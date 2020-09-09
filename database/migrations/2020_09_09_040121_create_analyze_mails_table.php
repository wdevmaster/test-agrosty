<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalyzeMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analyze_mails', function (Blueprint $table) {
            $table->foreignId('mail_id')->unique()->constrained('mails')->onDelete('cascade');
            $table->longText('format_body')->nullable();
            $table->integer('num_words')->default(0);
            $table->integer('num_spam_words')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analyze_mails');
    }
}
