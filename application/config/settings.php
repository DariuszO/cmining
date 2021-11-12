<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$config['SiteName'] = 'bitaltearning.com - Cloud Mining'; //Название сайта

$config['smtp_host'] = 'smtp.yandex.ru'; //Хост для SMTP
$config['smtp_port'] = '465'; //Порт SMTP
$config['smtp_user'] = 'support@bitaltearning.com'; //Логин SMTP
$config['smtp_pass'] = 'fhntvhfrjd1552'; //Пароль SMTP

/**
* 
* НЕ ТРОГАТЬ 
* 
*/
$config['protocol'] = 'smtp';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
/**
* 
* 
* 
*/



$config['AdminLogin'] = 'Admin'; //Логин админа

$config['AdminPassword'] = 'Password'; // Пароль админа


$config['PriceCloudGHS'] = 0.00006586; //Стоимость GHS  в биткоинах

$config['ReturnDayFromDeposit'] = 62; //Срок окупаемости в днях

$config['PercentFromExhange'] = 0.10; //Процент системе при обмене валют, кроме мощности (0.1 == 10%, 0.01 == 1%)


$config['PublicAPIkey'] = 'f0aabbf0495045b514fbdfeba7c565233fc63bf25a63016e24fa66b8dc082'; //Публичный ключ

$config['PrivateAPIkey'] = '62265Ca2f6E353f2A7BDf9AcC0373978a4324DDDbE12Bf31e821bcE1Ab677'; //Приватный ключ


/**
* Ключи для Recaptcha
*/
$config['PublicKeyRecaptcha'] = '6LfTiBMUAAAAAKdzG8WdiWmJjy5t6ut8-Frrtfb4'; // Публичный ключ
$config['SecretKeyRecaptcha'] = '6LfTiBMUAAAAAMfSBB_1KE6XeT_ra4MZ7AyFgS6i'; //Секретный ключ


$config['AutoPayment'] = 'off'; //Автовыплаты on - Включены    off -Полуавтовыплаты из админки

$config['PercentPayment'] = 0; //Процент за вывод средств

$config['AutoConfirmWithdraw'] = TRUE; //Автоподтверждение выплаты! Если TRUE то автоматически средства переводятся на кошелек юзера, если FALSE то нужно еще подтвердить по почте выплату! Это только для админа!!! Подтверждение из агрегатора!


$config['PercentPartners'] = 10; //Реферальный процент! Указывать в целых числах! Сейчас установлено 10%



///Настройки Payeer.COM
$config['WalletPayeerFromAutoPay'] = 'P51632721'; //Кошелек паера с которого будут идти выплаты
$config['UidPayeerApi'] = '297409635'; //ID созданного API
$config['SecretKeyPayeerApi'] = 'Wfz6nbRR7S0VjDyv'; //пароль от созданного API

$config['SecretKeyPayeerMerchant'] = 'ZQsHSBGdSZeiZKJx'; //пароль от созданного магазина
$config['UidPayeerMerchant'] = '297054479'; //ID от созданного магазина

$config['DateStartProject'] = '31.01.2017'; //Дата старта проекта