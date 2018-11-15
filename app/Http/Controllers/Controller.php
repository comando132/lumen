<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {
    public $respuesta = array('status' => 0, 'msj'=> '', 'data'=> null);
}
