<?php

namespace app\controller\frontend;

use app\controller\frontend\BaseController;
use app\model\frontend\HomeModel;
use app\coment\MenuRecusive;
use app\model\frontend\PageModel;
use app\coment\Pagination;

class PageController extends BaseController
{
    private $homeModel;
    private $menu;
    private $pageModel;
    private $pagination;
    private $limit = 5;
    public function __construct()
    {
        $this->homeModel = new HomeModel;
        $this->menu = new MenuRecusive;
        $this->pageModel = new PageModel;
        $this->pagination = new Pagination;
    }

    public function index()
    {

        $data = [];
        $data['category'] =  $this->homeModel->getCategory();
        $data['banner'] = $this->homeModel->getBanner();
        //menu

        $cateId = $_GET['cate'];
        $data['cate1'] = $cateId;

        $data['cate'] = $this->pageModel->getnameCate($cateId);
        $category = $this->pageModel->category();
        $menu = $this->menu->menuRecu($category, $cateId);
        $data['menu'] = $menu;

        //loc
        $category = $this->menu->getProductPage($category, $cateId);
        if ($category == '') {
            $category = $cateId;
        } else {
            $category = implode(",", $category);
        }

        $productId = $this->pageModel->getProductId($category);
        $filterColor = [];
        foreach ($productId as $value) {
            $filterColor[] = $value['id'];
        }
        $filterColor = implode(",", $filterColor);
        $data['colorFilter'] = $this->pageModel->getColorproduct($filterColor);
        $filterSize = [];
        foreach ($productId as $value) {
            $filterSize[] = $value['id'];
        }
        $filterSize = implode(",", $filterSize);
        $data['sizeFilter'] = $this->pageModel->getSizeproduct($filterSize);

        // data loc

        $arrlink = [
            'c' => 'page',
            'cate' => '' . $cateId . '',
            'page' => '{trang}'
        ];
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $product = $this->pageModel->getProduct($category);
        $link = $this->pagination->createLink($arrlink);
        $pagi = $this->pagination->creatPagination($link, count($product), $page, $this->limit);
        $data['pagination'] = $pagi['html'];
        $data['product'] = $this->pageModel->getDataProductByPage($pagi['start'], $this->limit, $category);
        $this->loadHeader($data);
        $this->loadBanner($data);
        $this->loadView('page/index', $data);
        $this->loadFooter();
    }

    public function searchPage()
    {
        $data = [];
        $data['category'] =  $this->homeModel->getCategory();
        $data['banner'] = $this->homeModel->getBanner();
        //menu
        if (isset($_GET['cate'])) {
            $cateId = $_GET['cate'];
            $data['cate1'] = $cateId;
        }

        $category = $this->pageModel->category();
        $menu = $this->menu->menuRecu($category, $cateId);
        $data['menu'] = $menu;

        //loc
        $category = $this->menu->getProductPage($category, $cateId);
        if ($category == '') {
            $category = $cateId;
        } else {
            $category = implode(",", $category);
        }
        $productId = $this->pageModel->getProductId($category);

        $filterColor = [];
        foreach ($productId as $value) {
            $filterColor[] = $value['id'];
        }
        $filterColor = implode(",", $filterColor);
        $data['colorFilter'] = $this->pageModel->getColorproduct($filterColor);
        $filterSize = [];
        foreach ($productId as $value) {
            $filterSize[] = $value['id'];
        }
        $filterSize = implode(",", $filterSize);
        $data['sizeFilter'] = $this->pageModel->getSizeproduct($filterSize);



        $product = [];
        foreach ($productId as $value) {
            $product[] = $value['id'];
        }
        $product = implode(",", $product);
        $sql = 'SELECT DISTINCT product.id,product.name,product.image,product.price,product.price_discout,product.discout,product.image,product.category_id FROM `product` INNER JOIN product_detail ON product.id = product_detail.product_id WHERE product.status= 1 AND product.id IN(' . $product . ') ';

        if (isset($_GET['color']) && $_GET['color'] != '') {
            $color = implode(",", $_GET['color']);
            $sql .= 'AND product_detail.color_id IN(' . $color . ')';
        }
        if (isset($_GET['size']) && $_GET['size'] != '') {
            $size = implode(",", $_GET['size']);
            $sql .= 'AND product_detail.size_id IN(' . $size . ')';
        }
        $minPrice = $_GET['minPrice'];
        $maxPrice = $_GET['maxPrice'];
        $sql .= 'AND product.price_discout BETWEEN ' . $minPrice . ' AND ' . $maxPrice . '';
        if (isset($_GET['oderByPage'])) {
            if ($_GET['oderByPage'] == 2) {
                $sql .= ' ORDER BY product.price_discout DESC';
            }
        }


        $data['product'] = $this->pageModel->searchPage($sql);

        $this->loadHeader($data);
        $this->loadBanner($data);
        $this->loadView('page/search', $data);
        $this->loadFooter();
    }
}
