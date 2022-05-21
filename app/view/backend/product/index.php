<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <div class="card mb-4 mt-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                       Danh sách sản phẩm
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="tacd">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    
                                    <th data-sortable="false">Tên sản phẩm</th>
                                    <th data-sortable="false">Hình ảnh</th>
                                    <th>Số lượng</th>
                                    <th data-sortable="false">Danh mục</th>
                                    <th>Giá bán</th>
                                    <th>Giảm giá</th>
                                    <th>Giá khuyến mãi</th>
                                    
                                    <th data-sortable="false">Trạng thái</th>
                                    <th colspan="2" data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <?php $stt = 1; ?>
                                <?php foreach($product as $value):?>
                                    <td><?=$stt++?></td>
                                    
                                    <td style="text-transform: uppercase;"><a href="admin.php?c=productDetail&id=<?=$value['id']?>"><?=$value['name']?></a></td>
                                    <td><img src="<?=$value['image']?>" alt="" width="70px"></td>
                                    <td><?=$value['qty']?></td>
                                    <td><?=$value['category']?></td>
                                     <td><?=number_format($value['price'])?>đ</td> 
                                     <td><?=$value['discout']?>%</td>  
                                     <td><?php if($value['price'] == $value['price_discout']){
                                         echo '0đ';
                                     }else{
                                         echo number_format($value['price_discout']) . 'đ';
                                     } ?></td> 
                                     
                                    <td><?php if($value['status'] == 1){
                                        echo 'Đang kinh doanh';
                                    }else{
                                        echo 'Ngừng kinh doanh';
                                    }?></td>
                                    <td class="text-center"><a href="admin.php?c=product&m=update&id=<?= $value['id'] ?>"
                                            class="btn btn-primary"><i class="fas fa-pen"></i></a></td>
                                    <td class="text-center"><a href="admin.php?c=product&m=delete&id=<?= $value['id'] ?>"
                                            class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không ?');"><i class="fas fa-trash-alt"></i></a></td>
                                            </tr>
                                <?php endforeach;?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
        </div>
    </main>