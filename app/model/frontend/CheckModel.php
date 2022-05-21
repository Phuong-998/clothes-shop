<?php

namespace app\model\frontend;

use app\database\Database;
use \PDO;

class CheckModel extends Database
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

    public function getShip($tinh,$quan,$phuong)
    {
        $result = [];
        $sql = 'SELECT ships FROM ship WHERE matp=:tinh AND maquanhuyen=:quan AND maphuong=:phuong';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':tinh',$tinh,PDO::PARAM_INT);
            $stmt->bindParam(':quan',$quan,PDO::PARAM_INT);
            $stmt->bindParam(':phuong',$phuong,PDO::PARAM_INT);
            if($stmt->execute()){
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function addMember($name,$tel,$address,$tinh,$quan,$phuong)
    {
        $sql = 'INSERT INTO member(name,phone,address,matp ,maqh ,maph) VALUES(:name,:tel,:address,:tinh,:quan,:phuong)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            $stmt->bindParam(':tel',$tel,PDO::PARAM_STR);
            $stmt->bindParam(':address',$address,PDO::PARAM_STR);
            
            $stmt->bindParam(':tinh',$tinh,PDO::PARAM_INT);
            $stmt->bindParam(':quan',$quan,PDO::PARAM_INT);
            $stmt->bindParam(':phuong',$phuong,PDO::PARAM_INT);
            if($stmt->execute()){
                $key = $this->conDb->lastInsertId();
                return $key;
            }
        }
        return false;
    }

    public function addOrder($member_id,$totalMoney,$time,$ship,$note)
    {
        $sql = 'INSERT INTO orders(member_id,totalMoney,created_time,ship,note) VALUES(:member_id,:totalMoney,:time,:ship,:note)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':member_id',$member_id,PDO::PARAM_INT);
            $stmt->bindParam(':totalMoney',$totalMoney,PDO::PARAM_INT);
            $stmt->bindParam(':ship',$ship,PDO::PARAM_INT);
            $stmt->bindParam(':time',$time,PDO::PARAM_STR);
            $stmt->bindParam(':note',$note,PDO::PARAM_STR);
            if($stmt->execute()){
                $key = $this->conDb->lastInsertId();
                return $key;
            }
        }
        return false;
    }

    public function addDetailOrder($order_id,$product_id ,$size,$color,$color_img,$qty,$price){
        $sql = 'INSERT INTO order_detail(order_id,product_id,size,color,color_img,qty,price) VALUES(:order_id,:product_id,:size,:color,:color_img,:qty,:price)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':order_id',$order_id,PDO::PARAM_INT);
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            $stmt->bindParam(':size',$size,PDO::PARAM_STR);
            $stmt->bindParam(':color',$color,PDO::PARAM_STR);
            $stmt->bindParam(':color_img',$color_img,PDO::PARAM_STR);
            $stmt->bindParam(':qty',$qty,PDO::PARAM_INT);
            $stmt->bindParam(':price',$price,PDO::PARAM_INT);
            if($stmt->execute()){
               return true;
            }
        }
        return false;
    }

    public function getIdSize($name)
    {
        $result = [];
        $sql = 'SELECT id FROM size WHERE name =:name';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            if($stmt->execute()){
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getIdColor($name)
    {
        $result = [];
        $sql = 'SELECT id FROM color WHERE name =:name';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':name',$name,PDO::PARAM_STR);
            if($stmt->execute()){
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getQty($product_id,$size,$color)
    {
        $result = [];
        $sql = 'SELECT qty FROM product_detail WHERE product_id=:product_id AND size_id=:size AND color_id=:color';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            $stmt->bindParam(':size',$size,PDO::PARAM_INT);
            $stmt->bindParam(':color',$color,PDO::PARAM_INT);
            if($stmt->execute()){
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function updateQty($product_id,$size,$color,$qty)
    {
        $sql = 'UPDATE product_detail SET qty=:qty WHERE product_id=:product_id AND size_id=:size AND color_id=:color';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            $stmt->bindParam(':size',$size,PDO::PARAM_INT);
            $stmt->bindParam(':color',$color,PDO::PARAM_INT);
            $stmt->bindParam(':qty',$qty,PDO::PARAM_INT);
            if($stmt->execute()){
               return true;
            }
        }
        return false;
    }

    public function updateQty1($product_id,$qty)
    {
        $sql = 'UPDATE product SET qty=:qty WHERE id=:product_id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            $stmt->bindParam(':qty',$qty,PDO::PARAM_INT);
            if($stmt->execute()){
               return true;
            }
        }
        return false;
    }

    public function getQty1($product_id)
    {
        $result = [];
        $sql = 'SELECT qty FROM product WHERE id=:product_id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            if($stmt->execute()){
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

}