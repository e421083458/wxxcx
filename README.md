# [laravel-wxxcx] package


Wechat applet plugins for Laravel 5.


## Notes

Branch dev-master is for development and is UNSTABLE!

## Installation

Run the following command and provide the latest stable version (e.g v1.0) :

```bash
composer require e421083458/wxxcx
```

or add the following to your `composer.json` file :

```json
"e421083458/wxxcx": "1.*"
```

Then register this service provider with Laravel :

```php
'E421083458\Wxxcx\WxxcxServiceProvider',
```

#### for Laravel 5.2/5.3 service provider should be :

```php
E421083458\Wxxcx\WxxcxServiceProvider::class,
```

Publish needed assets (styles, views, config files) :

```bash
php artisan vendor:publish --provider="E421083458\Wxxcx\WxxcxServiceProvider"
```
*Note:* Composer won't update them after `composer update`, you'll need to do it manually!

## Examples

```
Route::get('mywxxcx', function(){
    // Get login information
    $xcx = App::make("wxxcx");
    $info = $xcx->getLoginInfo("12345");
    
    // reponse:
    /*
        $jsonData = '{
            "openid": "oxkfq0NMYybphA3O6ZvN585ZuJCI",
            "session_key": "RKt9WSMWs8ijJ6TVj4OBbQ=="
        }';
    */
    
    // Get user information, you need to call getLoginInfo method
    $iv = "1111122312313131231";
    $encryptedData="3123131";
    $userinfo = $xcx->getUserInfo($encryptedData,$iv);
    
    // reponse:
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