<?php

namespace App\Helper;

class PasswordResetToken
{
    private $tokenLength;
    private $token;
    private $hashedToken;
    private $expiry;

    public function __construct($tokenLength = 64, $expireAfter = 60 * 60)
    {
        $this->tokenLength = $tokenLength;
        $this->token = bin2hex(random_bytes($this->tokenLength));
        $this->hashedToken = hash("sha256", $this->token);
        $this->expiry = date("Y-m-d H:i:s", time() + $expireAfter);
    }

    public function getToken()
    {
        return $this->token;
    }


    public function getTokenHash()
    {
        return $this->hashedToken;
    }

    public function getExpiry()
    {
        return $this->expiry;
    }

    public function verifyHashedToken($hashedToken)
    {
        return hash("sha256", $this->token) === $hashedToken;
    }
}
