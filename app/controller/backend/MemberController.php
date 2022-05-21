<?php 
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\MemberModel;

class MemberController extends BaseController
{
    private $memberModel;
    public function __construct()
    {
        if(!$this->checkUser($_SESSION['user_name'])){
            header('Location:admin.php?c=login');
            exit();
        }
        if(  $_SESSION['role'] != 1){
            echo 'Bạn không đủ quyền vào trang này';
            die();
         }
        $this->memberModel = new MemberModel;
        
    }

    public function index()
    {
        $data = [];
        $user_id = $_SESSION['user_id'];
        $data['member'] = $this->memberModel->getDataMember($user_id);
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('member/index',$data);
        $this->loadFooter();
    }

    public function addMember()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $fullname = $_POST['fullname'];
            $pass = md5($_POST['password']);
            $role = $_POST['role'];
            $this->memberModel->addMember($name,$fullname,$pass,$role);
            header('Location:admin.php?c=member');
        }
    }

    public function update()
    {
        $data = [];
        $id = $_GET['id'];
        $data['memberId'] = $this->memberModel->getIdMember($id);
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('member/update',$data);
        $this->loadFooter();
    }

    public function hadnelUpdate()
    {
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $role = $_POST['role'];
            $status = $_POST['status'];
            $this->memberModel->updateMember($status,$role,$id);
            header('Location:admin.php?c=member');
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->memberModel->deleteMember($id);
        header('Location:admin.php?c=member');
    }
}