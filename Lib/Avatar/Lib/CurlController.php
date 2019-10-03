<?php

namespace Avatar\Lib;

class CurlController extends \X\Controller
{
    protected $ua = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3414.0 Safari/537.36";

    public function get ($url, $timeout = 5) {
        if($url == "" || $timeout <= 0){
            return false;
        }
        $header[] = "User-Agent: " . $this->ua;
        $curl = curl_init((string)$url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        //curl_setopt($curl, CURLINFO_HEADER_OUT, TRUE);
        //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 信任任何证书
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, (int)$timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); //添加自定义的http header
        $result = curl_exec($curl);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $header = substr($result, 0, $headerSize);
        $body = substr($result, $headerSize);
        $avatar["content"] = $body;
        $avatar["hash"] = hash("sha256", $body);
        curl_close($curl);
        foreach (explode("\r\n", $header) as $i) {
            if (strpos($i, "Last-Modified: ") !== false) {
                $date = explode("Last-Modified: ", $i)[1];
                $avatar["last_modified"] = strtotime($date);
            }
            if (strpos($i, "Content-Type: ") !== false) {
                $avatar["mime"] = explode("Content-Type: ", $i)[1];
            }
            if (strpos($i, "Content-Length: ") !== false) {
                $avatar["length"] = explode("Content-Length: ", $i)[1];
            }
        }
        if (strlen($avatar["content"]) != $avatar["length"]) return false;
        return $avatar;
    }

    public function get_raw ($url, $timeout = 5) {
        if($url == "" || $timeout <= 0){
            return false;
        }
        $header[] = "User-Agent: " . $this->ua;
        $curl = curl_init((string)$url);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, (int)$timeout);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); //添加自定义的http header
        $result = curl_exec($curl);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $body = substr($result, $headerSize);
        curl_close($curl);
        return $body;
    }

}