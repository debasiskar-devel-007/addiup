<?php
    $baseUrl =  Yii::app()->baseUrl;

    $themeUrl = Yii::app()->theme->baseUrl;

    $imgPath = Yii::app()->getBaseUrl(true)."/uploads/product_image/thumb/237X214/";








?>

<div class="upsell-wrapper">
    <h3><?php echo $data->product_name ?></h3>

    <div class="pro-img"><img src="<?php echo $imgPath.$data->product_image;?>" style="display: block;margin: 0 auto" alt="#" /></div>

    <div class="pro-detail">
        <h4>Add To Order :<span>$<?php echo $data->product_price; ?></span></h4>
        <a href="#">YES</a><a href="#">NO</a>

        <h5>50% OFF</h5>

    </div>




    <div class="clear"></div>

</div>
