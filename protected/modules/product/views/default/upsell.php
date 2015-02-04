<?php $themeUrl = Yii::app()->theme->baseUrl;


$model= new TransactionOrderDetails();



?>
<div class="top-header">

    <div class="inner-wrapper">

        <div class="top-logo"><a href="#"><img src="<?php echo $themeUrl ?>/images/logo.png" alt="#" /></a></div>
        <div class="top-text-part">#1 Brain Fuel Pill On The Market, Our customers trust <span>AddieUP&trade;</span> as the ultimate Focus & Energy Supplement</div>

        <div class="clear"></div>
    </div>
</div>

<h2 class="upsell-heding">Don't Miss Out On This Other Great Offer</h2>


<div class="upsell-main">
    <div class="offer-img"><img src="<?php echo $themeUrl ?>/images/offer.png"  alt="#"/></div>
   <?php $this->widget(
    'bootstrap.widgets.TbThumbnails',
    array(
    'dataProvider' => LandingProductRelation::model()->fetchAllPro1($id),
    'template' => "{items}\n{pager}",
    //'viewData' => array('l_id'=>$model->product_id),
    'itemView' => 'application.modules.product.views.default.upsellproductList',
    )
    );
    ?>




</div>