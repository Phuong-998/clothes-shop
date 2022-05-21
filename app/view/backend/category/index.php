<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="row mt-4">
                <div class="col-4" >

                    <form action="admin.php?c=category&m=hadnelAdd" method="POST" role="form" id="frmAddCategory">
                        <legend>Thêm danh mục</legend>

                        <div class="form-group">
                            <label for="">Tên danh mục</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label for="">Danh mục cha</label>
                            
                            <select name="parent" id="input" class="form-select"  required="required">
                                <option value="0">Danh mục cha</option>
                                <?=$categoryOption?>
                            </select>
                            
                        </div>


                        <button type="submit" class="btn btn-primary mt-2" name="submit">Thêm</button>
                        <span style="color: red;"><?php if(isset($errAddCate)){ echo $errAddCate; } ?></span>
                    </form>

                </div>
                <div class="col-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Danh mục
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple" class="tacd">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên danh mục</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?=$category?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>