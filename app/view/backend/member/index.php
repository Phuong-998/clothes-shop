<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            
            <div class="row pt-1 mt-4">
            <div class="col-4">
            <form action="admin.php?c=member&m=addMember" method="POST" role="form" enctype="multipart/form-data" id="frmAddMember">
            <legend>Thêm thành viên</legend>
                
                <div class="form-group">
                    <label for="">Tên đăng nhập</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" name="fullname" id="" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Quyền</label>
                    <select name="role" id="" class="form-select">
                        <option value="1">Admin</option>
                        <option value="2">Nhân viên</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2" name="submit">Thêm</button>
            </form>
            </div>
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                       Danh sách thành viên
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="tacd">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th data-sortable="false">Tên thành viên</th>
                                    <th data-sortable="false">Quyền</th>
                                    <th data-sortable="false">Trạng thái</th>
                                    <th data-sortable="false"></th>
                                    <th data-sortable="false"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $stt = 0;?>
                               <?php foreach($member as $value):?>
                                <td><?=++$stt;?></td>
                                <td><?=$value['fullname']?></td>
                                <td><?php
                                if($value['role'] == 1){
                                    echo 'Admin';
                                }else{
                                    echo 'Nhân viên';
                                }
                                ?></td>
                                <td><?php
                                if($value['status'] == 1){
                                    echo 'Được đăng nhập';
                                }else{
                                    echo 'Ngừng đăng nhập';
                                }
                                ?></td>
                                    <td class="text-center"><a href="admin.php?c=member&m=update&id=<?= $value['id'] ?>"
                                            class="btn btn-primary"><i class="fas fa-pen"></i></a></td>
                                            <td class="text-center"><a href="admin.php?c=member&m=delete&id=<?= $value['id'] ?>"
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