<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            
            <div class="row pt-1 mt-4">
            <div class="col-4">
            <form action="admin.php?c=banner&m=hadnelAdd" method="POST" role="form" enctype="multipart/form-data" id="frmAddBannber">
            <legend>Thêm banner</legend>
                
                <div class="form-group">
                    <label for="">Tên banner</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Hình ảnh</label>
                    <input type="file" name="image" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Đường dẫn</label>
                    <input type="text" name="url" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select name="state" id="" class="form-select">
                        <option value="1">Hiện</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2" name="submit">Thêm</button>
            </form>
            </div>
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                       Danh sách banner
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="tacd">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th data-sortable="false">Tên banner</th>
                                    <th data-sortable="false">Hình ảnh</th>
                                    <th data-sortable="false">Đường dẫn</th>
                                    <th data-sortable="false">Trạng thái</th>
                                    <th data-sortable="false"></th>
                                    <th data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 1;?>
                                <?php foreach($banner as $value):?>
                                    <tr>
                                    <td><?=$stt++?></td>
                                    <td><?=$value['name']?></td>
                                    <td><img src="<?=$value['image']?>" alt="" width="70px"></td>
                                    <td><?=$value['url']?></td>
                                    <td><?php if($value['state'] == 1){
                                        echo "Hiện";
                                    }else{
                                        echo "Ẩn";
                                    } ?></td>
                                    <td class="text-center"><a href="admin.php?c=banner&m=update&id=<?= $value['id'] ?>"
                                            class="btn btn-primary"><i class="fas fa-pen"></i></a></td>
                                            <td class="text-center"><a href="admin.php?c=banner&m=delete&id=<?= $value['id'] ?>"
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