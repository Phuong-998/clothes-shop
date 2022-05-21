<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class OrderModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataOrder()
    {
        $result = [];
        $sql = 'SELECT member.id as memberId,member.name, orders.id AS ordersId, orders.totalMoney, orders.created_time, orders.status, orders.ship FROM `member` INNER JOIN orders ON orders.member_id = member.id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getMemberOrder($order_id)
    {
        $result = [];
        $sql = 'SELECT member.name, member.id AS memberId, member.phone, member.address, tinhthanhpho.name AS tp, quanhuyen.name AS quanhuyen,xaphuongthitran.name AS phuong,orders.id, orders.created_time, orders.status,orders.ship FROM member INNER JOIN tinhthanhpho ON tinhthanhpho.matp = member.matp INNER JOIN quanhuyen ON quanhuyen.maqh = member.maqh INNER JOIN xaphuongthitran ON xaphuongthitran.xaid = member.maph INNER JOIN orders on orders.member_id = member.id WHERE orders.id = :order_id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':order_id',$order_id,PDO::PARAM_INT);
            if($stmt->execute()){
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getDetailOrder($order_id)
    {
        $result = [];
        $sql = 'SELECT product.name,product.id, order_detail.size,order_detail.color, order_detail.color_img, order_detail.qty,order_detail.price FROM `order_detail` INNER JOIN orders ON orders.id = order_detail.order_id INNER JOIN product ON product.id = order_detail.product_id WHERE order_id = :order_id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':order_id',$order_id,PDO::PARAM_INT);
            if($stmt->execute()){
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function updateOrder($order_id,$status)
    {
        $sql = 'UPDATE orders SET status=:status WHERE id=:order_id ';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':order_id',$order_id,PDO::PARAM_INT);
            $stmt->bindParam(':status',$status,PDO::PARAM_INT);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function getNoProcesOrder()
    {
        $result = [];
        $sql = 'SELECT member.id as memberId,member.name, orders.id AS ordersId, orders.totalMoney, orders.created_time, orders.status, orders.ship FROM `member` INNER JOIN orders ON orders.member_id = member.id WHERE orders.status = 1';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function revenueToday()
    {
        $result = [];
        $sql = 'SELECT member.id as memberId,member.name, orders.id AS ordersId, orders.totalMoney, orders.created_time, orders.status, orders.ship FROM `member` INNER JOIN orders ON orders.member_id = member.id WHERE orders.status <> 5 AND orders.created_time = CURRENT_DATE';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getRevenDay()
    {
        $result = [];
        $sql = 'SELECT DAY(created_time)as times,SUM(totalMoney) AS money FROM `orders` WHERE status <> 5 AND YEAR(created_time) = YEAR(CURRENT_DATE) AND MONTH(created_time)= MONTH(CURRENT_DATE) GROUP BY times';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }
}