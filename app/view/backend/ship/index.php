<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="row mt-4">
                <div class="col-4">
                    <form action="admin.php?c=ship&m=hadnelAdd" method="POST" role="form" id="frmAddShip">
                        <legend>Thêm phí vận chuyển</legend>

                        <label for="">Tỉnh/ Thành phố</label>
                        <select name="tinh" id="" class="form-select tinh">
                            <option value="">Chọn Tỉnh/ thành phố</option>
                            <?php foreach ($tinh as $value) : ?>
                                <option value="<?= $value['matp'] ?>"><?= $value['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="">Quận/ Huyện</label>
                        <select name="quan" id="" class="form-select quan">
                            <option value="">Chọn Quận/ Huyện</option>
                        </select>
                        <label for="">Phường/ Xã</label>
                        <select name="phuong" id="" class="form-select phuong">
                            <option value="">Chọn Phường/ Xã</option>
                        </select>
                        <label for="">Phí vận chuyển</label>
                        <input type="number" class="form-control" name="ship" id="">
                        <?php if(isset($errAdd)):?>
                            <p style="color: red;"><?=$errAdd?></p>
                        <?php endif;?>      
                        <button type="submit" class="btn btn-primary mt-2" name="submit">Thêm phí</button>
                    </form>
                </div>
                <div class="col-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Danh sách phí vận chuyển
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="tacd">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên thành phố</th>
                                        <th>Tên quận huyện</th>
                                        <th>Tên xã phường</th>
                                       <th>Phí ship</th>
                                       <th data-sortable="false"></th>
                                       <th data-sortable="false"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 1;?>
                                    <?php foreach($ship as $value):?>
                                    <tr>
                                        <td><?=$stt++?></td>
                                        <td><?=$value['nametinh']?></td>
                                        <td><?=$value['namequan']?></td>
                                        <td><?=$value['namephuong']?></td>
                                        <td><?=number_format($value['ships'])?>đ</td>
                                        <td><a href="admin.php?c=ship&m=update&id=<?=$value['id']?>" class="btn btn-primary"><i class="fas fa-pen-square"></i></a></td>
                                            <td class="text-center"><a href="admin.php?c=ship&m=delete&id=<?= $value['id'] ?>"
                                            class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không ?');"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>