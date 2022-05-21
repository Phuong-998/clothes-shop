<?php

namespace app\model\backend;

use app\database\Database;
use \PDO;

class DashBoardModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getida($year)
    {
        $result = [];
        $sql = "SELECT SUM(totalMoney) as money,MONTH(created_time) AS times FROM `orders` WHERE YEAR(created_time) = " . $year . " AND status <> 5 GROUP BY times;";
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function sumProduct()
    {
        $result = [];
        $sql = 'SELECT COUNT(id) AS qty FROM product ';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }
    public function getNotOrder()
    {
        $result = [];
        $sql = 'SELECT COUNT(id) AS orderc FROM orders WHERE status = 1';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function revenueToday($time)
    {
        $result = [];
        $sql = "SELECT SUM(totalMoney) as mony FROM `orders` WHERE created_time = CURRENT_DATE AND status <> 5 ";
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function tonkho()
    {
        $result = [];
        $sql = 'SELECT SUM(qty) AS qty FROM product ';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    // public function gettonkho()
    // {
    //     $sql = 'SELECT category.id,category.name,COUNT(*) as soluong , MAX(product.price_discout) as giacao, MIN(product.price_discout) as giathap FROM category INNER JOIN product ON category.id=product.category_id GROUP BY category.id,category.name';
    //     $stmt = $this->conDb->prepare($sql);
    //     if ($stmt) {
    //         if ($stmt->execute()) {
    //             $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //             return $result;
    //         }
    //     }
    //     return false;
    // }

    public function gettonkhoDetail($category)
    {
        $result = [];
        $sql = 'SELECT product.id,product.name as produc,category.name,product.image,product.price_discout,product.qty as tonkho FROM `product` INNER JOIN category ON category.id = product.category_id  WHERE category_id = :category GROUP by tonkho';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':category', $category, PDO::PARAM_INT);
            if ($stmt->execute()) {
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getQtyBuyTonkho()
    {
        $result = [];
        $sql = 'SELECT product_id,SUM(order_detail.qty) AS buy FROM `order_detail` INNER JOIN orders ON orders.id = order_detail.order_id INNER JOIN product ON product.id = order_detail.product_id WHERE orders.status <> 5 GROUP BY product_id';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }
    public function getQtySuccesOrder()
    {
        $result = [];
        $sql = 'SELECT COUNT(id) FROM orders WHERE status = 4';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getQtyFailOrder()
    {
        $result = [];
        $sql = 'SELECT COUNT(id) FROM orders WHERE status = 5';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getQtySuccesOrderDay($day)
    {
        $result = [];
        $sql = 'SELECT COUNT(id) FROM orders WHERE status = 4 AND created_time = "' . $day . '"';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getQtyFailOrderDay($day)
    {
        $result = [];
        $sql = 'SELECT COUNT(id) FROM orders WHERE status = 5 AND created_time = "' . $day . '"';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getQtySuccesOrderMY($month, $year)
    {
        $result = [];
        $sql = 'SELECT COUNT(id) FROM `orders` WHERE MONTH(created_time) = ' . $month . ' AND YEAR(created_time) = ' . $year . ' AND status = 4';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }
    public function getQtyFailOrderMY($month, $year)
    {
        $result = [];
        $sql = 'SELECT COUNT(id) FROM `orders` WHERE MONTH(created_time) = ' . $month . ' AND YEAR(created_time) = ' . $year . ' AND status = 5';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function getSellProduct()
    {
        $result = [];
        $sql = 'SELECT product_id,product.name,product.image,product.price,product.price_discout,product.discout,SUM(order_detail.qty) AS buy FROM `order_detail` INNER JOIN orders ON orders.id = order_detail.order_id INNER JOIN product ON product.id = order_detail.product_id WHERE orders.status <>5 GROUP BY product_id
        ';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function expenseToday()
    {
        $result = [];
        $sql = 'SELECT phieunhap.id,ncc.name as ncc,phieunhap.qty,phieunhap.totalmoney,phieunhap.created_time,phieunhap.name_admin,phieunhap.state FROM phieunhap INNER JOIN ncc ON phieunhap.ncc_id = ncc.id WHERE MONTH(created_time) = MONTH(CURRENT_DATE) AND YEAR(created_time) = YEAR(CURRENT_DATE)
        ';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function sumExpenseToday()
    {
        $result = [];
        $sql = 'SELECT SUM(totalmoney) AS totalMoney FROM `phieunhap` WHERE MONTH(created_time) = MONTH(CURRENT_DATE) AND YEAR(created_time) = YEAR(CURRENT_DATE)';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }

    public function expenseChart($year)
    {
        $result = [];
        $sql = 'SELECT SUM(totalmoney) AS totalMoney,MONTH(created_time) as times FROM `phieunhap` WHERE YEAR(created_time) = ' . $year . ' GROUP BY times
        ';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        return $result;
    }
   
}