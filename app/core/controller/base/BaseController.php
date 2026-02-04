<?php

namespace app\core\controller\base;

use app\libs\http\Request;
use app\libs\http\Response;

class BaseController{
    protected $view, $scripts;

    public function __construct($scripts = [])
    {
        $this->view = "";
        $this->scripts = $scripts;
    }

    public function setCurrentView(Request $request): void
    {
        $this->view = $request->getController() . "/" . $request->getAction() . ".php";
    }

}