<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class ColorModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataColor()
    {
        $result = [];
        $sql = 'SELECT * FROM color';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function addColor($name)
    {
        $sql = 'INSERT INTO color(name) VALUES (:name)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function checkUpdateNameColor($id,$name)
    {
        $sql = 'SELECT name FROM color WHERE name =:name AND id <>:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    return false;
                }
            }
        }
        return true;
    }

    public function checkAddNameColor($name)
    {
        $sql = 'SELECT name FROM color WHERE name =:name';
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

    public function getIdColor($id)
    {
        $result = [];
        $sql = 'SELECT * FROM color WHERE id =:id';
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

    public function updateColor($id,$name)
    {
         $sql = 'UPDATE color SET name =:name WHERE id =:id';
         $stmt = $this->conDb->prepare($sql);
         if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
         }
         return false;
    }

    public function deleteColor($id)
    {
        $sql = 'DELETE FROM color WHERE id =:id';
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