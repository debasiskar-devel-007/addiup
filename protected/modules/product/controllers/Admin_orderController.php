<?php

class Admin_orderController extends MyController
{


    public function init()
    {
        yii::app()->theme="admin";//assign theme to this controller



    }

    public function actionIndex()
    {
        $model = new TransactionOrderDetails(); 
        $model->shipping_status = "";
        $model->is_refunded = "";

        if(isset($_GET['TransactionOrderDetails']))
        {
            $model->shipping_status=$_GET['TransactionOrderDetails']['shipping_status'];
            $model->transaction_id=$_GET['TransactionOrderDetails']['transaction_id'];
            $model->affiliatename=$_GET['TransactionOrderDetails']['affiliatename'];
            $model->fullname=$_GET['TransactionOrderDetails']['fullname'];
            $model->landing_id=$_GET['TransactionOrderDetails']['landing_id'];
            $model->is_refunded=$_GET['TransactionOrderDetails']['is_refunded'];
            if(!empty($_GET['TransactionOrderDetails']['fromdate']))
                $model->fromdate = @strtotime(str_replace('-','/',$_GET['TransactionOrderDetails']['fromdate'])." 00:00:00");
            if(!empty($_GET['TransactionOrderDetails']['todate']))
                $model->todate = @strtotime(str_replace('-','/',$_GET['TransactionOrderDetails']['todate']). " 23:59:59");
        }
        
        $ship_status = ShippingStatus::model()->findAll();
        $shiping_status_arr = array();
        foreach($ship_status as $row){
            $shiping_status_arr[$row['shipping_status_id']] = $row['shipping_status_val'];
        }
        
        $this->render('index',array('model'=>$model,'shiping_status_arr'=>$shiping_status_arr));
    }

    public function actionShowbill(){
        $id = $_POST['id']; 
        $model = new TransactionOrderDetails(); 
        $res = $model->fetchbyorder($id);
        $arr = array();
        foreach($res as $row){
            $arr['orderid'] = $row['orderid'];
            $arr['billing_fname'] = $row['billing_fname'];
            $arr['billing_lname'] = $row['billing_lname'];
            $arr['billing_add'] = $row['billing_add'];
            $arr['billing_phone'] = $row['billing_phone'];
            $arr['billing_country'] = "US";
            $arr['billing_email'] = $row['billing_email'];
            $arr['billing_state'] = $this->getStateCode($row['billing_state']);
            $arr['billing_zip'] = $row['billing_zip'];
            $arr['billing_city'] = $row['billing_city'];
            $arr['billing_zip'] = $row['billing_zip'];
        }
        echo json_encode($arr);  
    }

    public function actionShowship(){
        $id = $_POST['id'];
        $model = new TransactionOrderDetails(); 
        $res = $model->fetchbyorder($id);
        $arr = array();
        foreach($res as $row){
            $arr['orderid'] = $row['orderid'];
            $arr['shipping_fname'] = $row['shipping_fname'];
            $arr['shipping_lname'] = $row['shipping_lname'];
            $arr['shipping_add'] = $row['shipping_add'];
            $arr['shipping_phone'] = $row['shipping_phone'];
            $arr['shipping_country'] = "United State";
            $arr['shipping_state'] = $this->getStateCode($row['shipping_state']);
            $arr['shipping_city'] = $row['shipping_city'];
            $arr['shipping_zip'] = $row['shipping_zip'];
        }
        echo json_encode($arr);  
    }

    public function actionShowPro(){
        $id = $_POST['id']; 

        Yii::app()->theme="blank";



        $model = new TransactionOrderDetails();
        $data['model']=$model->fetchprobyorder($id);;
        $this->renderPartial("prolist",$data);

    }
    
    public function actionviewautoshipdet(){
            $id = $_POST['transcation_id']; 

        Yii::app()->theme="blank";  
        


        $data['model']=AutoshipManage::model()->findAll('transaction_id ='.$id);
        $this->render("autoshiplist",$data);

    }

    public function actionEditableSaver(){
        if($_POST['name'] == 'shipping_status'){
            $order_id = $_POST['pk'];
            $res = TransactionOrderDetails::model()->findAll('orderid = '.$order_id);
            $emailid = $res[0]['billing_email'];
            $res1 = ShippingStatus::model()->findAll('shipping_status_id = '.$_POST['value']);
            $shipping_status_val = $res1[0]['shipping_status_val'];

            $mail = new YiiMailMessage();

            $content= "Your order #".str_pad($order_id, 6, "0", STR_PAD_LEFT)." number status has been updated to ".$shipping_status_val." , please <a href=\"".Yii::app()->getBaseUrl(true)."/user/admin/account/order\">click here</a> to review you order status";

            $mail->addTo($emailid);

            $mail->from = ('info@azcowtown.com');
            $mail->setSubject("Notification for Order : #".str_pad($order_id, 6, "0", STR_PAD_LEFT));
            $mail->setBody($content, 'text/html');

            Yii::app()->mail->send($mail);
        }
        TransactionOrderDetails::model()->updateByPk($_POST['pk'],array($_POST['name']=>$_POST['value']));

    }
    
    public function actionduplicatesend(){
        $orderid = $_POST['orderid'];
        $order_ship_bill_details = array();
        $order_product_details = array();
        $autoship = array();
        
        $order_ship_bill = TransactionOrderDetails::model()->findAll('orderid ='.$orderid);
        
        foreach($order_ship_bill as $row){
            $order_ship_bill_details['billing_fname'] = $row['billing_fname'];
            $order_ship_bill_details['billing_lname'] = $row['billing_lname'];
            $order_ship_bill_details['billing_add'] = $row['billing_add'];
            $order_ship_bill_details['billing_phone'] = $row['billing_phone'];
            $order_ship_bill_details['billing_country'] = $row['billing_country'];
            $order_ship_bill_details['billing_email'] = $row['billing_email'];
            $order_ship_bill_details['billing_state'] = $row['billing_state'];
            $order_ship_bill_details['billing_city'] = $row['billing_city'];
            $order_ship_bill_details['billing_zip'] = $row['billing_zip'];
            $order_ship_bill_details['shipping_fname'] = $row['shipping_fname'];
            $order_ship_bill_details['shipping_lname'] = $row['shipping_lname'];
            $order_ship_bill_details['shipping_phone'] = $row['shipping_phone'];
            $order_ship_bill_details['shipping_add'] = $row['shipping_add'];
            $order_ship_bill_details['shipping_country'] = $row['shipping_country'];
            $order_ship_bill_details['shipping_state'] = $row['shipping_state'];
            $order_ship_bill_details['shipping_city'] = $row['shipping_city'];
            $order_ship_bill_details['shipping_zip'] = $row['shipping_zip'];
            $order_ship_bill_details['subtotal'] = $row['subtotal'];
            $order_ship_bill_details['shiping_charge'] = $row['shiping_charge'];
            $order_ship_bill_details['total'] = $row['total'];
            $order_ship_bill_details['order_time'] = $row['order_time'];
            $order_ship_bill_details['transaction_id'] = $row['transaction_id'];
            $order_ship_bill_details['discount_val'] = $row['discount_val'];
        }

        $order_product = TransactionProductDetails::model()->findAll('order_id ='.$orderid);
        $i=0;
        foreach($order_product as $row){
            $order_product_details[$i]['product_name'] = $row['product_name'];
            $order_product_details[$i]['product_quantity'] = $row['product_quantity'];
            $order_product_details[$i]['product_id'] = $row['product_id'];
            $order_product_details[$i]['product_price'] = $row['product_price'];
            $i++;
        }
        
        $autoship_arr = AutoshipManage::model()->findAll('transaction_id = '.$order_ship_bill_details['transaction_id']);
        
        foreach($autoship_arr as $row){
            $autoship[$row['product_id']] = 1;
        }
        
        
        
        
        
        $mail = new YiiMailMessage();

                    $params              = array('orderId'=>$orderid,'order_ship_bill_details'=>$order_ship_bill_details,'order_product_details'=>$order_product_details,'autoship'=>$autoship);

                    $mail->view = "d_orderlist";

                    if($order_ship_bill_details['billing_email']!='')$mail->addTo($order_ship_bill_details['billing_email']);
                    $mail->from = ('orders@valescere.com');
                    $mail->setSubject('Duplicate Bill');
                    $mail->setBody($params, 'text/html');

            Yii::app()->mail->send($mail);
    }
    
    public function actionprintinvoice(){
        $orderid = $_POST['orderid'];
        $order_ship_bill_details = array();
        $order_product_details = array();
        $autoship = array();
        
        $order_ship_bill = TransactionOrderDetails::model()->findAll('orderid ='.$orderid);
        
        foreach($order_ship_bill as $row){
            $order_ship_bill_details['billing_fname'] = $row['billing_fname'];
            $order_ship_bill_details['billing_lname'] = $row['billing_lname'];
            $order_ship_bill_details['billing_add'] = $row['billing_add'];
            $order_ship_bill_details['billing_phone'] = $row['billing_phone'];
            $order_ship_bill_details['billing_country'] = $row['billing_country'];
            $order_ship_bill_details['billing_email'] = $row['billing_email'];
            $order_ship_bill_details['billing_state'] = $row['billing_state'];
            $order_ship_bill_details['billing_city'] = $row['billing_city'];
            $order_ship_bill_details['billing_zip'] = $row['billing_zip'];
            $order_ship_bill_details['shipping_fname'] = $row['shipping_fname'];
            $order_ship_bill_details['shipping_lname'] = $row['shipping_lname'];
            $order_ship_bill_details['shipping_phone'] = $row['shipping_phone'];
            $order_ship_bill_details['shipping_add'] = $row['shipping_add'];
            $order_ship_bill_details['shipping_country'] = $row['shipping_country'];
            $order_ship_bill_details['shipping_state'] = $row['shipping_state'];
            $order_ship_bill_details['shipping_city'] = $row['shipping_city'];
            $order_ship_bill_details['shipping_zip'] = $row['shipping_zip'];
            $order_ship_bill_details['subtotal'] = $row['subtotal'];
            $order_ship_bill_details['shiping_charge'] = $row['shiping_charge'];
            $order_ship_bill_details['total'] = $row['total'];
            $order_ship_bill_details['order_time'] = $row['order_time'];
            $order_ship_bill_details['transaction_id'] = $row['transaction_id'];
            $order_ship_bill_details['discount_val'] = $row['discount_val'];
        }

        $order_product = TransactionProductDetails::model()->findAll('order_id ='.$orderid);
        $i=0;
        foreach($order_product as $row){
            $order_product_details[$i]['product_name'] = $row['product_name'];
            $order_product_details[$i]['product_quantity'] = $row['product_quantity'];
            $order_product_details[$i]['product_id'] = $row['product_id'];
            $order_product_details[$i]['product_price'] = $row['product_price'];
            $i++;
        }
        
        $autoship_arr = AutoshipManage::model()->findAll('transaction_id = '.$order_ship_bill_details['transaction_id']);
        
        foreach($autoship_arr as $row){
            $autoship[$row['product_id']] = 1;
        }
        
        
        $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        $file_name ='invoice-'.$randomString.".pdf";

                    /* This is for creating pdf from a html  */
                    # HTML2PDF has very similar syntax
                    $html2pdf = Yii::app()->ePdf->HTML2PDF();
                    $html2pdf->WriteHTML($this->renderPartial('invoice', array('orderId'=>$orderid,'order_ship_bill_details'=>$order_ship_bill_details,'order_product_details'=>$order_product_details,'autoship'=>$autoship), true)); 
                    //$html2pdf->Output('', EYiiPdf::OUTPUT_TO_STRING);
                    $content_PDF = $html2pdf->Output('./images/pdf/'.$file_name, EYiiPdf::OUTPUT_TO_FILE);
                    echo $file_name;
    }

public function actionautoshipdetupform(){
    $model = new TransactionOrderDetails('payment');
    $this->renderPartial('autoshiplistupdate', array('model'=>$model));
}

public function actionautoshipupdate(){
    
}

    public function getStateCode($id=0){
        $val ="";
        $model = new State();
        $res = $model->findAll('id = '.$id);

        if(count($res)){
            if(!empty($res[0]['s_st_iso']))
                $val = $res[0]['s_st_iso'];
            else
                $val = $res[0]['s_st_name'];
        }
        return $val;
    }

    public function actionExporting()
    {

        $data=$_POST['data'];
        $data1=$_POST['data1'];

        yii::app()->session['data']=$data;
        yii::app()->session['data1']=$data1;


    }


    public function actionexpcsv(){
        $res= yii::app()->session['data'];
        $res1= yii::app()->session['data1'];
        $arr=yii::app()->session['sess_user'];

        $clausestring= '';
        $flag=0;

    CsvExport::export(
        TransactionOrderDetails::model()->findgetval(), // a CActiveRecord array OR any CModel array
            array('fullname'=>array('text'),'transaction_id'=>array('text'),'shiping_charge'=>array('text'),'total'=>array('text'),'date'=>array('text'),'affiliatename'=>array('text'),'landing_name'=>array('text'),'landing_name'=>array('text'),'billing_fname'=>array('text'),'billing_lname'=>array('text'),'billing_add'=>array('text'),'billing_city'=>array('text'),'billing_state'=>array('text'),'billing_country'=>array('text'),'billing_zip'=>array('text'),'billing_phone'=>array('text'),'billing_email'=>array('text'),'shipping_fname'=>array('text'),'shipping_lname'=>array('text'),'shipping_add'=>array('text'),'shipping_city'=>array('text'),'shipping_state'=>array('text'),'shipping_country'=>array('text'),'shipping_zip'=>array('text'),'shipping_phone'=>array('text'),'product_name'=>array('text'),'product_price'=>array('text'),'product_quantity'=>array('text')),
            true, // boolPrintRows
            time().".csv"
    );
}


    public function actionshowRform(){
        $id = $_POST['id'];
        $model = new TransactionOrderDetails('refund');
        $mod= new TransactionProductDetails();
        //$res1=TransactionProductDetails::model()->findAll('orderid = '.$id);

        $res= $model->findAll('orderid = '.$id);
        $data['tran_id'] = $res[0]['transaction_id'];

        $pro=$model->fetchprobyorder($id);

        $prolist = '<option value="">Select Product</option>';

        foreach($pro as $row){


            $card=$row['card_last_four'];
            $cardexpmon=$row['card_exp_month'];
            $cardexpyear=$row['card_exp_year'];
            //$date=$cardexpmon.$cardexpyear;
            //print_r($row);
            $str = 'is_ref="0"';
            if(!empty($row['refund_value'])){
                $str = 'is_ref="1"';
            }

            $prolist .= '<option value="'.$row['product_price'].'" poid="'.$row['id'].'" '.$str.' card_no="'.$card.'" exp_date="'.$cardexpmon.'" exp_year="'.$cardexpyear.'" tran_id="'.$row['transaction_id'].'">'.$row['product_name'].'</option>';
        }

        $data['prolist'] =  $prolist;


        echo json_encode($data);

    }

    public function actionrefund(){





            $login_id = Yii::app()->params['g_loginname'];
            $tran_key = Yii::app()->params['g_transactionkey'];


        $ret = array();
        $model = new TransactionOrderDetails('refund');
        //$this->performAjaxValidation($model,'email-form');
        $model->attributes=$_POST['TransactionOrderDetails'];
        if($model->validate()){


            $card=(base64_decode($_POST['TransactionOrderDetails']['card_no']));
            $mon =  (base64_decode($_POST['TransactionOrderDetails']['card_exp_mon']));
            $year =  (substr(base64_decode($_POST['TransactionOrderDetails']['card_exp_year']),-2));

            //$year = substr($year, -2);

            $date = $mon.$year;

            if(!YII_MODE){
                $post_url = "https://test.authorize.net/gateway/transact.dll";
            }else{
                $post_url = "https://authorize.net/gateway/transact.dll";
            }

            $post_values = array(

                // the API Login ID and Transaction Key must be replaced with valid values
                "x_login"			=> $login_id,
                "x_tran_key"		=> $tran_key,

                "x_version"			=> "3.1",
                "x_delim_data"		=> "TRUE",
                "x_delim_char"		=> "|",
                "x_relay_response"	=> "FALSE",

                "x_type"			=> "CREDIT",
                "x_trans_id"        => $_POST['TransactionOrderDetails']['transaction_id'],
                "x_method"			=> "CC",
                "x_card_num"		=> $card,
                "x_exp_date"		=> $date,

                "x_amount"			=> $_POST['TransactionOrderDetails']['refundvalue'],
                "x_description"		=> "Sample Transaction",


                // Additional fields can be added here as outlined in the AIM integration
                // guide at: http://developer.authorize.net
            );


            $post_string = "";
            foreach( $post_values as $key => $value )
            { $post_string .= "$key=" . urlencode( $value ) . "&"; }
            $post_string = rtrim( $post_string, "& " );


            $request = curl_init($post_url); // initiate curl object
            curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
            curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
            curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
            curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
            $post_response = curl_exec($request); // execute curl post and store results in $post_response
            // additional options may be required depending upon your server configuration
            // you can find documentation on curl options at http://www.php.net/curl_setopt
            curl_close ($request); // close curl object

            $response_array = explode($post_values["x_delim_char"],$post_response);

           // print_r($response_array);

            if($response_array[0] == 1){
                TransactionProductDetails::model()->updateByPk($_POST['poid'],array('refund_value'=>$_POST['TransactionOrderDetails']['refundvalue'],'refund_time'=>time()));


                $_res = TransactionProductDetails::model()->findAll('id='.$_POST['poid']);

                $mail = new YiiMailMessage();

                $sub = "Refund for order #".str_pad($_res[0]['order_id'], 6, "0", STR_PAD_LEFT)." has been initiated";

                $msg = "Refund of amount $".$_POST['TransactionOrderDetails']['refundvalue']." for product ".$_res[0]['product_name']." has been initiated.";

                $_res1 = TransactionOrderDetails::model()->findAll('orderid='.$_res[0]['order_id']);


                $mail->addTo($_res1[0]['billing_email']);
                $mail->setFrom('confirmation@goaddieup.com', 'Addieup Orders');
                $mail->setSubject($sub);
                $mail->setBody($msg, 'text/html');

                //$swiftAttachment = Swift_Attachment::fromPath('./images/pdf/'.$file_name);
                //$mail->attach($swiftAttachment);
                // if(!empty($order_ship_bill_details['billing_email']))
                Yii::app()->mail->send($mail);


            }


            $ret['msg']="success";
            $ret['val'] = $response_array[3];
        }else{
            $ret['msg']="error";
            $ret['val'] = CActiveForm::validate($model);
        }
        echo json_encode($ret);
    }







    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
    // return the filter configuration for this controller, e.g.:
    return array(
    'inlineFilterName',
    array(
    'class'=>'path.to.FilterClass',
    'propertyName'=>'propertyValue',
    ),
    );
    }

    public function actions()
    {
    // return external action classes, e.g.:
    return array(
    'action1'=>'path.to.ActionClass',
    'action2'=>array(
    'class'=>'path.to.AnotherActionClass',
    'propertyName'=>'propertyValue',
    ),
    );
    }
    */
}