<?php

namespace Avatar\Middleware;

class Handle extends \X\Middleware {

    public function handle($event, \X\Request $request){

        $config = $this->app->config;

        //header("Server: Microsoft-IIS/8.0");
        //header("X-AspNet-Version: 4.0.30319");
        //header("X-AspNetMvc-Version: 4.0");
        //header("X-Powered-By: ASP.NET");
        header("X-Mixcm-Node: " . $config["Node"]);

    }

    public function response($event, \X\Response $response){

        $response->header([
            //"x-xphp-version" => "xphp/" . X,
            //"x-time"         => date('Y-m-d h:i:s')
        ]);

    }

}