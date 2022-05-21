<div id="carouselExampleControls" class="carousel slide BannerSlide Banner" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach($banner as $key =>$value): ?>
                <div class="carousel-item <?php if($key == 0){echo 'active';}else{echo '';} ?>">
                    <a href="<?=$value['url']?>"><img src="<?=$value['image']?>" class="d-block w-100" alt="..."></a>
                </div>
                <?php endforeach;?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div>