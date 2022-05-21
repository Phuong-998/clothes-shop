<?php
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\LoginModel;

class LoginController extends BaseController
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel;
    }
    public function index()
    {
        $data = [];
        if(isset($_SESSION['wrong'])){
           $data['wrong'] = $_SESSION['wrong'];
        }
        if(isset($_SESSION['errol'])){
            $data['errol'] = $_SESSION['errol'];
         }
        $this->loadView('login/index',$data);
    }

    public function hadnelLogin()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $password = md5($_POST['pass']);

            $name = addslashes($name);
            $password = addslashes($password); 
        
            $flag = true;
            if($name == '' || $password == ''){
                $flag = false;
            }
            if($flag){
                $login = $this->loginModel->checkLogin($name,$password);
                if(!empty($login)){
                    if(isset($_SESSION['wrong'])){
                        unset($_SESSION['wrong']);
                    }
                    if(isset($_SESSION['errol'])){
                        unset($_SESSION['errol']);
                    }
                    $_SESSION['user_name'] = $login['name'];
                    $_SESSION['fullname'] = $login['fullname'];
                    $_SESSION['role'] = $login['role'];
                    $_SESSION['user_id'] = $login['id'];
                    if($_SESSION['role'] == 1){
                        header('Location:admin.php?c=dashboard');
                    }else{
                        header('Location:admin.php?c=order');
                    }
                   
                }else{
                    $_SESSION['wrong'] = 'Sai tên đăng nhập hoặc mật khẩu';
                    header('Location:admin.php?c=login');
                }
            }else{
                $_SESSION['errol'] = 'Tên đăng nhập hoặc mật khẩu trống';
                header('Location:admin.php?c=login');
            }
            
        }
    }

    public function changePass()
    {
        $data = [];
        if(isset($_GET['state']) && $_GET['state'] == 'errChangePass'){
            $data['errChangePass'] = 'Mật khẩu không đúng';
        }
        $this->loadView('login/changePass',$data);
    }

    public function hadnelChangePass()
    {
        if(isset($_POST['submit'])){
            $passOld = md5($_POST['passOld']);
            $passNew = md5($_POST['passNew']);

            if($this->loginModel->checkChangePass($_SESSION['user_id'],$passOld)){
                $this->loginModel->changePass($_SESSION['user_id'],$passNew);
                session_destroy();
                header('Location:admin.php?c=login');
            }else{
                header('Location:admin.php?c=login&m=changePass&state=errChangePass');
            }
        }
    }
    public function validateLogin($name,$password)
    {
        $err = [];
        $err['name'] = empty($name) ? 'Tên dăng nhập trống' : '';
        $err['pass'] = empty($password) ? 'Mật khẩu trống' : '';
        return $err;
    }
}