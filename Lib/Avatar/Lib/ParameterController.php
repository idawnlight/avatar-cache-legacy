<?php

namespace Avatar\Lib;

class ParameterController extends \X\Controller
{

    public function size($data, $default = 100) {
        if (isset($data->route->size) && $data->route->size !== "" && $data->route->size !== NULL) {
            $size = $data->route->size;
        } else if (isset($data->get->s) && $data->get->s !== "" && $data->get->s !== NULL) {
            $size = $data->get->s;
        } else {
            $size = $default;
        }

        return $size;
    }

    public function gravatar($data) {
        if (isset($data->get->d) && $data->get->d !== "" && $data->get->d !== NULL) {
            $d = $data->get->d;
        } else {
            $d = NULL;
        }
        if (isset($data->get->r) && $data->get->r !== "" && $data->get->r !== NULL) {
            $r = $data->get->r;
        } else {
            $r = NULL;
        }

        $option = "d=$d&r=$r";
        
        return $option;
    }

}