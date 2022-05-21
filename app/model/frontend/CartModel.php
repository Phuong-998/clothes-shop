<?php

namespace app\model\frontend;

use app\database\Database;
use \PDO;

class CartModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataproduct($productId,$color_id,$size_id)
    {
        $result = [];
        $sql = 'SELECT color.name AS color,size.name AS size,product.name AS product,product_id,color_img FROM product_detail INNER JOIN product ON product.id = product_detail.product_id INNER JOIN color ON color.id = product_detail.color_id INNER JOIN size ON size.id = product_detail.size_id WHERE product_id = :product_id AND color_id =:color_id AND size_id = :size_id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$productId,PDO::PARAM_INT);
            $stmt->bindParam(':color_id',$color_id,PDO::PARAM_INT);
            $stmt->bindParam(':size_id',$size_id,PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getQtyCart($productId,$color_id,$size_id)
    {
        $result = [];
        $sql = 'SELECT qty FROM product_detail WHERE product_id=:product_id AND color_id=:color_id AND size_id=:size_id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$productId,PDO::PARAM_INT);
            $stmt->bindParam(':color_id',$color_id,PDO::PARAM_INT);
            $stmt->bindParam(':size_id',$size_id,PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }
    
}
