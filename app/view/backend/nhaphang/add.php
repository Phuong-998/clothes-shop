<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4 mt-4">
                <div class="card-header">
                    <i class="fas fa-database"></i>
                    Tạo phiếu nhập
                </div>
                <div class="card-body">

                    <form action="admin.php?c=phieuNhap&m=hadnelAdd" method="POST" role="form"
                        enctype="multipart/form-data" id="formAddHang">
                        <div class="row">
                            <div class="col-6">
                                <label for="id_label_single">
                                    Nhập tên sản phẩm
                                </label>
                                <select style="width: 100%" id="states" name="productId"> 
                                    <option value=""></option>
                                    <?php foreach($product as $value):?>
                                    <option value="<?=$value['id']?>"><?=mb_strtoupper($value['name'])?></option>
                                    <?php endforeach;?>
                                </select>
                                <div class="row">
                                    <div class="col-12">
                                            <label for="">Đơn giá</label>
                                            <input type="number" name="price" id="" class="form-control">

                                        </div>
                                        </div>
                                <div class="art">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="">Màu sắc</label>
                                            <select name="color[]" id="" class="form-select">
                                                <?php foreach($color as $value): ?>
                                                    <option value="<?=$value['id']?>"><?=$value['name']?></option>
                                                <?php endforeach;?>
                                            </select>
                                            
                                        </div>
                                        <div class="col-4">
                                            <label for="">Kích thước</label>
                                            <select name="size[]" id="" class="form-select">
                                            <?php foreach($size as $value): ?>
                                                    <option value="<?=$value['id']?>"><?=$value['name']?></option>
                                                <?php endforeach;?>
                                            </select>
                                           
                                        </div>
                                        <div class="col-4">
                                            <label for="">Số lượng</label>
                                            <input type="number" name="qty[]" id="" class="form-control">

                                        </div>
                                        
                                    </div>
                                </div>
                    </form>
                    <a href="javascript:void(0);" style="font-size:25px" class="addArt"><i
                            class="fa-solid fa-plus"></i></a><br>
                            <a href="javascript:void(0);" style="font-size:25px" class="minus"><i class="fa-solid fa-minus"></i></a>
                            <button type="submit" class="btn btn-primary mt-4 sumb" name="submit">Thêm</button>

                </div>
               
                <div class="col-6">
                <form action="admin.php?c=phieuNhap&m=addOrder" method="post">
                    <div class="form-group">
                        <label for="">Nhà cung cấp</label>
                        <select name="ncc" id="" class="form-select">
                            <?php foreach($ncc as $value):?>
                            <option value="<?=$value['id']?>"><?=$value['name']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="">Trạng thái</label>
                                        <select name="state" id="" class="form-select">
                                            <option value="0">Chưa thanh toán</option>
                                            <option value="1">Đã thanh toán</option>
                                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ngày nhập</label>
                        <input type="datetime-local" name="date" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Nhân viên</label>
                        <input type="text" name="admin" id="" value="<?=$_SESSION['user_name']?>" readonly class="form-control">
                    </div>

                    
                </div>




            </div>
            <?php if(isset($_SESSION['phieunhap'])):?>
<hr>

            <div class="card-body">
                            <table id="datatablesSimple" class="tacd">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Màu sắc</th>
                                        <th>Kích cỡ</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $qty = 0;?>
                                    <?php $money = 0;?>
                                   
                                    <?php foreach($_SESSION['phieunhap'] as $key=>$value): ?>
                                        <?php $qty = $qty + $value['qty']?>
                                        <?php $money = $money + ($value['price'] * $value['qty'])?>
                                        <tr>
                                            <td><?=$value['name']?></td>
                                            <td><?=$value['color']?></td>
                                            <td><?=$value['size']?></td>
                                            <td><?=$value['qty']?></td>
                                            <td><?=number_format($value['price'])?></td>
                                            <td><?=$value['price'] * $value['qty']?></td>
                                            <td class="text-center"><a
                                                href="admin.php?c=phieuNhap&m=delete&id=<?=$key?>"
                                                class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa không ?');"><i
                                                    class="fas fa-trash-alt"></i></a></td>
                                        </tr>
                                        
                                    <?php endforeach;?>
                                    
                                </tbody>
                            </table>

                        </div>
                        <input type="hidden" name="totalQty" id="" value="<?=$qty?>">
                        <input type="hidden" name="totalMoney" id="" value="<?=$money?>">
                        <button class="btn btn-primary" name="submit">Tạo phiếu</button>
            <?php endif;?>

            </form>
        </div>
</div>
</div>
</main>