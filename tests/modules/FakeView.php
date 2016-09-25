<?php 
/**
* 
*/
class FakeView
{
    function __construct()
    {
        $this->directories = [];
    }
    public function load($template, Array $context)
    {   
        echo file_get_contents($template);
    }

    public function clearAllAssign()
    {
        return [];
    }

    public function templateVars()
    {
        return ["value" => "fellipe"];
    }

    public function getTemplateDir($relatedName=null)
    {
        if ($relatedName != null) {
            return $this->directories[$relatedName];
        } else {
            return $this->directories;
        }
    }

    public function addTemplateDir($dir, $relatedName)
    {
        $this->directories[$relatedName] = $dir;
    }
}