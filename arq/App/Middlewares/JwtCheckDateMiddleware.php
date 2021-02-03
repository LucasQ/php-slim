<?php

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response as Response;

final class JwtCheckDateMiddleware
{
    public function __invoke(Request $req, Response $res, callable $next): Response
    {
        $token = $req->getAttribute("jwt"); // payload do token

        $expiredDate = new \DateTime($token['expired_at']);
        $now = new \DateTime();

        if ($expiredDate < $now) {
            return $res->withStatus(401);
        }

        $res = $next($req, $res);
        return $res;
    }
}
