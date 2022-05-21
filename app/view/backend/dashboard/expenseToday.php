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
                                
                              
                                <?php foreach($expenseToday as $value):?>
                                    <tr>
                                    <td><?=$value['id']?></td>
                                    <td><?=$value['ncc']?></td>
                                    <td><?=$value['qty']?></td>
                                    <td><?=number_format($value['totalmoney'])?></td>
                                    <td><?=$value['created_time']?></td>
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
                <form action="admin.php?c=dashboard&m=expense" method="post" id="frmExpens">
                    <select name="year" id="expens" class="form-select mb-2 mt-4">
                            <?php if (isset($year)) : ?>
                                <option value="<?= $year ?>"><?= $year ?></option>
                            <?php endif; ?>

                            <?php $now = getdate(); ?>
                            <option value="<?= $now['year'] ?>"><?= $now['year'] ?></option>
                            <option value="<?= $now['year'] - 1 ?>"><?= $now['year'] - 1 ?></option>
                            <option value="<?= $now['year'] - 2 ?>"><?= $now['year'] - 2 ?></option>
                            <option value="<?= $now['year'] - 3 ?>"><?= $now['year'] - 3 ?></option>
                            <option value="<?= $now['year'] - 3 ?>"><?= $now['year'] - 4 ?></option>
                        </select>
                    </form>
                <div class="card mb-4 mt-4">
                   
                <canvas id="myAreaChartExpense" width="100%" height="30" data-expens="<?=implode(",",$expenseChart)?>"></canvas>
                </div>
        </div>
    </main>