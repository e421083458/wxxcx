# [laravel-wxxcx] package

Laravel 5 微信小程序插件

## 备注

Api | 说明 | 对应方法
---|---|---
[wx.login](https://mp.weixin.qq.com/debug/wxadoc/dev/api/api-login.html) | 登录 | $obj->getLoginInfo
[wx.getUserInfo](https://mp.weixin.qq.com/debug/wxadoc/dev/api/open.html#wxgetuserinfoobject) | 获取用户信息 | $obj->getUserInfo($encryptedData,$iv);
reference：https://mp.weixin.qq.com/debug/wxadoc/dev/api/

## 安装

执行以下命令安装最新稳定版本:

```bash
composer require e421083458/wxxcx
```

或者添加如下信息到你的 `composer.json` 文件中 :

```json
"e421083458/wxxcx": "1.*"
```

然后注册服务提供者到 Laravel中 :

```php
E421083458\Wxxcx\WxxcxServiceProvider::class,
```
发布所需的资源(样式、视图、配置文件等): 

```bash
php artisan vendor:publish --provider="E421083458\Wxxcx\WxxcxServiceProvider"
```

## Demo

共需要两步操作
1. 调用getLoginInfo得到用户信息,里面会自动封装sessionKey信息

```php
$xcx = App::make("wxxcx");
$loginInfo = $xcx->getLoginInfo($code); //code为用户登陆成功后获取到的
print_r($loginInfo);
```

reponse:
```
{
    "openid": "oxkfq0NMYybphA3O6ZvN585ZuJCI",
    "session_key": "RKt9WSMWs8ijJ6TVj4OBbQ=="
}
```

2. 第一步操作成功后才能调用第二步, getUserInfo 会得到用户头像、昵称、等信息

```php
$iv = "r7BXXKkLb8qrSNn05n0qiA==";
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
//为能演示demo,所以我需要手动设置一下sessionKey (ps:实际环境中调用getLoginInfo会自动获取到)
$xcx->setSessionKey("tiihtNczf5v6AKRyjwEUhQ==");
$userinfo = $xcx->getUserInfo($encryptedData,$iv);
print_r($userinfo);
```

reponse:
```
{
    "openId": "oGZUI0egBJY1zhBYw2KhdUfwVJJE",
    "nickName": "Band",
    "gender": 1,
    "language": "zh_CN",
    "city": "Guangzhou",
    "province": "Guangdong",
    "country": "CN",
    "avatarUrl": "http://wx.qlogo.cn/mmopen/vi_32/aSKcBBPpibyKNicHNTMM0qJVh8Kjgiak2AHWr8MHM4WgMEm7GFhsf8OYrySdbvAMvTsw3mo8ibKicsnfN5pRjl1p8HQ/0",
    "unionId": "ocMvos6NjeKLIBqg5Mr9QjxrP1FA",
    "watermark": {
        "timestamp": 1477314187,
        "appid": "wx4f4bc4dec97d474b"
    }
}
```
