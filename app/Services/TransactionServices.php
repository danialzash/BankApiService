<?php

namespace App\Services;


use App\Events\TransactionSuccessEvent;
use App\Models\Card;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class TransactionServices
{

    public string $amount;
    public string $fromCard;
    public string $toCard;
    public function __construct(string $amount, string $fromCard, string $toCard)
    {
        $this->amount = $amount;
        $this->fromCard = $fromCard;
        $this->toCard = $toCard;
    }

    public function record(): JsonResponse
    {
        return DB::transaction(function () {

            $fromCard = Card::where('card_number', $this->fromCard)->firstOrFail();
            $toCard = Card::where('card_number', $this->toCard)->firstOrFail();
            $amountNet = (float) $this->amount;
            $amountWithConstantFee = $amountNet + config('transaction.constant_fee');

            if ($fromCard->account->balance < $amountWithConstantFee) {
                return response()->json(['message' => 'Insufficient funds'], 422);
            }

            $transaction = new Transaction([
                'from_card' => $fromCard->id,
                'to_card' => $toCard->id,
                'amount' => $amountNet,
            ]);

            $fromCard->account->balance -= $amountWithConstantFee;
            $toCard->account->balance += $amountNet;

            $transaction->save();
            $fromCard->account->save();
            $toCard->account->save();

            event(new TransactionSuccessEvent($transaction));

            return response()->json(['message' => 'Transaction created successfully'], 201);
        }, 5);
    }}
