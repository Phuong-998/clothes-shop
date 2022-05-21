<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="alert alert-primary" role="alert">
                Thông tin khách hàng
            </div>
            <div>
                <p>Tên khách hàng: <?= $member['name'] ?></p>
                <p>Số điện thoại: <?= $member['phone'] ?></p>
                <p>Địa chỉ nhận hàng:
                    <?= $member['address'] . ', ' .  $member['phuong'] . ', ' . $member['quanhuyen'] . ', ' . $member['tp'] ?>
                </p>
                <p>Ngày đặt hàng: <?= date("d-m-Y", strtotime($member['created_time'])) ?></p>

                
                <label class="" for="">Trạng thái</label>
                    <div class="form-group mt-2 mb-2" style="width:210px">
                        
                        <input type="hidden" id="orderId" name="orderid" value="<?=$member['id']?>">
                        <select name="status" id="updateOrderStatus" class="form-select" required="required">
                            <option value="<?= $member['status'] ?>">
                                <?php if ($member['status'] == 1) {
                echo 'Chưa xử lý';
            } elseif ($member['status'] == 2) {
                echo 'Đang xử lý';
            } elseif ($member['status'] == 3) {
                echo 'Đang giao hàng';
            } elseif ($member['status'] == 4) {
                echo 'Giao hàng thành công';
            }elseif ($member['status'] == 5) {
                echo 'Hủy đơn';
            }
            ?>
                            </option>
                            <option value="1">Chưa xử lý</option>
                            <option value="2">Đang xử lý</option>
                            <option value="3">Đang giao hàng</option>
                            <option value="4">Giao hàng thành công</option>
                            <option value="5">Hủy đơn</option>
                        </select>

                    </div>

               
            </div>
            <div class="alert alert-primary" role="alert">
                Thông tin đơn hàng
            </div>
            <table class="table">
                <tr>
                    <th></th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Giá tiền</th>
                </tr>
                <?php $totalMoney = 0; ?>
                <?php foreach ($order as $value) : ?>
                <?php $totalMoney += $value['price'] * $value['qty']; ?>
                <tr>
                    <td><img src="<?= $value['color_img'] ?>" alt="" width="50px"></td>
                    <td><?= $value['name'] ?>-<?= $value['size'] ?>-<?= $value['color'] ?></td>
                    <td><?= number_format($value['price']) ?>đ</td>
                    <td><?= $value['qty'] ?></td>
                    <td><?= number_format($value['price'] * $value['qty']) ?>đ</td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td colspan="3">Phí vận chuyển</td>
                    <td><?= number_format( $member['ship']) ?>đ</td>
                </tr>
                <tr style="background-color: #F8D7DA;">
                    <td></td>
                    <td colspan="3">Tổng tiền</td>
                    <td><?= number_format($totalMoney + $member['ship']) ?>đ</td>
                </tr>
                
                </table>
                    
                    <a href="admin.php?c=order&m=bill&orderid=<?= $member['id'] ?>&memberid=<?= $member['memberId'] ?>"
                            class="btn btn-primary mb-2">In hóa đơn</a>
               
            
        </div>
    </main>