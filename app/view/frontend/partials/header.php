<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/user/style/bootstrap.css">
    <link rel="stylesheet" href="public/user/style/style.css">

    <link rel="stylesheet" type="text/css" href="public/user/style/all.min.css">
    <link rel="stylesheet" href="public/user/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="public/user/owlcarousel/assets/owl.theme.default.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/user/style/jquery-ui.min.css">
    <title>Shopping</title>
</head>

<body class="body">
    <!-- Header -->

    <div class="header">
        <div class="loc">
            <div class="drawer__close">
                <button class="closefilter"><i class="fa-solid fa-xmark"></i> </button>
            </div>

            <div class="slir-inner">
            
                <form action="index.php" method="get">
                    <?php $a = 'page';$b='searchPage'?>
                    <input type="hidden" value="<?=$a?>" name="c">
                    <input type="hidden" value="<?=$b?>" name="m">
                <input type="hidden" value="<?=$cate1?>" name="cate">
                    <div class="oderBy">
                        <select name="oderByPage" class="oderByPage">
                            <option selected disabled>Sắp xếp theo:</option>
                            <option value="1">Mặc định</option>
                            <option value="2">Giá: giảm dần</option>
                            <option value="3">Giá: tăng dần</option>

                        </select>
                    </div>
                    <div class="filter_price">
                        <h3>GIÁ</h3>
                        <div id="slider-range"></div>
                        <p>
                            <label for="amount">Price range:</label>
                            <input type="text" id="amount" readonly style="border:0; color:balck; font-weight:bold;">
                             <input type="hidden" name="minPrice" id="minPrice" value="100000">
                             <input type="hidden" name="maxPrice" id="maxPrice" value="800000">   
                        </p>
                    </div>
                    <div class="filter_color">
                        <h3>Màu sắc</h3>
                        <ul>
                            <?php foreach($colorFilter as $value):?>
                            <li><input type="checkbox" name="color[]" id="color<?=$value['color_id']?>" value="<?=$value['color_id']?>">&nbsp;<label for="color<?=$value['color_id']?>"><?=$value['name']?></label></li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <div class="filter_size">
                        <h3>Kích cỡ</h3>
                        <ul>
                        <?php foreach($sizeFilter as $value):?>
                            <li><input type="checkbox" name="size[]" id="size<?=$value['size_id']?>" value="<?=$value['size_id']?>">&nbsp;<label for="size<?=$value['size_id']?>"><?=$value['name']?></label></li>
                           
                            <?php endforeach;?>
                        </ul>

                    </div>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>
            </div>
        </div>
        <div class="logo">
            <a href="index.php?c=home" title=""><img src="public/user/img/logo5.png" alt=""></a>
        </div>
        <div class="menu_icon">
            <a href="#" title="" class="searcBar"><i class="fa-solid fa-magnifying-glass"></i></a>
            <!-- <a href="" title=""><i class="fas fa-heart"></i></i></a> -->
            <button data-bs-toggle="modal" class="iconCart" data-bs-target="#exampleModal" title=""><i class="fas fa-shopping-cart"></i></button>
            <span class="cartCout"><?php if (isset($_SESSION['cart'])) {
                                        echo count($_SESSION['cart']);
                                    } else {
                                        echo "0";
                                    } ?></span>
        </div>
        <div class="nav">
            <ul class="nav_menu">
                <li class="nav_item">
                    <a href="index.php?c=home" class="nav_link" title="">Trang chủ</a>
                </li>
                <?php foreach ($category as $value) : ?>
                    <li class="nav_item">
                        <a href="index.php?c=page&cate=<?= $value['id'] ?>" class="nav_link" title=""><?= $value['name'] ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
        <div class="phoneNumber">
            <i class="fas fa-phone-alt"></i>
            <span>0399909888</span>
        </div>
        <div class="page_icon">
            <a href=""><i class="fab fa-facebook-f"></i></a>
            <a href=""><i class="fab fa-youtube"></i></a>
            <a href=""><i class="fab fa-instagram"></i></a>
        </div>
    </div>