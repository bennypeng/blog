<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeixinController extends Controller
{
    public function checkSignature(Request $request) {
      $signature = $request->input('signature');
      $timestamp = $request->input('timestamp');
      $nonce     = $request->input('nonce');
      $echostr   = $request->input('echostr');
      $token     = "v2sh_com";

      $tmpArr = array($token, $timestamp, $nonce);
      sort($tmpArr, SORT_STRING);

      $tmpStr = implode($tmpArr);
      $sign   = sha1($tmpStr);

      if ($sign == $signature) {
        echo $echostr;
      }
    }
}
