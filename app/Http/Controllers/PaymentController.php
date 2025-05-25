<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Str;
use CinetPay\CinetPay;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('payment.form');
    }

    public function initiatePayment(Request $request)
    {
        $transaction_id = Str::uuid()->toString();

        // Stocke la méthode sélectionnée dans la DB
        Payment::create([
            'user_id' => Auth::id(),
            'transaction_id' => $transaction_id,
            'payment_method' => $request->payment_method,
            'status' => false
        ]);

        // Prépare le paiement avec CinetPay
        $cp = new CinetPay(env('CINETPAY_SITE_ID'), env('CINETPAY_API_KEY'));
        $cp->setTransId($transaction_id);
        $cp->setTransDate(Carbon::now()->format('Y-m-d H:i:s'));
        $cp->setDesignation("Inscription tournoi");
        $cp->setAmount(2000); // Montant en FCFA
        $cp->setCurrency("XOF");
        $cp->setReturnUrl(route('payment.callback'));
        $cp->setNotifyUrl(route('payment.callback'));
        $cp->setCustom($request->payment_method); // On encode ici la méthode de paiement (ou autre info)

        // Génère le bouton de paiement
        $paymentForm = $cp->getPayButton('cinetpay_form');

        return view('payment.redirect', compact('paymentForm'));
    }

    public function callback(Request $request)
    {
        $transaction_id = $request->get('cpm_trans_id');

        $cp = new CinetPay(env('CINETPAY_SITE_ID'), env('CINETPAY_API_KEY'));
        $cp->setTransId($transaction_id);

        try {
            $cp->getPayStatus(); // ✅ méthode correcte dans le SDK

            if ($cp->isValidPayment()) {
                $payment = Payment::where('transaction_id', $transaction_id)->first();

                if ($payment && !$payment->status) {
                    $payment->status = true;
                    $payment->save();

                    $user = $payment->user;
                    $user->is_paid = true;
                    $user->save();
                }

                return redirect()->route('dashboard')->with('success', 'Paiement confirmé ✅');
            }

            return redirect()->route('payment.form')->with('error', 'Paiement non confirmé.');
        } catch (\Exception $e) {
            return redirect()->route('payment.form')->with('error', 'Erreur lors du traitement du paiement: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return redirect()->route('dashboard')->with('success', 'Paiement effectué avec succès ✅');
    }
}
