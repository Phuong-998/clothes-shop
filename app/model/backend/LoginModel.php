<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class LoginModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkLogin($name,$password)
    {
        $result = [];
        $sql = 'SELECT * FROM admin WHERE name =:name AND password =:password AND status =1';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':password',$password,PDO::PARAM_STR);
            if($stmt->execute()){
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function changePass($id,$password)
    {
        $sql = 'UPDATE admin SET password =:password WHERE id =:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':password',$password,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function checkChangePass($id,$password)
    {
        $sql = 'SELECT * FROM admin WHERE id =:id AND password =:password';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':password',$password,PDO::PARAM_STR);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                if($stmt->rowCount() >0){
                    return true;
                }
            }
        }
        return false;
    }
}