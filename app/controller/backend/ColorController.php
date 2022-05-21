<?php 
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\ColorModel;

class ColorController extends BaseController
{
    private $colorModel;
    public function __construct()
    {
        if(!$this->checkUser($_SESSION['user_name'])){
            header('Location:admin.php?c=login');
            exit();
        }
        $this->colorModel = new ColorModel;
    }

    public function index()
    {
        $data = [];
        $data['color'] = $this->colorModel->getDataColor();
        if(isset($_GET['state']) && $_GET['state'] == 'errAddNameColor'){
            $data['errAddNameColor'] = 'Tên màu đã tồn tại';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('color/index',$data);
        $this->loadFooter();
    }


    public function hadnelAdd()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            
                if($this->colorModel->checkAddNameColor($name)){
                    $this->colorModel->addColor($name);
                    header('Location:admin.php?c=color');
                }else{
                    header('Location:admin.php?c=color&state=errAddNameColor');
                }
               
            
        }
    }

    public function update()
    {
        $data = [];
        $color_id = $_GET['id'];
       
        if(isset($_GET['state']) && $_GET['state'] == 'errUpdateColor'){
            $data['errUpdateColor'] = 'Màu đã tồn tại';
        }
        $data['color'] = $this->colorModel->getIdColor($color_id);
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('color/update',$data);
        $this->loadFooter();
    }

    public function hadnelUpdate()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $color_id = $_POST['color_id'];
            
                if($this->colorModel->checkUpdateNameColor($color_id,$name)){
                    $this->colorModel->updateColor($color_id,$name);
                    header('Location:admin.php?c=color&id='.$color_id.'');
                }else{
                    header('Location:admin.php?c=color&m=update&id='.$color_id.'&state=errUpdateColor');
                }
            
        }
    }

    public function delete()
    {
        $color_id = $_GET['id'];
        $this->colorModel->deleteColor($color_id);
        header('Location:admin.php?c=color');
    }
}