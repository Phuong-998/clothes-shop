<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <div class="card mb-4 mt-4">
                    <div class="card-header">
                    <i class="fas fa-database"></i>
                      Thêm sản phẩm
                    </div>
                    <div class="card-body">
                        
                        <form action="admin.php?c=product&m=hadnelAdd" method="POST" role="form" enctype="multipart/form-data" id="formAddProduct">
                        <div class="row">
                            <div class="col-6">
                            

                            <div class="form-group">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="" name="name">
                            </div>   
                            
                            <div class="form-group">
                                <label for="">Danh mục</label>
                                <select name="category" id="" class="form-select">
                                    <?=$category?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Giá bán</label>
                                <input type="number" class="form-control" id="" name="price">
                            </div>
                            </div>
                            <div class="col-6">
                            <div class="form-group">
                                <label for="">Giá khuyến mãi</label>
                                <input type="number" class="form-control" id="" name="price_discout">
                            </div>

                

                            <div class="form-group">
                                <label for="">Ảnh sản phẩm</label>
                                <input type="file" class="form-control" id="" name="image">
                            </div>

                            <div class="form-group">
                                <label for="">Ảnh mô tả</label>
                                <input type="file" class="form-control" id="" name="images[]" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 sumb" name="submit">Thêm sản phẩm</button>
                            <?php if(isset($errProduct)): ?>
                                <?php foreach($errProduct as $value):?>
                                    <p style="color: red;"><?=$value?></p>
                                <?php endforeach;?>
                            <?php endif;?>
                            <?php if(isset($errAddProduct)): ?>
                                <p style="color: red;"><?=$errAddProduct?></p>
                            <?php endif;?>
                            </div>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
        </div>
    </main>