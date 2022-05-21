<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mb-4 mt-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Thống kê truy cập
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="tacd">
                        <thead>
                            <tr>
                                <th>Truy cập tháng trước</th>
                                <th>Truy cập tháng này</th>
                                <th>Truy cập năm nay</th>
                                <th>Tổng truy cập</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr>
                               <td><?=number_format($totalAccesLastMonth['qty'])?></td>
                               <td><?=number_format($totalAccesMonth['qty'])?></td>
                               <td><?=number_format($totalAccesYear['qty'])?></td>
                               <td><?=number_format($totalAcees['qty'])?></td>
                           </tr>


                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </main>