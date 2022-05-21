<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <form action="admin.php?c=dashboard&m=chitiettonkho&id=<?=$cateogry_id?>" method="POST" role="form" class="mt-3">

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <select name="MonthTonKho" id="" class="form-select">
                                <option value="" disabled selected>--Chọn tháng--</option>
                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <?php $year = getdate(); ?>
                            <select name="YearTonKho" id="" class="form-select">
                                <option value="" disabled selected>--Chọn năm--</option>
                                <option value="<?= $year['year'] ?>"><?= $year['year'] ?></option>
                                <option value="<?= $year['year'] ?>"><?= $year['year'] - 1 ?></option>
                                <option value="<?= $year['year'] ?>"><?= $year['year'] - 2 ?></option>
                                <option value="<?= $year['year'] ?>"><?= $year['year'] - 3 ?></option>
                                <option value="<?= $year['year'] ?>"><?= $year['year'] - 4 ?></option>
                            </select>

                        </div>
                    </div>
                    <div class="col-3"><button type="submit" class="btn btn-primary" name="submit">Submit</button></div>
                </div>




                
            </form>

            <div class="card mb-4 mt-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Tồn kho  <?php $month = getdate();
                                    echo $month['mon']; ?>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="tacd">
                        <thead>
                            <tr>
                                <th colspan="2">Hàng hóa</th>
                                <th colspan="2">Tồn kho đầu tháng</th>
                                <th colspan="2">Nhập kho</th>
                                <th colspan="2">Xuất kho</th>
                                <th colspan="2">Cuối tháng</th>
                            </tr>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $tonkhodauky = 0;
                            $triGiaHangTonDauky = 0;
                            $soluongTrongKy = 0;
                            $triGiahangTrongKy = 0;
                            $soluongxuatKy = 0;
                            $trigiaxuatky = 0;
                            $soluongcuoithang = 0;
                            $trigiacuoithang = 0;
                            ?>
                            <?php foreach ($tonkho as $value) : ?>
                                <?php
                                $tonkhodauky += $value['tonkhodauky'];
                                $triGiaHangTonDauky += $value['triGiaHangTonDauky'];
                                $soluongTrongKy += $value['soluongTrongKy'];
                                $triGiahangTrongKy += $value['triGiahangTrongKy'];
                                $soluongxuatKy += $value['soluongxuatKy'];
                                $trigiaxuatky += $value['trigiaxuatky'];
                                $soluongcuoithang += $value['tonkhodauky'] +  $value['soluongTrongKy'] - $value['soluongxuatKy'];
                                $trigiacuoithang += $value['triGiaHangTonDauky'] + $value['triGiahangTrongKy'] - $value['trigiaxuatky'];
                                ?>
                                <tr>
                                    <td style="text-transform: uppercase;"><?= $value['produc'] ?></td>
                                    <td><img src="<?= $value['image'] ?>" alt="" width="70px"></td>
                                    <td><?= $value['tonkhodauky'] ?></td>
                                    <td><?= number_format($value['triGiaHangTonDauky']) ?></td>
                                    <td><?= $value['soluongTrongKy'] ?></td>
                                    <td><?= number_format($value['triGiahangTrongKy']) ?></td>
                                    <td><?= $value['soluongxuatKy'] ?></td>
                                    <td><?= number_format($value['trigiaxuatky']) ?></td>
                                    <td><?= $value['tonkhodauky'] +  $value['soluongTrongKy'] - $value['soluongxuatKy'] ?>
                                    </td>
                                    <td><?= number_format($value['triGiaHangTonDauky'] + $value['triGiahangTrongKy'] - $value['trigiaxuatky']) ?>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                            <tr>
                                <td colspan="2">Tổng cộng</td>
                                <td><?= $tonkhodauky ?></td>
                                <td><?= number_format($triGiaHangTonDauky) ?></td>
                                <td><?= $soluongTrongKy ?></td>
                                <td><?= number_format($triGiahangTrongKy) ?></td>
                                <td><?= $soluongxuatKy ?></td>
                                <td><?= number_format($trigiaxuatky) ?></td>
                                <td><?= $soluongcuoithang ?></td>
                                <td><?= number_format($trigiacuoithang) ?></td>

                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </main>