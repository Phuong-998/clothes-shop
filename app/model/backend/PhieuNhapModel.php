<?php 
namespace app\model\backend;
use app\database\Database;
use \PDO;

class PhieuNhapModel extends Database
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDataPhieuNhap()
    {
        $result = [];
        $sql = 'SELECT phieunhap.id,ncc.name as ncc,phieunhap.qty,phieunhap.totalmoney,phieunhap.created_time,phieunhap.name_admin,phieunhap.state FROM phieunhap INNER JOIN ncc ON phieunhap.ncc_id = ncc.id
        ';
         $stmt = $this->conDb->prepare($sql);
         if($stmt){
             if($stmt->execute()){
                 $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                 return $result;
             }
         }
         return $result;
    }
    public function getProduct()
    {
        $result = [];
        $sql = 'SELECT * FROM product';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }
    public function getProductId($id)
    {
        $result = [];
        $sql = 'SELECT * FROM product WHERE id =:id';
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
    public function addOrder($ncc,$qty,$money,$time,$admin,$state)
    {
        $sql = 'INSERT INTO phieunhap(ncc_id,qty,totalmoney,created_time,name_admin,state) VALUES(:ncc,:qty,:money,:time,:admin,:state)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':ncc',$ncc,PDO::PARAM_INT);
            $stmt->bindParam(':qty',$qty,PDO::PARAM_INT);
            $stmt->bindParam(':money',$money,PDO::PARAM_INT);
            $stmt->bindParam(':time',$time,PDO::PARAM_STR);
            $stmt->bindParam(':admin',$admin,PDO::PARAM_STR);
            $stmt->bindParam(':state',$state,PDO::PARAM_INT);
            if($stmt->execute()){
                $key = $this->conDb->lastInsertId();
                return $key;
            }
        }
        return false;
    }
    
    public function addOrderDetail($ProductId,$phieunhap_id,$price,$qty,$color,$size)
    {
        $sql = 'INSERT INTO chitiephieunhap(product_id,phieunhap_id,price_import,qty,color,size) VALUES(:ProductId,:phieunhap_id,:price,:qty,:color,:size)';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':ProductId',$ProductId,PDO::PARAM_INT);
            $stmt->bindParam(':phieunhap_id',$phieunhap_id,PDO::PARAM_INT);
            $stmt->bindParam(':price',$price,PDO::PARAM_INT);
            $stmt->bindParam(':qty',$qty,PDO::PARAM_INT);
            $stmt->bindParam(':color',$color,PDO::PARAM_STR);
            $stmt->bindParam(':size',$size,PDO::PARAM_STR);
            if($stmt->execute()){
                return true;
            }
        }
        return false;
    }

    public function getChiTietPhieuNhap($id)
    {
        $result = [];
        $sql = 'SELECT chitiephieunhap.id,product.name,chitiephieunhap.price_import,chitiephieunhap.qty,chitiephieunhap.color,chitiephieunhap.size FROM chitiephieunhap INNER JOIN phieunhap ON phieunhap.id = chitiephieunhap.phieunhap_id INNER JOIN product ON chitiephieunhap.product_id = product.id WHERE phieunhap.id = :id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
        }
        return $result;
    }

    public function getIdPhieuNhap($id)
    {
        $result = [];
        $sql = 'SELECT phieunhap.id,ncc.name as ncc,phieunhap.qty,phieunhap.totalmoney,phieunhap.created_time,phieunhap.name_admin,phieunhap.state FROM phieunhap INNER JOIN ncc ON phieunhap.ncc_id = ncc.id WHERE phieunhap.id =:id
        ';
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

    public function thanhtoan($id,$state)
    {
        $sql = 'UPDATE phieunhap SET state =:state WHERE id =:id';
        $stmt = $this->conDb->prepare($sql);
        if($stmt){
            $stmt->bindParam(':state',$state,PDO::PARAM_INT);
            $stmt->bindParam(':id',$id,PDO::PARAM_INT);
             if($stmt->execute()){
                return true;
             }
         }
         return false;
    }
}