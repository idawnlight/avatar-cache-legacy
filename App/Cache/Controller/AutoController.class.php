<?php

namespace Controller\Cache;

class AutoController extends \X\Controller {

    public function index($req) {
        ob_start();
        $mail = $req->data->route->mail;

        $parameter = $this->app->boot("\Avatar\Lib\ParameterController");
        $response = $this->app->boot("\Avatar\Lib\ResponseController");

        $size = $parameter->size($req->data);
		
		if (strpos($mail, "@qq.com")) {
			$qq = explode("@qq.com", $mail)[0];
			$response->location("https://avatar.dawnlab.me/qq/". $qq . "?s=" . $size);
		} else {
			$response->location("https://avatar.dawnlab.me/gravatar/". md5($mail) . "?s=" . $size);
		}
    }

}
