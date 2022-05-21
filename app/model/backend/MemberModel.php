<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class MemberModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataMember($id)
    {
        $result = [];
        $sql = 'SELECT * FROM admin WHERE id <> :id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            
        }
        return $result;
    }

    public function addMember($name,$fullname,$password,$role)
    {
        $sql = 'INSERT INTO admin(name,fullname,password,role) VALUE(:name,:fullname,:password,:role)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':fullname',$fullname,PDO::PARAM_STR);
            $stmt->bindParam(':password',$password,PDO::PARAM_STR);
            $stmt->bindParam(':role',$role,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function getIdMember($id)
    {
        $result = [];
        $sql = 'SELECT * FROM admin WHERE id =:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function updateMember($status,$role,$id)
    {
        $sql = 'UPDATE admin SET status = :status,role = :role WHERE id=:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':status',$status,PDO::PARAM_INT);
            $stmt->bindParam(':role',$role,PDO::PARAM_INT);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function deleteMember($id)
    {
        $sql = 'DELETE FROM admin WHERE id=:id';
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