<?php

namespace src;

use App\DAO\MySQL\GerenciadorLojas\LojasDAO;

function slimConfiguration(): \Slim\Container
{
    $configuration = [
        'settings' => [
            'displayErrorDetails' => true,
        ],
    ];
    $container = new \Slim\Container($configuration);
    // toda vez que essa string é chamada, invoca o new LojasDAO()
    $container->offsetSet(LojasDAO::class, new LojasDAO());

    return $container;
}
