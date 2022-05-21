<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <ol class="breadcrumb mb-4">
            </ol>
            <div class="col-4">
                
                <form action="admin.php?c=ship&m=hadnelUpdate" method="POST" role="form" id="frmUpdateShip">
                
                    <div class="form-group">
                        <label for="">Tỉnh/ Thành phố</label>
                        <input type="text" readonly value="<?=$ship['nametinh']?>" class="form-control">
                        <label for="">Quận/ Huyện</label>
                        <input type="text" readonly value="<?=$ship['namequan']?>" class="form-control">
                        <label for="">Phường/ Xã</label>
                        <input type="text" readonly value="<?=$ship['namephuong']?>" class="form-control">
                        <label for="">Phí vận chuyển</label>
                        <input type="number" name="ship" class="form-control" value="<?=$ship['ships']?>">
                        <input type="hidden" name="id" class="form-control" value="<?=$ship['id']?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Xác nhận</button>
                </form>
               

            </div>
        </div>
    </main>