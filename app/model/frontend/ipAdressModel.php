<?php

namespace app\model\frontend;

use app\database\Database;
use \PDO;

class ipAdressModel extends Database
{
    public function addIpAdress($ip, $time)
    {
        $sql = 'INSERT INTO visitor (ip_address,date_time) VALUES (:ip,:time)';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
            $stmt->bindParam(':time', $time, PDO::PARAM_STR);
            if ($stmt->execute()) {
                return true;
            } 
        }
        return false;
    }

    public function totalAccess()
    {
        $result = [];
        $sql = 'SELECT COUNT(id) as qty FROM visitor';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } 
        }
        return $result;
    }

    public function totalAccesLastMonth()
    {
        $result = [];
        $sql = 'SELECT COUNT(id) as qty FROM `visitor` WHERE MONTH(date_time) = MONTH(CURRENT_DATE) - 1';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } 
        }
        return $result;
    }

    
    public function totalAccesMonth()
    {
        $result = [];
        $sql = 'SELECT COUNT(id) as qty FROM `visitor` WHERE MONTH(date_time) = MONTH(CURRENT_DATE)';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } 
        }
        return $result;
    }

    public function totalAccesYear()
    {
        $result = [];
        $sql = 'SELECT COUNT(id) as qty FROM `visitor` WHERE YEAR(date_time) = YEAR(CURRENT_DATE)';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } 
        }
        return $result;
    }

    public function totalAccesToday()
    {
        $result = [];
        $sql = 'SELECT COUNT(id) as qty FROM `visitor` WHERE date_time = CURRENT_DATE ';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            if ($stmt->execute()) {
                return $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } 
        }
        return $result;
    }

    public function checkIp($ip_address){
        $sql = 'SELECT id FROM visitor WHERE ip_address	= :ip_address';
        $stmt = $this->conDb->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':ip_address', $ip_address, PDO::PARAM_STR);
            if ($stmt->execute()) {
                if($stmt->rowCount() > 0){
                    return false;
                }
            } 
        }
        return true;
    }
    
}
