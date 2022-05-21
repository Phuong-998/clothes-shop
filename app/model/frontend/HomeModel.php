<?php 
namespace app\model\frontend;
use app\database\Database;
use \PDO;

class HomeModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategory()
    {
        $result = [];
        $sql = 'SELECT * FROM category WHERE parent_id = 0';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getBanner()
    {
        $result = [];
        $sql = 'SELECT * FROM banner WHERE state =1 ORDER BY id DESC';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getNewProduct()
    {
        $result = [];
        $sql = 'SELECT * FROM product ORDER BY id DESC LIMIT 8 ';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getSellProduct()
    {
        $result = [];
        $sql = 'SELECT product_id,product.name,product.category_id,product.discout,product.image,product.price,product.price_discout,SUM(order_detail.qty) as qty FROM `order_detail` INNER JOIN orders ON orders.id = order_detail.order_id INNER JOIN product ON product.id = order_detail.product_id WHERE orders.status = 4 GROUP BY product_id ORDER BY qty DESC LIMIT 8';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }
}