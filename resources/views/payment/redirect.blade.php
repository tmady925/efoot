<!-- resources/views/payment/redirect.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Redirection vers CinetPay</title>
</head>
<body>
    <h2>Redirection vers la page de paiement...</h2>
    {!! $paymentForm !!}
    <script>
        document.forms['cinetpay_form'].submit();
    </script>
</body>
</html>
