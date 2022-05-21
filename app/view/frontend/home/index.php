<div class="conten">
    <div class="heading">
        <div class="title_heading">
            <h3><a href="" title="">Sản phẩm mới nhất</a></h3>
        </div>
        <div class="cricle">
            <i class="far fa-circle"></i>
        </div>
    </div>
    <div class="selling_product">
        <div class="owl-carousel">

            <?php foreach($newProduct as $value):?>
            <div class="prodcut_image">
                <div class="img_row1">
                    <span class="discout"><?php if($value['discout']!=0){
                        echo '-' . $value['discout'] . '%';
                    }?></span>
                    <a href="index.php?c=detail&id=<?=$value['id']?>&cate=<?=$value['category_id']?>"><img
                            src="<?=$value['image']?>" alt=""></a>
                </div>
                <div class="price">
                    <span style="text-transform: uppercase;"><?=$value['name']?></span><br>
                    
                    <?php if($value['price'] != $value['price_discout']): ?>
                    <span style="font-size: 13px;color:red"><strike><?=number_format($value['price'])?>đ</strike></span><br>
                    <?php endif;?>
                    <span><?=number_format($value['price_discout'])?>đ</span>
                </div>
            </div>
            <?php endforeach;?>





        </div>
    </div>
    <div class="heading">
        <div class="title_heading">
            <h3><a href="" title="">Sản phẩm bán chạy nhất</a></h3>
        </div>
        <div class="cricle">
            <i class="far fa-circle"></i>
        </div>

    </div>
    <div class="selling_product">
        <div class="owl-carousel">
       
           
        <?php foreach($sellProduct as $value):?>
            <div class="prodcut_image">
                <div class="img_row1">
                    <span class="discout"><?php if($value['discout']!=0){
                        echo '-' . $value['discout'] . '%';
                    }?></span>
                    <a href="index.php?c=detail&id=<?=$value['product_id']?>&cate=<?=$value['category_id']?>"><img
                            src="<?=$value['image']?>" alt=""></a>
                </div>
                <div class="price">
                    <span style="text-transform: uppercase;"><?=$value['name']?></span><br>
                    
                    <?php if($value['price'] != $value['price_discout']): ?>
                    <span style="font-size: 13px;color:red"><strike><?=number_format($value['price'])?>đ</strike></span><br>
                    <?php endif;?>
                    <span><?=number_format($value['price_discout'])?>đ</span>
                </div>
            </div>
            <?php endforeach;?>
           
           
            
           
            
        </div>
    </div>
</div>