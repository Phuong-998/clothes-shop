<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="text-center">Phiếu nhập kho</h2>
            <p class="text-center">Ngày 19 tháng 02 năm 2022</p>
            <div class=" mb-4 mt-4">
                <div>
                    <p><u><i>Thông tin đơn hàng</i></u></p>

                </div>
                <div class="row">
                    <div class="col-3">
                        <p>Nhà cung cấp:</p>
                        <p>Ngày lập:</p>
                        <p>Nhân viên:</p>
                        <p>Tổng số lượng</p>
                        <p>Tổng tiền:</p>
                        <p>Trạng thái</p>
                    </div>
                    <div class="col-9">
                        <p><?=$phieunhap['ncc']?></p>
                        <p><?=$phieunhap['created_time']?></p>
                        <p><?=$phieunhap['name_admin']?></p>
                        <p><?=$phieunhap['qty']?></p>
                        <p><?=number_format($phieunhap['totalmoney'])?>đ</p>
                        <p><?php
                                        if($phieunhap['state'] == 0 ){
                                            echo 'Chưa thanh toán';
                                        }else{
                                            echo 'Đã thanh toán';
                                        }
                                    ?></p>
                    </div>
                </div>
            </div>
            <div class=" mb-4 mt-4">
                <div>
                    <p><u><i>Chi tiết đơn hàng</i></u></p>

                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Màu sắc</th>
                            <th>Kích cỡ</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $sumQty = 0;?>
                        <?php foreach($chiTietPhieuNhap as $value):?>
                        <?php $sumQty = $sumQty + ($value['price_import'] * $value['qty']);?>
                        <tr>
                            <td><?=$value['name']?></td>
                            <td><?=number_format($value['price_import'])?></td>
                            <td><?=$value['color']?></td>
                            <td><?=$value['size']?></td>
                            <td><?=$value['qty']?></td>
                            <td><?=number_format($value['price_import'] * $value['qty'])?>đ</td>
                        </tr>

                        <?php endforeach;?>
                        <tr style="font-weight: 700;">
                            <td colspan="5"><span style="display:flex;justify-content: flex-end;">Tổng tiền:</span></td>
                            <td><?=number_format($sumQty)?>đ</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="text-center">

                <div style="margin-left: 500px;">
                    <span><b>Người lập phiếu</b></span><br>
                    <span>Ký và ghi rõ họ tên</span>
                </div>

            </div>



        </div>
    </main>