<div id="layoutSidenav_content">
    <main>
        
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tổng quan</h1>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            <?= number_format($sumExpenseToday['totalMoney']) ?>đ <br> Chi tiêu tháng này
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="admin.php?c=dashboard&m=expense">Chi tiết</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <?= $order['orderc'] ?><br> Đơn hàng chưa xửa lý
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="admin.php?c=order&m=NoProcessOrder">Chi
                                tiết</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body"><?php if ($revenueToday['mony'] == '') {
                                                    echo '0đ';
                                                } else {
                                                    echo number_format($revenueToday['mony']) . 'đ';
                                                } ?> <br> Doanh thu hôm nay</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="admin.php?c=order&m=revenueToday">Chi
                                tiết</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body"><?=$totalAccesToday['qty']?> <br> Số lượng truy cập hôm nay</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="admin.php?c=dashboard&m=inventory">Chi
                                tiết</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <form action="admin.php?c=dashboard" method="post" id="frmYear">
                        <select name="yearRevenue" id="year" class="form-select mb-2 mt-4">
                            <?php if (isset($yearRevenue)) : ?>
                                <option value="<?= $yearRevenue ?>"><?= $yearRevenue ?></option>
                            <?php endif; ?>

                            <?php $now = getdate(); ?>
                            <option value="<?= $now['year'] ?>"><?= $now['year'] ?></option>
                            <option value="<?= $now['year'] - 1 ?>"><?= $now['year'] - 1 ?></option>
                            <option value="<?= $now['year'] - 2 ?>"><?= $now['year'] - 2 ?></option>
                            <option value="<?= $now['year'] - 3 ?>"><?= $now['year'] - 3 ?></option>
                            <option value="<?= $now['year'] - 3 ?>"><?= $now['year'] - 4 ?></option>
                        </select>
                    </form>
                    <div class="card mb-4">

                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Thống kê doanh thu
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="40" data-money-aa="<?= implode(",", $abc) ?>"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row">
                        
                            <div class="col-4">
                            <form action="admin.php?c=dashboard" method="post" id="frmTKOrderDay">
                                <label for="">Ngày:</label>
                                <input type="date" class="form-control" name="dayOrder" id="dayOrder" value="<?php if(isset($dayOrder)){echo $dayOrder;} ?>">
                                </form>
                            </div>
                        
                        <div class="col-4">
                        <form action="admin.php?c=dashboard" method="post" id="frmTKOrder">
                            <label for="">Tháng</label>
                            <select name="tkOrderMonth" id="tkOrderMonth" class="form-select">
                            <option selected disabled><?php if(isset($tkOrderMonth)){
                                echo $tkOrderMonth;
                            }else{
                                echo '--Chọn--';
                            } ?></option>
                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="">Năm</label>
                            <select name="tkOrderYear" id="tkOrderYear" class="form-select mb-2">
                                
                            <option selected disabled><?php if(isset($tkOrderYear)){
                                echo $tkOrderYear;
                            }else{
                                echo '--Chọn--';
                            } ?></option>
                                <?php $now = getdate(); ?>
                                <option value="<?= $now['year'] ?>"><?= $now['year'] ?></option>
                                <option value="<?= $now['year'] - 1 ?>"><?= $now['year'] - 1 ?></option>
                                <option value="<?= $now['year'] - 2 ?>"><?= $now['year'] - 2 ?></option>
                                <option value="<?= $now['year'] - 3 ?>"><?= $now['year'] - 3 ?></option>
                                <option value="<?= $now['year'] - 3 ?>"><?= $now['year'] - 4 ?></option>
                            </select>
                                </form>
                        </div>
                    </div>



                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Thống kê đơn hàng
                        </div>
                        <div class="card-body"><canvas id="myPieChart" width="100%" height="40" data-fail="<?= implode($orderfail) ?>" data-succes="<?= implode($orderScuces) ?>"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">

                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Sản phẩm bán chạy
                </div>
                <div class="card-body">
                <table id="datatablesSimple" class="tacd">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    
                                    <th data-sortable="false">Tên sản phẩm</th>
                                    <th data-sortable="false">Hình ảnh</th>
                                    <th>Giá bán</th>
                                    <th>Giá khuyến mãi</th>
                                    <th>Giảm giá</th>
                                    <th>Đã bán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php $stt = 1; ?>
                                <?php foreach($sellProduct as $value):?>
                                    <td><?=$stt++?></td>
                                    
                                    <td style="text-transform: uppercase;"><a href="admin.php?c=productDetail&id=<?=$value['product_id']?>"><?=$value['name']?></a></td>
                                    <td><img src="<?=$value['image']?>" alt="" width="70px"></td>
                                     <td><?=number_format($value['price'])?></td>   
                                     <td><?=number_format($value['price_discout'])?></td> 
                                     <td><?=$value['discout']?>%</td> 
                                     <td><?=$value['buy']?></td> 
                                            </tr>
                                <?php endforeach;?>
                                
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </main>