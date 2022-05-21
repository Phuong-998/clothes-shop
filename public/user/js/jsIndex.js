$(document).ready(function () {
  $(".searcBar").click(function () {
    $(".search").show();
  });

  $(".close").click(function () {
    $(".search").hide();
  });

  $("#form-buyNow").validate({
    rules: {
      name: "required",
      tel: {
        required: true,
        number: true,
        minlength: 10,
        maxlength: 10,
      },
      address: "required",
    },
    messages: {
      name: "Bạn chưa nhập tên",
      tel: {
        required: "Bạn chưa nhập số điện thoại",
        number: "Vui lòng nhập số",
        minlength: "Vui lòng kiếm tra lại số điện thoại",
        maxlength: "Vui lòng kiếm tra lại số điện thoại",
      },
      address: "Vui lòng nhập địa chỉ",
    },

    //   submitHandler: function(form) {
    //     alert('abcd');
    // }
  });
});

//carosel sp ban chay

$(document).ready(function () {
  $(".owl-carousel").owlCarousel({
    autoplay: true,
    items: 4,
    loop: true,
    margin: 10,
    nav: true,
    dots: true,
  });
});

//select product color
$(document).on("click", ".productColor", function () {
  $(".productColor").removeClass("activeColor");
  $(this).addClass("activeColor");
  var a = $(this).attr("src");
  $(".prodcutImg").attr("src", a);
});

$(document).ready(function () {
  $(".addproduct").click(function () {
    var quanty = $(".quanty").val();
    var relex = /^[0-9]+$/;
    if (quanty.match(relex)) {
      quanty = parseInt(quanty) + 1;
      $(".quanty").val(quanty);
    } else {
      alert("Vui lòng kiểm tra lại số lượng");
    }
  });
});

$(document).ready(function () {
  $(".minusproduct").click(function () {
    var quanty = $(".quanty").val();
    var relex = /^[0-9]+$/;
    if (quanty.match(relex)) {
      if (parseInt(quanty) > 1) {
        quanty = parseInt(quanty) - 1;
        $(".quanty").val(quanty);
      } else {
        alert("Bạn phải đặt tôi thiểu 1 sản phẩm");
      }
    } else {
      alert("Vui lòng kiểm tra lại số lượng");
    }
  });
});

$(".addToCart").prop("disabled", true);
$(".buyNow").prop("disabled", true);

$(".radioColor").click(function () {
  $(".radio").click(function () {
    $(".addToCart").prop("disabled", false);
    $(".buyNow").prop("disabled", false);
  });
});

$(".radio").click(function () {
  $(".radioColor").click(function () {
    $(".addToCart").prop("disabled", false);
    $(".buyNow").prop("disabled", false);
  });
});

$(".radioColor").click(function () {
  var productId = $(".productId").val();
  var selectedVal = "";
  var selected = $(".radioColor:checked");
  if (selected.length > 0) {
    selectedVal = selected.val();
    var color = selectedVal;

    var selectedVal = "";
    var selected = $(".radio:checked");
    if (selected.length > 0) {
      selectedVal = selected.val();
      var size = selectedVal;
    }

    if (size) {
      $.ajax({
        url: "index.php?c=detail&m=getQty",
        method: "post",
        data: {
          color: color,
          size: size,
          productId: productId,
        },
        success: function (data) {
          $(".loadQty").html(data);
        },
      });
    } else {
      $(".loadQty").html("");
    }
  }
});
$(".radio").click(function () {
  var productId = $(".productId").val();
  var selectedVal = "";
  var selected = $(".radio:checked");
  if (selected.length > 0) {
    selectedVal = selected.val();
    var size = selectedVal;

    var selectedVal = "";
    var selected = $(".radioColor:checked");
    if (selected.length > 0) {
      selectedVal = selected.val();
      var color = selectedVal;
    }

    if (color) {
      $.ajax({
        url: "index.php?c=detail&m=getQty",
        method: "POST",
        data: {
          color: color,
          size: size,
          productId: productId,
        },
        success: function (data) {
          $(".loadQty").html(data);
        },
      });
    } else {
      $(".loadQty").html("");
    }
  }
});

$(".addToCart").click(function () {
  var productId = $(".productId").val();
  var price = $(".price1").val();
  var qty = $(".quanty").val();
  var selectedVal = "";
  var selected = $(".radio:checked");
  if (selected.length > 0) {
    selectedVal = selected.val();
    var size = selectedVal;

    var selectedVal = "";
    var selected = $(".radioColor:checked");
    if (selected.length > 0) {
      selectedVal = selected.val();
      var color = selectedVal;
    }
  }
  $.ajax({
    url: "index.php?c=cart&m=addCart",
    method: "POST",
    data: {
      productId: productId,
      price: price,
      color: color,
      size: size,
      qty: qty,
    },
    success: function (data) {
      $(".myCart").html(data);
    },
  });
});
function updateQty1(key) {
  var cartQty = ".cartQty" + key;
  var qty = $(cartQty).val();

  $.ajax({
    url: "index.php?c=cart&m=editQty",
    method: "POST",
    data: { qty: qty, key: key },
    success: function (data) {
      $(".myCart").html(data);
    },
  });
}

function deleteCart(key){
  $.ajax({
    url: "index.php?c=cart&m=deleteCart",
    method: "POST",
    data: {key: key },
    success: function (data) {
      $(".myCart").html(data);
    },
  });
}
$(".iconCart").click(function () {
  $.ajax({
    url: "index.php?c=cart",
    method: "POST",
    success: function (data) {
      $(".myCart").html(data);
    },
  });
});

$(".continueShopping").click(function () {
  location.reload();
});

$(document).on("click", ".productSize", function () {
  $(".productSize").removeClass("active_size");
  $(this).addClass("active_size");
});


$(".btnLoc").click(function () {
  $(".loc").show();
});
$(".closefilter").click(function () {
  $(".loc").hide();
});

$(function () {
  $("#slider-range").slider({
    range: true,
    min: 100000,
    max: 800000,
    step: 50000,
    values: [100000, 800000],
    slide: function (event, ui) {
      $("#amount").val(ui.values[0] + "đ" + "-" + ui.values[1] + "đ");
      $("#minPrice").val(ui.values[0]);
      $("#maxPrice").val(ui.values[1]);
    },
  });
  $("#amount").val(
    $("#slider-range").slider("values", 0) +
      "đ" +
      "-" +
      $("#slider-range").slider("values", 1) +
      "đ"
  );
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

$(".phuong").change(function(){
  var tinh = $(".tinh").val();
  var quan = $(".quan").val();
  var phuong = $(".phuong").val();
  var tamtinh = $(".tamtinh").val();
  $.ajax({
    url:"index.php?c=checkout&m=addShip",
    method:"post",
    data:{tinh:tinh,quan:quan,phuong:phuong,tamtinh:tamtinh},
    success:function(data){
      var data = parseFloat(data)
      $(".tinhship").html(data.toLocaleString())
      $(".tongtien").html((parseFloat(tamtinh)+parseFloat(data)).toLocaleString())
      $(".tt").val(parseFloat(tamtinh)+parseFloat(data))  
      $(".ship").val(data)
    }
  })
})






