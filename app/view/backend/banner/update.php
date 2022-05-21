<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <ol class="breadcrumb mb-4">
            </ol>
            <div class="col-4">
                
                <form action="admin.php?c=banner&m=hadnelUpdate" method="POST" role="form" enctype="multipart/form-data" id="frmUpdateBanner">
                
                    <div class="form-group">
                        <label for="">Tên banner</label>
                        <input type="hidden" name="id" id="" value="<?=$bannerId['id']?>">
                        <input type="hidden" name="imgOld" value="<?=$bannerId['image']?>">
                        <input type="text" class="form-control" name="name" value="<?=$bannerId['name']?>"> 
                    </div>
                    
                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        
                       <div><img src="<?=$bannerId['image']?>" alt="" width="100px"></div>
                       <input type="file" name="imgNew" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">URL</label>
                      
                        <input type="text" class="form-control" name="url" value="<?=$bannerId['url']?>"> 
                    </div>
                    <div class="form-group">
                        <label for="">Trạng thái</label>
                      
                        <select name="state" id="" class="form-select">
                           
                            <option value="<?=$bannerId['state']?>"><?php
                            if($bannerId['state'] ==1 ){
                                echo "Hiện";
                            }else{
                                echo "Ẩn";
                            } ?></option>
                            <?php if($bannerId['state'] ==1){
                                echo ' <option value="0">Ẩn</option>';
                            }else{
                                echo ' <option value="1">Hiện</option>';
                            } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
                    
                </form>
            </div>
        </div>
    </main>