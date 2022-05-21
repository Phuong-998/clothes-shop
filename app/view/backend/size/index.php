<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            
            <div class="row mt-4">
            <div class="col-4">
            <form action="admin.php?c=size&m=hadnelAdd" method="POST" role="form" id="frmAddSize">
            <legend>Thêm size</legend>
                <div class="form-group">
                    <label for="">Tên size</label>
                    <input type="text" class="form-control" name="name"> 
                    <span style="color: red;"><?php if(isset($errNameSize)){ echo $errNameSize; } ?></span>
                </div>
                
                <button type="submit" class="btn btn-primary mt-2" name="submit">Thêm size</button>
            </form>
            </div>
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                       Danh sách size
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="tacd">
                            <thead>
                                <tr>
                                    <th data-sortable="false">STT</th>
                                    <th>Tên size</th>
                                    <th data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1; ?>
                                <?php foreach ($size as $value) : ?>
                                <tr>
                                    <td><?= $stt++ ?></td>
                                    <td><?= $value['name'] ?></td>
                                    <td class="text-center"><a href="admin.php?c=size&m=update&id=<?= $value['id'] ?>"
                                            class="btn btn-primary"><i class="fas fa-pen"></i></a>&ensp;
                                    <a href="admin.php?c=size&m=delete&id=<?= $value['id'] ?>"
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