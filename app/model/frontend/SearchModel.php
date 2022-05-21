<?php 
namespace app\model\frontend;
use app\database\Database;
use \PDO;

class SearchModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

   public function search($search)
    {
        $search = "%$search%";
        $sql = 'SELECT  product.id, product.name,product.price,product.price_discout,product.discout,product.category_id, qty, image, product.status FROM product INNER JOIN category ON product.category_id = category.id WHERE product.name LIKE ?';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute([$search])){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return false;
    }
}