window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple,{
            firstLast:true,
            perPage: 10,
            labels:{placeholder:"Tìm kiếm",perPage:"{select} mục",noRows:"Không có giữ liệu",noResults:"không có kết quả tìm kiếm",info:"Hiển thị {start} đến {end} trong tổng số {rows} mục"}
        });
    }
});
