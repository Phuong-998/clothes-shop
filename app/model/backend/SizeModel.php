<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class SizeModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataSize()
    {
        $result = [];
        $sql = 'SELECT * FROM size';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function addSize($name)
    {
        $sql = 'INSERT INTO size (name) VALUES (:name)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function checkAddSize($name)
    {
        $sql = 'SELECT name FROM size WHERE name =:name';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            if($stmt->execute()){
                if($stmt->rowCount() > 0)
                return false;
            }
        }
        return true;
    }

    public function updateSize($id,$name)
    {
        $sql = 'UPDATE size SET name =:name WHERE id =:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':name',$name,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function checkUpdateSize($id,$name)
    {
        $sql = 'SELECT * FROM size WHERE name =:name AND id <>:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':name',$name,PDO::PARAM_INT);
            if($stmt->execute()){
                if($stmt->rowCount() > 0){
                    return false;
                }
            }
        }
        return true;
    }

    public function getIdSize($id)
    {
        $result = [];
        $sql = 'SELECT * FROM size WHERE id =:id';
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

    public function deleteSize($id)
    {
        $sql = 'DELETE FROM size WHERE id =:id';
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