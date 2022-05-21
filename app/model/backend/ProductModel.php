<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class ProductModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataProduct()
    {
        
        $result = [];
        $sql = 'SELECT product.id, product.name,product.price,product.price_discout,product.discout, category.name as category, qty, image, product.status FROM product INNER JOIN category ON product.category_id = category.id
        ';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function addProduct( $name, $category_id,$price, $price_discout, $discout,$image)
    {
        $sql = 'INSERT INTO product( name, category_id, price, price_discout,discout, image) VALUES(:name, :category_id,:price, :price_discout, :discout, :image)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':category_id',$category_id,PDO::PARAM_INT);
            $stmt->bindParam(':price',$price,PDO::PARAM_INT);
            $stmt->bindParam(':price_discout',$price_discout,PDO::PARAM_INT);
            $stmt->bindParam(':discout',$discout,PDO::PARAM_INT); 
            $stmt->bindParam(':image',$image,PDO::PARAM_STR);
            if($stmt->execute()){
               $key = $this->conDb->lastInsertId();
               return $key;
            }
        }
        return false;
    }

    public function addImgProduct($product_id,$image)
    {
        $sql = 'INSERT INTO product_image(product_id, image) VALUES(:product_id, :image)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            $stmt->bindParam(':image',$image,PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function getIdProduct($id)
    {
        $result = [];
        $sql = 'SELECT product.id, product.name,product.price,product.price_discout, category.name as category, category.id as categoryId, qty, image, product.status FROM product INNER JOIN category ON product.category_id = category.id WHERE product.id =:id ';
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

    public function getImgProduct($productId)
    {
        $result = [];
        $sql = 'SELECT * FROM product_image WHERE product_id =:productId';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':productId',$productId,PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function updateProduct($id, $name, $category_id,$price, $price_discout, $discout ,$image,$status)
    {
        $sql = 'UPDATE product SET name =:name, category_id =:category_id,price =:price,price_discout =:price_discout, discout =:discout, image =:image, status =:status WHERE id=:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
           
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':category_id',$category_id,PDO::PARAM_INT);
            $stmt->bindParam(':price',$price,PDO::PARAM_INT);
            $stmt->bindParam(':price_discout',$price_discout,PDO::PARAM_INT);
            $stmt->bindParam(':discout',$discout,PDO::PARAM_INT);
            $stmt->bindParam(':image',$image,PDO::PARAM_STR);
            $stmt->bindParam(':status',$status,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function deleteImgProduct($product_id)
    {
        $sql = 'DELETE FROM product_image WHERE product_id =:product_id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function deleteProduct($id)
    {
        $sql = 'DELETE FROM product WHERE id =:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function checkAdd($name)
    {
        $sql = 'SELECT * FROM product WHERE name =:name';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    return false;
                }
            }
        }
        return true;
    }

    public function checkUpdate($name,$id)
    {
        $sql = 'SELECT * FROM product WHERE name =:name AND id <>:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$masp,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    return false;
                }
            }
        }
        return true;
    }
}