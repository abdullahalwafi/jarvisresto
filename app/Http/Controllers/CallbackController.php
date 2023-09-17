<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CallbackController extends Controller
{

    // Isi dengan private key anda
    protected $privateKey;

    public function __construct()
    {
        if (env('TRIPAY_SANDBOX') == 'true') {
            $keyprivate = env('TRIPAY_PRIVATE_KEY_SANDBOX');
        } else {
            $keyprivate = env('TRIPAY_PRIVATE_KEY');
        }
        $this->privateKey = $keyprivate;
    }
    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $transactionId = $data->merchant_ref;
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            $pesanan = Pesanan::where('kode_pesanan', $transactionId)->first();
            $transaction = Transaction::where('pesanan_id', $pesanan->id)
                ->where('status', '=', 'pending')
                ->first();

            if (!$transaction) {
                return Response::json([
                    'success' => false,
                    'message' => 'No transaction found or already paid: ' . $transactionId,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $transaction->update(['status' => 'success']);
                    $pesanan->update(['status' => 'success']);
                    break;

                case 'EXPIRED':
                    $transaction->update(['status' => 'cancel']);
                    $pesanan->update(['status' => 'cancel']);
                    break;

                case 'cancel':
                    $transaction->update(['status' => 'cancel']);
                    $pesanan->update(['status' => 'cancel']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            return Response::json(['success' => true]);
        }
    }
}
