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

    /**
     * @param $data
     * @param null $name
     */
	public function jsConsole($data, $name = null)
    {
        if(!$name)
            $name = 'data'.rand(1000,1000000);

        try{
            $str = \CUtil::PhpToJSObject($data);
        } catch (\Exception $e){
            $str = '"'.$e->getMessage().', file '.$e->getFile().', line '.$e->getLine().'"';
        }

        echo '<script>';
        echo 'var '.$name.' = '.$str.';';
        echo 'console.log('.$name.')';
        echo '</script>';
    }

    /**
     * @param $data
     * @param bool $hidden
     */
    public function var_dump($data, $hidden = true)
    {
        #if($this->develop_mode)
        #    $hidden = true;

        if($hidden)
            echo '<!-- ';

        echo '<pre>';
        var_dump($data);
        echo '</pre>';

        if($hidden)
            echo ' -->';
    }

    /**
     * @param $data
     * @param bool $hidden
     */
    public function print_r($data, $hidden = true)
    {
        #if($this->develop_mode)
        #    $hidden = true;

        if($hidden)
            echo '<!-- ';

        echo '<pre>'.print_r($data, true).'</pre>';

        if($hidden)
            echo ' -->';
    }

}