<?php
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\ProductModel;
use app\coment\RecusiveCategory;
use app\model\backend\CategoryModel;

class ProductController extends BaseController
{
    private $productModel;
    private $recusive;
    private $categoryModel;
    public function __construct()
    {
        if(!$this->checkUser($_SESSION['user_name'])){
            header('Location:admin.php?c=login');
            exit();
        }
        $this->productModel = new ProductModel;
        $this->recusive = new RecusiveCategory;
        $this->categoryModel = new CategoryModel;
    }
    public function index()
    {
        $data = [];
        $data['product'] = $this->productModel->getDataProduct();
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('product/index',$data);
        $this->loadFooter();
    }

    public function add()
    {
        $data = [];
        $category = $this->categoryModel->getDataCtegory();
        $data['category'] = $this->recusive->categoryOption($category);
        if(isset($_SESSION['errProduct'])){
            $data['errProduct'] = $_SESSION['errProduct'];
        }
        if(isset($_GET['state']) && $_GET['state'] == 'errAddProduct'){
            $data['errAddProduct'] = 'Sản phẩm đã tồn tại';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('product/add',$data);
        $this->loadFooter();
    }

    public function hadnelAdd()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'] . ' '. substr(md5(rand()), 0, 15);
            
            $category = $_POST['category'];
            $price = $_POST['price'];
            $price_discout = $_POST['price_discout'];
            if($price_discout == ''){
                $price_discout = $price;
                $discout = round(($price-$price_discout)/$price*100,0);
            }else{
               
                    $discout = round(($price-$price_discout)/$price*100,0);
                              
            }
            $target_dir = "public/upload/";
           
            
            if(!empty($_FILES['image']['name'])){
                $upload = true;
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "bmp" ){
                    $upload = false;
                }
            }

            if(!empty($_FILES['images']['name'])){
                $uploads = true;
                $target_files = $_FILES["images"]["name"];
                
            }

            $errol = $this->validateProduct($upload);
            $flag = true;
            if($errol!=''){
                $flag = false;
            }
            if($this->productModel->checkAdd($name)){
                if($flag){
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    $id = $this->productModel->addProduct($name,$category,$price,$price_discout,$discout,$target_file);
    
                    foreach($target_files as $key=>$value){
                        move_uploaded_file($_FILES['images']['tmp_name'][$key],$target_dir . $value);
                    }
                    foreach($target_files as $value){
                        $this->productModel->addImgProduct($id,$target_dir . $value);
                    }
                    if(isset($_SESSION['errProduct'])){
                        unset($_SESSION['errProduct']);
                    }
                    header('Location:admin.php?c=product');
                }else{
                    $_SESSION['errProduct'] = $errol;
                    header('Location:admin.php?c=product&m=add');
                }
            }else{
                header('Location:admin.php?c=product&m=add&state=errAddProduct');
            }            
        }

    }

    public function update()
    {
        $data = [];
        $id = $_GET['id'];
        $data['product'] = $this->productModel->getIdProduct($id);
        $category = $this->categoryModel->getDataCtegory();
        $data['category'] = $this->recusive->categoryOption($category);
        $data['img'] = $this->productModel->getImgProduct($id);
        if(isset($_SESSION['errUpdateProduct'])){
            $data['errUpdateProduct'] = $_SESSION['errUpdateProduct'];
        }
        if(isset($_GET['state']) && $_GET['state'] == 'errUpdate')
        {
            $data['errUpdate'] = 'Mã sản phẩm đã tồn tại';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('product/update',$data);
        $this->loadFooter();
    }

    public function hadnelUpdate()
    {
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
           
            $name = $_POST['name'];
            $category = $_POST['category'];
            $status = $_POST['status'];
            $price = $_POST['price'];
            $price_discout = $_POST['price_discout'];
            if($price_discout == ''){
                $price_discout = $price;
                $discout = round(($price-$price_discout)/$price*100,0);
            }else{
               
                    $discout = round(($price-$price_discout)/$price*100,0);
                              
            }
            $target_dir = 'public/upload/';
            $upload = true;
            if(!empty($_FILES['image']['name'])){
                
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "bmp" ){
                    $upload = false;
                }
            }else{
                $target_file = $_POST['img'];
            }
            
            $flag = true;
            $errol = $this->validateProduct($upload);
            
            if($errol!=''){
                $flag = false;
            }
            if($this->productModel->checkUpdate($name,$id)){
                if($flag){
                    if(isset($_SESSION['errUpdateProduct'])){
                        unset($_SESSION['errUpdateProduct']);
                    }
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    $this->productModel->updateProduct($id,$name,$category,$price, $price_discout, $discout,$target_file,$status);
    
                    if(!empty($_FILES['images']['name'][0])){
                        $target_files = $_FILES['images']['name'];
                        foreach($target_files as $key => $value){
                            move_uploaded_file($_FILES["images"]["tmp_name"][$key], $target_dir . $value);
                        }
                        $this->productModel->deleteImgProduct($id);                    
                        foreach($target_files as $value){
                            $this->productModel->addImgProduct($id,$target_dir . $value);
                        }                   
                    }
                    header('Location:admin.php?c=product');
                }else{
                    $_SESSION['errUpdateProduct'] = $errol;
                    header('Location:admin.php?c=product&m=update&id='.$id.'');
                }
            }else{
                header('Location:admin.php?c=product&m=update&id='.$id.'&state=errUpdate');
            }
            

        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->productModel->deleteProduct($id);
        header('Location:admin.php?c=product');
    }
    public function validateProduct($upload)
    {
        $err = !$upload ? 'Vui lòng kiểm tra định dạng ảnh' : '';
    
        return $err;
    }
}