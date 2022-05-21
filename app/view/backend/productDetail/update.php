<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Chỉnh sửa</h2>
            <ol class="breadcrumb mb-4">
            </ol>
            <div class="col-4">

                <form action="admin.php?c=productDetail&m=hadnelUpdate" method="POST" role="form" enctype="multipart/form-data" id="frmUpdateAtr">
                    <input type="hidden" name="img" value="<?=$product['color_img']?>">
                    <input type="hidden" name="id" value="<?=$product['id']?>">
                    <input type="hidden" name="product_id" value="<?=$product['product_id']?>">
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="number" class="form-control" name="qty" value="<?=$product['qty']?>">
                    </div>
                   

                           
                    <div class="form-group ">
                        <label for="">Ảnh sản phẩm</label>
                        <div><img src="<?=$product['color_img']?>" alt="" width="60px"></div>
                        <input type="file" class="form-control" id="" name="color_img">
                    </div>
                    <?php if(isset($errUpdate)):?>
                        <p style="color: red;"><?=$errUpdate?></p>
                    <?php endif;?>
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Submit</button>
                </form>


            </div>
        </div>
    </main>