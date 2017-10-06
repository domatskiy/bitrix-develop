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
    $CBitrixDevelop->sendAllEmailTo('test@test.ru');
}
```
