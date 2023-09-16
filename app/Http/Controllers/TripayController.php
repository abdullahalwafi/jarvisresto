<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TripayController extends Controller
{

    public function getMetode()
    {
        if (env('TRIPAY_SANDBOX') == 'true') {
            $apiKey = env('TRIPAY_API_KEY_SANDBOX');
            $urlkey = env('TRIPAY_CHANNEL_URL_SANDBOX');
        } else {
            $apiKey = env('TRIPAY_API_KEY');
            $urlkey = env('TRIPAY_CHANNEL_URL');
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $urlkey,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response)->data;
        // dd($response);
        return empty($error) ? $response : $error;
    }
    public function requestTransaksi($orderItems, $metode, $invoice, $total, $pemesan)
    {
        $key[] = "";
        if (env('TRIPAY_SANDBOX') == 'true') {
            $key['api'] = env('TRIPAY_API_KEY_SANDBOX');
            $key['private'] = env('TRIPAY_PRIVATE_KEY_SANDBOX');
            $key['url'] = env('TRIPAY_TRANSAKSI_URL_SANDBOX');
            $key['merchant'] = env('TRIPAY_MERCHANT_CODE_SANDBOX');
        } else {
            $key['api'] = env('TRIPAY_API_KEY');
            $key['private'] = env('TRIPAY_PRIVATE_KEY');
            $key['url'] = env('TRIPAY_TRANSAKSI_URL');
            $key['merchant'] = env('TRIPAY_MERCHANT_CODE');
        }
        $apiKey       = $key['api'];
        $privateKey   = $key['private'];
        $merchantCode = $key['merchant'];
        $merchantRef  = $invoice;
        $amount       = $total;
        $data = [
            'method'         => $metode,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $pemesan['nama'],
            'customer_email' => 'user@user.com',
            'customer_phone' => $pemesan['no_hp'],
            'order_items'    => $orderItems,
            'return_url'   => url('/'),
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];
        // dd($data);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $key['url'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response)->data;

        return empty($error) ? $response : $error;
    }
}
