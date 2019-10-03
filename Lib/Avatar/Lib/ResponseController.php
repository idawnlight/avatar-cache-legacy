<?php

namespace Avatar\Lib;

class ResponseController extends \X\Controller
{
    public function ret($content = "", $mime, $last_modified, $hash, $canonical = null, $age = null)
    {
        $header["Content-Type"] = $mime;
        $header["Last-Modified"] = gmdate("D, d M Y H:i:s", $last_modified) . " GMT";
        $header["Etag"] = '"'.md5(base64_encode($hash)).'"';
        if ($canonical !== null)  {
            $header["Link"] = '<' . $canonical . '>; rel="canonical"';
        }
        if ($age !== null) {
            $header["Age"] = $age;
        }
        foreach ($header as $a => $b) {
            header("$a: $b");
        }
        echo $content;
        self::finish();
        return true;
    }

    public function etag($req, $profile) {
        if (isset($req->HTTP_IF_NONE_MATCH) && $req->HTTP_IF_NONE_MATCH === '"' . $profile . '"') {
            header("HTTP/1.1 304 Not Modified");
            self::finish();
            return true;
        }
        return false;
    }

    public function location($url) {
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        header("location: $url");
        self::finish();
    }

    public function finish() {
        header("Connection: close");
        ignore_user_abort(true);
        $size = ob_get_length();
        header("Content-Length: $size");
        ob_end_flush();
        flush();
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }
    }
}