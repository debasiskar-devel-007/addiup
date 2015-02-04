<?php

$themeUrl = Yii::app()->theme->baseUrl;
if(!isset(Yii::app()->request->cookies['landing_page_id'])){
    Yii::app()->request->cookies['landing_page_id'] = new CHttpCookie('landing_page_id', 1,array('expire'=>time()+2592000));
}

?>
<div class="main-body">
    <div class="top-contain">

        <div class="top-wrapper">
            <h1>#1 Brain Fuel Pill On The Market, Our customers trust <span>AddieUP&trade;</span> as the ultimate Focus and Energy Supplement</h1>

            <div class="logo"><a href="#"><img src="<?php echo $themeUrl ?>/images/logo.png"  alt="#"/></a></div>

        </div>

    </div>

    <div class="clear"></div>

    <div class="top-contain-body">
        <div class="left-text-part">
            <ul>
                <li>Burn Fat</li>
                <li>Supreme Energy</li>
                <li>Appetite Suppressant</li>
                <li>Mental Clarity</li>
                <li>Memory Support</li>
                <li>Powerful Antioxidants</li>

            </ul>


            <div class="clear"></div>
            <div class="arrow-div"><span>CLAIM YOUR FREE BOTTLE TODAY!</span></div>

            <div class="product-box"><img src="<?php echo $themeUrl ?>/images/pro1.png" alt="#" /></div>



        </div>
        <div class="right-form-part">
            <div class="form-top">
                <div class="top-border"></div>

                <h2>GET YOUR</h2>
                <h3>Free Bottle Today!</h3>

            </div>

            <div class="form-left"></div>

            <div class="form-main">


                <?php /** @var TbActiveForm $form */
                $form = $this->beginWidget(
                    'bootstrap.widgets.TbActiveForm',
                    array(
                        'id' => 'horizontalForm',
                        'type' => 'horizontal',
                        'enableClientValidation' =>true,
                    )
                ); ?>

                <?php echo $form->textFieldRow(
                    $model,
                    'fname', array("placeholder"=>"First Name",'class'=>"input1")
                ); ?>

                <?php echo $form->textFieldRow(
                    $model,
                    'lname', array("placeholder"=>"Last Name",'class'=>"input1")
                ); ?>

                <?php echo $form->textFieldRow(
                    $model,
                    'email', array("placeholder"=>"Email Address",'class'=>"input1")
                ); ?>

                <?php echo $form->textFieldRow(
                    $model,
                    'phone', array("placeholder"=>"Phone",'class'=>"input1")
                ); ?>

                <?php echo $form->textFieldRow(
                    $model,
                    'address', array("placeholder"=>"Address",'class'=>"input1")
                ); ?>


                <?php echo $form->textFieldRow(
                    $model,
                    'city', array("placeholder"=>"City",'class'=>"input1")
                ); ?>
                <?php echo $form->dropDownListRow(
                    $model,
                    'state',$this->getStateList(254), array('class'=>"input2")
                ); ?>
                <?php echo $form->textFieldRow(
                    $model,
                    'zip', array("placeholder"=>"Zip Code",'class'=>"input1")
                ); ?>





                <input type="submit"  class="subbtn"  value="Send My Order!"/>

                <?php $this->endWidget(); ?>


            </div>

            <div class="form-right"></div>


            <div class="clear"></div>

            <div class="form-bottom"></div>
            <div class="clear"></div>

        </div>


        <div class="clear"></div>
    </div>



</div>

<div class="div-logo-contain">
    <img src="<?php echo $themeUrl ?>/images/img1.png" alt="#" />
    <img src="<?php echo $themeUrl ?>/images/img2.png" alt="#" />
    <img src="<?php echo $themeUrl ?>/images/img3.png" alt="#" />
    <img src="<?php echo $themeUrl ?>/images/img4.png" alt="#" />
    <img src="<?php echo $themeUrl ?>/images/img5.png" alt="#" />

</div>

<div class="middle-text-contain">
    <h2>Our customers trust AddieUP&trade; as the ultimate Focus and Energy Supplement.</h2>
    <div class="devider2"></div>
    <p>AddieUP&trade; continues to receive phenomenal reviews and testimonials from customers, bloggers, doctors, students and professionals. AddieUPtrade; delivers amazing Energy and Focus supplements with attention support. We use only the highest quality ingredients in our AddieUPtrade; Pills, and offer an unconditional money back guarantee to anyone who isnt completely satisfied with our product.</p>

    <div class="logo2"><img src="<?php echo $themeUrl ?>/images/logo2.png" alt="#" /></div>

</div>


<div class="middle-pro-contain">
    <div class="logo3"><img src="<?php echo $themeUrl ?>/images/text2.png" alt="#" /></div>
    <div class="devider3"></div>


    <div class="left-pro-table">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td class="table1" align="left" valign="top">
                    <div class="logo-div">
                        <img src="<?php echo $themeUrl ?>/images/pt1.png" alt="#" />
                    </div>
                    <ul>
                        <li>NO PRESCRIPTION</li>
                        <li>MPROVES MENTAL CLARITY </li>
                        <li>IMPROVES FOCUS </li>
                        <li>RICH IN ANTIOXIDANTS </li>
                        <li>ENHANCES PHYSICAL ENDURANCE </li>
                        <li>BRAIN PROTECTING INGREDIENTS </li>
                        <li>ESSENTIAL VITAMINS & MINERALS  </li>
                        <li>WONT CAUSE  JITTERS </li>
                        <li>UNCONDITIONAL MONEY-BACK GUARANTEE </li>
                    </ul>

                    <div class="bottom-div">PRICE POINT</div>

                </td>
                <td class="table2" align="center" valign="top">
                    <div class="logo-div">
                        <img src="<?php echo $themeUrl ?>/images/p2.png" alt="#" />
                    </div>
                    <ul>
                        <li><img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li><img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li><img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li><img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li><img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                    </ul>
                    <div class="bottom-div2"><del>$79.95 RETAIL</del>
                        <span>$59.95</span>
                        <strong>LIMITED TIME OFFER</strong> </div>
                </td>
                <td class="table3" align="center" valign="top">

                    <div class="logo-div">
                        <img src="<?php echo $themeUrl ?>/images/p3.png" alt="#" />
                    </div>
                    <ul>

                        <li><img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li>  <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li>  <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li>  <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li><img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li><img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                    </ul>
                    <div class="bottom-div3"><strong>$69.00+</strong>
                        Prescription </div>
                </td>
                <td class="table4" align="center" valign="top">
                    <div class="logo-div">
                        <img src="<?php echo $themeUrl ?>/images/p4.png" alt="#" />
                    </div>
                    <ul>

                        <li> <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li>  <img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/t.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li>  <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li>   <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li>  <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li>  <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/></li>
                        <li> <img src="<?php echo $themeUrl ?>/images/f.png"  alt="#"/>
                    </ul>
                    <div class="bottom-div3"><strong>$80.00+</strong>
                        Prescription</div>
                </td>
            </tr>
        </table>


    </div>

    <div class="product-img"><img src="<?php echo $themeUrl ?>/images/p5.png" alt="#" /></div>

    <div class="right-pro-con">
        <div class="block1">

            <img src="<?php echo $themeUrl ?>/images/rp2.png" />
            <div class="text-div1">
                <h2>YERBA MATE</h2>
                The key benefits of Yerba Mate include increased mental clarity, focus, alertness as well as mood elevation.
            </div>
            <div class="clear"></div>

        </div>

        <div class="blockdevider1"></div>


        <div class="block2">

            <img src="<?php echo $themeUrl ?>/images/rp1.png" />
            <div class="text-div2">
                <h2>Nootropics</h2>
                Nootropics work at improving oxygen supply to the brain and helping to stimulate nerve growth to the brain.
            </div>
            <div class="clear"></div>

        </div>

        <div class="blockdevider2"></div>

        <div class="block3">

            <img src="<?php echo $themeUrl ?>/images/rp3.png" />
            <div class="text-div3">
                <h2>Guarana</h2>
                Guarana has been used by the Amazon Indian Tribes for centuries to gain energy, brain power, and endurance.
            </div>
            <div class="clear"></div>

        </div>
    </div>

    <div class="clear"></div>

</div>

<div class="middle-video-wrapper">


    <div class="video-wrapper">
        <h2>Brain Fuel For Work And School... Addieup&trade;!</h2>
        <div class="video-box">
            <a href="<?php echo $themeUrl ?>/images/a.flv" class="player"  id="player" style="display:block; background:#fff;" >
            
            <img src="<?php echo $themeUrl ?>/images/flowplay-img.png"  alt="Search engine friendly content" />
          
            </a>


            <script language="JavaScript">


                flowplayer("player", "http://releases.flowplayer.org/swf/flowplayer-3.2.18.swf", {
				
                    clip: {
                        // these two configuration variables does the trick
                        autoPlay: true,
                        autoBuffering: true // <- do not place a comma here
                    }
                });


            </script>


        </div>


        <div class="video-text-part">

            <div class="video-left-text">
                <ul>

                    <li>You want to be the most energetic person at your office.</li>
                    <li>You need to EARN a higher G.P.A.</li>
                    <li>You have to GET that promotion at work.</li>
                    <li>You crave a big boost during your workouts to get results.</li>
                    <li>You’d love to have the focus and energy to get your work out
                        of the way to enjoy a more balanced lifestyle.</li>
                </ul>

            </div>

            <div class="video-right-text">
                <h3> Addieup&trade;</h3>

                <p>
                    <strong>AddieUP&trade;</strong> provides Focus Supplements for work and school acting as the perfect study pill. AddieUPtrade; simply outperforms edgy, sugar-saturated energy drinks and shots and lasts for several hours per use. AddieUP&trade; contains stimulants, antioxidants and nootropics.<br />
                    <br />


                    <strong>AddieUP&trade;</strong> is prepared in carefully-measured doses designed to activate synergistically, unlocking your maximum potential so you're able to tirelessly over-perform with focus and concentration.
                    <br />
                    <br />

                    <strong>AddieUP's&trade;</strong> attention support formula for Focus Pills is a well-respected, trusted product with a proven track record of satisfied customers. AddieUP&trade; Focus Supplements are often imitated but never duplicated. We use the highest quality nootropics and natural based stimulants to provided long lasting focus, power, and concentration.
                </p>

            </div>

            <div class="clear"></div>

            <a href="javascript:void(0)" onclick="scrolltoform()" class="buynow">Buy Now</a>

        </div>

    </div>




</div>

<div class="middle-text-body">
    <h3>Brain Fuel For Work And School... Addieup&trade;!</h3>

    <p>Our proprietary formula was developed after a Doctor’s frustration with prescription medications led to the extensive work needed to make the formula that would satisfy the most demanding of consumers. AddieUP&trade; combines stimulants and Nootropics, using the highest quality ingredients in their proper proportion. We use only the finest ingredients in our formula. We know of no other supplement that delivers the focus, attention support energy that AddieUP&trade; Focus Pills provide. We have thousands of satisfied customers that continue to rave about our formula.<br />
        <br />


        The AddieUP&trade; proprietary, trade secret formula contains natural based stimulants, anti-oxidants and nootropics. The ingredients were carefully chosen by a doctor who has had a lifetime of battles with focus and attention.</p>


    <div class="left-contain">
        <img src="<?php echo $themeUrl ?>/images/girl-img.png"  alt="#"/>

        <a href="javascript:void(0)" onclick="scrolltoform()" class="buynow2">Buy Now</a>

        <h4>Here are just a few reasons why our customers love
            AddieUP&trade;:</h4>

        <ul>
            <li>A proven formula with a track record of success. Our customers and independent reviews
                which are all over the internet (just google 'addieup reviews'!) can assist you if you have
                any hesitation about trying AddieUPtrade; Mental Focus Supplements.</li>
            <li>Your purchase is risk-free. We have a 100% unconditional money back guarantee, and to date
                we have had very few customers that have not been satisfied.</li>

            <li>AddieUPtrade; Energy and Focus supplements are manufactured in the US, at a GMP (Good
                Manufacturing Process) facility using the proper combination of high quality ingredients.</li>

        </ul>

    </div>

    <div class="right-contain">
        <div class="text-div">
            <strong>Focus, Energy and Mental Clarity</strong><br />

            There are several ingredients in our AddieUP&trade; Mental Focus Supplements that can help with focus. Yerba Mate and Guarana have been used for centuries by south american native cultures for their stimulating and focusing effect on the brain and body. The derivatives of chocolate found in AddieUP also have mood enhancing and energizing qualities. Our customers report increased mental energy, clarity and focus, without the uncomfortable side effects associated with drinking caffeinated beverages, such as headaches, stomach aches and jitters. AddieUP has the right ingredients in the right amounts. No expense was spared, we wanted the best and most potent ingredients in our formula.
        </div>

        <div class="text-div">
            <strong>Cognitive Function</strong><br />

            There are several ingredients in our AddieUP&trade; Mental Focus Supplements that can help with focus. Yerba Mate and Guarana have been used for centuries by south american native cultures for their stimulating and focusing effect on the brain and body. The derivatives of chocolate found in AddieUP also have mood enhancing and energizing qualities. Our customers report increased mental energy, clarity and focus, without the uncomfortable side effects associated with drinking caffeinated beverages, such as headaches, stomach aches and jitters. AddieUP has the right ingredients in the right amounts. No expense was spared, we wanted the best and most potent ingredients in our formula.
        </div>

        <div class="text-div">
            <strong>Control Your Weight</strong><br />
            The stimulant qualities in AddieUP&trade; Supplements for Focus help you feel full sooner after you begin eating, and it slows your digestion so that your stomach stays full longer. Combining AddieUP&trade; with a healthy diet and regular exercise can help boost your metabolism to burn more calories, and it can help you eat less by curbing your appetite.The chemical compounds and nutrients in AddieUP&trade; affect your metabolism to make your body use carbohydrates more efficiently. This means you'll get more energy from the food you eat. You'll also burn more of the calories your body has stored in fat cells as fuel when you take AddieUP&trade; Supplements for Focus regularly.The native people of South America have long used yerba mate tea as a traditional herbal remedy against digestive ailments. Yerba mate aids digestion by stimulating increased production of bile and other gastric acids. Yerba mate helps keep your colon clean for effective and efficient waste elimination, and helps reduce the stomach bacteria that can contribute to bad breath.
        </div>
    </div>


    <div class="clear"></div>

</div>

<div class="bottom-contain">
    <div class="text-wrapper">
        <h3>AddieUP&trade; has been accepted worldwide</h3>

        <div class="devider3"></div>

        <h4><span>AddieUP&trade;</span> has been accepted worldwide as THE supplement that gives you FOCUSED ATTENTION, memory support, and <span>INCREDIBLE LONG LASTING ENERGY</span>. Thousands of customers from all over the world have discovered the proprietary combination of memory enhancing nootropics and focus ingredients in <span>AddieUP&trade;</span>.</h4>

        <p>Information provided on this site is solely for informational purposes only. It is not a substitute for professional medical advice. Do not use this information for diagnosing or treating a health problem or disease, or prescribing of any medications or supplements. Only your healthcare provider should diagnose your healthcare problems and prescribe treatment. None of our statements or information, including health claims, articles, advertising or product information have been evaluated or approved by the United States Food and Drug Administration (FDA). The products or ingredients referred to on this site are not intended to diagnose, treat, cure or prevent any disease. Please consult your healthcare provider before starting any supplement, diet or exercise program, before taking any medications or receiving treatment, particularly if you are currently under medical care. Make sure you carefully read all product labeling and packaging prior to use. If you have or suspect you may have a health problem, do not take any supplements without first consulting and obtaining the approval of your healthcare provider. Addieup provides goods and services discussed on this website. A friendly reminder that ultimately it is your responsibility to get professional medical advice, and perform your own due diligence before purchasing any consumable product on any website, including AddieUP.com.</p>

        <h5><a href="javascript:void(0)" onclick="scrolltoform()">Get Your Free Bottle Now!</a></h5>


    </div>




</div>
