<?php 
namespace app\controller\frontend;
use app\controller\frontend\BaseController;
use app\model\frontend\HomeModel;
use app\model\frontend\CheckModel;

class CheckoutController extends BaseController
{
    private $homeModel;
    private $checkModel;
    public function __construct()
    {
        $this->homeModel = new HomeModel;
        $this->checkModel = new CheckModel;
    }

    public function index()
    {
        $data = [];
        $data['category'] = $this->homeModel->getCategory();
        $data['tinh'] = $this->checkModel->getDataTinh();
        $this->loadHeader($data);
        $this->loadView('checkout/index',$data);
        $this->loadFooter();
    }

    public function loadQuan()
    {
        $idTinh = $_POST['idTinh'];
        $quan = $this->checkModel->getDataQuan($idTinh);
        $html = "";
        $html .= '<option value="">Chọn Quận/ Huyện</option>';
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
        $html .= '<option value="">Chọn Phường/ Xã</option>';
        foreach($quan as $value){
            $html .= '<option value="'.$value['xaid'].'">'.$value['name'].'</option>';
        }
        echo $html;
    }

    public function addShip()
    {
        $tinh = $_POST['tinh'];
        $quan = $_POST['quan'];
        $phuong = $_POST['phuong'];
        $ship = $this->checkModel->getShip($tinh,$quan,$phuong);
        if($ship == ''){
            $ship = 30000;
        }else{
            $ship = implode(",",$ship);
        }
        
        echo $ship;

    }

    public function pay()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $tel = $_POST['tel'];
            $address = $_POST['address'];
            $quan = $_POST['quan'];
            $tinh = $_POST['tinh'];
            $phuong = $_POST['phuong'];
            $note = $_POST['note'];
            $totalMoney = $_POST['totalMoney'];
            $time = date("Y/m/d");

            $moneyShip = $_POST['ship'];
            $member_id = $this->checkModel->addMember($name,$tel,$address,$tinh,$quan,$phuong);
            $order_id = $this->checkModel->addOrder($member_id,$totalMoney,$time,$moneyShip,$note);
            foreach($_SESSION['cart'] as $value){
               $this->checkModel->addDetailOrder($order_id,$value['id'],$value['size'],$value['color'],$value['img'],$value['qty'],$value['price']);
                $size_id = $this->checkModel->getIdSize($value['size']);
                $color_id = $this->checkModel->getIdColor($value['color']);
                $qty = $this->checkModel->getQty($value['id'],implode($size_id),implode($color_id));
                $qty = (int)(implode($qty));
                $updateQty = $qty - $value['qty'];
                $this->checkModel->updateQty($value['id'], implode($size_id),implode($color_id),$updateQty);
                $qty1 = $this->checkModel->getQty1($value['id']);
                $qty1 = (int)(implode($qty1));
                $updateQty1 = $qty1 - $value['qty'];
                $this->checkModel->updateQty1($value['id'],$updateQty1);
            }
            unset($_SESSION['cart']);
            $data = [];
            $data['category'] = $this->homeModel->getCategory();
            $this->loadHeader($data);
            $this->loadView('checkout/succes');
            $this->loadFooter();
        }
    }

   
}