<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TransactionType;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_ref',
        'booking_id',
        'amount',
        'type',
        'data',
        'data2',
    ];

    /**
     * Establishes a relationship with Booking.
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    /**
     * Process a refund for the transaction.
     */
    public function refund()
    {
        try {
            $response = $this->refundTransaction();

            if ($response->isSuccessful()) {
                $refundReference = $response->getTransactionReference();
                // Create a new transaction record for the refund.
            } else {
                $errorMessage = $response->getMessage();
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        }

        return response()->json([
            'message' => isset($refundReference) ? 'Refund successful' : 'Refund failed',
            'error' => isset($errorMessage) ? $errorMessage : null
        ]);
    }

    protected function refundTransaction()
    {
        return $this->getSagePayGateway()->refund([])->send();
    }


    /**
     * Capture the remaining amount for the transaction.
     */
    public function captureRemaining()
    {
        $data = json_decode($this->data2);
        $ref = "FULL-" . $this->transaction_ref;

        try {
            $response = $this->captureTransaction($data, $ref);

            if ($response->isSuccessful()) {
                $captureReference = $response->getTransactionReference();
                $this->createNewTransaction($ref, $response, $captureReference);
                return true;
            } else {
                $errorMessage = $response->getMessage();
            }
        } catch (\Exception $e) {
            // Handle the exception (if needed)
        }
        return false;
    }

    /**
     * Perform the actual capture transaction.
     */
    protected function captureTransaction($data, $ref)
    {
        return $this->getSagePayGateway()->repeatPurchase([
            'transactionReference' => $this->transaction_ref,
            'amount' => $this->booking->getPayableAmount(),
            'description' => 'Capture full amount for ' . $this->transaction_ref,
            'transactionId' => $ref,
            'relatedTransactionId' => $this->transaction_ref,
            'currency' => 'GBP',
            'VPSTxId' => $data->VPSTxId,
            'SecurityKey' => $data->SecurityKey,
            'txAuthNo' => $data->TxAuthNo,

        ])->send();
    }

    /**
     * Create a new transaction record for the capture.
     */
    protected function createNewTransaction($ref, $response, $captureReference)
    {
        $transaction = new Transaction();
        $transaction->transaction_ref = $ref;
        $transaction->booking_id = $this->booking_id;
        $transaction->amount = $this->booking->getPayableAmount();
        $transaction->type = TransactionType::FULL;
        $transaction->data = json_encode($response->getData());
        $transaction->data2 = $captureReference;
        $transaction->save();
    }

    /**
     * Retrieve the SagePay gateway.
     */
    protected function getSagePayGateway()
    {
        return \Omnipay::gateway('opayo');
    }
}
