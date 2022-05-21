<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <ol class="breadcrumb mb-4">
            </ol>
            <div class="col-4">
                
                <form action="admin.php?c=ncc&m=hadnelUpdate" method="POST" role="form" id="frmUpdateNcc">
                
                    <div class="form-group">
                        <label for="">Tên nhà cung cấp</label>
                        <input type="hidden" name="id" id="" value="<?=$ncc['id']?>">
                        <input type="text" class="form-control" name="name" value="<?=$ncc['name']?>"> 
                    </div>
                    
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        
                        <input type="text" class="form-control" name="address" value="<?=$ncc['address']?>"> 
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                      
                        <input type="text" class="form-control" name="phone" value="<?=$ncc['phone']?>"> 
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
                    <span style="color: red;"><?php if(isset($errNcc)){ echo $errNcc; } ?></span>
                </form>
            </div>
        </div>
    </main>