<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            
            <div class="row mt-4">
                <div class="col-4">

                    <form action="admin.php?c=productDetail&m=hadnelAdd" method="POST" role="form" enctype="multipart/form-data" id="frmAddAtr">
                        <legend>Thêm thuộc tính</legend>
                        <input type="hidden" value="<?=$prdocut_id?>" name="product_id">
                        <div class="form-group">
                            <label for="">Size</label>
                            <select name="size" id="input" class="form-select"  required="required">
                                <?php foreach($size as $value):?>
                                    <option value="<?=$value['id']?>"><?=$value['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Màu sắc</label>
                            <select name="color" id="input" class="form-select"  required="required">
                            <?php foreach($color as $value):?>
                                    <option value="<?=$value['id']?>"><?=$value['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Màu ảnh</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label for="">Số lượng</label>
                            <input type="number" name="qty" class="form-control">
                        </div>        
                             
                        <button type="submit" class="btn btn-primary mt-2" name="submit">Thêm</button>
                        <?php if(isset($errAddproductDetail)): ?>
                                <?php foreach($errAddproductDetail as $value):?>
                                    <p style="color: red;"><?=$value?></p>
                                <?php endforeach;?>
                            <?php endif;?>
                        <?php if(isset($errAdd)): ?>
                            <p style="color: red;"><?=$errAdd?></p>
                        <?php endif;?>
                    </form>

                </div>
                <div class="col-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Danh mục
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="tacd">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Size</th>
                                        <th>Màu sắc</th>
                                        <th data-sortable="false">Hình ảnh</th>
                                        <th>Số lượng</th>
                                       <th data-sortable="false"></th>
                                       <th data-sortable="false"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 1;?>
                                    <?php $sumQty = 0;?>
                                    <?php foreach($product as $value): ?>
                                        <?php $sumQty = $sumQty + $value['qty']?>
                                        <tr>
                                            <td><?=$stt++; ?></td>
                                            <td><?=$value['size']?></td>
                                            <td><?=$value['color']?></td>
                                            <td><img src="<?=$value['color_img']?>" alt="" width="50px"></td>
                                            <td><?=$value['qty']?></td>
                                            
                                            <td><a href="admin.php?c=productDetail&m=update&id=<?=$value['id']?>" class="btn btn-primary"><i class="fas fa-pen-square"></i></a></td>
                                            <td class="text-center"><a href="admin.php?c=productDetail&m=delete&id=<?= $value['id'] ?>&productid=<?=$prdocut_id?>"
                                            class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không ?');"><i class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                    <?php endforeach;?>
                                    <tr>
                                        <td colspan="4">Tổng số lượng: </td>
                                        <td><?=$sumQty?></td>
                                    </tr>
                                </tbody>
                            </table>
                                
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>