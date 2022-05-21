<?php 
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\BannerModel;

class BannerController extends BaseController
{
    private $bannerModel;
    public function __construct()
    {
        $this->bannerModel = new BannerModel;
    }
    public function index()
    {
        $data = [];
        $data['banner'] = $this->bannerModel->getDataBanner();
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('banner/index',$data);
        $this->loadFooter();
    }

    public function hadnelAdd()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $url = $_POST['url'];
            $state = $_POST['state'];

            $target_dir = "public/upload/";
            $target_file = $target_dir . $_FILES["image"]["name"];
           
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            $this->bannerModel->addBanner($name,$target_file,$url,$state);
            header('Location:admin.php?c=banner');
        }
    }

    public function update()
    {
        $data = [];
        $id = $_GET['id'];
        $data['bannerId'] = $this->bannerModel->getIdBanner($id);
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('banner/update',$data);
        $this->loadFooter();
    }

    public function hadnelUpdate()
    {
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $name = $_POST['name'];
            $url = $_POST['url'];
            $state = $_POST['state'];

            $target_dir = "public/upload/";
            if(empty($_FILES['imgNew']['name'])){
                $target_file =  $_POST['imgOld'];
            }else{
                $target_file = $target_dir . $_FILES['imgNew']['name'];
            }

            $this->bannerModel->updatebanner($id,$name,$target_file,$url,$state);
            header('Location:admin.php?c=banner');
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->bannerModel->deleteBanner($id);
        header('Location:admin.php?c=banner');
    }
}