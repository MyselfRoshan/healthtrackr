<?php

namespace App\Helper;


class Token
{
    /**
     * Generate Access Token
     * @method generateAccessToken
     * @param array $payload Elements to be encoded
     *
     * @return string Access Token
     */
    public static function generateAccessToken($payload)
    {
        $token = Token::generateToken($payload, ACCESS_TOKEN_EXPIRES_AFTER, ACCESS_TOKEN_SECRET);
        return $token;
    }

    /**
     * Verify access token
     * @method verifyAccessToken
     * @param string $token Token to be verified
     * @return int 1 Signature does not match
     * @return int 2 Token is expired
     * @return array Payload and verified status encoded in the passed token
     */
    public static function verifyAccessToken($token)
    {
        $result = Token::verifyToken($token, ACCESS_TOKEN_SECRET);
        return $result;
    }

    /**
     * Generate Refresh Token
     * @method generateRefreshToken
     * @param array $payload Elements to be encoded
     *
     * @return string Refresh Token
     */
    public static function generateRefreshToken($payload)
    {
        $token = Token::generateToken($payload, REFRESH_TOKEN_EXPIRES_AFTER, REFRESH_TOKEN_SECRET);
        return $token;
    }

    /**
     * Verify refresh token
     * @method verifyRefreshToken
     * @param string $token Token to be verified
     * @return int 1 Signature does not match
     * @return int 2 Token is expired
     * @return array Payload and verified status encoded in the passed token
     */
    public static function verifyRefreshToken($token)
    {
        $result = Token::verifyToken($token, REFRESH_TOKEN_SECRET);
        return $result;
    }

    /**
     * Generate a token similar to JWT token
     * @method generateToken
     * @param array $payload Elements to be encoded
     * @param string $key Secret key used to generate and verify token
     * @param int $expire (optional) Token expiry time in seconds
     *
     * @return string Token generated using $payload, $key and $expire
     */
    private static function generateToken($payload, $expire, $key)
    {
        //Header
        $header = [
            'algo' => 'HS256',
            'type' => 'HWT'
        ];
        if ($expire != null && $expire != "") $header['expire'] = time() + $expire;
        $header_encoded = base64_encode(json_encode($header));
        $header_wo_equal = str_replace("=", "", $header_encoded);

        //Payload
        $payload_encoded = base64_encode(json_encode($payload));
        $payload_wo_equal = str_replace("=", "", $payload_encoded);

        //Signature
        $signature = hash_hmac('SHA256', $header_wo_equal . $payload_wo_equal, $key);
        $signature_encoded = base64_encode($signature);
        $signature_wo_equal = str_replace("=", "", $signature_encoded);

        $token = $header_wo_equal . '.' . $payload_wo_equal . '.' . $signature_wo_equal;
        return $token;
    }

    /**
     * Verify the token generated using Token::GenerateToken
     * @method verifyToken
     * @param string $token Token to be verified
     * @param string $key Secret key used to generate and verify token
     * @return int 1 Signature does not match
     * @return int 2 Token is expired
     * @return array Payload and verified status encoded in the passed token
     */
    private static function verifyToken($token, $key)
    {
        // Explode the provided token into an array of header, payload and signature
        $token_parts = explode('.', $token);

        // Generate the signature from exploded elements of provided token
        $signature = base64_encode(hash_hmac('SHA256', $token_parts[0] . $token_parts[1], $key));
        $signature_wo_equal = str_replace("=", "", $signature);

        // Compare the generated signature with signature element of exploded token
        if ($signature_wo_equal != $token_parts[2]) return 0;

        // Verify if the token is expired
        $header = json_decode(base64_decode($token_parts[0]), true);
        if (isset($header["expire"]) && $header["expire"] < time()) return 1;

        // Decode the payload obtained from exploded token
        $payload = json_decode(base64_decode($token_parts[1]), true);

        return ["verified" => true, "payload" => $payload];
    }
}
