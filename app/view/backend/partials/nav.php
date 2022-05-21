<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                <a class="nav-link collapsed" href="admin.php?c=order">
                        <div class="sb-nav-link-icon"> <i class="fas fa-shopping-cart"></i></div>
                        Đơn hàng

                    </a>
                   
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#product"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        Sản phẩm
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="product" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="admin.php?c=product&m=add">Thêm mới</a>
                            <a class="nav-link" href="admin.php?c=product">Danh sách</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#ncc"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-address-book"></i></div>
                        Nhà cung cấp
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="ncc" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.html">Thêm mới</a>
                            <a class="nav-link" href="admin.php?c=ncc">Danh sách</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#properties"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Thuộc tính
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="properties" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="admin.php?c=color">Màu sắc</a>
                            <a class="nav-link" href="admin.php?c=size">Kích cỡ</a>
                            <a class="nav-link" href="admin.php?c=category">Danh mục</a>
                        </nav>
                    </div>
                   
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#nhaphang"
                        aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
                        Nhập hàng
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="nhaphang" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="admin.php?c=phieuNhap">Danh sách</a>
                            <a class="nav-link" href="admin.php?c=phieuNhap&m=add">Tạo phiếu nhập</a>
                        </nav>
                    </div>


                   <?php if(  $_SESSION['role'] == 1):?>
                    <a class="nav-link collapsed" href="admin.php?c=member">
                        <div class="sb-nav-link-icon"> <i class="fas fa-users"></i></div>
                       Thành Viên

                    </a>
                    <?php endif;?>
                    <a class="nav-link collapsed" href="admin.php?c=banner">
                        <div class="sb-nav-link-icon"><i class="fa-brands fa-bilibili"></i></div>
                        Banner

                    </a>
                    <a class="nav-link collapsed" href="admin.php?c=ship">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-truck-fast"></i></div>
                        Phí vận chuyển

                    </a>
                    <?php if(  $_SESSION['role'] == 1):?>
                    <a class="nav-link" href="admin.php?c=dashboard">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Thống kê 
                    </a>
                        <?php endif?>
                </div>
            </div>
            <div class="sb-sidenav-footer">

            </div>
        </nav>
    </div>