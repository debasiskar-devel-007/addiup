<?php $themeUrl = Yii::app()->theme->baseUrl;
$last_insert_id =  Yii::app()->session['last_insert_id'];

$price = number_format(floatval(0),2);
$shipping = 0;
$tax = 0;

$errors = $model->geterrors();
$errors = @$errors["product_id"][0];

?>
<style type="text/css">
    .thumbnails{
        margin-left: 0 !important;
        margin-bottom: 0 !important;
    }
</style>
<script type="application/javascript">
    $(function(){

       /* $('.ck1:checkbox').screwDefaultButtons({
            image: 'url("images/checkboxSmall.png")',
            width: 26,
            height: 30
        });

        $('.ck2:checkbox').screwDefaultButtons({
            image: 'url("images/checkboxSmall2.png")',
            width: 15,
            height: 16
        });*/


        $('#TransactionOrderDetails_card_exp_mon').parent().parent('.control-group').css('width','35%');
        $('#TransactionOrderDetails_card_exp_mon').parent().parent('.control-group').css('float','left');
        $('#TransactionOrderDetails_card_exp_mon').parent('.controls').css('width','100%');
        $('#TransactionOrderDetails_card_exp_year').parent().parent('.control-group').css('width','35%');
        $('#TransactionOrderDetails_card_exp_year').parent().parent('.control-group').css('float','left');
        $('#TransactionOrderDetails_card_exp_year').parent('.controls').css('width','100%');
        $('#TransactionOrderDetails_card_cvv').parent().parent('.control-group').css('width','75%');
        $('#TransactionOrderDetails_card_cvv').parent().parent('.control-group').css('float','left');
        $('#TransactionOrderDetails_card_cvv').parent('.controls').css('width','100%');


    if($("#horizontalForm").find('input.error').length >0){
        $('html, body').animate({ scrollTop: $("#horizontalForm").find('input.error:first').offset().top-100 }, 500);
        $('#horizontalForm').find('input.error:first').focus();
        if($("#horizontalForm").find('input[type="hidden"].error').length >0){
            $('#errrrrr').text('<?php echo $errors;?>');
            $('html, body').animate({ scrollTop: $("#errrrrr").offset().top-100 }, 500);
        }
    }else{
        $('html, body').animate({ scrollTop: $("#horizontalForm").offset().top-200 }, 500);
    }

        if($('.err1').text() != ""){
            $('html, body').animate({ scrollTop: $("#TransactionOrderDetails_card_no").offset().top-100 }, 500);
            $('#TransactionOrderDetails_card_no').focus();
        }


       // $('.left-contain').stickyScroll({ container: '.right-contain' })


    });

    function scrolltoform1(){
        $('html, body').animate({ scrollTop: $("#horizontalForm").offset().top-100 }, 500);
        $('#TransactionOrderDetails_shipping_fname').focus();
    }
</script>
<div class="top-header">

    <div class="inner-wrapper">

        <div class="top-logo"><a href="#"><img src="<?php echo $themeUrl ?>/images/logo.png" alt="#" /></a></div>
        <div class="top-text-part">#1 Brain Fuel Pill On The Market, Our customers trust <span>AddieUP&trade;</span> as the ultimate Focus & Energy Supplement</div>

        <div class="clear"></div>
    </div>
</div>


<div class="inner-wrapper">
<div class="order-pro-contain">

       <!-- <div class="top-header">Buy 3 Bottles & Get <span>2 FREE!</span></div>-->
<!--        <div class="leftpro1">

            <input type="checkbox"  class="ck1">

            <img src="<?php /*echo $themeUrl */?>/images/product1.png" alt="#" />

        </div>

        <div class="offerimg"><img src="<?php /*echo $themeUrl */?>/images/free.png"  alt="#"/></div>
        <div class="rightprice1">

            <h2>5 Bottle Mega Plan</h2>
            <h3>$179.85</h3>
            <a href="#" class="buynow">Buy Now</a>
            <img src="<?php /*echo $themeUrl */?>/images/plogo.png" alt="#"  style="display:block; margin:10px auto; width:150px;" />


        </div>
        <div class="clear"></div>-->

        <?php

        $this->widget(
            'bootstrap.widgets.TbThumbnails',
            array(
                'dataProvider' => LandingProductRelation::model()->fetchAllPro($landing_id),
                'template' => "{items}\n{pager}",
                'viewData' => array('l_id'=>$model->product_id),
                'itemView' => 'application.modules.product.views.default.productList',
            )
        );
        ?>





    <div class="purchase-contain">
        <h3>Product Purchase Plan:</h3>

        <div class="purchase-table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" id="itemtbl">
                <tr>
                    <td width="81%" align="left" valign="middle" id="proname">No Product</td>
                       <td width="1%" align="center" valign="middle" style="background:none; box-shadow:none; border:none;">&nbsp;</td>
                    <td width="18%" align="center" valign="middle" id="proprice1">$<span>00.00</span></td>
                 
                </tr>
                <tr>
                    <td width="100%"  colspan="3"align="center" valign="middle" id="proprice">Sub Total : $<span>00.00</span></td>

                </tr>
                <tr>
                    <td width="100%"  colspan="3"align="center" valign="middle" id="proship">Shipping : $<span>00.00</span></td>

                </tr>
                <tr>
                    <td width="100%"  colspan="3"align="center" valign="middle" id="prototal">Total : $<span>00.00</span></td>

                </tr>
            </table>


        </div>

    </div>
    
    
    <div class="new-bottom-block">
      <div class="left-img"><img src="<?php echo $themeUrl ?>/images/safepurchase.png" alt="#" /></div>
      <div class="right-text">Satisfaction Guaranteed! We're so confident that AddieUp will work for you that we are offering a 60-Day Money Back Guarantee*! So feel confident, or you money back!<br />
<br />

<strong>*Excludes Shipping and Handling</strong></div>
          <div class="clear"></div>
    
    </div>

</div>

<div class="order-form-contain">
    <div class="top-devider"></div>
    <h2>PaYMENT INFORMATION</h2>
    <h3>FINAL STEP</h3>

    <strong style="display: block; padding:10px 0 0 15px;">1. Shipping Address</strong>

    <?php /** @var TbActiveForm $form */
    $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id' => 'horizontalForm',
            'type' => 'horizontal',
            'enableClientValidation' =>true,
        )
    ); ?>

    <?php echo $form->hiddenField(
        $model,
        'landing_product_id[]'
    ); ?>

    <?php echo $form->hiddenField(
        $model,
        'product_id[]'
    ); ?>

    <?php echo $form->hiddenField(
        $model,
        'product_name[]'
    ); ?>

    <?php echo $form->hiddenField(
        $model,
        'product_desc'
    ); ?>

    <?php echo $form->hiddenField(
        $model,
        'product_quan[]'
    ); ?>

    <?php echo $form->hiddenField(
        $model,
        'autoship_id[]'
    ); ?>

    <?php echo $form->hiddenField(
        $model,
        'subtotal',array('value'=>$price)
    ); ?>

    <?php echo $form->hiddenField(
        $model,
        'shiping_charge',array('value'=>$shipping)
    ); ?>

    <?php echo $form->hiddenField(
        $model,
        'tax',array('value'=>$tax)
    ); ?>



    <?php echo $form->textFieldRow(
        $model,
        'shipping_fname', array("placeholder"=>"First Name",'class'=>"input1")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'shipping_lname', array("placeholder"=>"Last Name",'class'=>"input1")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'shipping_add', array("placeholder"=>"Address",'class'=>"input1")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'shipping_city', array("placeholder"=>"City",'class'=>"input1")
    ); ?>


    <?php echo $form->dropDownListRow(
        $model,
        'shipping_state',$this->getStateList(254), array('class'=>"input2")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'shipping_zip', array("placeholder"=>"Zip Code",'class'=>"input1")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'shipping_phone', array("placeholder"=>"Phone",'class'=>"input1")
    ); ?>






    <div class="ckbox">
        <input id="chk_bill_ship" type="checkbox" value="" name="">
        Use shipping address as the billing address.
    </div>

    <strong style="display: block; padding:10px 0 0 15px;">2. Billing  Address</strong>


    <?php echo $form->textFieldRow(
        $model,
        'billing_fname', array("placeholder"=>"First Name",'class'=>"input1")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'billing_lname', array("placeholder"=>"Last Name",'class'=>"input1")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'billing_add', array("placeholder"=>"Address",'class'=>"input1")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'billing_city', array("placeholder"=>"City",'class'=>"input1")
    ); ?>


    <?php echo $form->dropDownListRow(
        $model,
        'billing_state',$this->getStateList(254), array('class'=>"input2")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'billing_zip', array("placeholder"=>"Zip Code",'class'=>"input1")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'billing_phone', array("placeholder"=>"Phone",'class'=>"input1")
    ); ?>


    <?php echo $form->textFieldRow(
        $model,
        'billing_email', array("placeholder"=>"Email ID",'class'=>"input1")
    ); ?>


    <strong style="display: block; padding:10px 0 0 15px;">3. Payment Info</strong>

    <span style="color: #71A006;" class="error err1"><?php echo Yii::app()->user->getFlash('msg');?></span>
    <label>Card Number</label>
    <?php echo $form->textFieldRow(
        $model,
        'card_no', array("placeholder"=>"Card Number",'class'=>"input1")
    ); ?>
    <img src="<?php echo $themeUrl;?>/images/f1.png" alt="#" class="visaimg"  />

    <label>Expiration Date</label>
    <div style="margin-left: 10px;">
        <?php echo $form->textFieldRow(
            $model,
            'card_exp_mon', array("placeholder"=>"Card Exp Month",'class'=>"input3")
        ); ?>
        <div class="slimg">/</div>
        <?php echo $form->textFieldRow(
            $model,
            'card_exp_year', array("placeholder"=>"Card Exp Year",'class'=>"input4")
        ); ?>
        <div class="clear"></div>
    </div>
    <label>CVV No</label>
    <?php echo $form->textFieldRow(
        $model,
        'card_cvv', array("placeholder"=>"Card Verification Code",'class'=>"input5")
    ); ?>

    <img src="<?php echo $themeUrl ?>/images/f2.png"  alt="#" style="margin:0px 0 0 10px;"/>
    <div class="clear"></div>

    <!--<input class="check-btn" type="submit" value="Check">-->


    <input type="submit"  class="subbtn1"  value="Send Order"/>


    <div class="bottom-devider"></div>
    <?php $this->endWidget(); ?>
</div>

<div class="clear"></div>
</div>
