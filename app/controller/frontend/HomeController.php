<?php 
namespace app\controller\frontend;
use app\controller\frontend\BaseController;
use app\model\frontend\HomeModel;

class HomeController extends BaseController
{
    private $homeModel;
    public function __construct()
    {
        $this->homeModel = new HomeModel;
    }

    public function index()
    {
        $data = [];
        $data['category'] = $this->homeModel->getCategory();
        $data['banner'] = $this->homeModel->getBanner();
        $data['newProduct'] = $this->homeModel->getNewProduct();
        $data['sellProduct'] = $this->homeModel->getSellProduct();
        $this->loadHeader($data);
        $this->loadBanner($data);
        $this->loadView('home/index',$data);
        $this->loadFooter();
    }
}