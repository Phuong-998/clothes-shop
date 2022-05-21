<?php

namespace app\controller\frontend;

use app\model\frontend\CartModel;

class CartController
{
    private $cartModel;
    public function __construct()
    {
        $this->cartModel = new CartModel;
    }
    public function index()
    {
        $html = "";
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            $html = "Bạn chưa chọn sản phẩm nào";
            echo $html;
        } else {
            $html .= '<table class="table">
            <tr>
                <th></th>
                <th>Sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th></th>
            </tr>';
            $sum = 0;
            foreach ($_SESSION['cart'] as $value) {
                $sum = $sum + ($value['qty'] * $value['price']);
                $html .= ' <tr>
                <td><img src="' . $value['img'] . '" alt="" width="70px"></td>
                <td>' . $value['name'] . '-' . $value['size'] . '</td>
                <td>' . number_format($value['price']) . '</td>
                <td><input type="number" onchange="updateQty1(\'' . $value['key'] . '\')" class="cartQty' . $value['key'] . '" id="" value="' . $value['qty'] . '"></td>
                <td>' . number_format($value['qty'] * $value['price']) . '</td>
                <td style="font-size:20px"><i class="fa-solid fa-xmark" style="cursor: pointer;" onclick="deleteCart(\'' . $value['key'] . '\')"></i></td>
                </tr>';
            }
            $html .= '<tr style="font-weight: 700;">
            <td colspan="4" ><span style="display:flex;justify-content: flex-end;">Tổng tiền:</span></td>
            <td colspan="2">' . number_format($sum) . 'đ</td>
        </tr>';
            $html .= '</table>';
            echo $html;
        }
    }
    public function addCart()
    {
        $productId = $_POST['productId'];
        $price = $_POST['price'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $qty = $_POST['qty'];
        $checkQty = $this->cartModel->getQtyCart($productId,$color,$size);
        if(empty($checkQty)){
            $html = 'Sản phẩm tạm hết hàng';
            echo $html;
        }
        elseif($qty > (int)(implode($checkQty))){
            $html = 'Số lượng bạn chọn đã đạt mức tối đa của sản phẩm này';
            echo $html;
        }else{
            $cart = $this->cartModel->getDataproduct($productId, $color, $size);
            $key =  $productId . $cart['color'] . $cart['size'];
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'][$key]['key'] = $key;
                $_SESSION['cart'][$key]['id'] = $cart['product_id'];
                $_SESSION['cart'][$key]['name'] = $cart['product'];
                $_SESSION['cart'][$key]['color'] = $cart['color'];
                $_SESSION['cart'][$key]['img'] = $cart['color_img'];
                $_SESSION['cart'][$key]['size'] = $cart['size'];
                $_SESSION['cart'][$key]['qty'] = $qty;
                $_SESSION['cart'][$key]['price'] = $price;
            } else {
    
                if (isset($_SESSION['cart'][$key]['id']) && $_SESSION['cart'][$key]['color'] ==  $cart['color'] && $_SESSION['cart'][$key]['size'] ==  $cart['size']) {
                    $_SESSION['cart'][$key]['qty'] = $qty + $_SESSION['cart'][$key]['qty'];
                }
                if (isset($_SESSION['cart'][$key]['id'])) {
                    if ($_SESSION['cart'][$key]['color'] != $cart['color'] && $_SESSION['cart'][$key]['size'] != $cart['size']) {
                        $key =  $productId . $cart['color'] . $cart['size'];
                        $_SESSION['cart'][$key]['key'] = $key;
                        $_SESSION['cart'][$key]['id'] = $cart['product_id'];
                        $_SESSION['cart'][$key]['name'] = $cart['product'];
                        $_SESSION['cart'][$key]['color'] = $cart['color'];
                        $_SESSION['cart'][$key]['img'] = $cart['color_img'];
                        $_SESSION['cart'][$key]['size'] = $cart['size'];
                        $_SESSION['cart'][$key]['qty'] = $qty;
                        $_SESSION['cart'][$key]['price'] = $price;
                    } elseif ($_SESSION['cart'][$key]['color'] == $cart['color'] && $_SESSION['cart'][$key]['size'] != $cart['size']) {
                        $key =  $productId . $cart['color'] . $cart['size'];
                        $_SESSION['cart'][$key]['key'] = $key;
                        $_SESSION['cart'][$key]['id'] = $cart['product_id'];
                        $_SESSION['cart'][$key]['name'] = $cart['product'];
                        $_SESSION['cart'][$key]['color'] = $cart['color'];
                        $_SESSION['cart'][$key]['img'] = $cart['color_img'];
                        $_SESSION['cart'][$key]['size'] = $cart['size'];
                        $_SESSION['cart'][$key]['qty'] = $qty;
                        $_SESSION['cart'][$key]['price'] = $price;
                    } elseif ($_SESSION['cart'][$key]['color'] != $cart['color'] && $_SESSION['cart'][$key]['size'] == $cart['size']) {
                        $key =  $productId . $cart['color'] . $cart['size'];
                        $_SESSION['cart'][$key]['key'] = $key;
                        $_SESSION['cart'][$key]['id'] = $cart['product_id'];
                        $_SESSION['cart'][$key]['name'] = $cart['product'];
                        $_SESSION['cart'][$key]['color'] = $cart['color'];
                        $_SESSION['cart'][$key]['img'] = $cart['color_img'];
                        $_SESSION['cart'][$key]['size'] = $cart['size'];
                        $_SESSION['cart'][$key]['qty'] = $qty;
                        $_SESSION['cart'][$key]['price'] = $price;
                    }
                } else {
                    $key =  $productId . $cart['color'] . $cart['size'];
                    $_SESSION['cart'][$key]['key'] = $key;
                    $_SESSION['cart'][$key]['id'] = $cart['product_id'];
                    $_SESSION['cart'][$key]['name'] = $cart['product'];
                    $_SESSION['cart'][$key]['color'] = $cart['color'];
                    $_SESSION['cart'][$key]['img'] = $cart['color_img'];
                    $_SESSION['cart'][$key]['size'] = $cart['size'];
                    $_SESSION['cart'][$key]['qty'] = $qty;
                    $_SESSION['cart'][$key]['price'] = $price;
                }
            }
            $html = "";
            $html .= '<table class="table">
             <tr>
                 <th></th>
                 <th>Sản phẩm</th>
                 <th>Đơn giá</th>
                 <th>Số lượng</th>
                 <th>Thành tiền</th>
                 <th></th>
             </tr>';
            $sum = 0;
            foreach ($_SESSION['cart'] as $value) {
                $sum = $sum + ($value['qty'] * $value['price']);
                $html .= ' <tr>
                 <td><img src="' . $value['img'] . '" alt="" width="70px"></td>
                 <td>' . $value['name'] . '-' . $value['size'] . '</td>
                 <td>' . number_format($value['price']) . '</td>
                 <td><input type="number" onchange="updateQty1(\'' . $value['key'] . '\')"  class="cartQty' . $value['key'] . '" id="" value="' . $value['qty'] . '"></td>
                 <td>' . number_format($value['qty'] * $value['price']) . '</td><td style="font-size:20px"><i class="fa-solid fa-xmark" style="cursor: pointer;" onclick="deleteCart(\'' . $value['key'] . '\')"></i></td></tr>';
            }
            $html .= '<tr style="font-weight: 700;">
             <td colspan="4" ><span style="display:flex;justify-content: flex-end;">Tổng tiền:</span></td>
             <td  colspan="2">' . number_format($sum) . 'đ</td>
         </tr>';
            $html .= '</table>';
            echo $html;
        }
        
    }

    public function editQty()
    {
        $qty = $_POST['qty'];
        $id = $_POST['key'];
        $_SESSION['cart'][$id]['qty'] = $qty;
        $html = "";
        $html .= '<table class="table">
         <tr>
             <th></th>
             <th>Sản phẩm</th>
             <th>Đơn giá</th>
             <th>Số lượng</th>
             <th>Thành tiền</th>
             <th></th>
         </tr>';
        $sum = 0;
        foreach ($_SESSION['cart'] as $value) {
            if ($value['qty'] == '') {
                $tt = 0 * $value['price'];
                $sum = $sum + (0 * $value['price']);
            } else {
                $tt = $value['qty'] * $value['price'];
                $sum = $sum + ($value['qty'] * $value['price']);
            }
            $html .= ' <tr>
             <td><img src="' . $value['img'] . '" alt="" width="70px"></td>
             <td>' . $value['name'] . '-' . $value['size'] . '</td>
             <td>' . number_format($value['price']) . '</td>
             <td><input type="number" onchange="updateQty1(\'' . $value['key'] . '\')"  class="cartQty' . $value['key'] . '" id="" value="' . $value['qty'] . '"></td>
             <td>' . number_format($tt) . '</td><td style="font-size:20px"><i class="fa-solid fa-xmark" style="cursor: pointer;" onclick="deleteCart(\'' . $value['key'] . '\')"></i></td></tr>';
        }
        $html .= '<tr style="font-weight: 700;">
         <td colspan="4" ><span style="display:flex;justify-content: flex-end;">Tổng tiền:</span></td>
         <td  colspan="2">' . number_format($sum) . 'đ</td>
     </tr>';
        $html .= '</table>';
        echo $html;
    }

    public function deleteCart()
    {
        $id = $_POST['key'];
        unset($_SESSION['cart'][$id]);
        $html = "";
        $html .= '<table class="table">
         <tr>
             <th></th>
             <th>Sản phẩm</th>
             <th>Đơn giá</th>
             <th>Số lượng</th>
             <th>Thành tiền</th>
             <th></th>
         </tr>';
        $sum = 0;
        foreach ($_SESSION['cart'] as $value) {
            if ($value['qty'] == '') {
                $tt = 0 * $value['price'];
                $sum = $sum + (0 * $value['price']);
            } else {
                $tt = $value['qty'] * $value['price'];
                $sum = $sum + ($value['qty'] * $value['price']);
            }
            $html .= ' <tr>
             <td><img src="' . $value['img'] . '" alt="" width="70px"></td>
             <td>' . $value['name'] . '-' . $value['size'] . '</td>
             <td>' . number_format($value['price']) . '</td>
             <td><input type="number" onchange="updateQty1(\'' . $value['key'] . '\')"  class="cartQty' . $value['key'] . '" id="" value="' . $value['qty'] . '"></td>
             <td>' . number_format($tt) . '</td><td style="font-size:20px"><i class="fa-solid fa-xmark" style="cursor: pointer;" onclick="deleteCart(\'' . $value['key'] . '\')"></i></td></tr>';
        }
        $html .= '<tr style="font-weight: 700;">
         <td colspan="4" ><span style="display:flex;justify-content: flex-end;">Tổng tiền:</span></td>
         <td  colspan="2">' . number_format($sum) . 'đ</td>
     </tr>';
        $html .= '</table>';
        echo $html;
    }
}
