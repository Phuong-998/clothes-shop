<?php
namespace app\controller\backend;
use app\controller\backend\BaseController;

class LogoutController extends BaseController
{
    public function index()
    {
        session_destroy();
        header('Location:admin.php?c=login');
    }
}