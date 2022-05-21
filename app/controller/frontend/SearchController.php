<?php 
namespace app\controller\frontend;
use app\controller\frontend\BaseController;
use app\model\frontend\SearchModel;
use app\model\frontend\HomeModel;
class SearchController extends BaseController
{
    private $searhModel;
    private $homeModel;
    public function __construct()
    {
        $this->searhModel = new SearchModel;
        $this->homeModel = new HomeModel;
    }
    public function index()
    {
        if(isset($_POST['submit'])){
            $search = $_POST['search'];
            $data = [];
            $data['product'] = $this->searhModel->search($search);
            $data['category'] = $this->homeModel->getCategory(); 
            $data['search'] = $search;
            $this->loadHeader($data);
            $this->loadView('search/index',$data);
            $this->loadFooter();
        }
        
    }
}