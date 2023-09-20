<?php

namespace App\Enums;

enum TransactionType: string
{
    case DEPOSIT = 'deposit';
    case BALANCE = 'balance';
    case REFUND = 'refund';
    case FULL = 'full';
}
