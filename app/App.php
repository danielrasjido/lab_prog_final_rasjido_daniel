<?php

namespace app;

use app\core\controller\AuthenticationController;
use app\libs\pipeline\Pipeline;
use app\libs\pipeline\middlewares\ExceptionHandlerMiddleware;
use app\libs\pipeline\middlewares\RouterHandlerMiddleware;
use app\libs\pipeline\middlewares\AuthenticationMiddleware;
use app\libs\http\Request;
use app\libs\http\Response;
use app\libs\pipeline\middlewares\UserSessionHandlerMiddleware;

final class app{
    
    private function __construct()
    {
       
    }

    public static function run(){
        $pipeline = new Pipeline();


        $pipeline
        ->pipe(new ExceptionHandlerMiddleware())
        ->pipe(new RouterHandlerMiddleware());

        $pipeline->process(new Request(), new Response());
    }

}