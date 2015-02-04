<?php
    $baseUrl =  Yii::app()->baseUrl;

    $themeUrl = Yii::app()->theme->baseUrl;

    $imgPath = Yii::app()->getBaseUrl(true)."/uploads/product_image/thumb/520X212/";




if($data->autoship == 1){
    $imgPath = Yii::app()->getBaseUrl(true)."/uploads/product_image/thumb/237X214/";
}



?>
<div class="problock1">
<div class="top-header"><?php echo $data->product_desc;?></span></div>
     <div class="leftpro1">

            <input type="checkbox"  class="ck1 product_chk" <?php if(intval($l_id) >0 && (intval($l_id) == $data->id)){ ?> checked="checked" <?php } ?>>

         <img src="<?php echo $imgPath.$data->product_image;?>" alt="#" />

        </div>
        <?php
        if($data->shipping_id==6)
        {
        ?>
        <div class="offerimg"><img src="<?php echo $themeUrl ?>/images/free.png"  alt="#"/></div>
    <?php

        }
        else
        {
    ?>
    <div class="offerimg2"><img src="<?php echo $themeUrl ; ?>/images/car.png"  alt="#"/>


        <?php
        $res=ShippingCharge::model()->findAll('id='.$data->shipping_id);
        ?>
        Shipping Cost: <span>$<?php echo $res[0]['shipping_charge'] ?></span>
    </div>

        <?php } ?>
        <div class="rightprice1">

            <h2><?php echo $data->product_name;?></h2>
            <h3>$<?php echo $data->product_price;?></h3>
            <?php if(intval($l_id) >0 && (intval($l_id) == $data->id)){ ?>
            <a href="javascript:void(0)" class="buynow btnim" l_id="<?php echo intval($data->id);?>" st="0" onclick="selectproduct(this)">Buy Now</a>
            <?php } else{ ?>
            <a href="javascript:void(0)" class="buynow btnim" l_id="<?php echo intval($data->id);?>" st="1" onclick="selectproduct(this)">Buy Now</a>
            <?php }?>


          <?php

          if($data->autoship==1)
          {
          ?>



            <div class="autobill">
            <input value="<?php echo $data->id;?>" type="checkbox" name="ex3_b" class="autoship_chk ck2">
                <label>Autobill</label>
            </div>

              <h3 style="font-size: 16px;color: #000">$49.95 monthly</h3>

    <?php } ?>
            <img src="<?php echo $themeUrl ?>/images/plogo.png" alt="#"  style="display:block; margin:10px auto; width:150px;margin-top: -7px" />

        </div>
        <div class="clear"></div>

</div>
