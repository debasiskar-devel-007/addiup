<?php

class DefaultController extends MyController
{

    public function init(){
        Yii::app()->theme = 'front';
        $this->pageTitle = "Product";
        Yii::import('application.modules.user.models.UserManager');
        Yii::import('application.modules.gallery.models.Gallery');



    }

    public function actionIndex()
    {

        $this->pageTitle = "Home";

       $model= new UserManager('index');
        if(count($_POST) > 0){

            $model->attributes = $_POST['UserManager'];
            if($model->validate()){
                if(isset(Yii::app()->request->cookies['affliate_id'])){
                    $affiliate_id = Yii::app()->request->cookies['affliate_id'];
                    $model->affiliate_id = (string)$affiliate_id;
                }
                if(isset(Yii::app()->request->cookies['landing_page_id'])){
                    $landing_page_id = Yii::app()->request->cookies['landing_page_id'];
                    $model->landing_page_id = (string)$landing_page_id;
                }
                $model->is_partial =1;
                $model->phone =$_POST['UserManager']['phone'];
                $model->address =$_POST['UserManager']['address'];
                $model->save();
                $insert_id = $model->id;

               Yii::app()->session['last_insert_id'] = $insert_id;
               yii::app()->session['user_id']= $insert_id;

                $this->redirect(Yii::app()->getBaseUrl(true).'/product/default/cart-page');
            }
        }



        $this->render('index',array('model'=>$model));
    }

    public function actioncart_page(){


        $last_insert_id =  Yii::app()->session['last_insert_id'];

        if(intval($last_insert_id) == 0)
            $this->redirect(Yii::app()->getBaseUrl(true));

        $usermodel = new UserManager();
        $res = $usermodel->model()->findAll('id='.$last_insert_id);

        $model= new TransactionOrderDetails();

        $model->shipping_fname = @$res[0]['fname'];
        $model->shipping_lname = @$res[0]['lname'];
        $model->billing_email = @$res[0]['email'];
        $model->shipping_city = @$res[0]['city'];
        $model->shipping_zip = @$res[0]['zip'];
        $model->shipping_state = @$res[0]['state'];
        $model->shipping_add = @$res[0]['address'];
        $model->shipping_phone = @$res[0]['phone'];
        $userlanding=UserManager::model()->findAll('id='.$last_insert_id);
        if(count($_POST) > 0){


            $model->attributes = $_POST['TransactionOrderDetails'];
            if($model->validate()){
                //$model->save();
                $landingmod=new LandingProductRelation();
                $res=$landingmod->checkupsell($userlanding[0]['landing_page_id']);
               if($res==1){

                   $this->redirect(yii::app()->getBaseUrl(true).'/product/default/upsell');
                   exit;

               }

                $this->orders($_POST['TransactionOrderDetails'],$last_insert_id);


            }
        }


        $pro_res = Product::model()->findAll();
        $product_det = @$pro_res[0];


        $this->render('cart_page',array('model'=>$model,'product_det'=>$product_det,'landing_id'=>$userlanding[0]['landing_page_id']));
    }

    public function actionthanks_page(){

        $model= new Product();
        $this->render('thanks_page',array('model'=>$model));
    }


    //This is get State list in coutry wise aray from state table
    public function getStateList($id=0){
        $model = new State();

        $res = $model->findAll('i_cnt_id = '.$id.' order by s_st_name');

        $arr = array();
        $arr[""]="State";
        foreach($res as $row){
            $arr[$row['id']] = $row['s_st_name'];
        }

        return $arr;
    }

    public function getStateCode($id=0){
        $val ="";
        $model = new State();
        $res = $model->findAll('id = '.$id);

        if(count($res)){
            $val = $res[0]['s_st_iso'];
        }
        return $val;
    }



    public function payment($data,$payable_amount){



        require_once(Yii::app()->basePath . '/payment_anet/AuthorizeNet.php');

        //if(!YII_MODE){
            $transaction = new AuthorizeNetAIM('27BKdvPU8h', '6H5Uennu7655d9M9'); // For sandbox account
       // }else{
       //     $transaction = new AuthorizeNetAIM('6L9Fsb5e', '722kf6DqRZ73y9NA');
       // }


        $transaction->amount = number_format($payable_amount,2);
        $transaction->card_num = $data['card_no'];
        $transaction->exp_date = $data['card_exp_mon'].'/'.$data['card_exp_year'];

        $transaction1 = (object)array();
        $transaction1->first_name = $data['billing_fname'];
        $transaction1->last_name = $data['billing_lname'];
        $transaction1->company = "";
        $transaction1->address = $data['billing_add'];
        $transaction1->city = $data['billing_city'];
        $transaction1->state = $this->getStateCode($data['billing_state']);
        $transaction1->zip = $data['billing_zip'];
        $transaction1->country = "US";
        $transaction1->phone = $data['billing_phone'];
        $transaction1->fax = "";
        $transaction1->email = $data['billing_email'];
        $transaction1->ship_to_first_name=$data['shipping_fname'];
        $transaction1->ship_to_last_name=$data['shipping_lname'];
        $transaction1->ship_to_address=$data['shipping_add'];
        $transaction1->ship_to_city=$data['shipping_city'];
        $transaction1->ship_to_state=$this->getStateCode($data['shipping_state']);
        $transaction1->ship_to_zip=$data['shipping_zip'];
        $transaction1->ship_to_country="US";
        $transaction1->tax=$data['tax'];
        $transaction1->email_customer=FALSE;


        $transaction1->customer_ip = $this->getIP();


        $transaction->setFields($transaction1);

        //if(!YII_MODE)
            $transaction->setSandbox(TRUE);
       // else
         //   $transaction->setSandbox(FALSE);

        $response = $transaction->authorizeAndCapture();

        return $response;


    }


    public function autoshippayment($data,$autoship_payable_amount){


       // if(!YII_MODE){
            // For sandbox account
            $loginname="27BKdvPU8h";
            $transactionkey="6H5Uennu7655d9M9";
            $host = "apitest.authorize.net";
            $path = "/xml/v1/request.api";
       // }else{
      //      $loginname="6L9Fsb5e";
      //      $transactionkey="722kf6DqRZ73y9NA";
       //     $host = "api.authorize.net";
       //     $path = "/xml/v1/request.api";
      //  }

        require_once(Yii::app()->basePath . '/payment_anet/authnetfunction.php');

        $total_occ = 24;
        $occ_interval = 1;

        //define variables to send
        $amount = $autoship_payable_amount;
        $refId = "";
        $name = "test";
        $length = $occ_interval;
        $unit = "months";
        $startDate = date('Y-m-d');
        $totalOccurrences = $total_occ;
        $trialOccurrences = 0;
        $trialAmount = 0;
        $cardNumber = $data['card_no'];
        $expirationDate = $data['card_exp_year'].'-'.$data['card_exp_mon'];
        $firstName = "test";
        $lastName = "test";

//build xml to post
        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<ARBCreateSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
            "<merchantAuthentication>".
            "<name>" . $loginname . "</name>".
            "<transactionKey>" . $transactionkey . "</transactionKey>".
            "</merchantAuthentication>".
            "<refId>" . $refId . "</refId>".
            "<subscription>".
            "<name>" . $name . "</name>".
            "<paymentSchedule>".
            "<interval>".
            "<length>". $length ."</length>".
            "<unit>". $unit ."</unit>".
            "</interval>".
            "<startDate>" . $startDate . "</startDate>".
            "<totalOccurrences>". $totalOccurrences . "</totalOccurrences>".
            "<trialOccurrences>". $trialOccurrences . "</trialOccurrences>".
            "</paymentSchedule>".
            "<amount>". $amount ."</amount>".
            "<trialAmount>" . $trialAmount . "</trialAmount>".
            "<payment>".
            "<creditCard>".
            "<cardNumber>" . $cardNumber . "</cardNumber>".
            "<expirationDate>" . $expirationDate . "</expirationDate>".
            "</creditCard>".
            "</payment>".
            "<billTo>".
            "<firstName>". $firstName . "</firstName>".
            "<lastName>" . $lastName . "</lastName>".
            "</billTo>".
            "</subscription>".
            "</ARBCreateSubscriptionRequest>";

        $response = send_request_via_curl($host,$path,$content);

        $res_arr = array();

        if ($response)
        {
            /*
        a number of xml functions exist to parse xml results, but they may or may not be avilable on your system
        please explore using SimpleXML in php 5 or xml parsing functions using the expat library
        in php 4
        parse_return is a function that shows how you can parse though the xml return if these other options are not avilable to you
        */
            list ($refId, $resultCode, $code, $text, $subscriptionId) =parse_return($response);


            $res_arr['response_code'] = $resultCode;
            $res_arr['response_reason_code'] = $code;
            $res_arr['response_text']= $text;
            $res_arr['ref_id'] = $refId;
            $res_arr['subscription_id'] = $subscriptionId;
            $res_arr['amount'] = $amount;
            $res_arr['total_occ'] = $total_occ;
            $res_arr['start_date'] = date('m/d/Y',strtotime("+".$occ_interval." months"));
            $res_arr['sub_interval'] = $occ_interval;
        }


        return $res_arr;
    }

    public function actioncanSubscription(){
        $autoship_id = $_POST['autoship_id'];

        $autoship_det = AutoshipManage::model()->findByPK($autoship_id);
        $subs_id = $autoship_det['autoship_response_code'];
        $subscriptionId = intval($subs_id);

      //  if(!YII_MODE){
            // For sandbox account
            $loginname="27BKdvPU8h";
            $transactionkey="6H5Uennu7655d9M9";
            $host = "apitest.authorize.net";
            $path = "/xml/v1/request.api";
      //  }else{
         //   $loginname="6L9Fsb5e";
        //    $transactionkey="722kf6DqRZ73y9NA";
          //  $host = "api.authorize.net";
         //   $path = "/xml/v1/request.api";
      //  }

        require_once(Yii::app()->basePath . '/payment_anet/authnetfunction.php');

        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>".
            "<ARBCancelSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">".
            "<merchantAuthentication>".
            "<name>" . $loginname . "</name>".
            "<transactionKey>" . $transactionkey . "</transactionKey>".
            "</merchantAuthentication>" .
            "<subscriptionId>" . $subscriptionId . "</subscriptionId>".
            "</ARBCancelSubscriptionRequest>";

//send the xml via curl
        $response = send_request_via_curl($host,$path,$content);
        if ($response)
        {
            AutoshipManage::model()->updateByPk($autoship_id,array('status'=>2,'cancel_date'=>date('m/d/Y')));
        }


    }


    public function getIP(){

        if (!empty($_SERVER['HTTP_CLIENT_IP'])){   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }









    //These are old function


    public function actionlisting(){

      yii::app()->params['pageactive']='home';
        $model= new Product(); 

        $this->render('listing',array('model'=>$model));
    }

    public function actionlisting1(){

        yii::app()->params['pageactive']='productlist';
        $model= new Product();

        $this->render('listingproduct',array('model'=>$model));
    }


    
    public function actionwishlist(){
        $c_url = Yii::app()->request->hostInfo . Yii::app()->request->url;

        $sess = Yii::app()->session['sess_user'];


        if(empty($sess)){
            Yii::app()->session['login_redirect_url'] = $c_url;
            $this->redirect(Yii::app()->getBaseUrl(true).'/login');
        }

        $this->pageTitle = 'Wishlist';
        $model= new Product(); 

        $this->render('wishlist',array('model'=>$model));
    }

    public function actiondetails($id=0,$name="",$catagoryid=0){
        yii::app()->params['pageactive']='productlist';
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('product').'/assets/js/custom.js'), CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('product').'/assets/js/elastislide.js'), CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('product').'/assets/js/imagezoom.js'), CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('product').'/assets/js/details.js'), CClientScript::POS_HEAD);

        $model= new Product();
        $result = $model->fetchSingle($id);
        $cat=new Category();
        $catname=$cat->fetchcatname($catagoryid);
        $catname=$catname[0]['categoryname'];
        $this->pageTitle = $result['productname']." || ".$catname." || products";       
        $result1 = $model->fetchallbycat($id,$catagoryid);
        $model1=new ProductStock();
        $res=$model1->availstock($id);
        //echo "<pre>";
        $st=$res[0]['avail_stock'];
        //echo $st;
        //exit;
      
      
        
        
/*       
        foreach($res as $s)
        {
          $stock[]=$s['stock'];  
            
        }
        
         echo  count($stock);
        exit;*/
       
        $this->render('details',array('result'=>$result,'result1'=>$result1,'st'=>$st));
    }
    
    
        public function actiondetailscat($id=0,$name=""){

      
        $model= new Product();
        //$result = $model->fetchSingle($id);
        $this->pageTitle = $name;       

        $this->render('listing1',array('model'=>$model,'id'=>$id));            
    }
    
    

    public function actionTerms()
    {

        $this->render('termscondition');

    }
    public function actionPolicy()
    {

        $this->render('pol');

    }

    public function actionAboutus()
    {
         $this->pageTitle = "About" ;
        $this->render('about');

    }


    public function actionContactus()
    {

        $this->render('contact');

    }

    public function actionGallery()
    {
        $this->pageTitle = "Gallery";
        $this->render('gal');

    }

    public function actionNews()
    {

        $this->render('news');

    }

    public function actionNews1()
    {

        $this->render('news1');

    }

    public function actionTestimonial()
    {

        $this->render('testimonial');

    }

    //Insert cookie id in Database in per click
    public function set_cookie_perclick($id=0,$page=1){
        $model = new AffiliatePerClick();
        
        $aff_id = (string)$id;
        
        $res = UserManager::model()->fetchdetail($aff_id);
        
        $cpc = $res['cpc'];
        
        
        
        $model->affiliate_code = $aff_id;
        $model->page_id = $page;
        $model->ip_address = Yii::app()->request->getUserHostAddress();
        $model->time = time();
        $model->cpc_rate = $cpc;

        $model->save();
    } 
    
    public function actiondownload_product($id=0){
          $res = DownloadableProduct::model()->findAll('id = '.$id);
          $pro_id = $res[0]['product_id'];
           $validtime = $res[0]['time']+(72*60*60);
           $curtime = time();
          if($validtime > $curtime){
          
          $pro_res = Product::model()->findAll('productid ='.$pro_id);
          $filename = $pro_res[0]['file_name'];
          $origname = $pro_res[0]['original_name'];
          
           $path = Yii::app()->request->hostInfo . Yii::app()->request->baseURL . '/uploads/files/' . $filename;
           return Yii::app()->getRequest()->sendFile($origname, @file_get_contents($path));

          }else{
              echo 1;
          }
    }

    public function actionaddnotify(){
        $model = new NotifyList();
        $res=$model->checknotify($_POST);
        if($res!=0)
        {
            $model->attributes=$_POST;
            $model->time = time();

            $model->save();
        }


    }
    public function actionBill(){
        $tid=$_GET['tran_id'];


        //print_r($_REQUEST);exit;
      // echo yii::app()->session['tran'];


       $this->render('bill',array('tid'=>$tid));


    }

   public function upsell($arr){


        $model=new TransactionOrderDetails();
      $this->render('upsell',array('arr'=>$arr,'model'=>$model));
       exit;

   }
    public function orders($arr,$insertid){
        $usermodel=new UserManager();
        $model= new TransactionOrderDetails();

        $model->attributes = $arr;

        $payable_amount = number_format(floatval($arr['subtotal']+$arr['shiping_charge']+$arr['tax']),2);
        $p_response = $this->payment($arr,$payable_amount);


        if($p_response->approved == 1){
            $userArray['fname']=$arr['shipping_fname'];
            $userArray['lname']=$arr['shipping_lname'];
            $userArray['address']=$arr['shipping_add'];
            $userArray['city']=$arr['shipping_city'];
            $userArray['state']=$arr['shipping_state'];
            $userArray['country']=254;
            $userArray['phone']=$arr['shipping_phone'];
            $userArray['email']=$arr['billing_email'];
            $userArray['is_partial']=0;

            $usermodel->updateByPk($insertid,$userArray);


            $model->transaction_id = $p_response->transaction_id;
            //yii::app()->session['tran']=$model->transaction_id;

            $model->transaction_status = "Success";
            $model->billing_country = "US";
            $model->shipping_country = "US";
            $model->user_id = intval($insertid);
            $model->order_time = $order['time'] = time();
            $model->total = $order['total'] = $payable_amount;
            if(isset(Yii::app()->request->cookies['affliate_id'])){
                $affiliate_id = Yii::app()->request->cookies['affliate_id'];
                $affiliate_id = (string)$affiliate_id;
                $model->affiliate_code = $affiliate_id;
                $aff_det = UserManager::model()->findAll('id='.$affiliate_id);
                $model->cpa_rate = $aff_det[0]['cpa'];
            }
            if(isset(Yii::app()->request->cookies['landing_page_id'])){
                $landing_page_id = Yii::app()->request->cookies['landing_page_id'];
                $model->landing_id = (string)$landing_page_id;
            }

            $model->save();
            $order_id = $order['id'] = $model->orderid;

            $m_pro_dat['order_id'] = $order_id;
            $m_pro_dat['landing_product_id'] = $arr['landing_product_id'];
            $m_pro_dat['product_id'] = $arr['product_id'];
            $m_pro_dat['product_name'] = $arr['product_name'];
            $m_pro_dat['product_desc'] = $arr['product_desc'];
            $m_pro_dat['product_price'] = $arr['subtotal'];
            $m_pro_dat['product_quantity'] = $arr['product_quan'];

            $pro_mod = new TransactionProductDetails();
            $pro_mod->attributes = $m_pro_dat;

            $pro_mod->save();



            if(intval($arr['autoship_id'])){
                $autoship_payable_amount = number_format(floatval($arr['subtotal'])+floatval($arr['shiping_charge']),2);
                $autores = $this->autoshippayment($_POST['TransactionOrderDetails'],$autoship_payable_amount);

                $auto_mod = new AutoshipManage();
                $auto_mod->amount = $autores['amount'];
                $auto_mod->autoship_response_code = $autores['subscription_id'];
                $auto_mod->autoship_response_text = $autores['response_text'];
                $auto_mod->totalOccurrences = $autores['total_occ'];
                $auto_mod->start_date = $autores['start_date'];
                $auto_mod->sub_interval = $autores['sub_interval'];
                $auto_mod->status = 1;
                $auto_mod->transaction_id = $p_response->transaction_id;
                $auto_mod->product_id = $m_pro_dat['landing_product_id'];
                $auto_mod->product_name = $m_pro_dat['product_name'];

                $auto_mod->save();
            }





            $mail = new YiiMailMessage();

            $params              = array('order'=>$order,'order_ship_bill_details'=>$arr,'order_product_details'=>$m_pro_dat,'autoship'=>intval($arr['autoship_id']));

            $mail->view = "orderlist";

            if($arr['billing_email']!='')$mail->addTo($arr['billing_email']);
            $mail->addTo('bhaskar.involutiontech@gmail.com');
            //$mail->from = ('confirmation@goaddieup.com');
            $mail->setFrom('confirmation@goaddieup.com', 'Addieup Orders');
            $mail->setSubject('Transaction Successful');
            $mail->setBody($params, 'text/html');

            //$swiftAttachment = Swift_Attachment::fromPath('./images/pdf/'.$file_name);
            //$mail->attach($swiftAttachment);
            // if(!empty($order_ship_bill_details['billing_email']))
            Yii::app()->mail->send($mail);





            unset(Yii::app()->session['last_insert_id']);
            Yii::app()->request->cookies->clear();
            $this->redirect(Yii::app()->getBaseUrl(true).'/product/default/bill/tran_id/'.$model->transaction_id);

        }else{
            Yii::app()->user->setFlash('msg', $p_response->response_reason_text);
        }
    }
}