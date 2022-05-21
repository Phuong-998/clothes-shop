<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class BannerModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataBanner()
    {
        $result = [];
        $sql = 'SELECT * FROM banner ORDER BY id DESC';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function addBanner($name,$image,$url,$state)
    {
        $sql = 'INSERT INTO banner(name,image,url,state) VALUES(:name,:image,:url,:state)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':image',$image,PDO::PARAM_STR);
            $stmt->bindParam(':url',$url,PDO::PARAM_STR);
            $stmt->bindParam(':state',$state,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function getIdBanner($id)
    {
        $result = [];
        $sql = 'SELECT * FROM banner WHERE id =:id';
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

    public function updatebanner($id,$name,$image,$url,$state)
    {
        $sql = 'UPDATE banner SET name =:name,image =:image,url =:url,state =:state WHERE id=:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':image',$image,PDO::PARAM_STR);
            $stmt->bindParam(':url',$url,PDO::PARAM_STR);
            $stmt->bindParam(':state',$state,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function deleteBanner($id)
    {
        $sql = 'DELETE FROM banner WHERE id=:id';
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