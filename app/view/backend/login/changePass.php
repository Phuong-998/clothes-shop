<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Đổi mật khẩu</title>
        <link href="public/admin/dist/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Đổi mật khẩu</h3></div>
                                    <div class="card-body">
                                        <form action="admin.php?c=login&m=hadnelChangePass" method="post">
                                            <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" placeholder="Mật khẩu" name="passOld"/>
                                                <label for="">Mật khẩu cũ</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Mật khẩu" name="passNew"/>
                                                <label for="inputPassword">Mât khẩu mới</label>
                                            </div>
                                            <div class=""><h3 class="text-center font-weight-light my-4"><button class="btn btn-primary" name="submit">Xác nhận</button></h3></div>
                                            <?php if(isset($errChangePass)): ?>
                                                <p><?=$errChangePass?></p>
                                            <?php endif;?>
                                           
                                        </form>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="public/admin/dist/js/scripts.js"></script>
    </body>
</html>
