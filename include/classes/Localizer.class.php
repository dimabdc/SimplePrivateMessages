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
        if (is_file ("lang/".$language.".xml")){
            self::$dictionary = simplexml_load_file("lang/".$language.".xml");
        } else {
            self::$dictionary = simplexml_load_file("lang/ru.xml");
        }
        self::$lang = $language;
    }
    
    public function getLanguage($language) {
        return self::$lang;
    }
    
    public function Parse($template) {        
        $this->html = $template; 

        foreach (self::$dictionary as $key => $value) {
            $template_name = '<$' . $key . '$>';
            $this->html = str_replace($template_name, $value, $this->html);
        }
        return $this->html;
    }
    
    public function Translate($name) {
        return self::$dictionary->{$name};
    }
}
