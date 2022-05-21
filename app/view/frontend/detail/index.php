<div class="conten">
    <div class="detail_product">
        <div class="row">
            <div class="col-3 ">
                <img src="<?= $product['image'] ?>" alt="" width="100%" class="prodcutImg">

            </div>
            <div class="col-9 product_info">
                <form method="post" action="index.php?c=cart">
                    <input type="hidden"  class="productId" value="<?= $product['id'] ?>">
                    <input type="hidden"  class="price1" value="<?= $product['price_discout'] ?>">
                    <h1><?= $product['name'] ?></h1>
                    <p style="color: red;font-size:22px"><?= number_format($product['price_discout']) ?>₫</p>
                    <span>Màu sắc:</span>
                    <div class="product_color">
                        <?php foreach ($color as $value) : ?>
                            <label class="list_color">
                                <img src="<?= $value['color_img'] ?>" alt="" class="productColor">
                                <input type="radio" name="color" value="<?= $value['color_id'] ?>" class="radioColor">
                            </label>
                        <?php endforeach; ?>

                    </div>
                    <div class="product_info-size">
                        <span>Kích cỡ:</span><br>
                        <?php foreach ($size as $value) : ?>
                            <label class="productSize">
                                <div>
                                    <?= $value['name'] ?>
                                </div>
                                <input type="radio" name="size" value="<?= $value['size_id'] ?>" class="radio">
                            </label>
                        <?php endforeach; ?><br>
                        <span class="loadQty" style="color: red;"></span>
                    </div>
                    
                    <div class="qty">
                        <span>Số lượng :</span><br>
                        <button type="button" class="addproduct"><i class="fas fa-plus"></i></button>
                        <input type="text" name=""  value="1" class="quanty">
                        <button type="button" class="minusproduct"><i class="fas fa-minus"></i></i></button>
                    </div>
                    
                    <div class="addCart">
                        <button type="button" value="addToCart" class="addToCart" name="addCart" data-bs-toggle="modal" data-bs-target="#exampleModal">Thêm vào giỏ hàng</button>
                        <button type="submit" value="buynow" class="buyNow" name="buyNow">Mua Ngay</button>



                    </div>
                    </form>
                   
                
                <div class="service">
                    <p>» BẢO HÀNH SẢN PHẨM 90 NGÀY</p>
                    <p>» ĐỔI HÀNG TRONG VÒNG 30 NGÀY</p>
                    <p>» HOTLINE BÁN HÀNG 1900 633 501</p>
                </div>
            </div>
        </div>

        <div class="des">
            <?php foreach ($image as $value) : ?>
                <img src="<?= $value['image'] ?>" width="100%">
            <?php endforeach; ?>
        </div>
        <div class="related">
            <div class="related_box"></div>
            <div class="related_title">
                <h3>Sản phẩm cùng danh mục</h3>
            </div>
        </div>
        <div class="product">
            <div class="container">
                <div class="row">
                    <?php foreach ($productCate as $value) : ?>
                        <div class="col-3 my-2 prodcut_image">
                    
                    <div class="img_row1">
                    <span class="discout"><?php if($value['discout']!=0){
                    echo $value['discout'] . '%';
                }?></span>
                        <a href="index.php?c=detail&id=<?=$value['id']?>&cate=<?=$value['category_id']?>"><img src="<?=$value['image']?>" alt="" width="100%"></a>
                    </div>
                    
                    <div class="price">
                    <span style="text-transform: uppercase;"><?=$value['name']?></span><br>
                    <?php if($value['price'] != $value['price_discout']): ?>
                <span style="font-size: 13px;"><strike><?=number_format($value['price'])?>đ</strike></span><br>
                <?php endif;?>
                        <span><?=number_format($value['price_discout'])?>đ</span>
                    </div>
                </div>
                    <?php endforeach; ?>


                </div>
            </div>
        </div>
    </div>
</div>