<?php 
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\NccModel;

class NccController extends BaseController
{
    private $nccModel;
    public function __construct()
    {
        if(!$this->checkUser($_SESSION['user_name'])){
            header('Location:admin.php?c=login');
            exit();
        }
        $this->nccModel = new NccModel;
    }

    public function index()
    {
        $data = [];
        $data['ncc'] = $this->nccModel->getDataNcc();
        if(isset($_GET['state']) && $_GET['state'] == 'errAdd'){
            $data['errAdd'] = 'Tên nhà cung cấp đã tồn tại';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('ncc/index',$data);
        $this->loadFooter();
    }

    public function hadnelAdd()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $adress = $_POST['address'];
            $phone = $_POST['phone'];
            
            if($this->nccModel->checkAdd($name)){
                $this->nccModel->addNcc($name,$adress,$phone);
                header('Location:admin.php?c=ncc');
            }else{
                header('Location:admin.php?c=ncc&state=errAdd');
            }
        }
    }

    public function update()
    {
        $data = [];
        $id = $_GET['id'];
        $data['ncc'] = $this->nccModel->getIdUpdate($id);
        if(isset($_GET['state']) && $_GET['state'] == 'errNcc'){
            $data['errNcc'] = 'Tên nhà cung cấp đã tồn tại';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('ncc/update',$data);
        $this->loadFooter();
    }

    public function hadnelUpdate()
    {
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];

            if($this->nccModel->checkUpdate($name,$id)){
                $this->nccModel->updateNcc($id,$name,$address,$phone);
                header('Location:admin.php?c=ncc');
            }else{
                header('Location:admin.php?c=ncc&m=update&id='.$id.'&state=errNcc');
            }
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->nccModel->deleteNcc($id);
        header('Location:admin.php?c=ncc');
    }
}