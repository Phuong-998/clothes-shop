<div class="conten">
            <div class="pay">
            <div class="title_pay">Thanh toán giỏ hàng</div>
            <div class="row payq">
                <div class="col-4 ">
                    <div class="check-out">
                        <div class="title_bill">
                            <span>1</span>
                            <span>Thông tin hóa đơn</span>
                        </div>
                        <form method="post" action="index.php?c=checkout&m=pay" class="form-group" id="form-buyNow">
                            <label>Họ và tên</label>
                            <input type="text" class="form-control" name="name" autofocus>
                            <label>Điện thoại</label>
                            <input type="tel" name="tel" class="form-control">
                            <label>Địa chỉ</label>
                            <input type="text" name="address" class="form-control">
                            <label for="">Tỉnh/ Thành phố</label>
                            <select name="tinh" id="" class="form-select tinh">
                                <option value="">Chọn Tỉnh/ thành phố</option>
                                <?php foreach($tinh as $value):?>
                                    <option value="<?=$value['matp']?>"><?=$value['name']?></option>
                                <?php endforeach;?>
                            </select>
                            <label for="">Quận/ Huyện</label>
                            <select name="quan" id="" class="form-select quan">
                                <option value="">Chọn Quận/ Huyện</option>
                            </select>
                            <label for="">Phường/ Xã</label>
                            <select name="phuong" id="" class="form-select phuong">
                                <option value="">Chọn Phường/ Xã</option>
                            </select>
                           
                            <label>Ghi chú đơn hàng</label>
                            <textarea name="note" class="form-control"></textarea>
                    </div>                   
                </div>
                <div class="col-3"style="border-right:1px solid #d8d8d8;border-left:1px solid #d8d8d8;">
                    <div class="title_bill" >
                        <span>2</span>
                        <span>Phương thức thanh toán</span>
                    </div>
                    <label>
                        <input type="radio" name="" checked="checked">
                        <span>Thanh toán tiền mặt khi nhận hàng (COD)</span>
                    </label>
                </div>
                <div class="col-5">
                    <div class="title_bill">
                        <span>3</span>
                        <span>Thông tin giỏ hàng</span>
                    </div>

                    <div class="info-cart">
                        <table class="table">
                            
                            <tr>
                                <th></th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                
                            </tr>
                            <?php $tt = 0;?>

                            <?php foreach($_SESSION['cart'] as $value):?>
                                <?php $tt = ($value['qty']*$value['price']) + $tt;?>
                            <tr>
                                <td><img src="<?=$value['img']?>" alt="" width="60px"></td>
                                <td><?=$value['name'].'-'.$value['color'].'-'.$value['size']?></td>
                                <td><?=$value['qty']?></td>
                                <td><?=number_format($value['qty']*$value['price'])?></td>
                            </tr>
                            <?php endforeach;?>
                            <tr>
                                <td colspan="3">Tạm tính</td>
                                <td colspan="1"><?=number_format($tt)?></td>
                            </tr>
                            <tr>
                            <td colspan="3">Phí vận chuyển</td>
                            <td colspan="1"><div class="tinhship"></div></td>
                            </tr>
                            <tr>
                            <td colspan="3">Tổng tiền</td>
                            <td colspan="1"><div class="tongtien"></div></td>
                            </tr>
                        </table>
                        <input type="hidden" class="tamtinh" value="<?=$tt?>">
                        <input type="hidden" class="tt" name="totalMoney">
                        <input type="hidden" class="ship" name="ship">
                    </div>
                    <button class="btn btn-primary" style="margin-left:380px" type="submit" name="submit">Thanh toán</button>
                </div>
                </form>
            </div>
          </div>  
        </div>