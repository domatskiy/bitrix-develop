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
	    if($email === '')
	        return;

	    if(!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL))
	        throw new \Exception('not correct email');

        $EventManager = \Bitrix\Main\EventManager::getInstance();
        $EventManager->addEventHandler('main', 'OnBeforeEventSend', function (&$arFields, &$arTemplate) use ($email){

            if($this->develop_mode)
            {
                $arTemplate['SUBJECT'] .= '[DEV MODE for '.$arTemplate['EMAIL_TO'].']';
                $arTemplate['EMAIL_TO'] = $email;
            }

        });

	}

}