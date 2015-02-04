

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo   $this->pageTitle. ' | '.Yii::app()->params['site_url'];  ?></title>





<?php



$themeUrl = Yii::app()->theme->baseUrl;



$cs = Yii::app()->getClientScript();



$cs->registerCSSFile($themeUrl.'/css/animate.css');

$cs->registerCSSFile($themeUrl.'/css/style.css');

$cs->registerCSSFile($themeUrl.'/css/media.css');



$cs->registerCSSFile($themeUrl.'/css/facebox.css');

//$cs->registerScriptFile($themeUrl.'/js/facebox.js',CClientScript::POS_HEAD);



$cs->registerScriptFile($themeUrl.'/js/jquery.screwdefaultbuttonsV2.js',CClientScript::POS_HEAD);

$cs->registerScriptFile($themeUrl.'/js/wow.js',CClientScript::POS_HEAD);

$cs->registerScriptFile($themeUrl.'/js/fp.js',CClientScript::POS_HEAD);



$cs->registerScriptFile($themeUrl.'/js/facebox.js',CClientScript::POS_HEAD);

?>

<style type="text/css">

    @font-face

    {

        font-family:MyriadPro;

        src:url("<?php echo $themeUrl;?>/font/MyriadPro-Semibold.otf");

    }





    @font-face

    {

        font-family:MyriadProCondensed;

        src:url("<?php echo $themeUrl;?>/font/Myriad-Pro-Semibold-Condensed_31644.ttf");

    }





</style>





<script type="text/javascript">







    function scheduled_terms()

    {

        $.facebox($('#scheduledterms').html());

        $("#facebox").css('left','18%');

        $("#facebox .close").css('left','88%');

    }



    function scheduled_policy()

    {

        $.facebox($('#scheduledpolicy').html());

        $("#facebox").css('left','18%');

        $("#facebox .close").css('left','88%');

    }







    function scheduled_contact()

    {

        $.facebox($('#scheduledcontact').html());

        $("#facebox").css('left','18%');

        $("#facebox .close").css('left','88%');

    }



</script>





<script type="text/javascript">



    theme_url = "<?php echo $themeUrl;?>";

    base_url = "<?php echo Yii::app()->getBaseUrl(true);?>";

    asset_url = "<?php echo $this->module->getAssetsUrl();?>";

    var actionid = '<?php echo Yii::app()->controller->action->id; ?>';

    var controllerid = '<?php echo Yii::app()->controller->id; ?>';



    function scheduled_terms()

    {

        $.facebox($('#scheduledterms').html());

        $("#facebox").css('left','18%');

        $("#facebox .close").css('left','88%');

    }



    function scheduled_policy()

    {

        $.facebox($('#scheduledpolicy').html());

        $("#facebox").css('left','18%');

        $("#facebox .close").css('left','88%');

    }



    function scheduled_ingredients ()

    {

        $.facebox($('#scheduledingredients').html());

        $("#facebox").css('left','18%');

        $("#facebox .close").css('left','88%');

    }





    function scheduled_contact()

    {

        $.facebox($('#scheduledcontact').html());

        $("#facebox").css('left','18%');

        $("#facebox .close").css('left','88%');

    }





    function scheduled_return()

    {

        $.facebox($('#scheduledreturn').html());

        $("#facebox").css('left','18%');

        $("#facebox .close").css('left','88%');

    }



</script>





<script type="text/javascript">

    $(function(){





        $('.ck1:checkbox').screwDefaultButtons({

            image: 'url("'+theme_url+'/images/checkboxSmall.png")',

            width: 26,

            height: 30

        });



        $('.ck2:checkbox').screwDefaultButtons({

            image: 'url("'+theme_url+'/images/checkboxSmall2.png")',

            width: 15,

            height: 16

        });



        $('.autoship:checkbox').screwDefaultButtons({

            image: 'url("<?php echo $themeUrl;?>/images/checkboxSmall.jpg")',

            width: 43,

            height: 42

        });







    });

</script>

<script>

    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');



    ga('create', 'UA-54426434-1', 'auto');

    ga('send', 'pageview');



</script>

</head>



<body>











<?php echo $content; ?>









<?php require_once('footer.php'); ?>







</div>





</body>

</html>



















