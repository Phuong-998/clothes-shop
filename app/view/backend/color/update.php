<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <ol class="breadcrumb mb-4">
            </ol>
            <div class="col-4">
                
                <form action="admin.php?c=color&m=hadnelUpdate" method="POST" role="form" id="frmUpdateColor">
                
                    <div class="form-group">
                        <label for="">Tên màu</label>
                        <input type="hidden" name="color_id" id="" value="<?=$color['id']?>">
                        <input type="text" class="form-control" name="name" value="<?=$color['name']?>"> 
                        
                        <span style="color: red;"><?php if(isset($errUpdateColor)){ echo $errUpdateColor; } ?></span>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </main>