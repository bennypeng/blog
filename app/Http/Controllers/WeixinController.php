<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeixinController extends Controller
{
    /**
     * [checkSignature description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function checkSignature(Request $request) {

      $signature = $request->input('signature');
      $timestamp = $request->input('timestamp');
      $nonce     = $request->input('nonce');
      $echostr   = $request->input('echostr');

      $tmpArr = array(getenv('WX_TOKEN'), $timestamp, $nonce);
      sort($tmpArr, SORT_STRING);

      $tmpStr = implode($tmpArr);
      $sign   = sha1($tmpStr);

      if ($sign == $signature) {
        echo $echostr;
      }
    }

    /**
     * 获取accessToken
     * @param  Client $client [description]
     * @return [type]         [description]
     */
    public function getAccessToken(Client $client) {
      $url  = sprintf("https://api.weixin.qq.com/cgi-bin/token?grant_type=%s&appid=%s&secret=%s", "client_credential", getenv('WX_APPID'), getenv('WX_APPSECRET'));
      $res  = $client->request('GET', $url);
      $json = $res->getBody();
      $obj  = json_decode($json);
      echo $obj->access_token;
    }
}
