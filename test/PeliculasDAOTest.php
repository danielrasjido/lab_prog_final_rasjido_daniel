<?php

use app\core\model\dao\PeliculasDAO;
use app\libs\database\Connection;

try{
    $dao = new PeliculasDAO(Connection::get());
}catch(\Exception $ex){
    print_r("<p>" . $ex->getMessage() . "</p>");
}