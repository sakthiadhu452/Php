<!DOCTYPE html>
<html>
<head>
  <title>PHP Razorpay Payment Gateway Integration Example</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<style>
  .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center;
  }
  .card-product .img-wrap img {
    max-height: 100%;
    max-width: 100%;
    object-fit: cover;
  }
  .card-product .info-wrap {
    overflow: hidden;
    padding: 15px;
    border-top: 1px solid #eee;
  }
  .card-product .bottom-wrap {
    padding: 15px;
    border-top: 1px solid #eee;
  }

  .label-rating { margin-right:10px;
    color: #333;
    display: inline-block;
    vertical-align: middle;
  }

  .card-product .price-old {
    color: #999;
  }
</style>
<body>
<div class="container">
<br><br><br>
<div class="row">
<div class="col-md-4">
<figure class="card card-product">
  <div class="img-wrap"><img src="Images/mouse.jpg"></div>
  <figcaption class="info-wrap">
      <h4 class="title">Mouse</h4>
      <p class="desc">Some small description goes here</p>
      <div class="rating-wrap">
        <div class="label-rating">132 reviews</div>
        <div class="label-rating">154 orders </div>
      </div>
  </figcaption>
  <div class="bottom-wrap">
    <a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now" data-amount="1000" data-id="1">Order Now</a> 
    <div class="price-wrap h5">
      <span class="price-new">₹1000</span> <del class="price-old">₹1200</del>
    </div> 
  </div> 
</figure>
</div> 
<div class="col-md-4">
<figure class="card card-product">
  <div class="img-wrap"><img src="Images/watch.jpg"> </div>
  <figcaption class="info-wrap">
      <h4 class="title">Sony Watch</h4>
      <p class="desc">Some small description goes here</p>
      <div class="rating-wrap">
        <div class="label-rating">132 reviews</div>
        <div class="label-rating">154 orders </div>
      </div> 
  </figcaption>
  <div class="bottom-wrap">
      <a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now" data-amount="1280" data-id="2">Order Now</a> 
      <div class="price-wrap h5">
        <span class="price-new">₹1280</span> <del class="price-old">₹1400</del>
      </div> <!-- price-wrap.// -->
  </div> <!-- bottom-wrap.// -->
</figure>
</div> <!-- col // -->
<div class="col-md-4">
<figure class="card card-product">
  <div class="img-wrap"><img src="Images/mobile.jpg"></div>
  <figcaption class="info-wrap">
      <h4 class="title">Mobile</h4>
      <p class="desc">Some small description goes here</p>
      <div class="rating-wrap">
        <div class="label-rating">132 reviews</div>
        <div class="label-rating">154 orders </div>
      </div> 
  </figcaption>
  <div class="bottom-wrap">
      <a href="javascript:void(0)" class="btn btn-sm btn-primary float-right buy_now" data-amount="1280" data-id="3">Order Now</a> 
      <div class="price-wrap h5">
        <span class="price-new">₹1500</span> <del class="price-old">₹1980</del>
      </div> <!-- price-wrap.// -->
  </div> <!-- bottom-wrap.// -->
</figure>
</div> <!-- col // -->
</div> <!-- row.// -->
</div> 
<!--container.//-->

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>    <!-- add a checkout rozpay js-->
<script>
// using jquery when click a button it directs to function
  $('body').on('click', '.buy_now', function(e){   
    var totalAmount = $(this).attr("data-amount");
    var product_id =  $(this).attr("data-id");
    var imagearray=["Images/mouse.jpg","Images/watch.jpg","Images/mobile.jpg"];
    var imgid=product_id-1;
    var options = {
    "key": "rzp_live_ILgsfZCZoFIKMb",
    "amount": (1*100), // 100 paise = INR 1
    "name": "Sakthi_Demo",
    "description": "Payment",
    "image":imagearray[imgid] ,
    "handler": function (response){
          $.ajax({
            alert:alert(),
            url: 'payment-process.php',
            type: 'post',
            dataType: 'json',
            data: {
                razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,
            },  
            success: function (msg) {
                alert()
               window.location.href = 'success.php';
            }
        });
     
    },

    "theme": {
        "color": "#528FF0"  //color for template of rozarpay
    }
  };
  var rzp1 = new Razorpay(options);
  rzp1.open();
  e.preventDefault();
  });

</script>
</body>
</html>