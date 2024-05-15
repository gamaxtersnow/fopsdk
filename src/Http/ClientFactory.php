<?php

namespace fop\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;

class ClientFactory
{
    protected $httpClient;
    public static function create(string $baseUrl,Config $config): ClientInterface
    {
        $stack = HandlerStack::create();
        $stack->push(FopMiddleware::post());
        $stack->push(FopMiddleware::sign($config));
        $stack->push(FopMiddleware::encrypt($config));
        $stack->push(FopMiddleware::retry());
        $stack->push(FopMiddleware::response($config));
        return new Client(['base_uri' => $baseUrl,'handler' => $stack]);
    }
}
