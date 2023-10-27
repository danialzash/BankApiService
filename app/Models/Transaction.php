<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/** @property int $from_card */
/** @property int $to_card */
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['from_card', 'to_card', 'amount'];

    public function fromCard(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'from_card');
    }

    public function toCard(): BelongsTo
    {
        return $this->belongsTo(Card::class, 'to_card');
    }

    public function fromUser()
    {
        return $this->fromCard->account->user();
    }

    public function toUser()
    {
        return $this->toCard->account->user();
    }
}
