<?php

namespace App\Domain\Contracts;

interface OrderContract
{

    public const TABLE = 'orders';

    public const USER_ID = 'user_id';
    public const NAME = 'name';
    public const SURNAME = 'surname';
    public const EMAIL = 'email';
    public const PHONE = 'phone';
    public const COMMENT = 'comment';
    public const STREET = 'street';
    public const HOME = 'home';
    public const APARTMENT = 'apartment';
    public const ENTRANCE = 'entrance';
    public const FLOOR = 'floor';
    public const OFFICE = 'office';
    public const STATUS = 'status';
    public const PAYMENT_ID = 'payment_id';
    public const PAYMENT_STATUS = 'payment_status';
    public const SUM = 'sum';
}
