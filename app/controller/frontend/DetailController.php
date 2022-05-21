<?php 
namespace app\controller\frontend;
use app\controller\frontend\BaseController;
use app\model\frontend\HomeModel;
use app\model\frontend\DetailModel;
class DetailController extends BaseController
{
    private $homeModel;
    private $detailModel;
    public function __construct()
    {
        $this->homeModel = new HomeModel;
        $this->detailModel = new DetailModel;
    }
    public function index()
    {   
        $data = [];
        $id = $_GET['id'];
        $cate = $_GET['cate'];
        $data['category'] = $this->homeModel->getCategory();
        $data['product'] = $this->detailModel->getProduct($id);
        $data['color'] = $this->detailModel->getColorproduct($id);
        $data['size'] = $this->detailModel->getSizeproduct($id);
        $data['image'] = $this->detailModel->getImgProduct($id);
        $data['productCate'] = $this->detailModel->getProductCategory($cate,$id);
        $this->loadHeader($data);
        $this->loadView('detail/index',$data);
        $this->loadFooter();
    }

    public function getQty()
    {
        $color = $_POST['color'];
        $size = $_POST['size'];
        $productId = $_POST['productId'];
        $qty = $this->detailModel->getQtyProduct($color,$size,$productId);
        if(empty($qty)){
            $html = '<p>Hết hàng</p>';
            echo $html;
        }else{
            $html = '<p>Số lượng: '.$qty['qty'].'</p>';
            echo $html;
        }
        
    }
}