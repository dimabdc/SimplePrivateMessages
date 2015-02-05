<?php
class HtmlTemplate {
    private $html;
    private $parameters = array();

    public function assign($variable, $value) {
        $this->parameters[$variable] = $value;
    }

    public function parse($template) { 
        $this->html = $template; 

        foreach (array_reverse ($this->parameters) as $key => $value) {
            $template_name = '<#' . $key . '#>';
            $this->html = str_replace($template_name, $value, $this->html);
        }
        return $this->html;
    }
    
    public function display($template, $localize) {
        echo $localize->Parse($this->parse($template));
    }
}
