<?php 
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\SizeModel;

class SizeController extends BaseController
{
    private $sizeModel;

    public function __construct()
    {
        if(!$this->checkUser($_SESSION['user_name'])){
            header('Location:admin.php?c=login');
            exit();
        }
        $this->sizeModel = new SizeModel;
    }

    public function index()
    {
        $data = [];
        $data['size'] = $this->sizeModel->getDataSize();
        if(isset($_GET['state']) && $_GET['state'] == 'errNameSize'){
            $data['errNameSize'] = 'Tên size đã tồn tại';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('size/index',$data);
        $this->loadFooter();
    }

    public function hadnelAdd()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
           
                if($this->sizeModel->checkAddSize($name)){
                    $this->sizeModel->addSize($name);
                    header('Location:admin.php?c=size');
                }else{
                    header('Location:admin.php?c=size&state=errNameSize');
                }
            
        }
    }

    public function update()
    {
        $size_id = $_GET['id'];
        if(isset($_GET['state']) && $_GET['state'] == 'errNameSize'){
            $data['errNameSize'] = 'Tên size đã tồn tại';
        }
        $data['size'] = $this->sizeModel->getIdSize($size_id);
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('size/update',$data);
        $this->loadFooter();
    }

    public function hadnelUpdate()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $id = $_POST['size_id'];
           
                if($this->sizeModel->checkUpdateSize($id,$name)){
                    $this->sizeModel->updateSize($id,$name);
                    header('Location:admin.php?c=size');
                }else{
                    header('Location:admin.php?c=size&m=update&id='.$id.'&state=errNameSize');
                }
            
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->sizeModel->deleteSize($id);
        header('Location:admin.php?c=size');
    }
}