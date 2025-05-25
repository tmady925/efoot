<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec l'utilisateur
            $table->string('transaction_id')->unique(); // ID de la transaction (de CinetPay)
            $table->string('payment_method')->nullable(); // Exemple: wave, orange_money, free
            $table->integer('amount'); // Montant du paiement
            $table->string('status')->default('PENDING'); // PENDING, SUCCESS, FAILED
            $table->text('response')->nullable(); // JSON brut ou data complète de réponse
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
        Schema::dropIfExists('payments');
    }
};
