<?php 
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\PhieuNhapModel;
use app\model\backend\NccModel;
use app\model\backend\ColorModel;
use app\model\backend\SizeModel;

class PhieuNhapController extends BaseController
{
    private $phieuNhapModel;
    private $nccModel;
    private $colorModel;
    private $sizeModel;

    public function __construct()
    {
        if(!$this->checkUser($_SESSION['user_name'])){
            header('Location:admin.php?c=login');
            exit();
        }
        $this->phieuNhapModel = new PhieuNhapModel;
        $this->nccModel = new NccModel;
        $this->colorModel = new ColorModel;
        $this->sizeModel = new SizeModel;
    }

    public function index()
    {
        $data = [];
        $data['phieu'] = $this->phieuNhapModel->getDataPhieuNhap();
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('nhaphang/index',$data);
        $this->loadFooter();
    }

    public function add()
    {
        $data = [];
        $ncc = $this->nccModel->getDataNcc();
        $data['ncc'] = $ncc;
        $data['product'] = $this->phieuNhapModel->getProduct();
        $data['color'] = $this->colorModel->getDataColor();
        $data['size'] = $this->sizeModel->getDataSize();
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('nhaphang/add',$data);
        $this->loadFooter();
    }
    
    // public function search()
    // {
    //     $result = [];
       
    //     if(isset($_POST['action'])){
    //         $search = $_POST['search_name'];
    //         $result = $this->phieuNhapModel->search($search);
    //         $output = "";
    //         foreach($result as $value){
    //             $output .= '<li class="list_item">
    //             <div class="image">
    //                 <img src="'.$value['image'].'"
    //                     alt="" width="50px">
    //             </div>
    //         </li>
    //         <li class="list_item">
    //             <div class="name">
    //                 <a href="">
    //                     '.$value['name'].'
    //                 </a>
    //             </div>
    //         </li>
    //         <li class="list_item">
    //             <div class="map">
    //                 <a href="">
    //                     '.$value['masp'].'
    //                 </a>
    //             </div>
    //         </li>';
    //         }
    //         echo $output;
    //     }
    // }

    public function hadnelAdd()
    {
        if(isset($_POST['submit'])){
            $id = $_POST['productId'];
            $productId = $this->phieuNhapModel->getProductId($id);
            if(!isset($_SESSION['phieunhap'])){
                
             $key = 0;
                for($i=0;$i<count($_POST['color']);$i++){
                    $key ++;
                    $_SESSION['phieunhap'][$key]['id'] = $productId['id'];
                    $_SESSION['phieunhap'][$key]['name'] = $productId['name'];
                    $_SESSION['phieunhap'][$key]['price'] = $_POST['price'];
                    $_SESSION['phieunhap'][$key]['color'] = $_POST['color'][$i];
                    $_SESSION['phieunhap'][$key]['size'] = $_POST['size'][$i];
                    $_SESSION['phieunhap'][$key]['qty'] = $_POST['qty'][$i];
                }
                
                
            }else{
                $key  = array_key_last($_SESSION['phieunhap']);
                for($i=0;$i<count($_POST['color']);$i++){
                   $key++;
                   $_SESSION['phieunhap'][$key]['id'] = $productId['id'];
                    $_SESSION['phieunhap'][$key]['name'] =$productId['name'];
                    $_SESSION['phieunhap'][$key]['price'] = $_POST['price'];
                    $_SESSION['phieunhap'][$key]['color'] = $_POST['color'][$i];
                    $_SESSION['phieunhap'][$key]['size'] = $_POST['size'][$i];
                    $_SESSION['phieunhap'][$key]['qty'] = $_POST['qty'][$i];

                }
                
            }
            header('Location:admin.php?c=phieuNhap&m=add');
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        unset($_SESSION['phieunhap'][$id]);
        header('Location:admin.php?c=phieuNhap&m=add');
    }

    public function addOrder()
    {
        if(isset($_POST['submit'])){
            $ncc = $_POST['ncc'];
            $state = $_POST['state'];
            $date = $_POST['date']; 
            $date = date('Y-m-d H:i:s',strtotime($date));
            $admin = $_POST['admin'];
            $qty = $_POST['totalQty'];
            $money = $_POST['totalMoney'];
            $key = $this->phieuNhapModel->addOrder($ncc,$qty,$money,$date,$admin,$state);
            foreach($_SESSION['phieunhap'] as $value){
                $this->phieuNhapModel->addOrderDetail($value['id'],$key,$value['price'],$value['qty'],$value['color'],$value['size']);
            }
            unset($_SESSION['phieunhap']);
            header('Location:admin.php?c=phieuNhap');
        }
        
    }

    public function chiTietPhieuNhap()
    {
        $data = [];
        $id = $_GET['id'];
        $data['phieunhap'] = $this->phieuNhapModel->getIdPhieuNhap($id);
        $data['chiTietPhieuNhap'] = $this->phieuNhapModel->getChiTietPhieuNhap($id);
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('nhaphang/chitiet',$data);
        $this->loadFooter();
    }

    public function thanhtoan()
    {
        $id = $_GET['id'];
        $state = $_GET['state'];
        $this->phieuNhapModel->thanhtoan($id,$state);
        header('Location:admin.php?c=phieuNhap&m=chiTietPhieuNhap&id='.$id.'');
    }

    public function print()
    {
        $data = [];
        $id = $_GET['id'];
        $data['phieunhap'] = $this->phieuNhapModel->getIdPhieuNhap($id);
        $data['chiTietPhieuNhap'] = $this->phieuNhapModel->getChiTietPhieuNhap($id);
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('nhaphang/print',$data);
        $this->loadFooter();
    }

    public function addatr()
    {
        $color = $this->colorModel->getDataColor();
        $size= $this->sizeModel->getDataSize();
        $html = '';
        $html .= '<div class="row">
        <div class="col-4">
            <label for="">Màu sắc</label>
            <select name="color[]" id="" class="form-select">';
            foreach($color as $value){
                $html .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
            }
        $html .= ' </select>                                   
        </div>
        <div class="col-4">
            <label for="">Kích thước</label>
            <select name="size[]" id="" class="form-select">';     
            foreach($size as $value){
                $html .= '<option value="'.$value['id'].'">'.$value['name'].'</option>';
            }
        $html .= '</select>                                  
        </div>
        <div class="col-4">
            <label for="">Số lượng</label>
            <input type="number" name="qty[]" id="" class="form-control">

        </div>
        
    </div>';
    echo $html;
    }
}