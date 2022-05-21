<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Chỉnh sửa</h2>
            <ol class="breadcrumb mb-4">
            </ol>
            <div class="col-4">
                
            <form action="admin.php?c=member&m=hadnelUpdate" method="POST" role="form" enctype="multipart/form-data" id="frmUpdateMember">
            <legend>Thêm thành viên</legend>
                
                <div class="form-group">
                    <input type="hidden" name="id" value="<?=$memberId['id']?>">
                    <label for="">Trạng thái</label>
                    <select name="status" id="" class="form-select">
                        <?php if($memberId['status'] == 1){
                            echo ' <option value="1">Được đăng nhập</option>';
                            echo '<option value="2">Ngừng đăng nhập</option>';
                        }else{
                            echo '<option value="2">Ngừng đăng nhập</option>';
                            echo ' <option value="1">Được đăng nhậ</option>';
                        }
                       
                        ?>
                    </select>
                </div>
    
                <div class="form-group">
                    <label for="">Quyền</label>
                    <select name="role" id="" class="form-select">
                    <?php if($memberId['role'] == 1){
                            echo ' <option value="1">Admin</option>';
                            echo '<option value="2">Nhân viên</option>';
                        }else{
                            echo '<option value="2">Nhân viên</option>';
                            echo ' <option value="1">Admin</option>';
                        }
                       
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2" name="submit">Xác nhận</button>
            </form>
               

            </div>
        </div>
    </main>