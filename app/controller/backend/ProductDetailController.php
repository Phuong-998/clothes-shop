<?php

namespace app\controller\backend;

use app\controller\backend\BaseController;
use app\model\backend\ProductDetailModel;
use app\model\backend\SizeModel;
use app\model\backend\ColorModel;

class ProductDetailController extends BaseController
{
    private $productDetailModel;
    private $colorModel;
    private $sizeModel;
    public function __construct()
    {
        if (!$this->checkUser($_SESSION['user_name'])) {
            header('Location:admin.php?c=login');
            exit();
        }
        $this->productDetailModel = new ProductDetailModel;
        $this->colorModel = new ColorModel;
        $this->sizeModel = new SizeModel;
    }

    public function index()
    {
        $prdocut_id = $_GET['id'];
        $data = [];
        $data['size'] = $this->sizeModel->getDataSize();
        $data['color'] = $this->colorModel->getDataColor();
        $data['product'] = $this->productDetailModel->getProductDetail($prdocut_id);
        $data['prdocut_id'] = $prdocut_id;
        if (isset($_SESSION['errAddproductDetail'])) {
            $data['errAddproductDetail'] = $_SESSION['errAddproductDetail'];
        }
        if (isset($_GET['state']) && $_GET['state'] == 'errAdd') {
            $data['errAdd'] = 'Sản phẩm đã có size và màu sắc';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('productDetail/index', $data);
        $this->loadFooter();
    }

    public function hadnelAdd()
    {
        if (isset($_POST['submit'])) {

            $product_id = $_POST['product_id'];

            $size = $_POST['size'];
            $color = $_POST['color'];
            $qty = $_POST['qty'];

            $target_dir = "public/upload/";
            $upload = true;
            if (!empty($_FILES['image']['name'])) {
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "bmp") {
                    $upload = false;
                }
            } else {
                $upload = false;
            }
            $flag = true;
            $err = $this->validateProductDetail($upload);
            if($err !=''){
                $flag = false;
            }
            if ($flag) {
                if ($this->productDetailModel->checkAddDetail($product_id, $size, $color)) {
                    if (isset($_SESSION['errAddproductDetail'])) {
                        unset($_SESSION['errAddproductDetail']);
                    }
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    $this->productDetailModel->addProductDetail($product_id, $color, $target_file, $size, $qty);
                    $sumQty = $this->productDetailModel->getSumQty($product_id);
                    $sumQty = implode($sumQty);
                    $this->productDetailModel->updateSumQty($product_id, $sumQty);
                    header('location:admin.php?c=productDetail&id=' . $product_id . '');
                } else {
                    header('Location:admin.php?c=productDetail&id=' . $product_id . '&state=errAdd');
                }
            } else {
                $_SESSION['errAddproductDetail'] = $err;
                header('Location:admin.php?c=productDetail&id=' . $product_id . '');
            }
        }
    }

    public function update()
    {
        $data = [];
        $id = $_GET['id'];
        $data['product'] = $this->productDetailModel->getIdProductDetail($id);
        if(isset($_GET['state']) && $_GET['state'] == 'err'){
            $data['errUpdate'] = 'Kiểm tra lại ảnh màu';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('productDetail/update', $data);
        $this->loadFooter();
    }

    public function hadnelUpdate()
    {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $product_id = $_POST['product_id'];
            $qty = $_POST['qty'];

            $target_dir = 'public/upload/';
            $upload = true;
            if ($_FILES['color_img']['name'] == '') {
                $target_file = $_POST['img'];
            } else {
                
                $target_file =  $target_dir . $_FILES['color_img']['name'];
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "bmp") {
                    $upload = false;
                }
            }
            $flag = true;
            $err = $this->validateProductDetail($upload);
            if($err !=''){
                $flag = false;
            }
            if($flag){
                move_uploaded_file($_FILES["color_img"]["tmp_name"], $target_file);
                $this->productDetailModel->updateProductDetail($id, $qty, $target_file);
                $sumQty = $this->productDetailModel->getSumQty($product_id);
                $sumQty = implode($sumQty);
                $this->productDetailModel->updateSumQty($product_id, $sumQty);
                header('Location:admin.php?c=productDetail&id=' . $product_id . '');
            }else{
                header('Location:admin.php?c=productDetail&m=update&id=' . $id . '&state=err');
            }
           
        }
    }
    public function delete()
    {
        $id = $_GET['id'];
        $prdocut_id = $_GET['productid'];
        $this->productDetailModel->deletedetail($id);
        $sumQty = $this->productDetailModel->getSumQty($prdocut_id);
        $sumQty = implode($sumQty);
        $this->productDetailModel->updateSumQty($prdocut_id, $sumQty);
        header('Location:admin.php?c=productDetail&id=' . $prdocut_id . '');
    }
    public function validateProductDetail($upload)
    {
       
        $err = !$upload ? ' Kiểm tra lại ảnh màu' : '';
        return $err;
    }
}
