<?php 
/**
* 
*/
class FakeView
{
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
}