# [laravel-wxxcx] package


微信小程序 for Laravel 5.


## Notes

Branch dev-master is for development and is UNSTABLE!

## Installation

Run the following command and provide the latest stable version (e.g v1.0) :

```bash
composer require itpp/wxxcx
```

or add the following to your `composer.json` file :

```json
"itpp/wxxcx": "1.*"
```

Then register this service provider with Laravel :

```php
'Itpp\Wxxcx\WxxcxServiceProvider',
```

#### for Laravel 5.2/5.3 service provider should be :

```php
Itpp\Wxxcx\WxxcxServiceProvider::class,
```

Publish needed assets (styles, views, config files) :

```bash
php artisan vendor:publish --provider="Itpp\Wxxcx\WxxcxServiceProvider"
```
*Note:* Composer won't update them after `composer update`, you'll need to do it manually!

## Examples

```
Route::get('mywxxcx', function(){
    // 获取登陆信息
    $xcx = App::make("wxxcx");
    $info = $xcx->getLoginInfo("12345");
    // 返回内容:
    /*
        $jsonData = '{
            "openid": "oxkfq0NMYybphA3O6ZvN585ZuJCI",
            "session_key": "RKt9WSMWs8ijJ6TVj4OBbQ=="
        }';
    */

    // 获取用户信息，需要先调用getLoginInfo方法
    $iv = "1111122312313131231";
    $encryptedData="3123131";
    $userinfo = $xcx->getUserInfo($encryptedData,$iv);
    // 返回内容:
    /*
        {
            "openId": "OPENID",
            "nickName": "NICKNAME",
            "gender": GENDER,
            "city": "CITY",
            "province": "PROVINCE",
            "country": "COUNTRY",
            "avatarUrl": "AVATARURL",
            "unionId": "UNIONID",
            "watermark":
            {
                "appid":"APPID",
            "timestamp":TIMESTAMP
            }
        }
    */
});
```