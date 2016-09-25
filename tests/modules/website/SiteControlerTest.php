	<?php 
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../FakeView.php';

class SiteControllerTest extends PHPUnit_Framework_TestCase
{
    protected function setUp() 
    {
        $fakeView = new FakeView();
        $this->site = new SiteController($fakeView);
    }

    protected function tearDown()
    {
        $this->site->view->clearAllAssign();
    }

    public function testInstance()
    {
        $this->assertInstanceOf( SiteController::class, $this->site );
    }

    public function testIndexParamValue(){
        $this->setOutputCallback(function() {});

        $this->site->index("fellipe");

        $vars = $this->site->view->templateVars();

        $this->assertContains("fellipe", $vars);
    }

    public function testIndexRenderOutput($value='')
    {
        ob_start();
        
        $this->site->index("fellipe");
        
        $buffer = ob_get_contents();

        $this->assertContains('<h1>Hello, {$value}!</h1>', $buffer);

        ob_end_clean();
    }

    public function testIfHasControllers()
    {
        $controllers = ['index'];

        foreach ($controllers as $controller) {
            $this->assertTrue( method_exists($this->site, $controller) );
        }
    }
}