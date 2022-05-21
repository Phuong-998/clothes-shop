<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class CategoryModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataCtegory()
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
    
    public function checkAddCate($name)
    {
        $sql = 'SELECT * FROM category WHERE name=:name';
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

    public function addCate($name,$parent)
    {
        $sql = 'INSERT INTO category(name,parent_id) VALUES(:name,:parent)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':parent',$parent,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function getIdCategory($id)
    {
        $result = [];
        $sql = 'SELECT * FROM category WHERE id =:id';
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

   public function checkUpdate($name,$id)
   {
       $sql = 'SELECT * FROM category WHERE name =:name AND id <>:id';
       $stmt = $this->conDb->prepare($sql);
       if($stmt){
           $stmt->bindParam(':name',$name,PDO::PARAM_STR);
           $stmt->bindParam(':id',$id,PDO::PARAM_INT);
           if($stmt->execute()){
               if($stmt->rowCount() > 0){
                   return false;
               }
           }
       }
       return true;
   }

   public function updateCate($name,$id,$parent_id)
   {
        $sql = 'UPDATE category SET name = :name,parent_id =:parent_id WHERE id=:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':parent_id',$parent_id,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
   }

   public function deleteCate($id)
   {
       $sql = 'DELETE FROM category WHERE id =:id';
       $stmt = $this->conDb->prepare($sql);
       if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            } 
       }
       return false;
   }
}