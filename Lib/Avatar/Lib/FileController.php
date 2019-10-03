<?php

namespace Avatar\Lib;

class FileController extends \X\Controller
{
    public function write($content) {
        $hash = hash("sha256", $content);
        return file_put_contents($this->app->config['SysDir'] . $this->app->config['Path']['Resource'] . $hash, $content);
    }

    public function get($hash) {
        return file_get_contents($this->app->config['SysDir'] . $this->app->config['Path']['Resource'] . $hash);
    }
}