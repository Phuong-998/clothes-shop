$("#formAddProduct").validate({
  rules: {
    name: "required",
    price: "required",
  },
  messages: {
    name: "Bạn chưa nhập tên sản phẩm",
    price: "Bạn chưa nhập giá bán",
  },
});

$("#formUpdateProduct").validate({
  rules: {
    name: "required",
    price: "required",
  },
  messages: {
    name: "Bạn chưa nhập tên sản phẩm",
    price: "Bạn chưa nhập giá bán",
  },
});

$("#frmAddAtr").validate({
  rules: {
    qty: "required",
  },
  messages: {
    qty: "Bạn chưa nhập số lượng",
  },
});

$("#frmUpdateAtr").validate({
  rules: {
    qty: "required",
  },
  messages: {
    qty: "Bạn chưa nhập số lượng",
  },
});

$("#frmAddShip").validate({
  rules: {
    tinh: "required",
    quan: "required",
    phuong: "required",
    ship: "required",
  },
  messages: {
    tinh: "Bạn chưa chọn Tỉnh/thành phố",
    quan: "Bạn chưa chọn Quận/Huyện",
    phuong: "Bạn chưa chọn Phường/Xã",
    ship: "Bạn chưa nhập phí vận chuyển",
  },
});

$("#frmUpdateShip").validate({
  rules: {  
    ship: "required",
  },
  messages: {
    ship: "Bạn chưa nhập phí vận chuyển",
  },
});

$("#frmAddSize").validate({
  rules: {  
    name: "required",
  },
  messages: {
    name: "Bạn chưa nhập size",
  },
});

$("#frmUpdateSize").validate({
  rules: {  
    name: "required",
  },
  messages: {
    name: "Bạn chưa nhập size",
  },
});

$("#frmAddColor").validate({
  rules: {  
    name: "required",
  },
  messages: {
    name: "Bạn chưa nhập màu sắc",
  },
});

$("#frmUpdateColor").validate({
  rules: {  
    name: "required",
  },
  messages: {
    name: "Bạn chưa nhập màu sắc",
  },
});

$("#frmAddCategory").validate({
  rules: {  
    name: "required",
  },
  messages: {
    name: "Bạn chưa nhập tên danh mục",
  },
});

$("#frmUpdateCategory").validate({
  rules: {  
    name: "required",
  },
  messages: {
    name: "Bạn chưa nhập tên danh mục",
  },
});

$("#frmAddBannber").validate({
  rules: {  
    name: "required",
    url:"required"
  },
  messages: {
    name: "Bạn chưa nhập tên danh mục",
    url:"Bạn nhập URL"
  },
});
$("#frmUpdateBanner").validate({
  rules: {  
    name: "required",
    url:"required"
  },
  messages: {
    name: "Bạn chưa nhập tên danh mục",
    url:"Bạn nhập URL"
  },
});

$("#frmAddNcc").validate({
  rules: {
    name: "required",
    phone: {
      required: true,
      number: true,
      minlength: 10,
      maxlength: 10,
    },
    address: "required",
  },
  messages: {
    name: "Bạn chưa nhập tên",
    phone: {
      required: "Bạn chưa nhập số điện thoại",
      number: "Vui lòng nhập số",
      minlength: "Vui lòng kiếm tra lại số điện thoại",
      maxlength: "Vui lòng kiếm tra lại số điện thoại",
    },
    address: "Vui lòng nhập địa chỉ",
  },
});

$("#frmUpdateNcc").validate({
  rules: {
    name: "required",
    phone: {
      required: true,
      number: true,
      minlength: 10,
      maxlength: 10,
    },
    address: "required",
  },
  messages: {
    name: "Bạn chưa nhập tên",
    phone: {
      required: "Bạn chưa nhập số điện thoại",
      number: "Vui lòng nhập số",
      minlength: "Vui lòng kiếm tra lại số điện thoại",
      maxlength: "Vui lòng kiếm tra lại số điện thoại",
    },
    address: "Vui lòng nhập địa chỉ",
  },
});

$("#frmAddMember").validate({
  rules: {
    name: "required",
    fullname: "required",
    password: "required",
  },
  messages: {
    name: "Bạn chưa nhập tên",
    fullname: "Bạn chưa nhập họ tên",
    password: "Bạn chưa nhập mật khẩu",
  },
});

$("#formAddHang").validate({
  rules: {
    productId: "required",
    "price[]": "required",
    "color[]": "required",
    "size[]": "required",
    "qty[]": "required",
  },
  messages: {
    productId: "Bạn chưa nhập sản phẩm",
    price: "Bạn chưa nhập giá",
    "color[]": "bạn chưa nhập màu sắc",
    "size[]": "Bạn chưa nhập kích thước",
    "qty[]": "Bạn chưa nhập số lượng",
  },
});
//select2 
$(document).ready(function() {
    $("#states").select2({
        placeholder: "Nhập tên sản phẩm",
        allowClear: true,
        language: {
            noResults: function() {
                return '<button id="no-results-btn" onclick="noResultsButtonClicked()">Không tìm thấy click để thêm sản phẩm</a>';
            },
        
        },
        escapeMarkup: function(markup) {
      return markup;
    },
    });
    
});

function noResultsButtonClicked() {
    window.location.href = 'admin.php?c=product&m=add';
}
// them thuoc tinh nhap hang
$(document).ready(function(){

    $(".addArt").click(function(){
      $.ajax({
        url:"admin.php?c=phieuNhap&m=addatr",
        method:"post",
        success:function(data){
          $(".art").append(data);
        }
      });
            
         
    });
    $(".minus").click(function(){
        
      $(".art .row").last().remove();
   
});
});

$(".tinh").change(function(){
    var idTinh = $(".tinh").val();
    $.ajax({
      url:"index.php?c=checkout&m=loadQuan",
      method:"post",
      data:{idTinh:idTinh},
      success:function(data){
        $(".quan").html(data)
      }
    })
  });
  
  $(".quan").change(function(){
    var idQuan = $(".quan").val();
    $.ajax({
      url:"index.php?c=checkout&m=loadPhuong",
      method:"post",
      data:{idQuan:idQuan },
      success:function(data){
        $(".phuong").html(data)
      }
    })
  });

  
  $("#updateOrderStatus").change(function(){
    var status = $("#updateOrderStatus").val();
    var order_id = $("#orderId").val();
    $.ajax({
      url:"admin.php?c=order&m=updateOrder",
      method:"post",
      data:{status:status,order_id:order_id},
      success:function(data){
        alert('Cập nhật thành công')
      }
    })
  })

  $("#year").change(function(){

    $("#frmYear").submit();
  });

  $("#dayOrder").change(function(){

    $("#frmTKOrderDay").submit();
  });

  $("#tkOrderMonth").change(function(){
    $("#tkOrderYear").change(function(){
      $("#frmTKOrder").submit();
    });
  });
  

  
  $("#expens").change(function(){

    $("#frmExpens").submit();
  });

