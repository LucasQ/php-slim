<?php

namespace App\Controllers;

use App\Exceptions\MyException;
use Exception;
use InvalidArgumentException;
use Throwable;
use Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Http\Response as Response;

class ExceptionController
{
    public function test(Request $req, Response $res, array $args): Response
    {
        try {
            // throw new Exception("Mensagem de erro.");
            // throw new InvalidArgumentException("Faltou envio de senha.");
            throw new MyException("Testando custom exception");
            return $res->withJson(['msg' => 'ok']);
        } catch(MyException $e) {
            return $res->withJson([
                'error' => MyException::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'Testando o MyException...',
                'customFunction' => $e->customFunction(),
                'trace' => $e->getMessage()
            ], 400);
        } catch(InvalidArgumentException $e) {
            return $res->withJson([
                'error' => InvalidArgumentException::class,
                'status' => 400,
                'code' => '002',
                'userMessage' => 'É necessário enviar todos os dados para efetuar o login.',
                'trace' => $e->getMessage()
            ], 400);
        } catch(Exception | Throwable $e) { // Throwable é erro de codigo
            return $res->withJson([
                'error' => Exception::class,
                'status' => 500,
                'code' => '001',
                'userMessage' => 'Erro na aplicação, entre em contato com o administrador do sistema',
                'trace' => $e->getMessage()
            ], 500);
        }
    }
}