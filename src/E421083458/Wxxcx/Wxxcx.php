<?php
namespace E421083458\Wxxcx;


use Ixudra\Curl\Facades\Curl;

class Wxxcx
{
    /**
     * @var string
     */
    private $appId;
    private $secret;
    private $code2session_url;
    private $openId;
    private $sessionKey;
    private $authInfo;

    /**
     * Wxxcx constructor.
     * @param $code 登录凭证（code）
     */
    function __construct($wxConfig)
    {
        $this->appId = isset($wxConfig["appid"]) ? $wxConfig["appid"] : "";
        $this->secret = isset($wxConfig["secret"]) ? $wxConfig["secret"] : "";
        $this->code2session_url = isset($wxConfig["code2session_url"]) ? $wxConfig["code2session_url"] : "";
    }

    /**
     * Created by e421083458@163.com
     * @return mixed
     */
    public function getLoginInfo($code){
        $this->authCodeAndCode2session($code);
        return $this->authInfo;
    }

    /**
     * Created by e421083458@163.com
     * @param $encryptedData
     * @param $iv
     * @return string
     * @throws \Exception
     */
    public function getUserInfo($encryptedData, $iv){
        $pc = new WXBizDataCrypt($this->appId, $this->sessionKey);
        $decodeData = "";
        $errCode = $pc->decryptData($encryptedData, $iv, $decodeData);
        if ($errCode !=0 ) {
            throw new \Exception('weixin_decode_fail');
        }
        return $decodeData;
    }

    /**
     * Created by e421083458@163.com
     * @throws \Exception
     */
    private function authCodeAndCode2session($code){
        $code2session_url = sprintf($this->code2session_url,$this->appId,$this->secret,$code);
        $jsonData = Curl::to($code2session_url)->get();
        $this->authInfo = json_decode($jsonData,true);
        if(!isset($this->authInfo['openid'])){
            throw new \Exception('weixin_session_expired');
        }
        $this->openId = isset($jsonArr['openid']) ? $jsonArr['openid'] : "" ;
        $this->sessionKey = isset($jsonArr['session_key']) ? $jsonArr['session_key'] : "" ;
    }

}