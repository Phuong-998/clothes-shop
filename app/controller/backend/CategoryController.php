<?php 
namespace app\controller\backend;
use app\controller\backend\BaseController;
use app\model\backend\CategoryModel;
use app\coment\RecusiveCategory;

class CategoryController extends BaseController
{
    private $categoryModel;
    private $recusiveCate;
    public function __construct()
    {
        if(!$this->checkUser($_SESSION['user_name'])){
            header('Location:admin.php?c=login');
            exit();
        }
        $this->categoryModel = new CategoryModel;
        $this->recusiveCate = new RecusiveCategory;
    }

    public function index()
    {
        $data = [];
        $category = $this->categoryModel->getDataCtegory();
        $data['category'] = $this->recusiveCate->category($category);
        $data['categoryOption'] = $this->recusiveCate->categoryOption($category);
        
        if(isset($_GET['state']) && $_GET['state'] == 'errAddCate'){
            $data['errAddCate'] = 'Tên danh mục đã tồn tại';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('category/index',$data);
        $this->loadFooter();
    }

    public function hadnelAdd()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $parent = $_POST['parent'];
            
                if($this->categoryModel->checkAddCate($name)){
                    $this->categoryModel->addCate($name,$parent);
                    header('Location:admin.php?c=category');
                }else{
                    header('Location:admin.php?c=category&state=errAddCate');
                }
            
        }
    }

    public function update()
    {
        $data = [];
        $id = $_GET['id'];
        $category = $this->categoryModel->getDataCtegory();
        $categoryId = $this->categoryModel->getIdCategory($id);
        $data['category_id'] = $categoryId;
        $data['parent'] = $this->recusiveCate->updatecate($category,$categoryId['parent_id']);
        $data['categoryOption'] = $this->recusiveCate->categoryOption($category);
        
        if(isset($_GET['state']) && $_GET['state'] == 'errAddCate'){
            $data['errAddCate'] = 'Tên danh mục đã tồn tại';
        }
        $this->loadHeader();
        $this->loadNav();
        $this->loadView('category/update',$data);
        $this->loadFooter();
    }

    public function hadnelUpdate()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $id = $_POST['category_id'];
            $parent_id = $_POST['parent'];
            
                if($this->categoryModel->checkUpdate($name,$id)){
                    $this->categoryModel->updateCate($name,$id,$parent_id);
                    header('Location:admin.php?c=category');
                }else{
                    header('Location:admin.php?c=category&m=update&id='.$id.'&state=errNameCate');
                }
            
        }
    }

    public function delete()
    {
        $id = $_GET['id'];
        $this->categoryModel->deleteCate($id);
        header('Location:admin.php?c=category');
    }
}
