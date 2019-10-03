<?php

namespace Controller\Cache;

class CacheController extends \X\Controller {

    public function qq($req){

        ob_start();
        $qq = $req->data->route->qq;

        $parameter = $this->app->boot("\Avatar\Lib\ParameterController");
        $curl = $this->app->boot("\Avatar\Lib\CurlController");
        $file = $this->app->boot("\Avatar\Lib\FileController");
        $response = $this->app->boot("\Avatar\Lib\ResponseController");

        $size = $parameter->size($req->data);
        $url = "https://q.qlogo.cn/g?b=qq&nk=$qq&s=$size";

        if (!$this->isCached($qq, $size, "qq")) {
            $response->location($url);

            $avatar = $curl->get($url);
            if (!$avatar) exit;

            $file->write($avatar["content"]);

            if (!$this->getResourceModel()->getResource($avatar["hash"])) {
                $this->getResourceModel()->addResource($avatar["hash"], $avatar["mime"]);
            }
            $this->getProfileModel()->addProfile($qq, "qq", $avatar["hash"], $size, $url, "-1", $avatar["last_modified"], time());
        } else {
            $profile = $this->getProfileModel()->getProfile($qq, $size, "qq");
            $resource = $this->getResourceModel()->getResource($profile->hash);
            $age = time() - (int)$profile->last_update;

            if (!$response->etag($req->data->server, md5(base64_encode($profile->hash))))  {
                $content = $file->get($profile->hash);
                $response->ret($content, $resource->mime, $profile->last_modified, $profile->hash, $profile->raw_url, $age);
            }

            unset($content);

            if ($age > 86400) {
                $avatar = $curl->get($url);
                if ($avatar["last_modified"] == (int)$profile->last_modified) {
                    $this->getProfileModel()->updateTime($qq, $size, "qq", time());
                } else {
                    if (!$this->getResourceModel()->getResource($avatar["hash"])) {
                        $file->write($avatar["content"]);
                        $this->getResourceModel()->addResource($avatar["hash"], $avatar["mime"]);
                    }
                    $this->getProfileModel()->updateProfile($qq, $size, "qq", $avatar["hash"], $avatar["last_modified"], time());
                }
            }
        }

        exit;
    }

    public function gravatar($req) {

        ob_start();
        $mail = $req->data->route->mail;

        $parameter = $this->app->boot("\Avatar\Lib\ParameterController");
        $curl = $this->app->boot("\Avatar\Lib\CurlController");
        $file = $this->app->boot("\Avatar\Lib\FileController");
        $response = $this->app->boot("\Avatar\Lib\ResponseController");

        $option = $parameter->gravatar($req->data);
        $size = $parameter->size($req->data);

        $url = "https://secure.gravatar.com/avatar/$mail?s=$size&$option";

        if (!$this->isCached($mail, $size, "gravatar", $option)) {
            $response->location($url);

            $avatar = $curl->get($url);
            if (!$avatar) exit;

            $file->write($avatar["content"]);

            if (!$this->getResourceModel()->getResource($avatar["hash"])) {
                $this->getResourceModel()->addResource($avatar["hash"], $avatar["mime"]);
            }
            $this->getProfileModel()->addProfile($mail, "gravatar", $avatar["hash"], $size, $url, "-1", $avatar["last_modified"], time(), $option);
        } else {
            $profile = $this->getProfileModel()->getProfile($mail, $size, "gravatar", $option);
            $resource = $this->getResourceModel()->getResource($profile->hash);
            $age = time() - (int)$profile->last_update;

            if (!$response->etag($req->data->server, md5(base64_encode($profile->hash))))  {
                $content = $file->get($profile->hash);
                $response->ret($content, $resource->mime, $profile->last_modified, $profile->hash, $profile->raw_url, $age);
            }

            unset($content);

            if ($age > 86400) {
                $avatar = $curl->get($url);
                if ($avatar["last_modified"] == (int)$profile->last_modified) {
                    $this->getProfileModel()->updateTime($mail, $size, "gravatar", time(), $option);
                } else {
                    if (!$this->getResourceModel()->getResource($avatar["hash"])) {
                        $file->write($avatar["content"]);
                        $this->getResourceModel()->addResource($avatar["hash"], $avatar["mime"]);
                    }
                    $this->getProfileModel()->updateProfile($mail, $size, "gravatar", $avatar["hash"], $avatar["last_modified"], time(), $option);
                }
            }
        }

        exit;
    }

    public function github($req) {

        ob_start();
        $name = $req->data->route->name;

        $parameter = $this->app->boot("\Avatar\Lib\ParameterController");
        $curl = $this->app->boot("\Avatar\Lib\CurlController");
        $file = $this->app->boot("\Avatar\Lib\FileController");
        $response = $this->app->boot("\Avatar\Lib\ResponseController");

        $size = $parameter->size($req->data);

        if (!$this->isCached($name, $size, "github")) {
            $api = json_decode($curl->get_raw("https://api.github.com/users/$name?access_token="));
            if ($api === NULL) {
                return $this->json(["status" => "failed", "code" => 404]);
            }
            $raw_id = $api->id;
            $url = $api->avatar_url;
            $url .= ($size !== 0) ? "&s=$size" : NULL;

            $response->location($url);

            $avatar = $curl->get($url);
            if (!$avatar) exit;

            $file->write($avatar["content"]);

            if (!$this->getResourceModel()->getResource($avatar["hash"])) {
                $this->getResourceModel()->addResource($avatar["hash"], $avatar["mime"]);
            }

            $this->getProfileModel()->addProfile($name, "github", $avatar["hash"], $size, $url, $raw_id, $avatar["last_modified"], time());
        } else {
            $profile = $this->getProfileModel()->getProfile($name, $size, "github");
            $resource = $this->getResourceModel()->getResource($profile->hash);
            $age = time() - (int)$profile->last_update;

            if (!$response->etag($req->data->server, md5(base64_encode($profile->hash))))  {
                $content = $file->get($profile->hash);
                $response->ret($content, $resource->mime, $profile->last_modified, $profile->hash, $profile->raw_url, $age);
            }

            unset($content);

            if ($age > 86400) {
                $url = $profile->raw_url;
                $avatar = $curl->get($url);
                if ($avatar["last_modified"] == (int)$profile->last_modified) {
                    $this->getProfileModel()->updateTime($name, $size, "github", time());
                } else {
                    if (!$this->getResourceModel()->getResource($avatar["hash"])) {
                        $file->write($avatar["content"]);
                        $this->getResourceModel()->addResource($avatar["hash"], $avatar["mime"]);
                    }
                    $this->getProfileModel()->updateProfile($name, $size, "github", $avatar["hash"], $avatar["last_modified"], time());
                }
            }
        }

        exit;
    }

    public function isCached($identification, $size, $type, $option = NULL) {
        $profile = $this->getProfileModel()->getProfile($identification, $size, $type, $option);
        return (!$profile) ? false : true;
    }

    private function getProfileModel() {
        return $this->model("Cache/ProfileModel");
    }

    private function getResourceModel() {
        return $this->model("Cache/ResourceModel");
    }

}
