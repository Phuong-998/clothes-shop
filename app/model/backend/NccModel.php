<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class NccModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataNcc()
    {
        $result = [];
        $sql = 'SELECT * FROM ncc';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function addNcc($name,$address,$phone)
    {
        $sql = 'INSERT INTO ncc(name,address,phone) VALUES(:name,:address,:phone)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':address',$address,PDO::PARAM_STR);
            $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function checkAdd($name)
    {
        $sql = 'SELECT * FROM ncc WHERE name =:name';
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

    public function getIdUpdate($id)
    {
        $result = [];
        $sql = 'SELECT * FROM ncc WHERE id =:id';
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

    public function updateNcc($id,$name,$address,$phone)
    {
        $sql = 'UPDATE ncc SET name =:name, address =:address, phone =:phone WHERE id=:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':address',$address,PDO::PARAM_STR);
            $stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function checkUpdate($name,$id)
    {
        $sql = 'SELECT * FROM ncc WHERE name =:name AND id <>:id';
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

    public function deleteNcc($id)
    {
        $sql = 'DELETE FROM ncc WHERE id =:id';
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