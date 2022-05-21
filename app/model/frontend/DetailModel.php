<?php

namespace app\model\frontend;

use app\database\Database;
use \PDO;

class DetailModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProduct($id)
    {
        $result = [];
        $sql = 'SELECT * FROM product WHERE id =:id';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getColorproduct($product_id)
    {
        $result = [];
        $sql = 'SELECT DISTINCT color_img,color_id FROM product_detail WHERE product_id=:product_id';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getSizeproduct($product_id)
    {
        $result = [];
        $sql = 'SELECT DISTINCT size_id,size.name FROM product_detail INNER JOIN size ON product_detail.size_id = size.id WHERE product_id=:product_id';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getImgProduct($id)
    {
        $result = [];
        $sql = 'SELECT * FROM product_image WHERE product_id = :id
        ';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getProductCategory($category_id, $id)
    {
        $result = [];
        $sql = 'SELECT * FROM product WHERE category_id =:category_id AND status =1 AND id <>:id';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getQtyProduct($color,$size,$product_id)
    {
        $result = [];
        $sql = 'SELECT qty FROM product_detail WHERE product_id =:product_id AND color_id =:color_id AND size_id =:size_id ';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            $stmt->bindParam(':color_id',$color,PDO::PARAM_INT);
            $stmt->bindParam(':size_id',$size,PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    
}
