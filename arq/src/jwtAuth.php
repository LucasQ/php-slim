<?php

namespace src;

use Tuupola\Middleware\JwtAuthentication;

function jwtAuth(): JwtAuthentication
{
    return new JwtAuthentication([ //verifica se o token é válido
        "secret" => getenv("JWT_SECRET_KEY"),
        "attribute" => 'jwt'
    ]);
}