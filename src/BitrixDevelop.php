<?php

namespace Domatskiy;

class BitrixDevelop
{
	protected $develop_mode = false;
	
	/**
     * @var \Domatskiy\BitrixDevelop
     */
    protected static $instance;
	
    function __construct()
    {

    }

    /**
     * @return BitrixDevelop
     */
    public static function getInstance()
    {
        if(!(static::$instance instanceof \Domatskiy\BitrixDevelop))
            static::$instance = new static();

        return static::$instance;
    }
	
	function setDevelopMode($develop_mode)
	{
		$this->develop_mode = $develop_mode;
	}
	
	function isDevelopMode()
	{
		return $this->develop_mode;
	}
	
	public function sendAllEmailTo($email)
	{
        $EventManager = \Bitrix\Main\EventManager::getInstance();
        $EventManager->addEventHandler('main', 'OnBeforeEventSend', function (&$arFields, &$arTemplate){

            if($this->develop_mode)
            {
                $arTemplate['SUBJECT'] .= '[DEV for '.$arTemplate['EMAIL_TO'].']';
                $arTemplate['EMAIL_TO'] = 'domackii@yandex.ru';
            }

        });

	}

}