<?php 
namespace app\model\frontend;
use app\database\Database;
use \PDO;

class PageModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function category()
    {
        $result = [];
        $sql = 'SELECT * FROM category';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }
    public function getnameCate($cateId)
    {
        $result = [];
        $sql = 'SELECT * FROM category WHERE id =:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$cateId,PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }
    public function getProduct($category)
    {
        $result = [];
        $sql = 'SELECT * FROM product WHERE status =1 AND category_id IN('.$category.')';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getProductId($category)
    {
        $result = [];
        $sql = 'SELECT id FROM product WHERE status =1 AND category_id IN('.$category.')';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }
    public function getColorproduct($productId)
    {
        $result = [];
        $sql = 'SELECT DISTINCT color_id,color.name FROM product_detail INNER JOIN color ON color.id = product_detail.color_id WHERE product_id IN ('.$productId.')';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getSizeproduct($productId)
    {
        $result = [];
        $sql = 'SELECT DISTINCT size_id,size.name FROM product_detail INNER JOIN size ON size.id = product_detail.size_id WHERE product_id IN ('.$productId.')';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function searchPage($sql)
    {
        $result = [];
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getDataProductByPage($start,$limit,$category)
    {
        $result = [];
        $sql = 'SELECT * FROM product WHERE status =1 AND category_id IN('.$category.') LIMIT :start, :limit';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':start',$start,PDO::PARAM_INT);
            $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }
}