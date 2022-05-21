<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class ShipModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataTinh()
    {
        $result = [];
        $sql = 'SELECT * FROM tinhthanhpho';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getDataQuan($matp)
    {
        $result = [];
        $sql = 'SELECT * FROM quanhuyen WHERE matp =:matp';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':matp',$matp,PDO::PARAM_INT);
            if($stmt->execute()){
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getDataPhuong($maQuan)
    {
        $result = [];
        $sql = 'SELECT * FROM xaphuongthitran WHERE maqh =:maQuan';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':maQuan',$maQuan,PDO::PARAM_INT);
            if($stmt->execute()){
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function addShip($tinh,$quan,$phuong,$ship)
    {
        $sql = 'INSERT INTO ship(matp ,maquanhuyen ,maphuong ,ships) VALUES(:tinh,:quan,:phuong,:ship)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':tinh',$tinh,PDO::PARAM_INT);
            $stmt->bindParam(':quan',$quan,PDO::PARAM_INT);
            $stmt->bindParam(':phuong',$phuong,PDO::PARAM_INT);
            $stmt->bindParam(':ship',$ship,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function getDataship()
    {
        $result = [];
        $sql = 'SELECT ship.id,ship.matp,ship.maquanhuyen,ship.maphuong,ship.ships,tinhthanhpho.name as nametinh,quanhuyen.name AS namequan,xaphuongthitran.name AS namephuong FROM `ship` INNER JOIN tinhthanhpho ON tinhthanhpho.matp = ship.matp INNER JOIN quanhuyen ON quanhuyen.maqh = ship.maquanhuyen INNER JOIN xaphuongthitran ON xaphuongthitran.xaid = ship.maphuong;
        ';
         $stmt = $this->conDb->prepare($sql);
         if($stmt){
             if($stmt->execute()){
                 return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
             }
         }
         return $result;
    }

    public function checkAddShip($tinh,$quan,$phuong)
    {
        $sql = 'SELECT * FROM ship WHERE matp=:tinh AND maquanhuyen=:quan AND maphuong=:phuong';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':tinh',$tinh,PDO::PARAM_INT);
            $stmt->bindParam(':quan',$quan,PDO::PARAM_INT);
            $stmt->bindParam(':phuong',$phuong,PDO::PARAM_INT);
            if($stmt->execute()){
                if($stmt->rowCount() >0){
                    return false;
                }
            }
        }
        return true;
    }

    public function getShipId($id)
    {
        $result = [];
        $sql = 'SELECT ship.id,ship.matp,ship.maquanhuyen,ship.maphuong,ship.ships,tinhthanhpho.name as nametinh,quanhuyen.name AS namequan,xaphuongthitran.name AS namephuong FROM `ship` INNER JOIN tinhthanhpho ON tinhthanhpho.matp = ship.matp INNER JOIN quanhuyen ON quanhuyen.maqh = ship.maquanhuyen INNER JOIN xaphuongthitran ON xaphuongthitran.xaid = ship.maphuong WHERE ship.id=:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function updateShip($id,$ship)
    {
        $sql = 'UPDATE ship SET ships=:ship WHERE id=:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            $stmt->bindParam(':ship',$ship,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function deteleShip($id)
    {
        $sql = 'DELETE FROM ship WHERE id=:id';
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