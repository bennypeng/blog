<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeixinController extends Controller
{

    private $token     = "v2sh_com";
    private $appID     = "wxbb24a6cb184f31eb";
    private $appsecret = "c2305a632396641fad17e34cda2d922b";

    // 验证token
    public function checkSignature(Request $request) {
      $signature = $request->input('signature');
      $timestamp = $request->input('timestamp');
      $nonce     = $request->input('nonce');
      $echostr   = $request->input('echostr');

      $tmpArr = array($this->token, $timestamp, $nonce);
      sort($tmpArr, SORT_STRING);

      $tmpStr = implode($tmpArr);
      $sign   = sha1($tmpStr);

      if ($sign == $signature) {
        echo $echostr;
      }
    }

    // 获取accesstoken
    public function getAccessToken(Client $client) {
      $url  = sprintf("https://api.weixin.qq.com/cgi-bin/token?grant_type=%s&appid=%s&secret=%s", "client_credential", $this->appID, $this->appsecret);
      $res  = $client->request('GET', $url);
      $json = $res->getBody();
      $obj  = json_decode($json);
      echo $obj->access_token;
    }
}
