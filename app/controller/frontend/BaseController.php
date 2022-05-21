<?php 
namespace app\controller\frontend;

class BaseController 
{
    private $pathView = 'app/view/frontend/';

    protected function loadView($View,$data = [])
    {
        extract($data);
        require $this->pathView . $View . '.php';
    }

    protected function loadBanner($data = [])
    {
        $this->loadView('partials/banner',$data);
    }

    protected function loadHeader($data = [])
    {
        $this->loadView('partials/header',$data);
    }

    protected function loadFooter($data = [])
    {
        $this->loadView('partials/footer',$data = []);
    }
}