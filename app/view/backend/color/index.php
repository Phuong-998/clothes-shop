<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            
            <div class="row pt-1 mt-4">
            <div class="col-4">
            <form action="admin.php?c=color&m=hadnelAdd" method="POST" role="form" id="frmAddColor">
            <legend>Thêm màu</legend>
                <div class="form-group">
                    <label for="">Tên màu</label>
                    <input type="text" class="form-control" name="name"> 
                    <span style="color: red;"><?php if(isset($errAddNameColor)){ echo $errAddNameColor; } ?></span>
                </div>
                
                <button type="submit" class="btn btn-primary mt-2" name="submit">Thêm màu</button>
            </form>
            </div>
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                       Danh sách màu sắc
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="tacd">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên màu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; ?>
                                <?php foreach ($color as $value) : ?>
                                <tr>
                                    <td><?= $stt++ ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td class="text-center"><a href="admin.php?c=color&m=update&id=<?= $value['id'] ?>"
                                            class="btn btn-primary"><i class="fas fa-pen"></i></a>&ensp;
                                    <a href="admin.php?c=color&m=delete&id=<?= $value['id'] ?>"
                                            class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa không ?');"><i class="fas fa-trash-alt"></i></a></td>
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