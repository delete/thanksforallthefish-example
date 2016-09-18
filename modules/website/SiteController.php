<?php 
/**
* 
*/
class SiteController extends Controller
{    
    public $view;
    public $templateDir;
    
    public function index($value=null)
    {
        $context = ["value" => $value];
        $template = 'index.html';
        
        $this->loadTemplate($template, $context);
    }
}