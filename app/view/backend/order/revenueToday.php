<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <div class="card mb-4 mt-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                       Đơn hàng chưa xử lý
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="tacd">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th data-sortable="false">Khách hàng</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày tạo</th>
                                    <th data-sortable="false">Trạng thái</th>
                                    <th data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach($order as $value):?>
                                    <tr>
                                        <td><?=$value['ordersId']?></td>
                                        <td><?=$value['name']?></td>
                                        <td><?=number_format($value['totalMoney'])?>đ</td>
                                        <td><?=$value['created_time']?></td>
                                        <td><?php 
                                        if($value['status'] == 1){
                                            echo '<span class="badge bg-warning text-dark">Chưa xử lý</span>';
                                        }elseif($value['status'] == 2){
                                            echo '<span class="badge bg-primary">Đang xử lý</span>';
                                        }elseif($value['status'] == 3){
                                            echo '<span class="badge bg-secondary">Đang giao hàng</span>';
                                        }elseif($value['status'] == 4){
                                            echo '<span class="badge bg-success">Giao hàng thành công</span>';
                                        }elseif($value['status'] == 5){
                                            echo '<span class="badge bg-danger">Hủy đơn</span>';
                                        }
                                        ?></td>
                                        <td><a href="admin.php?c=order&m=chitiet&orderId=<?=$value['ordersId']?>" style="font-size: 18px;">Chi tiết</a></td>
                                    </tr>
                                <?php endforeach;?>
                                
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="card-body"><canvas id="myAreaChartToday" width="100%" height="30" data-day="<?=implode(",",$day)?>" data-reven="<?=implode(",",$reven)?>"></canvas></div>
                </div>
        </div>
    </main>