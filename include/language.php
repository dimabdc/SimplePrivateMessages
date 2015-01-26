<?php
class Localizer {
    private static $instance;
    public static $lang;
    public static $dictionary;
    private $html;

    public function __construct(){ }
    private function __clone() {}
    
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function setLanguage($language) {
        if (is_file ("lang/".$this->lang.".php")){
            require_once "lang/".$this->lang.".php";
        } else {
            require_once "lang/ru.php";
        } 
        $this->dictionary = $_LANG;
        $this->lang = $language;
    }
    
    public function getLanguage($language) {
        return $this->lang;
    }
    
    public function Parse($template) {        
        $this->html = $template; 

        foreach ($this->dictionary as $key => $value) {
            $template_name = '<$' . $key . '$>';
            $this->html = str_replace($template_name, $value, $this->html);
        }
        return $this->html;
    }
    
    public function Translate($name) {
        return $this->dictionary[$name];
    }
}
