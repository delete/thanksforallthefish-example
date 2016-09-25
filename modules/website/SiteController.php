<?php 
/**
* 
*/
class SiteController extends Controller
{    
    public $view;
    public $templateDir;

    function __construct($view=null) {
        parent::__construct($view);
        $this->view->addTemplateDir($this->templateDir, 'website');
    }
    
    public function index($value=null)
    {
        $context = ["value" => $value];
        $template = 'index.html';
        
        $this->loadTemplate($template, $context);
    }
}