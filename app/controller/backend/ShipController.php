<?php
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\ShipModel;

class ShipController extends BaseController
{
    private $shipModel;

    public function __construct()
    {
        if(!$this->checkUser($_SESSION['user_name'])){
            header('Location:admin.php?c=login');
            exit();
        }
        $this->shipModel = new ShipModel;
    }
    public function index()
    {
        $data = [];
        $data['tinh'] = $this->shipModel->getDataTinh();
        $data['ship'] = $this->shipModel->getDataship();
        if(isset($_GET['state']) && $_GET['state'] == 'errAdd'){
            $data['errAdd'] = 'Phí vận chuyển đã tồn tại';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('ship/index',$data);
        $this->loadFooter();
    }
    public function loadQuan()
    {
        $idTinh = $_POST['idTinh'];
        $quan = $this->checkModel->getDataQuan($idTinh);
        $html = "";
        $html .= '<option>Chọn Quận/ Huyện</option>';
        foreach($quan as $value){
            $html .= '<option value="'.$value['maqh'].'">'.$value['name'].'</option>';
        }
        echo $html;
    }

    public function loadPhuong()
    {
        $idQuan = $_POST['idQuan'];
        $quan = $this->checkModel->getDataPhuong($idQuan);
        $html = "";
        $html .= '<option>Chọn Phường/ Xã</option>';
        foreach($quan as $value){
            $html .= '<option value="'.$value['xaid'].'">'.$value['name'].'</option>';
        }
        echo $html;
    }

    public function hadnelAdd()
    {
        if(isset($_POST['submit'])){
            $tinh = $_POST['tinh'];
            $quan = $_POST['quan'];
            $phuong = $_POST['phuong'];
            $ship = $_POST['ship'];
            if($this->shipModel->checkAddShip($tinh,$quan,$phuong)){
                $this->shipModel->addShip($tinh,$quan,$phuong,$ship);
                header('Location:admin.php?c=ship');
            }else{
                header('Location:admin.php?c=ship&state=errAdd');
            }
           
        }
    }

    public function update()
    {
        $data = [];
        $id = $_GET['id'];
        $data['ship'] = $this->shipModel->getShipId($id);
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('ship/update',$data);
        $this->loadFooter();
    }

    public function hadnelUpdate()
    {
        if(isset($_POST['submit'])){
            $ship = $_POST['ship'];
            $id = $_POST['id'];
            $this->shipModel->updateShip($id,$ship);
            header('Location:admin.php?c=ship');
        }
        
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->shipModel->deteleShip($id);
        header('Location:admin.php?c=ship');
    }
}