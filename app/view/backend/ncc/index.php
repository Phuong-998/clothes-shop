<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="row mt-4">
                <div class="col-4">
                    <form action="admin.php?c=ncc&m=hadnelAdd" method="POST" role="form" id="frmAddNcc">
                        <legend>Thêm nhà cung cấp</legend>
                        <div class="form-group">
                            <label for="">Tên nhà cung cấp</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input type="text" class="form-control" name="address">
                        </div>
                        <div class="form-group">
                            <label for="">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2" name="submit">Thêm</button>
                        <span style="color: red;"><?php if(isset($errAdd)){ echo $errAdd; } ?></span>
                    </form>
                </div>
                <div class="col-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Danh sách nhà cung cấp
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="tacd">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên nhà cung cấp</th>
                                        <th>Địa chỉ</th>
                                        <th>Điện thoại</th>
                                        <th data-sortable="false"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $stt = 1; ?>
                                    <?php foreach ($ncc as $value) : ?>
                                    <tr>
                                        <td><?= $stt++ ?></td>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= $value['address'] ?></td>
                                        <td><?= $value['phone'] ?></td>
                                        <td class="text-center"><a
                                                href="admin.php?c=ncc&m=update&id=<?= $value['id'] ?>"
                                                class="btn btn-primary"><i class="fas fa-pen"></i></a></td>
                                        <td class="text-center"><a
                                                href="admin.php?c=ncc&m=delete&id=<?= $value['id'] ?>"
                                                class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa không ?');"><i
                                                    class="fas fa-trash-alt"></i></a></td>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>