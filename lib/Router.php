<?php 

namespace lib;

class Router {

    protected $routers = array (
        'site' => 'site',
        'admin' => 'admin'
    );

    protected $routerOnRaiz = 'site';

    protected $onRaiz = true;

}