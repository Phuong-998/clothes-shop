<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <div class="row m-4">
            <div class="col-8 border offset-2">
            <p>Mã đơn hàng: <?=$member['id']?></p>
                <div class="row">
                    
                    <div class="col-6">
                        
                        <p>Từ:</p>
                        <p>Cửa hàng CLothing</p>
                    </div>
                    <div class="col-6">
                        <p>Đến:</p>
                        <p>Họ tên: <?= $member['name'] ?></p>
                        <p>Số điện thoại: <?= $member['phone'] ?></p>
                        <p>Địa chỉ: <?= $member['address'] . ', ' .  $member['phuong'] . ', ' . $member['quanhuyen'] . ', ' . $member['tp'] ?></p>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <tr>
                               
                                <th>Tên sản phẩm</th>
                               
                                <th>Số lượng</th>
                                
                            </tr>
                            <?php $totalMoney = 0; ?>
                            <?php foreach ($order as $value) : ?>
                                <?php $totalMoney += $value['price'] * $value['qty']; ?>
                                <tr>
                                    <td><?= $value['name'] ?>-<?= $value['size'] ?></td>
                                    
                                    <td><?= $value['qty'] ?></td>
                                    
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                
                                <td>Tổng tiền</td>
                                <td><?= number_format($totalMoney) ?>đ</td>
                            </tr>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
            
        </div>
    </main>