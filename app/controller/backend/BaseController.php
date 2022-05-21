<?php
namespace app\controller\backend;

class BaseController 
{
    private $pathView = 'app/view/backend/';

    protected function loadView($view,$data = [])
    {
        extract($data);
        require $this->pathView . $view . '.php';
    }

    protected function loadHeader($data = [])
    {
         $this->loadView('partials/header',$data);
    }
    
    protected function loadNav($data = [])
    {
         $this->loadView('partials/nav',$data);
    }

    protected function loadFooter($data = [])
    {
         $this->loadView('partials/footer',$data);
    }

    protected function checkUser($username)
    {
         if(empty($username)){
              return false;
         }else{
              return true;
         }
    }

}