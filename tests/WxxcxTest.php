<?php

class WxxcxTest extends TestCase
{
    protected $wxxcx;


    public function setUp()
    {
        parent::setUp();

        // config
        $config = [
            'appid' => 'wx4f4bc4dec97d474b',
            'secret' => 'tiihtNczf5v6AKRyjwEUhQ==',
            'code2session_url' => "https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
        ];

        $this->wxxcx = new E421083458\Wxxcx\Wxxcx($config);
    }


    public function testGetUserInfo()
    {
        $xcx = \Illuminate\Support\Facades\App::make("wxxcx");
        $encryptedData="CiyLU1Aw2KjvrjMdj8YKliAjtP4gsMZM
                QmRzooG2xrDcvSnxIMXFufNstNGTyaGS
                9uT5geRa0W4oTOb1WT7fJlAC+oNPdbB+
                3hVbJSRgv+4lGOETKUQz6OYStslQ142d
                NCuabNPGBzlooOmB231qMM85d2/fV6Ch
                evvXvQP8Hkue1poOFtnEtpyxVLW1zAo6
                /1Xx1COxFvrc2d7UL/lmHInNlxuacJXw
                u0fjpXfz/YqYzBIBzD6WUfTIF9GRHpOn
                /Hz7saL8xz+W//FRAUid1OksQaQx4CMs
                8LOddcQhULW4ucetDf96JcR3g0gfRK4P
                C7E/r7Z6xNrXd2UIeorGj5Ef7b1pJAYB
                6Y5anaHqZ9J6nKEBvB4DnNLIVWSgARns
                /8wR2SiRS7MNACwTyrGvt9ts8p12PKFd
                lqYTopNHR1Vf7XjfhQlVsAJdNiKdYmYV
                oKlaRv85IfVunYzO0IKXsyl7JCUjCpoG
                20f0a04COwfneQAGGwd5oa+T8yO5hzuy
                Db/XcxxmK01EpqOyuxINew==";

        $iv = 'r7BXXKkLb8qrSNn05n0qiA==';
        $userinfo = $xcx->getUserInfo($encryptedData,$iv);
        $userArr = json_decode($userinfo,true);
        $this->assertEquals('oGZUI0egBJY1zhBYw2KhdUfwVJJE', $userArr["openId"]);
    }

}
