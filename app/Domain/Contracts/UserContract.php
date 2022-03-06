<?php

namespace App\Domain\Contracts;

interface UserContract
{

    public const TABLE   = 'users';

    public const NAME = 'name';
    public const SURNAME = 'surname';
    public const EMAIL = 'email';
    public const EMAIL_VERIFIED_AT = 'email_verified_at';
    public const PHONE = 'phone';
    public const PASSWORD = 'password';
    public const REMEMBER_TOKEN = 'remember_token';

}
