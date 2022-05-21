<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="text-center">Chi tiết đơn</h2>
        <div class="card mb-4 mt-4">
                    <div class="card-header">
                     Thông tin đơn
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Ngày nhập</th>
                                    <th>Nhân viên</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Tổng số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td><?=$phieunhap['created_time']?></td>
                                    <td><?=$phieunhap['name_admin']?></td>
                                    <td><?=$phieunhap['ncc']?></td>
                                    <td><?=$phieunhap['qty']?></td>
                                    <td><?=number_format($phieunhap['totalmoney'])?>đ</td>
                                    <td><?php
                                        if($phieunhap['state'] == 0 ){
                                            echo 'Chưa thanh toán';
                                        }else{
                                            echo 'Đã thanh toán';
                                        }
                                    ?></td>
                                </tr>
                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <div class="card mb-4 mt-4">
                    <div class="card-header">
                     Chi tiết đơn
                    </div>
                    <div class="card-body">
                        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    
                                    <th>Màu sắc</th>
                                    <th>Kích cỡ</th>
                                   
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $sumQty = 0;?>
                                <?php foreach($chiTietPhieuNhap as $value):?>
                                    <?php $sumQty = $sumQty + ($value['price_import'] * $value['qty']);?>
                                    <tr>
                                        <td><?=$value['name']?></td>
                                        
                                        <td><?=$value['color']?></td>
                                        <td><?=$value['size']?></td>
                                       
                                        <td><?=$value['qty']?></td>
                                        <td><?=number_format($value['price_import'])?>đ</td>
                                        <td><?=number_format($value['price_import'] * $value['qty'])?>đ</td>
                                    </tr>
                                    
                                <?php endforeach;?>
                                <tr style="font-weight: 700;">
                                    <td colspan="5" ><span style="display:flex;justify-content: flex-end;">Tổng tiền:</span></td>
                                    <td><?=number_format($sumQty)?>đ</td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <?php if($phieunhap['state'] == 0 ){
                    echo '<a href="admin.php?c=phieuNhap&m=thanhtoan&state=1&id='.$phieunhap['id'].'" class="btn btn-outline-primary">Thanh toán</a>';
                }
                ?>
                
                
        </div>
    </main>