<?php

namespace app;

use app\libs\pipeline\Pipeline;
use app\libs\pipeline\middlewares\ExceptionHandlerMiddleware;
use app\libs\pipeline\middlewares\RouterHandlerMiddleware;
use app\libs\pipeline\middlewares\AuthenticationMiddleware;
use app\libs\http\Request;
use app\libs\http\Response;

final class app{
    
    private function __construct()
    {
       
    }

    public static function run(){
        $pipeline = new Pipeline();
        
        $pipeline
        ->pipe(new ExceptionHandlerMiddleware())
        ->pipe(new AuthenticationMiddleware())
        ->pipe(new RouterHandlerMiddleware());

        $pipeline->process(new Request(), new Response());
    }

}