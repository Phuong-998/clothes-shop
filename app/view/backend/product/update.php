<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <div class="card mb-4 mt-4">
                    <div class="card-header">
                    <i class="fas fa-database"></i>
                      Sửa thông tin
                    </div>
                    <div class="card-body">
                        
                        <form action="admin.php?c=product&m=hadnelUpdate" method="POST" role="form" enctype="multipart/form-data" id="formUpdateProduct">
                        <div class="row">
                            <input type="hidden" name="id" value="<?=$product['id']?>">
                            <input type="hidden" name="img" value="<?=$product['image']?>">
                           
                            <div class="col-6">
                           

                            <div class="form-group">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="" name="name" value="<?=$product['name']?>" >
                            </div>   
                            
                            <div class="form-group">
                                <label for="">Danh mục</label>
                                <select name="category" id="" class="form-select">
                                    <option value="<?=$product['categoryId']?>"><?=$product['category']?></option>
                                    <?=$category?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Giá bán</label>
                                <input type="number" class="form-control" id="" name="price" value="<?=$product['price']?>">
                            </div>
                            <div class="form-group">
                                <label for="">Giá khuyến mãi</label>
                                <input type="number" class="form-control" id="" name="price_discout" value="<?=$product['price_discout']?>">
                            </div>
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <select name="status" id="" class="form-select">
                                   
                                    <option value="<?=$product['status']?>"><?php if($product['status'] ==1 ){echo 'Đang kinh doanh';}else{echo 'Ngừng kinh doanh';}?></option>
                                    <?php if($product['status'] ==1){
                                        echo ' <option value="0">Ngừng kinh doanh</option>';
                                    }else{
                                        echo ' <option value="1">Đang kinh doanh</option>';
                                    } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group ">
                                <label for="">Ảnh sản phẩm</label>
                                <div><img src="<?=$product['image']?>" alt="" width="60px"></div>
                                <input type="file" class="form-control" id="" name="image">
                            </div><br>

                            <div class="form-group">
                                <label for="">Ảnh mô tả</label><br>
                                <?php foreach($img as $value): ?>
                                    <span><img src="<?=$value['image']?>" alt="" width="60px"></span>
                                <?php endforeach;?>
                                <input type="file" class="form-control" id="" name="images[]" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4" name="submit">Xác nhận</button>
                            </div>
                            
                            

                            
                            <?php if(isset($errUpdateProduct)): ?>
                                <?php foreach($errUpdateProduct as $value):?>
                                    <p style="color: red;"><?=$value?></p>
                                <?php endforeach;?>
                            <?php endif;?>
                             <?php if(isset($errUpdate)): ?>
                                <p style="color: red;"><?=$errUpdate?></p>
                            <?php endif;?>
                            
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
        </div>
    </main>