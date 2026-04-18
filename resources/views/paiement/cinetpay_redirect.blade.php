<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Redirection vers CinetPay...</title>
</head>
<body onload="document.forms['cinetpay_form'].submit()">
    <p>Redirection vers CinetPay, veuillez patienter...</p>

    <form name="cinetpay_form" method="POST" action="https://checkout.cinetpay.com">
        <input type="hidden" name="apikey" value="{{ env('CINETPAY_API_KEY') }}">
        <input type="hidden" name="site_id" value="{{ env('CINETPAY_SITE_ID') }}">
        <input type="hidden" name="transaction_id" value="{{ $transaction_id }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="currency" value="XAF">
        <input type="hidden" name="description" value="Paiement facture #{{ $facture->numero_facture }}">
        <input type="hidden" name="return_url" value="{{ route('paiement.retour') }}">
        <input type="hidden" name="notify_url" value="{{ route('paiement.notification') }}">
        <input type="hidden" name="customer_name" value="{{ $client_name }}">
        <input type="hidden" name="customer_email" value="{{ $client_email }}">
    </form>
</body>
</html>
