<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index() {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "http://www.baidu.com");
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $str = curl_exec($ch);//返回内容
      $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);//状态码
      curl_close($ch);
      //dd($code);
      //dd($str);

      $res = preg_match_all("/<[a|A].*?href=[\'\"]{0,1}([^>\'\"]*).*?>/", $str, $out);
      if ($res) {
        dd($out[1]);
      }

    }
}
