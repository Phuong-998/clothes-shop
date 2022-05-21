<?php 
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\OrderModel;
use app\model\frontend\CheckModel;

class OrderController extends BaseController
{
    private $orderModel;
    private $checkModel;
    public function __construct()
    {
        if(!$this->checkUser($_SESSION['user_name'])){
            header('Location:admin.php?c=login');
            exit();
        }
        $this->orderModel = new OrderModel;
        $this->checkModel = new CheckModel;
    }
    public function index()
    {
        $data = [];
        $data['order'] = $this->orderModel->getDataOrder();
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('order/index',$data);
        $this->loadFooter();
    }

    public function chitiet()
    {
        $data = [];
        $order_id = $_GET['orderId'];
        $data['member'] = $this->orderModel->getMemberOrder($order_id);
        $data['order'] = $this->orderModel->getDetailOrder($order_id);
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('order/chitiet',$data);
        $this->loadFooter();
    }

    public function updateOrder()
    {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];
        if($status == 5){
           $order= $this->orderModel->getDetailOrder($order_id);
           foreach($order as $value){
            $size_id = $this->checkModel->getIdSize($value['size']);
            $color_id = $this->checkModel->getIdColor($value['color']);
            $qty = $this->checkModel->getQty($value['id'],implode($size_id),implode($color_id));
            $qty = implode($qty);
            $updateQty = $qty + $value['qty'];
            $this->checkModel->updateQty($value['id'], implode($size_id),implode($color_id),$updateQty);
            $qty1 = $this->checkModel->getQty1($value['id']);
            $qty1 = (int)(implode($qty1));
            $updateQty1 = $qty1 + $value['qty'];
            $this->checkModel->updateQty1($value['id'],$updateQty1);
           }

        }
       $this->orderModel->updateOrder($order_id,$status);
        

    }

    public function bill()
    {
        $data = [];
        $orderid = $_GET['orderid'];
        $member_id = $_GET['memberid'];
        $data['member'] = $this->orderModel->getMemberOrder($orderid);
        $data['order'] = $this->orderModel->getDetailOrder($orderid);
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('order/bill',$data);
        $this->loadFooter();
    }

    public function NoProcessOrder()
    {
        $data = [];
        $data['order'] = $this->orderModel->getNoProcesOrder();
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('order/noProcessOrder',$data);
        $this->loadFooter();
    }

    public function revenueToday()
    {
        $data = [];
        $data['order'] = $this->orderModel->revenueToday();
        $month = date('m');
        $year = date('Y');
        $arrday = [];
        for($day = 1;$day<=31;$day++){
            $time = mktime(12,0,0,$month,$day,$year);
            if($day == date('d',$time)){
                $arrday[] = $day;
            }
        }
        $reven = $this->orderModel->getRevenDay();
        $arrRen = [];
        foreach($arrday as $value){
            $money = 0;
            foreach($reven as $item){
                if($value == $item['times']){
                    $money = $item['money'];
                    break;
                }
            }
            $arrRen[$value] = (float)$money;
        }
       
        $data['reven'] = $arrRen;
        $data['day'] = $arrday;
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('order/revenueToday',$data);
        $this->loadFooter();
    }
}