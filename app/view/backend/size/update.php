<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Chỉnh sửa</h2>
            <ol class="breadcrumb mb-4">
            </ol>
            <div class="col-4">
                
                <form action="admin.php?c=size&m=hadnelUpdate" method="POST" role="form" id="frmUpdateSize">
                
                    <div class="form-group">
                        <label for="">Tên size</label>
                        <input type="hidden" name="size_id" id="" value="<?=$size['id']?>">
                        <input type="text" class="form-control" name="name" value="<?=$size['name']?>"> 
                        <span style="color: red;"><?php if(isset($errNameSize)){ echo $errNameSize; } ?></span>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
                </form>
               

            </div>
        </div>
    </main>