<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class ProductDetailModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProductDetail($product_id)
    {
        $result = [];
        $sql = 'SELECT product_detail.id, product_id, color_id,color_img, size_id, qty, color.name as color, size.name as size FROM `product_detail` INNER JOIN color ON color.id = product_detail.color_id INNER JOIN size ON size.id = product_detail.size_id WHERE product_id = :product_id;
        ';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function addProductDetail($product_id, $color_id, $color_img, $size_id, $qty)
    {
        $sql = 'INSERT INTO product_detail(product_id, color_id, color_img, size_id, qty ) VALUES(:product_id, :color_id, :color_img, :size_id, :qty)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            $stmt->bindParam(':color_id',$color_id,PDO::PARAM_INT);
            $stmt->bindParam(':color_img',$color_img,PDO::PARAM_STR);
            $stmt->bindParam(':size_id',$size_id,PDO::PARAM_INT);
            $stmt->bindParam(':qty',$qty,PDO::PARAM_INT);
            
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function getIdProductDetail($id)
    {
        $result = [];
        $sql = 'SELECT * FROM product_detail WHERE id =:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function updateProductDetail($id,$qty,$color_img)
    {
        $sql = 'UPDATE product_detail SET color_img =:color_img, qty =:qty  WHERE id=:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':color_img',$color_img,PDO::PARAM_STR);
            $stmt->bindParam(':qty',$qty,PDO::PARAM_INT);
           
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function checkAddDetail($product_id,$size_id,$color_id)
    {
        $sql = 'SELECT * FROM product_detail WHERE product_id =:product_id AND color_id =:color_id AND size_id =:size_id ';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            $stmt->bindParam(':color_id',$color_id,PDO::PARAM_INT);
            $stmt->bindParam(':size_id',$size_id,PDO::PARAM_INT);
            if($stmt->execute()){
                if($stmt->rowCount() >0){
                    return false;
                }
            }
        }
        return true;
    }

    public function deletedetail($id)
    {
        $sql = 'DELETE FROM product_detail WHERE id=:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function getSumQty($product_id){
        $result = [];
        $sql = 'SELECT SUM(qty) FROM `product_detail` WHERE product_id = :product_id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function updateSumQty($product_id,$qty){
     
        $sql = 'UPDATE product SET qty =:qty WHERE id=:product_id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':qty',$qty,PDO::PARAM_INT);
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            if($stmt->execute()){
               return true;
            }
        }
        return false;
    }
}