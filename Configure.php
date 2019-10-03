<?php
date_default_timezone_set('Asia/Shanghai');

    $configure = [
        "Node"    => "hongkong.0",
        "Avatar_Version" => "3.0.1",
        "SysDir"  => SysDir,
        "Path"    => [
            "Route"       => "Var/Route/",
            "Application" => "App/",
            "Template"    => "Var/Template/",
            "Cache"       => "Var/Cache/",
            "Resource"    => "Resource/",
            "Log"         => [
                "Info"      => "Var/Log/info.log",
                "Error"     => "Var/Log/error.log"
            ],
            "Language"    => "Var/Lang/"
        ], 
        "View"    => [
            "Start"    => "{{",
            "End"      => "}}",
            "ExtName"  => ".tpl",
            "Template" => "default",
            "Cache"    => false
        ],
        "Database"=> [
            'connection_string' => 'mysql:host=127.0.0.1;dbname=avatar;charset=utf8', //DSN
            'driver_options'    => array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'), //PDO Option
            'username'          => '', //用户名 username
            'password'          => '', //密码 password
            'logging'           => true, //开启Query日志 Enable Query Log
            'caching'           => true, //开启缓存 Enalble Cache
            'caching_auto_clear'=> true //自动清理缓存 Auto Clear Cache
        ],
        "Route"   => [
            "Base"     => ""
        ],
        "Language"=> "zh_cn",
        "Version" => X,
        "Debug"   => true
    ];

    return $configure;
