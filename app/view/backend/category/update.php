<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h2 class="mt-4">Sửa danh mục</h2>
            <ol class="breadcrumb mb-4">
            </ol>
            <div class="col-4">

                <form action="admin.php?c=category&m=hadnelUpdate" method="POST" role="form" id="frmUpdateCategory">

                    <div class="form-group">
                        <label for="">Tên danh mục</label>
                        <input type="hidden" name="category_id" id="" value="<?=$category_id['id']?>">
                        <input type="text" class="form-control" name="name" value="<?=$category_id['name']?>">
                    </div>
                    <div class="form-group">
                    <label for="">Thứ tự</label>
                        <select name="parent" id="input" class="form-select" required="required">
                            <?php if($category_id['parent_id'] == 0):?>
                            <option value="<?=$category_id['parent_id']?>"><?=$category_id['name']?></option>
                            <?php endif;?>
                            <?=$parent?>
                            <?=$categoryOption?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2" name="submit">Xác nhận</button>
                    <span style="color: red;"><?php if(isset($nullNameColor)){ echo $nullNameColor; } ?></span>
                        <span style="color: red;"><?php if(isset($errUpdateColor)){ echo $errUpdateColor; } ?></span>
                </form>


            </div>
        </div>
    </main>