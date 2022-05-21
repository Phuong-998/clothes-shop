<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <div class="card mb-4 mt-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                       Danh sách phiếu nhập
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="tacd">
                            <thead>
                                <tr>
                                    <th>Mã phiếu</th>
                                    <th data-sortable="false">Nhà cung cấp</th>
                                    <th data-sortable="false">Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày lập</th>
                                    <th data-sortable="false">Nhân viên</th>
                                    <th data-sortable="false">Trạng thái</th>
                                    <th data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                              
                                <?php foreach($phieu as $value):?>
                                    <tr>
                                    <td><?=$value['id']?></td>
                                    <td><?=$value['ncc']?></td>
                                    <td><?=$value['qty']?></td>
                                    <td><?=number_format($value['totalmoney'])?></td>
                                    <td><?=date("d-m-Y H:i:s",strtotime($value['created_time']))?></td>
                                    <td><?=$value['name_admin']?></td>
                                    <td><?php 
                                        if($value['state'] == 0){
                                            echo 'Chưa thanh toán';
                                        }else{
                                            echo 'Đã thanh toán';
                                        }
                                    ?></td>
                                    <td><a href="admin.php?c=phieuNhap&m=chiTietPhieuNhap&id=<?=$value['id']?>" class="btn btn-primary">Chi tiết</a></td>
                                    <td><a href="admin.php?c=phieuNhap&m=print&id=<?=$value['id']?>" class="btn btn-primary">In đơn</a></td>
                                    </tr>
                                <?php endforeach;?>
                                
                            </tbody>
                        </table>
                        
                    </div>
                </div>
        </div>
    </main>