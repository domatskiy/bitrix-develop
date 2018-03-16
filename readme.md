# bitrix-develop

## install 

```
composer require domatskiy/bitrix-develop
```
## use

in php_interface/init.php

```php
if(class_exists('\Domatskiy\BitrixDevelop'))
{
    $CBitrixDevelop = \Domatskiy\BitrixDevelop::getInstance();
    $CBitrixDevelop->setDevelopMode(strpos($_SERVER['SERVER_NAME'], 'dev.') !== false);
    
    // send all emails from cms to the developer's email
    $CBitrixDevelop->sendAllEmailTo('test@test.ru');
}
```

### the output in the browser console

```php
$CBitrixDevelop = \Domatskiy\BitrixDevelop::getInstance();
$CBitrixDevelop->jsConsole('test');
```

