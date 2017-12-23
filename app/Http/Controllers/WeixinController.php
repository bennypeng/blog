<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

/**
 * @resource 微信类
 * 微信相关接口
 */
class WeixinController extends Controller
{
    //  菜单
    private $menuJson =
<<<EOF
    {"button":[
      {"type":"click","name":"听歌看片","key":"V1001_MUSIC_VEDIO"},
      {"type":"click","name":"干货分享","key":"V1001_SHARES"},
      {"name":"天气预报","sub_button":[
        {"type":"view","name":"本地天气","url":"http://m.hao123.com/a/tianqi"},
        {"type":"click","name":"北京天气","key":"V1002_WEATHER_BEIJING"},
        {"type":"click","name":"上海天气","key":"V1002_WEATHER_SHANGHAI"}]
      }],
    }
EOF;

    /**
     * 验证token
     * @param  Request $request [description]
     * @return String           [description]
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
     * 创建菜单
     * @param  Client $client [description]
     * @return String         [description]
     */
    public function createMenu(Client $client) {
      $accessToken = $this->getAccessToken($client);
      $url  = sprintf("https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s", $accessToken);
      $res = $client->request('POST', $url,
          ['body' => $this->menuJson]
      );
      return $res->getBody()->getContents();
    }

    /**
     * 获取accessToken
     * @param  Client $client [description]
     * @return String         accessToken
     */
    private function getAccessToken(Client $client) {
      $url  = sprintf("https://api.weixin.qq.com/cgi-bin/token?grant_type=%s&appid=%s&secret=%s", "client_credential", getenv('WX_APPID'), getenv('WX_APPSECRET'));
      $res  = $client->request('GET', $url);
      $json = $res->getBody();
      $obj  = json_decode($json);
      return $obj->access_token;
    }
}
