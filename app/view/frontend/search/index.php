<div class="conten">
            <div class="img_search">
                <h2>Tìm kiếm với: "<?=$search?>"</h2>
            </div>
            <h3>Kết quả với từ khóa "<?=$search?>":</h3>
            <div class="Men_Product">
                <div class="row">
                <?php foreach($product as $value):?>
                    <div class="col-3 my-2 prodcut_image">
                    
                        <div class="img_row1">
                        <span class="discout"><?php if($value['discout']!=0){
                        echo '-'.$value['discout'] . '%';
                    }?></span>
                            <a href="index.php?c=detail&id=<?=$value['id']?>&cate=<?=$value['category_id']?>"><img src="<?=$value['image']?>" alt="" width="100%"></a>
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