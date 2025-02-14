<?php

require '../vendor/autoload.php';
include_once ("../inc_config.php");
include "../phpqrcode/qrlib.php";
$filePath="../../pdfFiles/";

use Dompdf\Dompdf;

   $dompdf = new DOMPDF();
   $logo = file_get_contents('../acnt_logo.png');
   $base64 = 'data:image/' . $type . ';base64,' . base64_encode($logo);
   $guid = getGUID();

   //БАТАЛГААЖУУЛАХ КОД
   $verifyCode = date("Ymd").getGUIDVERIFY();

   //тодорхойлолт файлын нэр
   $filename = $guid . '.pdf';
   $filenameQR = $guid . '.png';

   //Тодорхойлолт файл хадгалагдах зам
   $dir=$filePath.$filename;
   
   //Тодорхойлолт файл хадгалагдах зам
   //$dirQR=$filePath.$filenameQR;
   
   $dirQR="../RECOM/files/".$filenameQR;
   
   //QR -д байрлах мэдээлэл
   $url = "https://www.transbank.mn/verify?verifyCode=".$verifyCode;
   QRcode::png($url, $dirQR, "R", 2, 2); 
   $qrFile = file_get_contents($dirQR);
   $qrDir = 'data:image/' . $type . ';base64,' . base64_encode($qrFile);

  /*if(!isset($token)){
  echo "WRONG REQUEST";
  exit;
  }
 
 $ADM_PRIVILEGE="10158012"; //Энд тухайн тайлангийн эрхийн кодыг тогтмол оруулж өгнө.
 $tokenParams = checkPerm($ADM_PRIVILEGE, $token); */
 
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script src="../jquery/external/jquery/jquery.js"></script>
<script src="../jquery/jquery-ui.js"></script>
<link href="../jquery/jquery-ui.css" rel="stylesheet" />
<style>
body {font-size: 12px; font-family: "Times New Roman", Times, serif;}

body {
  background: rgb(204,204,204); 
   }
   page {
     background: white;
     display: block;
     margin: 0 auto;
     margin-bottom: 0.5cm;
     margin-left: 2.5;
     margin-right: 2.5;
   }
   page[size="A4"][layout="landscape"] {
     width: 29.7cm;
     height: 21cm;  
   }
   @media print {
      body * {visibility: hidden; font-family: "Times New Roman", Times, serif;}
      #table_wrapper, #table_wrapper * {
         visibility: visible;
      }
      #table_wrapper {
         position: absolute;
         left: 0;
         top: 0;
         margin-left: +2%;
      }
   }

   @media print {
      body * {visibility: hidden; font-family: "Times New Roman", Times, serif;}
      #table_wrapper1, #table_wrapper1 * {
         visibility: visible;
      }
      #table_wrapper1 {
         position: absolute;
         left: 0;
         top: 0;
         margin-left: +6%;
      }
   }
   #font1 {
   font-family: Times New Roman;
   font-size: 10px;
   }

   #font2 {
      font-family: Times New Roman;
      font-size: 9px;
   }
   #font3 {
      font-family: Times New Roman;
      font-size: 9px;
   }
</style>

</head>
<body>


   <script type="text/javascript">
      $(document).ready(function() {
        $("#btnExport").click(function(e) {
         e.preventDefault();
      
         //getting data from our table
         var data_type = 'data:application/vnd.ms-excel';
         var table_div = document.getElementById('table_wrapper');
         var table_html = table_div.outerHTML.replace(/ /g, '%20');
      
         var a = document.createElement('a');
         a.href = data_type + ', ' + table_html;
         a.download = 'currencyExchangeReport' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
         a.click();
        });
      });
      function checkSubmit(){
         rptcustcode = $('#rptcustcode').val();
         acnt_field = $('#acnt_field').val();
         
         if(rptcustcode=='' && acnt_field==''){
            alert('ИРГЭНИЙ ХАРИЛЦАГЧИЙН ДУГААР ЭСВЭЛ ДАНСНЫ ДУГААР ОРУУЛНА УУ');
            return false;
         }else{
            return true;
         }
         
      }
   
      
   </script>
<script type="text/javascript">
     
     
     function disableButton(){
            document.getElementById("rptSubmit").disabled="disabled";
            document.getElementById("rptSubmit").value="Уншиж байна...";
         }
   </script>
   <script type="text/javascript">
     
     function disableButton1(){
            document.getElementById("rptSubmit1").disabled="disabled";
            document.getElementById("rptSubmit1").value="Уншиж байна...";
         }
   </script>

   <script type="text/javascript">
     
     
     function disableButton2(){

            var array = [];
            var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
            if(checkboxes.length>3){
               alert('3-аас их данс сонгохгүй');
               return false;
            }else{
               document.getElementById("rptSubmit2").disabled="disabled";
               document.getElementById("rptSubmit2").value="Уншиж байна...";
               return true;

            }
         }
   </script>


   <?php 

      $custCode = "";
      $acntType = '';
      $acnt_field = $_POST['acnt_field'];



      if (@$cmd == "gettoData") {
         
         $sql = "SELECT ba.acnt_code,
                        ba.cur_code,
                        ba.prod_type,
                        ba.cust_code
                   FROM tb_test90.bcom_acnt ba
                   left join tb_test90.cif_person cp on cp.cust_code = ba.cust_code
                  WHERE ba.cust_code = '".$rptcustcode."' AND ba.prod_type IN ('CA', 'TD', 'SA')
                        AND ba.status = 'O'
                        AND ba.PROD_CODE NOT IN ('32023212', '221220', '231631')
                        or cp.id_card_no = '".$rptcustcode."' AND ba.prod_type IN ('CA', 'TD', 'SA')
                        AND ba.status = 'O'
                        AND ba.PROD_CODE NOT IN ('32023212', '221220', '231631')
               ORDER BY cur_code, prod_type ASC";

         $rowsAcnt = getArrayDataSql($sql);
         //die(var_dump($rowsAcnt));
         
         $custCode = $rowsAcnt[0]['CUST_CODE'];
         //die(var_dump($custCode));

      }
      ?> 


<?php 

$custCode = "";
$acnt_field = "";
$shortName1 = "";
$shortName2 = "";
$registerCode = "";
$acntCode = '';
$curCode = '';
$curCode1 = '';
$rate = '';
$rate1 = '';
$acntType = '';
$acnt_field = $_POST['acnt_code'];
$acntCnt = $_POST['account_cnt'];
//die(var_dump($acnt_field));

$userId = $_POST['user_id'];

$dirName11 = "";
$dirName22 = "";
$dirshortName11 = "";
$dirshortName22 = "";

$acntList = array();

for($i=0; $i<$acntCnt; $i++){
   if($_POST['acnt_code'][$i]){
      array_push($acntList, $_POST['acnt_code'][$i]);
   }
}
//die(var_dump($acntList));

function array_addstuff($a, $i){
   foreach($a as &$e){
      $e=$i.$e.$i;
   }
   return $a;
}

$acntList = array_addstuff($acntList, "'");
//die(var_dump($acntList));
$acntList = implode(", ", $acntList);
//die($acntList);
$getPurpose = $_POST['purpose'];
//die(var_dump($getPurpose));

if (@$cmdaa == "getaaData") {
   $sql = "SELECT BA.ACNT_CODE, 
                  CP.CUST_CODE,
                  CP.SHORT_NAME,
                  CP.SHORT_NAME2,
                  CP.REGISTER_CODE,
                  CP.ID_CARD_NO,
                  BA.PROD_TYPE ACNT_TYPE 
                  FROM tb_test90.BCOM_ACNT BA 
                  LEFT JOIN tb_test90.CIF_PERSON CP ON CP.CUST_CODE = BA.CUST_CODE
                  LEFT JOIN tb_test90.CASA_ACNT CA ON CA.ACNT_CODE = BA.ACNT_CODE
                  LEFT JOIN tb_test90.CCY_MAIN_RATE CC ON CC.CUR_CODE = CA.CUR_CODE
                  WHERE BA.ACNT_CODE in (".trim($acntList).")";
   //die(var_dump($sql));
   $rowsCustomer = getArrayDataSql($sql);
   //die(var_dump($acnt_field));
   //die(var_dump($rowsCustomer));
   $curquery = "SELECT a.cur_code, max (R.BUY_RATE) as rate
                    FROM tb_test90.BCOM_ACNT a
                    left join tb_test90.CCY_RATE r on r.rate_type_id = 1 and r.cur_code = a.cur_code
                   WHERE A.ACNT_CODE IN (".trim($acntList).")
                   GROUP BY A.CUR_CODE";
   $rowscurquery = getArrayDataSql($curquery);
   //die(var_dump($curquery));
   $emailquery = "SELECT    SUBSTR (trim(ad.LAST_NAME), 1, 1) || '.' || trim(ad.FIRST_NAME) SHORTNAME,
                            GB.BRCH_CODE, 
                            GB.NAME, 
                            GB.NAME2,
                            A.EMAIL
                          FROM tb_test90.ADM_USER A
                          LEFT JOIN tb_test90.GEN_BRANCH_USER G ON G.USER_ID = A.USER_ID
                          LEFT JOIN tb_test90.GEN_BRANCH GB ON GB.BRCH_CODE = G.BRCH_CODE
                          left join tb_test90.adm_user ad on ad.user_id = gb.head_emp_id
                          WHERE A.USER_ID  ='".$userId."'";
   $rowsemailquery = getArrayDataSql($emailquery);
   //die(var_dump($rowsemailquery));


   $dirName11 =  $rowsemailquery[0]['NAME'];
   $dirName22 =  $rowsemailquery[0]['NAME2'];
   $dirshortName11 = $rowsemailquery[0]['SHORTNAME'];

   $custCode = $rowsCustomer[0]['CUST_CODE'];
   $shortName11 = $rowsCustomer[0]['SHORT_NAME'];
   $shortName22 = $rowsCustomer[0]['SHORT_NAME2'];
   $registerCode1 = $rowsCustomer[0]['REGISTER_CODE'];
   $idcardNo1 = $rowsCustomer[0]['ID_CARD_NO'];

}
$firstnamelist = "";
$firstnamelist = '';
$acnt_field = $_POST['acnt_field'];
//die(var_dump($acnt_field));


if (@$cmdname == "getaaDataname") {
    $sqlname = "SELECT acnt_code, cp.register_code, cp.cust_code, upper(trim(substr(cp.last_name,1,1))) ||'.'|| trim(substr(cp.first_name ,1)) as firstname, 'own' as owner
                       from tb_test90.bcom_acnt ba 
                       left join tb_test90.cif_person cp on cp.cust_code = ba.cust_code
                       where ba.acnt_code in ('$acnt_field')
                union all
                select acnt_code, cpp.register_code, cpp.cust_code, upper(trim(substr(cpp.last_name,1,1))) ||'.'|| trim(substr(cpp.first_name ,1)) as firstname, 'co-owner' as owner
                       from tb_test90.bcom_acnt_jholder j
                       left join tb_test90.cif_person cpp on cpp.cust_code = j.cust_code
                       where j.acnt_code in ('$acnt_field')";
    //die(var_dump($sql));
    $sqlnameQuery = getArrayDataSql($sqlname);
    //die(var_dump($sqlnameQuery));


    $firstnamelist =  $sqlnameQuery[0]['FIRSTNAME'];
    $firstnamelist =  $sqlnameQuery[0]['OWNER'];

 }
?>




   <?php 



//die($month0);

      $custCode = "";
      $acnt_field = "";
      $shortName1 = "";
      $shortName2 = "";
      $registerCode = "";
      $acntCode = '';
      $curCode = '';
      $rate2 = '';
      $acntType = '';
      $acnt_field = $_POST['acnt_field'];
      $nameList = $_POST['namelist'];
      $registerlist = $_POST['registerList'];
      $custcodelist = $_POST['custcodelist'];
      //$custcodelists = implode($custcodelist);
      $dirName1 = "";
      $dirName2 = "";
      $dirshortName1 = "";
      $dirshortName2 = "";



      if (@$cmda == "getaData") {
         
         if($acnt_field!=''){
             $sql = "SELECT BA.ACNT_CODE, 
                          CP.CUST_CODE,
                          CP.SHORT_NAME,
                          CP.SHORT_NAME2,
                          CP.REGISTER_CODE,
                          CP.ID_CARD_NO,
                          CA.CUR_CODE,
                          CA.ACNT_TYPE,
                          CC.RATE
                          FROM tb_test90.BCOM_ACNT BA 
                          LEFT JOIN tb_test90.CIF_PERSON CP ON CP.CUST_CODE = BA.CUST_CODE
                          LEFT JOIN tb_test90.CASA_ACNT CA ON CA.ACNT_CODE = BA.ACNT_CODE
                          LEFT JOIN tb_test90.CCY_MAIN_RATE CC ON CC.CUR_CODE = CA.CUR_CODE
                          WHERE BA.ACNT_CODE = '".trim($acnt_field)."' and cp.cust_code = '$custcodelists'
                  union all
                  SELECT BA.ACNT_CODE, 
                          CP.CUST_CODE,
                          CP.SHORT_NAME,
                          CP.SHORT_NAME2,
                          CP.REGISTER_CODE,
                          CP.ID_CARD_NO,
                          CA.CUR_CODE,
                          CA.ACNT_TYPE,
                          CC.RATE
                          FROM tb_test90.BCOM_ACNT_JHOLDER BA 
                          LEFT JOIN tb_test90.CIF_PERSON CP ON CP.CUST_CODE = BA.CUST_CODE
                          LEFT JOIN tb_test90.CASA_ACNT CA ON CA.ACNT_CODE = BA.ACNT_CODE
                          LEFT JOIN tb_test90.CCY_MAIN_RATE CC ON CC.CUR_CODE = CA.CUR_CODE
                          WHERE BA.ACNT_CODE = '".trim($acnt_field)."' and cp.cust_code = '$custcodelists'";
                     }
         //die(var_dump($sql));
         $rowsCustomer = getArrayDataSql($sql);
         //die(var_dump($rowsCustomer));
         if($acnt_field!=''){
             $sqlownerquery = "SELECT ACNT_CODE,
                                     CP.REGISTER_CODE,
                                     CP.CUST_CODE,
                                     CP.ID_CARD_NO,
                                        UPPER (TRIM (SUBSTR (CP.LAST_NAME, 1, 1))) ||'.'|| TRIM (SUBSTR (CP.FIRST_NAME, 1))    AS FIRSTNAME
                                FROM tb_test90.BCOM_ACNT  BA
                                     LEFT JOIN tb_test90.CIF_PERSON CP ON CP.CUST_CODE = BA.CUST_CODE
                               WHERE     BA.ACNT_CODE IN ('".trim($acnt_field)."')
                                     AND CP.CUST_CODE = '$custcodelists'";
                     }
         //die(var_dump($sql));
         $ownerId = getArrayDataSql($sqlownerquery);


         

         $firstnamequery = "select upper(trim(substr(cp.last_name,1,1))) ||'.'|| trim(substr(cp.first_name ,1)) as firstname from tb_test90.cif_person cp where cp.cust_code = '$custcodelists'";
         $firstnamequery = getArrayDataSql($firstnamequery);
         //die(var_dump($firstnamequery));
         $firstNamelast =  $firstnamequery[0]['FIRSTNAME'];
         //die(var_dump($firstNamelast));

         $dirName1 =  $rowsemailquery[0]['NAME'];
         $dirName2 =  $rowsemailquery[0]['NAME2'];
         $dirshortName1 = $rowsemailquery[0]['SHORTNAME'];


         $custCode = $rowsCustomer[0]['CUST_CODE'];
         $shortName1 = $rowsCustomer[0]['SHORT_NAME'];
         $shortName2 = $rowsCustomer[0]['SHORT_NAME2'];
         $registerCode = $rowsCustomer[0]['REGISTER_CODE'];
         $idcardNo = $rowsCustomer[0]['ID_CARD_NO'];
         $acntCode = $rowsCustomer[0]['ACNT_CODE'];
         $curCode2 = $rowsCustomer[0]['CUR_CODE'];
         $rate2 = $rowsCustomer[0]['RATE'];
         $acnt_field = $rowsCustomer[0]['ACNT_CODE'];
         
         //die(var_dump($rowsCustomer));
         //die(var_dump($data1));
         $acntType = '';
         $acntType = $rowsCustomer[0]['ACNT_TYPE'];

//die($acntType);
         $data1 = getAcntStatementDetail($conn, $acnt_field, $acntType);
         //die($data1);
       
       $prod_name = '';
         $prod_name = $data1['PROD_NAME'];
       
         $cramount1 = '';
         $dramount1 = '';
         $cramount1 = $data1['CR1'];
         //die(var_dump($cramount1));
         $dramount1 = $data1['DR1'];

         $cramount2 = '';
         $dramount2 = '';
         $cramount2 = $data1['CR2'];
         $dramount2 = $data1['DR2'];
         //die(var_dump($cramount2));
         
         $cramount3 = '';
         $dramount3 = '';
         $cramount3 = $data1['CR3'];
         $dramount3 = $data1['DR3'];
         //die(var_dump($cramount3));

         
         $cramount4 = '';
         $dramount4 = '';
         $cramount4 = $data1['CR4'];
         $dramount4 = $data1['DR4'];
         //die(var_dump($cramount4));
         
         $cramount5 = '';
         $dramount5 = '';
         $cramount5 = $data1['CR5'];
         $dramount5 = $data1['DR5'];  
         
         $cramount6 = '';
         $dramount6 = '';
         $cramount6 = $data1['CR6'];
         $dramount6 = $data1['DR6'];


         $sumbalance = '';
         $avgbalance = $data1['BALANCE_S'];
         $balance_o = $data1['BALANCE_O'];
         //die(var_dump($balance_s));


         $numsumbal1 = $sum_balance1;
         $numsumbal2 = $sum_balance2;
         $numsumbal3 = $sum_balance3;
         $numsumbal4 = $sum_balance4;
         $numsumbal5 = $sum_balance5;
         $numsumbal6 = $sum_balance6;

         $numbal1 = $balance1;
         $numbal2 = $balance2;
         $numbal3 = $balance3;
         $numbal4 = $balance4;
         $numbal5 = $balance5;
         $numbal6 = $balance6;

            $sumbal = $numbal1 + $numbal2 + $numbal3 + $numbal4 + $numbal5 + $numbal6;
            $sumsbal = $numsumbal1 + $numsumbal2 + $numsumbal3 + $numsumbal4 + $numsumbal5 + $numsumbal6;
            $averagebalance = $sumsbal / $sumbal;

      }
      ?>
   <table width="96%" border="0" align="center">
         <tr>
            <td colspan="7" align="center" style="font-size: 14px;">
               <p>
                  <b>ЭЛЧИН САЙДЫН ЯАМНЫ ХУРААНГУЙ ХУУЛГА</b>
                  <div></div>
               </p>
            </td>
         </tr>
         <tr>
            <td colspan="7" align="center" style="font-size: 12px; color: gray;">
               <div><i>1.Тайлан бэлтгэхдээ харилцагчийн дугаар эсвэл дансны дугаарын аль нэг утгаар хайна.</i></div>
               <div><i>2.Та харилцагчийн дугаараар хайлт хийхэд дээд талдаа 3 дансны хураангуйг харах боломжтой.</i></div>
               <div><i>3.Дансны дугаараар хайлт хийхэд зөвхөн 1 дансны мэдээлэл харуулна.</i></div>
               <div><i>3.Дансны хуулгаар хөрвөдөг хадгаламжийн бүтээгдэхүүн гарахгүй болохыг анхаарна уу.</i></div>
               <hr class="new1">
            </td>
         </tr>
   </table>
   <table width="100%">
      <tr>
         <td>
            <form name="frmReport" id="frmReport" enctype="application/x-www-form-urlencoded" method="post" onsubmit="return checkSubmit()">
               <input type="hidden" name="cmdname" id="cmdname" value="getaaDataname" />
               <table width="44%" border="0" align="right">
                  <tr>
                     <td align="right" style="font-size:12px">Дансны дугаар:</td>
                     <td width="100px" align="center">
                        <input type="text" name="acnt_field" id="acnt_field"  value=""/>
                     </td>
                     <td align=""><label></label> <input type="submit" name="rptSubmit" value="Харах" /></td>
                  </tr>
               </table>
            </form>
         </td>
         <td>
            <form name="frmReport" id="frmReport" enctype="application/x-www-form-urlencoded" method="post" onsubmit="return checkSubmit()">
               <input type="hidden" name="cmd" id="cmd" value="gettoData" />
               <table width="44%" border="0" align="left">
                  <tr>
                     <td align="right" style="font-size:12px">Харилцагчийн дугаар:</td>
                     <td>&nbsp;</td>
                     <td width="100px"><input type="text" name="rptcustcode" id="rptcustcode" value="<?=(@$rptcustcode==""?"":$rptcustcode)?>" /></td>
                     <td><label></label> <input type="submit" id="rptSubmit"  name="rptSubmit" value="Харах" /></td>
                  </tr>
               </table>
            </form>
         </td>
      </tr>
   </table>
   <table width="100%" id="font1">
      <tr>
         <td>
            <form name="acnt_code" method="post" id="frmReport" enctype="application/x-www-form-urlencoded" onsubmit="changeActionURL()">
               <input type="hidden" name="cmda" id="cmda" value="getaData"/>
               <input type="hidden" name="account_cnt" value="<?php echo count($sqlnameQuery); ?>">
               <table width="40%" align="center" style="background-color:#F4F6F6;">
			   <?php if($sqlnameQuery != null){?>
				   <tr>
					  <th colspan="5">
						<label for="acnt_code">Хаана:</label>
						<textarea class="form-control" type="text" id="font1" name="purpose" placeholder="Тайлбар оруулах" style="width:700px; height:80px; border-bottom: none;"></textarea>
					  </th>
				  </tr>
				<?php }?>
                 <?php 
                     foreach($sqlnameQuery as $key=>$row){
                        ?>
                        <tr>
                            <th width="1%"><?php echo $key+1;?></th>
                            <th width="24%" align="left">
                              <input type="radio"  id="custcodelist[<?php echo $key;?>]" name="custcodelist[0]" value="<?php echo $row['CUST_CODE']; ?>">
                              <label for="acnt_code"><?php echo $row['CUST_CODE']; ?></label>
                            </th> 
                            <th width="16%" align="left">
                              <input type="hidden" id="registerList" name="registerList" value="<?php echo $row['FIRSTNAME']; ?>" readonly>
                              <label for="acnt_code"><?php echo $row['FIRSTNAME']; ?></label>
                            </th>
                            <th width="16%" align="left"><label for="acnt_code"><?php echo $row['OWNER']; ?></label></th>
                            <th width="24%" align="left">
                              <input type="hidden" id="acnt_field" name="acnt_field" value="<?php echo $row['ACNT_CODE']; ?>" readonly>
                              <label for="acnt_code"><?php echo $row['ACNT_CODE']; ?></label>
                            </th>
                         </tr>
                      <?php
                  }?>
               <?php if($cmdname){
               ?>
               <table>
                  <tr>
                     <td>
                       <input type="submit" value="Хуулга хаааааааааааааааааааааарах" style="margin-left:1240px"/> 
                     </td>
                  </tr>
               </table>
            <?php 
               }
               ?>
         </form>
         </td>
      </tr>
   </table>
   <table width="100%" id="font1">
      <tr>
         <td>
            <form name="acnt_code" method="post" id="frmReport" enctype="application/x-www-form-urlencoded" onsubmit="changeActionURL()">
               <input type="hidden" name="cmdaa" id="cmdaa" value="getaaData"/>
               <input type="hidden" name="account_cnt" value="<?php echo count($rowsAcnt); ?>">
               <table width="40%" align="center" style="background-color:#F4F6F6;">
			   <?php if($rowsAcnt != null){?>
				   <tr>
					  <th colspan="5" align="left">
						<label for="acnt_code">Хаана:</label>
						<textarea class="form-control" type="text" id="font1" name="purpose" placeholder="Тайлбар оруулах" style="width:700px; height:80px; border-bottom: none;"></textarea>
					  </th>
				  </tr>
				<?php }?>
                 <?php 
                     foreach($rowsAcnt as $key=>$row){
                        ?>
                        <tr>
                            <th width="1%"><?php echo $key+1;?></th>
                            <th width="24%" align="left">
                              <input type="checkbox" id="acnt_code[<?php echo $key;?>]" name="acnt_code[<?php echo $key;?>]" value="<?php echo $row['ACNT_CODE']; ?>">
                              <label for="acnt_code"><?php echo $row['ACNT_CODE']; ?></label>
                            </th>
                            <th width="6%" align="left"><label for="acnt_code"><?php echo $row['CUR_CODE']; ?></label></th>
                            <th width="20%" align="left"><label for="acnt_code"><?php echo $row['PROD_TYPE']; ?></label></th>
                            <th width="24%" align="left">
                              <input hidden id="cust_codeacnt" name="cust_codeacnt" value="<?php echo $row['CUST_CODE']; ?>">
                            </th>
                          </tr>
                      <?php
                  }?>
               </table>
               <?php if($cmd){
               ?>
               <table>
                  <tr>
                     <td>
                       <input type="submit" value="Хуулга харах" style="margin-left:1240px"/> 
                     </td>
                  </tr>
               </table>
            <?php 
               }
               ?>
         </form>
         </td>
      </tr>
   </table>



   <?php 
if($cmda){

   ?>
   <div id="table_wrapper1">
      <page size="A4" layout="landscape">
         <h3 align="left">&nbsp;</h3>
         <table width="96%" border="0" id="font1" align="center">
            <tr>
               <td width="224" align="left" style="margin-left: 20px;"><img src="../acnt_logo.png" height="40" style="opacity:0.6" /></td>
               <td width="369" align="center">&nbsp;</td>
               <td width="176" align="right"><p style="font-size: 10px; color: gray;"></p>
               </td>
            </tr>
            <tr>
               <td>
                  <hr width="346%" size="3px" color="#D49803">
               </td>
            </tr>
         </table>
         <table width="96%" align="center">
            <tr>
               <td width="71%" height="17" align="left" style="font-size:10px">Огноо : <?=date("Y")?> оны <?=date("m")?> -р сарын <?=date("d")?> -ны өдөр</td>
               <td style="font-size: 10px;"><?php echo $getPurpose?></td>
            </tr>
         </table>
         <br>
         <br>
         <table width="96%" align="center">
            <tr>
               <td align="center" style="font-size:10px"><strong>ВИЗ МЭДҮҮЛЭГЧИЙН ДАНСНЫ ХУУЛГЫН ХУРААНГУЙ</strong></td>
            </tr>
            <tr></tr>
            <tr>
               <td style="font-size:10px "><p style="text-align: justify;">&emsp;&emsp;Тээвэр Хөгжлийн Банкны харилцагч <?php echo $firstNamelast?> ( ID: <?php echo $idcardNo?> )-н <?php if($ownerId == null){ echo " хамтран"; } else {echo "";}?>  эзэмшдэг дансны сүүлийн 6 сарын хугацаанд гарсан орлого, зарлагын гүйлгээ, үлдэгдлийн мэдээллийг дараах байдлаар тодорхойлов.  Энэхүү тодорхойлолтыг харилцагчийн хүсэлтээр гаргасан бөгөөд дансны талаар мэдээллийг задруулсантай холбоотойгоор аливаа хариуцлагыг Тээвэр Хөгжлийн Банк нь хүлээхгүй болно. Дансны тодорхойлолт нь зөвхөн тухайн тодорхойлолт гаргасан өдрөөр хүчинтэй байна.</p></td>
            </tr>
         </table>
         <table width="96%" style="border-collapse:collapse" border="1" align="center" id="font3">
            <tr>
               <td rowspan="3" width="6%"><div align="center">Дансны төрөл, дугаар, валют</div></td>
               <td colspan="7" align="center"><span style="align:center">Орлого</span></td>
               <td colspan="7" align="center"><span style="align:center">Зарлага</span></td>
               <td align="center" width="6%"><span style="align:center">Одоогийн үлдэгдэл</span></td>
               <td rowspan="3" align="center"><span style="align:center">Орлоготой харьцуулах зарлагын хувь (%)</span></td>
            </tr>
            <?php 

               $num1 = $cramount1;
               $num2 = $cramount2;
               $num3 = $cramount3;
               $num4 = $cramount4;
               $num5 = $cramount5;
               $num6 = $cramount6;
                  $numbersInSet = 6;
                  $sum = $num1 + $num2 + $num3 + $num4 + $num5 + $num6;
                  $average = $sum / $numbersInSet;


               $numd1 = $dramount1;
               $numd2 = $dramount2;
               $numd3 = $dramount3;
               $numd4 = $dramount4;
               $numd5 = $dramount5;
               $numd6 = $dramount6;
                  $numbersInSetd = 6;
                  $sumd = $numd1 + $numd2 + $numd3 + $numd4 + $numd5 + $numd6;
                  $averaged = $sumd / $numbersInSetd;
                  //die($averaged);
                  

                  $averagem = ($averaged / $average)*100;

               ?>

            <tr>
               <td width="6%" align="center"><span style="align:center">1 сар</span><div  align="center"></td>
               <td width="6%" align="center"><span style="align:center">2 сар</span><div  align="center"></td>
               <td width="6%" align="center"><span style="align:center">3 сар</span><div  align="center"></td>
               <td width="6%" align="center"><span style="align:center">4 сар</span><div  align="center"></td>
               <td width="6%" align="center"><span style="align:center">5 сар</span><div  align="center"></td>
               <td width="6%" align="center"><span style="align:center">6 сар</span><div  align="center"></td>
               <td width="6%" rowspan="2" align="center"><span style="align:center">Сарын дундаж орлого</span></td>
               <td width="6%" align="center"><span style="align:center">1 сар</span><div  align="center"></td>
               <td width="6%" align="center"><span style="align:center">2 сар</span><div  align="center"></td>
               <td width="6%" align="center"><span style="align:center">3 сар</span><div  align="center"></td>
               <td width="6%" align="center"><span style="align:center">4 сар</span><div  align="center"></td>
               <td width="6%" align="center"><span style="align:center">5 сар</span><div  align="center"></td>
               <td width="6%" align="center"><span style="align:center">6 сар</span><div  align="center"></td>
               <td width="6%" rowspan="2" align="center"><span style="align:center">Сарын дундаж зарлага</span></td>
               <td rowspan="2" align="center" width="6%"><span style="align:center">6 сарын өмнөх өдрийн үлдэгдэл</span></td>
            </tr>
            <tr>
               <td colspan="6" align="center"><span style="align:center">Нийт орлого (Сүүлийн 6 сар)</span></td>
               <td colspan="6" align="center"><span style="align:center">Нийт зарлага (Сүүлийн 6 сар)</span></td>
            </tr>
            <tr>
               <td rowspan="2" style="height:30px" align="center"><div><?php echo $prod_name?><br><?php echo $acnt_field ?></div><?php echo $curCode2?></td>
               <td height="20px" align="center"><?php if($cramount1 == null or $cramount1 == '0.00'){ echo "-"; } else { echo number_format("$cramount1",'2');}?></td>
               <td align="center"><?php if($cramount2 == null or $cramount2 == '0.00'){ echo "-"; } else { echo number_format("$cramount2",'2');}?></td>
               <td align="center"><?php if($cramount3 == null or $cramount3 == '0.00'){ echo "-"; } else { echo number_format("$cramount3",'2');}?></td>
               <td align="center"><?php if($cramount4 == null or $cramount4 == '0.00'){ echo "-"; } else { echo number_format("$cramount4",'2');}?></td>
               <td align="center"><?php if($cramount5 == null or $cramount5 == '0.00'){ echo "-"; } else { echo number_format("$cramount5",'2');}?></td>
               <td align="center"><?php if($cramount6 == null or $cramount6 == '0.00'){ echo "-"; } else { echo number_format("$cramount6",'2');}?></td>
               <td rowspan ="2" align="center"><?php if($average == null or $average == '0.00'){ echo "-"; } else { echo number_format("$average",'2');}?></td>
               <td align="center"><?php if($dramount1 == null or $dramount1 == '0.00'){ echo "-"; } else { echo number_format("$dramount1",'2');}?></td>
               <td align="center"><?php if($dramount2 == null or $dramount2 == '0.00'){ echo "-"; } else { echo number_format("$dramount2",'2');}?></td>
               <td align="center"><?php if($dramount3 == null or $dramount3 == '0.00'){ echo "-"; } else { echo number_format("$dramount3",'2');}?></td>
               <td align="center"><?php if($dramount4 == null or $dramount4 == '0.00'){ echo "-"; } else { echo number_format("$dramount4",'2');}?></td>
               <td align="center"><?php if($dramount5 == null or $dramount5 == '0.00'){ echo "-"; } else { echo number_format("$dramount5",'2');}?></td>
               <td align="center"><?php if($dramount6 == null or $dramount6 == '0.00'){ echo "-"; } else { echo number_format("$dramount6",'2');}?></td>
               <td rowspan="2" align="center"><?php if($averaged == null or $averaged == '0.00'){ echo "-"; } else { echo number_format("$averaged",'2');}?></td>
               <td align="center"><?php if($avgbalance == null or $avgbalance == '0.00'){ echo "-"; } else { echo number_format("$avgbalance",'2');}?></td>
               <td align="center"><?php if($averagem == null or $averagem == '0.00'){ echo "-"; } else { echo number_format("$averagem",'2');}?>%</td>
            </tr>
            <tr>
               <td colspan="6" height="20px" align="center"><?php if($sum == null or $sum == '0.00'){ echo "-"; } else { echo number_format("$sum",'2');}?></td>
               <td colspan="6" align="center"><?php if($sumd == null or $sumd == '0.00'){ echo "-"; } else { echo number_format("$sumd",'2');}?></td>
               <td align="center"><?php if($balance_o == null or $balance_o == '0.00'){ echo "-"; } else { echo number_format("$balance_o",'2');}?></td>
               <td></td>
            </tr>
            <tr>
               <td align="center"><span style="align:center">Нийт</span></td>
               <td colspan="6" align="center"><?php if($sum == null  or $sum == '0.00'){ echo "-"; } else { echo number_format("$sum",'2');}?></td>
               <td align="center"><?php if($average == null  or $average == '0.00'){ echo "-"; } else { echo number_format("$average",'2');}?></td>
               <td colspan="6" align="center"><?php if($sumd == null  or $sumd == '0.00'){ echo "-"; } else { echo number_format("$sumd",'2');}?></td>
               <td align="center"><?php if($averaged == null  or $averaged == '0.00'){ echo "-"; } else { echo number_format("$averaged",'2');}?></td>
               <td align="center"><?php if($avgbalance == null  or $avgbalance == '0.00'){ echo "-"; } else { echo number_format("$avgbalance",'2');}?></td>
               <td align="center"><?php if($averagem == null or $averagem == '0.00'){ echo "-"; } else { echo number_format("$averagem",'2');}?>%</td>
            </tr>
         </table>
         <table width="96%" id="font2" style="margin-left:30px; margin-top:2px; margin-bottom: 2px;">
            <tr>
               <td width="96%" style="font-size:10px; font-size:bold">(Монгол банкны валютын албан ханш : <?=date("Y")?> оны <?=date("m")?> сарын <?=date("d")?>).</td>
            </tr> 
         </table>
         <table width="94%" align="center">
            <tr>
               <td  align="left" id="font3" width="1%"><?php echo $key+1;?>.</td>
               <td id="font3" align="left"> 1&nbsp;<?php echo $curCode2?> = <?php echo $rate2?> MNT</td>
            </tr>
         </table>
         <br>
         <table style="margin-left:20px; font-size:10px">
            <tr>
               <td>* Ангилал хэсэгт энгийн харилцах, хугацаагүй хадгаламж, хугацаатай хадгаламж зэргийг тус тус бичнэ<div>- Гэхдээ, Нийт гэдэгт зөвхөн энгийн харилцах дансны хуулгын дүнг бичнэ.</div></td>
            </tr>
         </table>
         <table width="96%" style="margin-left: 20px; border-collapse:collapse; font-size:10px" border="0">
            <tr>
               <td>
                 <table width="100%" style="border-collapse:collapse; font-size:10px" border="1">
                    <tr>
                        <td align="center">˹Дансны хуулгатай холбоотой мэдээлэл˼ олгохыг зөвшөөрөх (Хувийн мэдээлэл цуглуулах зорилгоㆍмэдээлэл өгөхөөс татгалзаж болох мэдэгдэл)</td>
                     </tr>
                     <tr>
                        <td>
                           <div style="text-align:justify;">
                              ￭ Виз мэдүүлэгчийн ˹Дансны хуулгатай холбоотой мэдээлэл˼ нь Визний материал шалгахаас өөр ямар ч зорилгоор ашиглагдахгүй бөгөөд дотоод журмын дагуу тодорхой хугацаанд хадгалагдсаны дараа устгагдах болно.
                           </div>
                           <div style="text-align:justify; margin-top: 4px;">
                              ￭ Хувь хүн хүсвэл мэдээллээ олгохоос татгалзаж болно. Гэхдээ энэ тохиолдолд виз шалгах үйл явц хязгаарлагдах (үнэн зөвийг шалгах), хариуны үр дүнд сөрөг нөлөөтэйг анхааруулж байна.</div>
                           <div style="text-align:justify;">
                              ￭ Иймд өөрийн ˹Дансны хуулгатай холбоотой мэдээлэл˼-ийг өгөхийг зөвшөөрч байна. [Тийм <span><input type="checkbox" name=""></span>Үгүй <span><input type="checkbox" name=""></span>]
                           </div>
                           <div align="right">Виз мэдүүлэгчийн нэр : .................................................../&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/&emsp;</div><br>
                     <div align="right">&emsp;Гарын үсэг&emsp;&emsp;&emsp; </div>
                           <div align="right">Бэлтгэсэн ажилтны нэр : .................................................../&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/&emsp; </div>
                     <div align="right">&emsp;Гарын үсэг, тамга&emsp;&emsp; </div>
                        </td>
                     </tr>
                 </table>
                 <table width="100%" style="border-collapse:collapse; font-size:10px" border="0" >
                     <tr>
                        <td width="74%">
                           <table width="100%" style="margin-top: -20px;">
                              <tr>
                                 <td>
                                   <div><p style="text-align:justify; ">※ Тус маягт нь татварын тодорхойлолт (аж ахуй нэгжийн захирал) болон нийгмийн даатгалын лавлагаа (байгууллагын ажилтан) өгч буй виз мэдүүлэгчийн санхүүгийн чадвар нотлох <p style="margin-left: 12px; margin-top: -10px;">бичиг баримтад тооцогдохгүй.</p></p></div>
                                    <div style="margin-top:-8px;"><p>※ Материал шалгах явцад тус маягтад бичигдсэн үнийн дүнг шалгах зорилгоор <u><b>дансны хуулгыг эх хувиар</b></u> шаардах боломжтой.</p></div>
                                    <div style="margin-top:-8px;"><p>※ Виз мэдүүлэхийн тулд <u><b>түр орлого хийсэн</b></u> тохиолдолд зүй бус гэж үзэн <u><b>визний хариу татгалзах</b></u> боломжтой.</p></div> 
                                 </td>
                              </tr>
                           </table>
                        </td>
                        <td>
                           <table width="100%" style="border-collapse:collapse; height: 80px;" border="0">
                              <tr>
                                 <td>
                                    <table style="border-collapse:collapse; height:80px; margin-top:0px" border="1" width="70px">
                                       <tr>
                                          <td><img src="<?php echo $dirQR?>"></td>
                                       </tr>
                                    </table>
                                 </td>
                                 <td>
                                    <table width="100%" style="margin-top:0px">
                                       <tr>
                                          <td width="100%"><div style="margin-top: 0px;">Тус QR кодыг уншуулан эсвэл дараах</div>
                                                холбоосоор баталгаажуулна уу.
                                              <div>
                                                 <a href="https://transbank.mn/verify">https://transbank.mn/verify
                                              </div>
                                              <div>
                                                 Баталгаажуулах код:<?php echo $verifyCode?>
                                              </div>
                                          </td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                          </table>
                        </td>
                     </tr>
                 </table> 
               </td>
               <td>
                 <table width="5%" style="border-collapse:collapse" border="0">
                    <tr>
                        <td></td>
                     </tr>
                 </table> 
               </td>
            </tr>
         </table>
      </page>
   </div>
   <?php
   $htmlString="<!DOCTYPE html><head>
         <meta charset='utf-8'>
         </head>       
            <style>
               .imageview{
                  width: 300px;
                  } 
               .limage{
                  width: 200px;
                  }
               .title{
                  text-align:center;
                  margin-bottom:5mm;
                  }
                   
               .head{
                       line-height:1mm;
                       font-size: 6px;
                       font-family: DejaVu Sans, Times, serif !important;
                       width: 300px;
                  }
                  
      
                  
               .footer{ 
                       line-height:1mm;
                       font-size: 6px;
                       font-family: DejaVu Sans, Times, serif !important;
                       margin-left:5mm;
                  }
                  
               .purpose{
                  margin-left:17mm;
                  margin-right:5mm;
                  margin-top:5mm;
                  position: absolute;
                  width: 300px;
                  
                  }
                  .qr{
                     margin-top:10mm;
                     }
                  .verify{
                     margin-left:35mm;
                     line-height:2mm;
                     }
                  .footerTitle{
                     
                     border-top: 2px solid #c09155; 
                     width: 100%; 
                     margin-top:5mm;
                     }
                  @page{
                     margin-left: 0px;
                     margin-right: 0px;
                     margin-top: 0px;
                     margin-bottom: 0px;
                  }
                  body{
                       border:none;
                       min-width:10px;
                       font-size: 8px;
                       font-family: DejaVu Sans, Times, serif !important;
                       padding: 5mm 5mm 5mm 5mm; 
                        
                  thead {
                    border: 1px solid #5B5858;
                  }
                  table {
                    border-collapse: collapse;
                    width: 100%;
                  }

           </style>
         <body>";
   $htmlString.='
         <h3 align="left">&nbsp;</h3>
         <table width="100%" border="0" id="font1" align="center">
            <tr>
               <td width="224" align="left" style="margin-left: 20px;"><img src="'.$base64.'" height="40" style="opacity:0.6" /></td>
               <td width="369" align="center">&nbsp;</td>
               <td width="176" align="right"><p style="font-size: 10px; color: gray;"></p>
               </td>
            </tr>
            <tr>
               <td>
                  <hr width="346%" size="3px" color="#D49803">
               </td>
            </tr>
         </table>
         <table width="100%" align="center">
            <tr>
               <td width="72%" height="17" align="left" style="font-size:9px">Огноо : '.date("Y").' оны '.date("m").' -р сарын '.date("d").' -ны өдөр</td>
               <td style="font-size: 9px;">'.$getPurpose.'</td>
            </tr>
         </table>
         <br>
         <br>
         <table width="100%" align="center">
            <tr>
               <td align="center" style="font-size:8px"><strong>ВИЗ МЭДҮҮЛЭГЧИЙН ДАНСНЫ ХУУЛГЫН ХУРААНГУЙ</strong></t
            </tr>
            <tr><td></td></tr>
            <tr>
               <td style="font-size:8px "><p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Тээвэр Хөгжлийн Банкны харилцагч '.$firstNamelast.' (ID: )-н';?>
                      <?php if($ownerId == null){ $htmlString = $htmlString." хамтран "; } else { $htmlString = $htmlString."";}
                  $htmlString = $htmlString.'эзэмшдэг дансны сүүлийн 6 сарын хугацаанд гарсан орлого, зарлагын гүйлгээ, үлдэгдлийн мэдээллийг дараах байдлаар тодорхойлов.  Энэхүү тодорхойлолтыг харилцагчийн хүсэлтээр гаргасан бөгөөд дансны талаар мэдээллийг задруулсантай холбоотойгоор аливаа хариуцлагыг Тээвэр Хөгжлийн Банк нь хүлээхгүй болно. Дансны тодорхойлолт нь зөвхөн тухайн тодорхойлолт гаргасан өдрөөр хүчинтэй байна.</p></td>
            </tr>
         </table>
         <table width="100%" style="border-collapse:collapse" border="1" align="center" id="font3">
            <tr>
               <td rowspan="3" width="6%"><div align="center">Дансны төрөл, дугаар, валют</div></td>
               <td colspan="7" align="center"><span style="align:center">Орлого</span></td>
               <td colspan="7" align="center"><span style="align:center">Зарлага</span></td>
               <td align="center" width="6%"><span style="align:center">Одоогийн үлдэгдэл</span></td>
               <td rowspan="3" align="center"><span style="align:center">Орлоготой харьцуулах зарлагын хувь (%)</span></td>
            </tr>';
            

               $num1 = $cramount1;
               $num2 = $cramount2;
               $num3 = $cramount3;
               $num4 = $cramount4;
               $num5 = $cramount5;
               $num6 = $cramount6;
                  $numbersInSet = 6;
                  $sum = $num1 + $num2 + $num3 + $num4 + $num5 + $num6;
                  $average = $sum / $numbersInSet;


               $numd1 = $dramount1;
               $numd2 = $dramount2;
               $numd3 = $dramount3;
               $numd4 = $dramount4;
               $numd5 = $dramount5;
               $numd6 = $dramount6;
                  $numbersInSetd = 6;
                  $sumd = $numd1 + $numd2 + $numd3 + $numd4 + $numd5 + $numd6;
                  $averaged = $sumd / $numbersInSetd;
                  //die($averaged);
                  

                  $averagem = ($averaged / $average)*100;

               ?>
               <?php 
               $htmlString .= '<tr>
               <td width="6%" align="center"><span style="align:center">1 сар</span></td>
               <td width="6%" align="center"><span style="align:center">2 сар</span></td>
               <td width="6%" align="center"><span style="align:center">3 сар</span></td>
               <td width="6%" align="center"><span style="align:center">4 сар</span></td>
               <td width="6%" align="center"><span style="align:center">5 сар</span></td>
               <td width="6%" align="center"><span style="align:center">6 сар</span></td>
               <td width="6%" rowspan="2" align="center"><span style="align:center">Сарын дундаж орлого</span></td>
               <td width="6%" align="center"><span style="align:center">1 сар</span></td>
               <td width="6%" align="center"><span style="align:center">2 сар</span></td>
               <td width="6%" align="center"><span style="align:center">3 сар</span></td>
               <td width="6%" align="center"><span style="align:center">4 сар</span></td>
               <td width="6%" align="center"><span style="align:center">5 сар</span></td>
               <td width="6%" align="center"><span style="align:center">6 сар</span></td>
               <td width="6%" rowspan="2" align="center"><span style="align:center">Сарын дундаж зарлага</span></td>
               <td rowspan="2" align="center" width="6%"><span style="align:center">6 сарын өмнөх өдрийн үлдэгдэл</span></td>
            </tr>
            <tr>
               <td colspan="6" align="center"><span style="align:center">Нийт орлого (Сүүлийн 6 сар)</span></td>
               <td colspan="6" align="center"><span style="align:center">Нийт зарлага (Сүүлийн 6 сар)</span></td>
            </tr>
            <tr><td rowspan="2" style="height:30px" align="center"><div>'.$prod_name.'<br>'.$acnt_field.'</div>'.$curCode2.'</td><td height="20px" align="center">';
               ?>
            
               
               <?php if($cramount1 == null or $cramount1 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$cramount1",'2');}
                  $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($cramount2 == null or $cramount2 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$cramount2",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($cramount3 == null or $cramount3 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$cramount3",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($cramount4 == null or $cramount4 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$cramount4",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($cramount5 == null or $cramount5 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$cramount5",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($cramount6 == null or $cramount6 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$cramount6",'2');}
               $htmlString = $htmlString.'</td>
               <td rowspan ="2" align="center">';
               ?><?php if($average == null or $average == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$average",'2');
               $htmlString = $htmlString.'</td>
               <td align="center">';
               }?><?php if($dramount1 == null or $dramount1 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$dramount1",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($dramount2 == null or $dramount2 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$dramount2",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($dramount3 == null or $dramount3 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$dramount3",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($dramount4 == null or $dramount4 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$dramount4",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($dramount5 == null or $dramount5 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$dramount5",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($dramount6 == null or $dramount6 == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$dramount6",'2');}
               $htmlString = $htmlString.'</td>
               <td rowspan="2" align="center">';
               ?>
               <?php if($averaged == null or $averaged == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$averaged",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($avgbalance == null or $avgbalance == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$avgbalance",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($averagem == null or $averagem == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$averagem",'2');}
               $htmlString = $htmlString.'%</td>
            </tr>
            <tr>
               <td colspan="6" height="20px" align="center">';
               ?>
               <?php if($sum == null or $sum == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$sum",'2');}
               $htmlString = $htmlString.'</td>
               <td colspan="6" align="center">';
               ?>
               <?php if($sumd == null or $sumd == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$sumd",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($balance_o == null or $balance_o == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$balance_o",'2');}
               $htmlString = $htmlString.'</td>
               <td></td>
            </tr>
            <tr>
               <td align="center"><span style="align:center">Нийт</span></td>
               <td colspan="6" align="center">';
               ?>
               <?php if($sum == null  or $sum == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$sum",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($average == null  or $average == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$average",'2');}
               $htmlString = $htmlString.'</td>
               <td colspan="6" align="center">';
               ?>
               <?php if($sumd == null  or $sumd == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$sumd",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($averaged == null  or $averaged == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$averaged",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($avgbalance == null  or $avgbalance == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$avgbalance",'2');}
               $htmlString = $htmlString.'</td>
               <td align="center">';
               ?>
               <?php if($averagem == null or $averagem == '0.00'){ $htmlString = $htmlString."-"; } else { $htmlString = $htmlString.number_format("$averagem",'2');}
               $htmlString = $htmlString.'%</td>
            </tr>
         </table>
         <table width="100%" id="font2" style="margin-top:2px; margin-bottom: 2px;">';
               ?>
               <?php 
               $htmlString .= '<tr>
               <td width="96%" style="font-size:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Монгол банкны валютын албан ханш : '.date("Y").' оны '.date("m").' сарын '.date("d").').</td>
            </tr> 
         </table>
         <table width="100%" align="center">
            <tr>
               <td  align="left" id="font3" width="1%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($key+1).'.</td>
               <td id="font3" align="left"> 1&nbsp; '.$curCode2.' = '.$rate2.' MNT</td>
            </tr>
         </table>
         <br>
         <table id="font1">
            <tr>
               <td>* Ангилал хэсэгт энгийн харилцах, хугацаагүй хадгаламж, хугацаатай хадагаламж зэргийг тус тус бичнэ<div>- Гэхдээ, Нийт гэдэгт зөвхөн энгийн харилцах дансны хуулгын дүнг бичнэ.</div></td>
            </tr>
         </table>
         <table width="100%" style="border-collapse:collapse"  id="font1">
            <tr>
               <td>
                 <table width="100%" style="border-collapse:collapse" border="1">
                    <tr>
                        <td align="center" style="border-collapse:collapse" border="1">˹Дансны хуулгатай холбоотой мэдээлэл˼ олгохыг зөвшөөрөх (Хувийн мэдээлэл цуглуулах зорилгоㆍмэдээлэл өгөхөөс татгалзаж болох мэдэгдэл)</td>
                     </tr>
                     <tr>
                        <td>
                           <div style="text-align:justify;">
                              * Виз мэдүүлэгчийн ˹Дансны хуулгатай холбоотой мэдээлэл˼ нь Визний материал шалгахаас өөр ямар ч зорилгоор ашиглагдахгүй бөгөөд дотоод журмын дагуу тодорхой хугацаанд хадгалагдсаны дараа устгагдах болно.
                           </div>
                           <div style="text-align:justify; margin-top: 4px;">
                              * Хувь хүн хүсвэл мэдээллээ олгохоос татгалзаж болно. Гэхдээ энэ тохиолдолд виз шалгах үйл явц хязгаарлагдах (үнэн зөвийг шалгах), хариуны үр дүнд сөрөг нөлөөтэйг анхааруулж байна.</div>
                           <div style="text-align:justify;">
                              * Иймд өөрийн ˹Дансны хуулгатай холбоотой мэдээлэл˼-ийг өгөхийг зөвшөөрч байна. [Тийм <span><input type="checkbox" name=""></span>Үгүй <span><input type="checkbox" name=""></span>]
                           </div>
                           <div align="right">Виз мэдүүлэгчийн нэр : .................................................../&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>
                     <div align="right">&emsp;Гарын үсэг&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div>
                           <div align="right">Бэлтгэсэн ажилтны нэр : .................................................../&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                     <div align="right">&emsp;Гарын үсэг, тамга&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div>
                        </td>
                     </tr>
                 </table>
                 <table width="100%" style="border-collapse:collapse;" border="0" >
                     <tr>
                        <td width="75%">
                           <table width="100%">
                              <tr>
                                 <td>
                                   <div><p >※ Тус маягт нь татварын тодорхойлолт (аж ахуй нэгжийн захирал) болон нийгмийн даатгалын лавлагаа (байгууллагын ажилтан) өгч буй виз мэдүүлэгчийн санхүүгийн чадвар нотлох бичиг баримтад тооцогдохгүй.</p></div> 
                                   <div><p style=" ">※ Материал шалгах явцад тус маягтад бичигдсэн үнийн дүнг шалгах зорилгоор <u><b>дансны хуулгыг эх хувиар</b></u> шаардах боломжтой.
                                   <div><p style="">※ Виз мэдүүлэхийн тулд <u><b>түр орлого хийсэн</b></u> тохиолдолд зүй бус гэж үзэн <u><b>визний хариу татгалзах</b></u> боломжтой.</p></div>
                                   </div>
                                   <div><p style="color:red">&emsp;</p></div>
                                   <div><p style="color:red">&emsp;</p></div>
                                   </div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                        <td style="border-bottom-color: yellow;">
                          <table width="100%" style="border-collapse:collapse; height: 120px; font-size:8px" border="0">
                     <tr>
                        <td>
                           <table style="border-collapse:collapse; height:80px; width:80px; margin-top:0px" border="1">
                              <tr>
                                 <td><img src="'.$qrDir.'">
                                 </td>
                              </tr>
                           </table>
                        </td>
                        <td>
                           <table width="100%" style="margin-top:0px">
                              <tr>
                                 <td width="100%"><div style="margin-top: 0px;">
                                        Тус QR кодыг уншуулан эсвэл дараах холбоосоор баталгаажуулна уу.
                                     </div>
                                     <div>
                                        <a href="https://transbank.mn/verify">https://transbank.mn/verify
                                     </div>
                                     <div>
                                         Баталгаажуулах код:'.$verifyCode.'
                                     </div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                 </table>
                        </td>
                     </tr>
                 </table> 
               </td>
            </tr>
         </table>
   </div>';
   $htmlString.='</body>
      </html>';
            

QRcode::png($url, $dirQR, "R", 2, 2);

$dompdf->load_html($htmlString, 'UTF-8');
$dompdf->set_paper("a4", "landscape");
$dompdf->set_option('isHtml5ParserEnabled', TRUE);

$dompdf->render();

//$dompdf->stream($dir, array("Attachment"=>0));
$output = $dompdf->output();
file_put_contents($dir, $output);

$content = $htmlString;
$fp = fopen($filePath."myText.html","wb");
fwrite($fp,$content);
fclose($fp);


 $sqlInsertAccrecom = "INSERT INTO eoffice.accrecom (id,accnumber, email,username,recom_date,recom_url,verifycode,recomnumber, recom_type, language_type, ORGANIZATION,FILENAME) VALUES (EOFFICE.ACCRECOM_SEQ.nextval,'$acnt_field','','', sysdate, '$url', '$verifyCode',lpad(eoffice.RECOM_NUMBER_SEQ.nextval,10,'0'), 1,'0', 'Солонгос элчин','$filename' )";
    if(queryExec($sqlInsertAccrecom, $PROGRAMID, $PAGENAME, $cmd)!="S"){
       echo $errorMsg =$sqlInsertAccrecom;
       writeErrorLogPrograms($LOG_PATH."RECOM",$PROGRAMID, $PAGENAME, "ERROR", "$errorMsg sqlInsertAccrecom= $sqlInsertAccrecom");
       exit;
    }


 ?>


   
   
   



   
   
   <?php
   }

   ?>

   <?php if($cmda){
      ?>
       <table width="88%">
         <tr>
            <td>
               <div align="right">
                  <button onclick="window.print()" class="btn btn-primary">Хэвлэх</button>
               </div>
            </td>
         </tr>
      </table>
   <?php 
      }
      ?>




<?php if($cmdaa){



 ?>

<div id="table_wrapper">
      <page size="A4" layout="landscape">
         <h3 align="left">&nbsp;</h3>
         <table width="96%" border="0" id="font1" align="center">
            <tr>
               <td width="224" align="left" style="margin-left: 20px;"><img src="../acnt_logo.png" height="40" style="opacity:0.6" /></td>
               <td width="369" align="center">&nbsp;</td>
               <td width="176" align="right"><p style="font-size: 10px; color: gray;"></p>
               </td>
            </tr>
            <tr>
               <td>
                  <hr width="346%" size="3px" color="#D49803" >
               </td>
            </tr>
         </table>
         <table width="96%" align="center" id="font1">
            <tr>
               <td width="71%" height="17" align="left" style="font-size:10px">Огноо : <?=date("Y")?> оны <?=date("m")?> -р сарын <?=date("d")?> -ны өдөр</td>
               <td style="font-size: 10px;"><?php echo $getPurpose?></td>
            </tr>
         </table>
         <br>
         <br>
         <table width="96%" align="center" style="margin-top:-10px" id="font1">
            <tr>
               <td align="center" style="font-size:10px"><strong>ВИЗ МЭДҮҮЛЭГЧИЙН ДАНСНЫ ХУУЛГЫН ХУРААНГУЙ</strong></td>
            </tr>
            <tr></tr>
            <tr>
               <td style="font-size:11px" class="p"><p style="text-align: justify;">&emsp;&emsp;Тээвэр Хөгжлийн Банкны харилцагч <?php echo $shortName11?> ( ID:<?php echo $idcardNo1?> ) -н дансны сүүлийн 6 сарын хугацаанд гарсан орлого, зарлагын гүйлгээ, үлдэгдлийн мэдээллийг дараах байдлаар тодорхойлов.  Энэхүү тодорхойлолтыг харилцагчийн хүсэлтээр гаргасан бөгөөд дансны талаар мэдээллийг задруулсантай холбоотойгоор аливаа хариуцлагыг Тээвэр Хөгжлийн Банк нь хүлээхгүй болно. Дансны тодорхойлолт нь зөвхөн тухайн тодорхойлолт гаргасан өдрөөр хүчинтэй байна.</p></td>
            </tr>
         </table>
         <table width="96%" style="border-collapse:collapse" border="1" align="center" id="font2">
            <tr>
               <td rowspan="3" width="6%"><div align="center">Дансны төрөл, дугаар, валют</div></td>
               <td colspan="7" align="center"><span style="align:center">Орлого</span></td>
               <td colspan="7" align="center"><span style="align:center">Зарлага</span></td>
               <td align="center" width="6%" style="height:30px"><span style="align:center">Одоогийн үлдэгдэл</span></td>
               <td rowspan="3" align="center"><span style="align:center">Орлоготой харьцуулах зарлагын хувь (%)</span></td>
            </tr>
            <?php 

               

               ?>
            <tr>
               <td width="6%" align="center" id="font2"><span style="align:center">1 сар</span></td>
               <td width="6%" align="center"><span style="align:center">2 сар</span></td>
               <td width="6%" align="center"><span style="align:center">3 сар</span></td>
               <td width="6%" align="center"><span style="align:center">4 сар</span></td>
               <td width="6%" align="center"><span style="align:center">5 сар</span></td>
               <td width="6%" align="center"><span style="align:center">6 сар</span></td>
               <td width="6%" rowspan="2" align="center"><span style="align:center">Сарын дундаж орлого</span></td>
               <td width="6%" align="center" id="font2"><span style="align:center">1 сар</span></td>
               <td width="6%" align="center"><span style="align:center">2 сар</span></td>
               <td width="6%" align="center"><span style="align:center">3 сар</span></td>
               <td width="6%" align="center"><span style="align:center">4 сар</span></td>
               <td width="6%" align="center"><span style="align:center">5 сар</span></td>
               <td width="6%" align="center"><span style="align:center">6 сар</span></td>
               <td width="6%" rowspan="2" align="center"><span style="align:center">Сарын дундаж зарлага</span></td>
               <td rowspan="2" align="center" width="6%"><span style="align:center">6 сарын өмнөх өдрийн үлдэгдэл</span></div>
            </tr>
            <tr>
               <td colspan="6" align="center"><span style="align:center">Нийт орлого (Сүүлийн 6 сар)</span></td>
               <td colspan="6" align="center"><span style="align:center">Нийт зарлага (Сүүлийн 6 сар)</span></td>
            </tr>
       <?php 
       
       $sumAvgIN = 0;
       $sumAvgOUT = 0;
       $sumIN = 0;
       $sumOUT = 0;
       $sumBAL = 0;
       $sumPER = 0;

   foreach($rowsCustomer as $key=>$row){

      $acntCode = $row['ACNT_CODE'];
      $acnt_field = $row['ACNT_CODE'];
      $curCode1 = $row['CUR_CODE'];
      $rate1 = $row['RATE'];
      //die(var_dump($curCode));


      

   
   //die(var_dump($data6));
   $acntType = '';
   $acntType = $row['ACNT_TYPE'];
   //die($acntType);
   $data1 = getAcntStatementDetail($conn, $acnt_field, $acntType);
   //die(var_dump($data1));// cif-er
   
   $prod_name2 = '';
   $prod_name2 = $data1['PROD_NAME'];
   
   $curCode = '';
   $curCode = $data1['CUR_CODE'];

   $rate1 = '';
   $rate1 = $data1['RATE'];
   //die(var_dump($rate1));
   //die(var_dump($rate));

   $cramount1 = '';
   $dramount1 = '';
   $cramount1 = $data1['CR1'];
   //die(var_dump($cramount1));
   $dramount1 = $data1['DR1'];

   $cramount2 = '';
   $dramount2 = '';
   $cramount2 = $data1['CR2'];
   $dramount2 = $data1['DR2'];
   //die(var_dump($cramount2));
   
   $cramount3 = '';
   $dramount3 = '';
   $cramount3 = $data1['CR3'];
   $dramount3 = $data1['DR3'];
   
   $cramount4 = '';
   $dramount4 = '';
   $cramount4 = $data1['CR4'];
   $dramount4 = $data1['DR4'];
   
   $cramount5 = '';
   $dramount5 = '';
   $cramount5 = $data1['CR5'];
   $dramount5 = $data1['DR5'];  
   
   $cramount6 = '';
   $dramount6 = '';
   $cramount6 = $data1['CR6'];
   $dramount6 = $data1['DR6'];


   $sumbalance = '';
   $avgbalance = $data1['BALANCE_S'];
   $balance_o = $data1['BALANCE_O'];

      $num1 = $cramount1;
      $num2 = $cramount2;
      $num3 = $cramount3;
      $num4 = $cramount4;
      $num5 = $cramount5;
      $num6 = $cramount6;

         $numbersInSet = 6;
         $suma = $num1 + $num2 + $num3 + $num4 + $num5 + $num6;
         $average = $suma / $numbersInSet;

         $sumIN = $sumIN+$suma;
         $sumAvgIN = $sumAvgIN+$average;
         //die(var_dump($sumIN));


      $numd1 = $dramount1;
      $numd2 = $dramount2;
      $numd3 = $dramount3;
      $numd4 = $dramount4;
      $numd5 = $dramount5;
      $numd6 = $dramount6;
      $numbersInSetd = 6;

         $sumd = $numd1 + $numd2 + $numd3 + $numd4 + $numd5 + $numd6;
         $averaged = $sumd / $numbersInSetd;
         $averagem = ($averaged / $average)*100;

         $sumOUT = $sumOUT+$sumd;
         $sumAvgOUT = $sumAvgOUT+$averaged;

      
         $sumBAL = $sumBAL+$avgbalance;
         $sumPER = $sumPER + $averagem;

    ?>
            <tr>
               <td rowspan="2" style="height:30px" align="center"><div><?php echo $prod_name2?><br><?php echo $acnt_field ?></div><?php echo $curCode?></td>
               <td height="20px" align="center"><?php if($cramount1 == null or $cramount1 == '0.00'){ echo "-"; } else { echo number_format("$cramount1",'2');}?></td>
               <td align="center"><?php if($cramount2 == null or $cramount2 == '0.00'){ echo "-"; } else { echo number_format("$cramount2",'2');}?></td>
               <td align="center"><?php if($cramount3 == null or $cramount3 == '0.00'){ echo "-"; } else { echo number_format("$cramount3",'2');}?></td>
               <td align="center"><?php if($cramount4 == null or $cramount4 == '0.00'){ echo "-"; } else { echo number_format("$cramount4",'2');}?></td>
               <td align="center"><?php if($cramount5 == null or $cramount5 == '0.00'){ echo "-"; } else { echo number_format("$cramount5",'2');}?></td>
               <td align="center"><?php if($cramount6 == null or $cramount6 == '0.00'){ echo "-"; } else { echo number_format("$cramount6",'2');}?></td>
               <td rowspan="2" align="center" id="average" name="average"><?php if($average == null or $average == '0.00'){ echo "-"; } else { echo number_format("$average",'2');}?></td>
               <td align="center"><?php if($dramount1 == null or $dramount1 == '0.00'){ echo "-"; } else { echo number_format("$dramount1",'2');}?></td>
               <td align="center"><?php if($dramount2 == null or $dramount2 == '0.00'){ echo "-"; } else { echo number_format("$dramount2",'2');}?></td>
               <td align="center"><?php if($dramount3 == null or $dramount3 == '0.00'){ echo "-"; } else { echo number_format("$dramount3",'2');}?></td>
               <td align="center"><?php if($dramount4 == null or $dramount4 == '0.00'){ echo "-"; } else { echo number_format("$dramount4",'2');}?></td>
               <td align="center"><?php if($dramount5 == null or $dramount5 == '0.00'){ echo "-"; } else { echo number_format("$dramount5",'2');}?></td>
               <td align="center"><?php if($dramount6 == null or $dramount6 == '0.00'){ echo "-"; } else { echo number_format("$dramount6",'2');}?></td>
               <td rowspan="2" align="center" id="averaged" ><?php if($averaged == null or $averaged == '0.00'){ echo "-"; } else { echo number_format("$averaged",'2');}?></td>
               <td align="center"><?php if($avgbalance == null or $avgbalance == '0.00'){ echo "-"; } else { echo number_format("$avgbalance",'2');}?></td>
               <td align="center"><?php if($averagem == null or $averagem == '0.00'){ echo "-"; } else { echo number_format("$averagem",'2');}?>%</td>
            </tr>
            <tr>
               <td colspan="6" height="20px" align="center"><?php if($suma == null or $suma == '0.00'){ echo "-"; } else { echo number_format("$suma",'2');}?></td>
               <td colspan="6" align="center"><?php if($sumd == null or $sumd == '0.00'){ echo "-"; } else { echo number_format("$sumd",'2');}?></td>
               <td align="center"><?php if($balance_o == null or $balance_o == '0.00'){ echo "-"; } else { echo number_format("$balance_o",'2');}?></td>
               <td></td>
            </tr>

            <?php
      }

      ?>
           
            <tr>
               <td align="center"><span style="align:center">Нийт</span><div  align="center"></td>
               <td colspan="6" align="center"><?php if($sumIN == null or $sumIN == '0.00'){ echo "-"; } else { echo number_format("$sumIN",'2');}?></td>
               <td align="center"><?php if($sumAvgIN == null or $sumAvgIN == '0.00'){ echo "-"; } else { echo number_format("$sumAvgIN",'2');}?></td>
               <td colspan="6" align="center"><?php if($sumOUT == null or $sumOUT == '0.00'){ echo "-"; } else { echo number_format("$sumOUT",'2');}?></td>
               <td align="center"><?php if($sumAvgOUT == null or $sumAvgOUT == '0.00'){ echo "-"; } else { echo number_format("$sumAvgOUT",'2');}?></td>
               <td align="center"><?php if($sumBAL == null or $sumBAL == '0.00'){ echo "-"; } else { echo number_format("$sumBAL",'2');}?></td>
               <td align="center"><?php if($sumPER == null or $sumPER == '0.00'){ echo "-"; } else { echo number_format("$sumPER",'2');}?></td>
            </tr>
         </table>
         <table width="96%" id="font2" style="margin-left:30px; margin-top:2px; margin-bottom: 2px;">
            <tr>
               <td width="96%" style="font-size:10px; font-size:bold">(Монгол банкны валютын албан ханш : <?=date("Y")?> оны <?=date("m")?> сарын <?=date("d")?>).</td>
            </tr> 
         </table>
         <table width="94%" align="center">
            <?php 
               foreach($rowscurquery as $key=>$row){
                  $acntCode = $row['ACNT_CODE'];
                  $acnt_field = $row['ACNT_CODE'];

                     $curCode = $row['CUR_CODE'];
                     $rate1 = $row['RATE'];
                  ?>
                  <tr>
                     <td  align="left" id="font3" width="1%"><?php echo $key+1;?>.</td>
                     <td id="font3" align="left"> 1&nbsp;<?php echo $curCode?> = <?php echo $rate1?> MNT</td>
                  </tr>
               <?php
            }

            ?>
         </table>
         <table style="margin-left:20px; font-size:10px">
            <tr>
               <td>* Ангилал хэсэгт энгийн харилцах, хугацаагүй хадгаламж, хугацаатай хадагаламж зэргийг тус тус бичнэ<div>- Гэхдээ, Нийт гэдэгт зөвхөн энгийн харилцах дансны хуулгын дүнг бичнэ.</div></td>
            </tr>
         </table>
         <table width="96%" style="margin-left: 20px; border-collapse:collapse; font-size:10px" border="0">
            <tr>
               <td>
                 <table width="100%" style="border-collapse:collapse; font-size:10px" border="1">
                    <tr>
                        <td align="center">˹Дансны хуулгатай холбоотой мэдээлэл˼ олгохыг зөвшөөрөх (Хувийн мэдээлэл цуглуулах зорилгоㆍмэдээлэл өгөхөөс татгалзаж болох мэдэгдэл)</td>
                     </tr>
                     <tr>
                        <td>
                           <div style="text-align:justify;">
                              ￭ Виз мэдүүлэгчийн ˹Дансны хуулгатай холбоотой мэдээлэл˼ нь Визний материал шалгахаас өөр ямар ч зорилгоор ашиглагдахгүй бөгөөд дотоод журмын дагуу тодорхой хугацаанд хадгалагдсаны дараа устгагдах болно.
                           </div>
                           <div style="text-align:justify; margin-top: 4px;">
                              ￭ Хувь хүн хүсвэл мэдээллээ олгохоос татгалзаж болно. Гэхдээ энэ тохиолдолд виз шалгах үйл явц хязгаарлагдах (үнэн зөвийг шалгах), хариуны үр дүнд сөрөг нөлөөтэйг анхааруулж байна.</div>
                           <div style="text-align:justify;">
                              ￭ Иймд өөрийн ˹Дансны хуулгатай холбоотой мэдээлэл˼-ийг өгөхийг зөвшөөрч байна. [Тийм <span><input type="checkbox" name=""></span>Үгүй <span><input type="checkbox" name=""></span>]
                           </div>
                           <div align="right">Виз мэдүүлэгчийн нэр : .................................................../&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/&emsp;</div><br>
                           <div align="right">&emsp;Гарын үсэг&emsp;&emsp;&emsp; </div>
                     <div align="right">Бэлтгэсэн ажилтны нэр : .................................................../&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;/&emsp;</div><br>
                           <div align="right">&emsp;Гарын үсэг, тамга&emsp;&emsp; </div>
                        </td>
                     </tr>
                 </table>
                 <table width="100%" style="border-collapse:collapse;" border="0" >
                     <tr>
                        <td width="74%">
                           <table width="100%" style="margin-top: -20px;">
                              <tr>
                                 <td>
                                   <div><p style="text-align:justify; ">※ Тус маягт нь татварын тодорхойлолт (аж ахуй нэгжийн захирал) болон нийгмийн даатгалын лавлагаа (байгууллагын ажилтан) өгч буй виз мэдүүлэгчийн санхүүгийн чадвар нотлох <p style="margin-left: 12px; margin-top: -10px;">бичиг баримтад тооцогдохгүй.</p></p></div>
                                    <div style="margin-top:-8px;"><p>※ Материал шалгах явцад тус маягтад бичигдсэн үнийн дүнг шалгах зорилгоор <u><b>дансны хуулгыг эх хувиар</b></u> шаардах боломжтой.</p></div>
                                    <div style="margin-top:-8px;"><p>※ Виз мэдүүлэхийн тулд <u><b>түр орлого хийсэн</b></u> тохиолдолд зүй бус гэж үзэн <u><b>визний хариу татгалзах</b></u> боломжтой.</p></div> 
                                 </td>
                              </tr>
                           </table>
                        </td>
                        <td>
                           <table width="100%" style="border-collapse:collapse; height: 80px;" border="0">
                              <tr>
                                 <td>
                                    <table style="border-collapse:collapse; height:80px; margin-top:0px" border="1" width="70px">
                                       <tr>
                                          <td><img src="<?php echo $dirQR?>"></td>
                                       </tr>
                                    </table>
                                 </td>
                                 <td>
                                    <table width="100%" style="margin-top:0px">
                                       <tr>
                                          <td width="100%"><div style="margin-top: 0px;">Тус QR кодыг уншуулан эсвэл дараах</div>
                                                холбоосоор баталгаажуулна уу.
                                              <div>
                                                 <a href="https://transbank.mn/verify">https://transbank.mn/verify
                                              </div>
                                              <div>
                                                 Баталгаажуулах код:<?php echo $verifyCode?>
                                              </div>
                                          </td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                          </table>
                        </td>
                     </tr>
                 </table> 
               </td>
               <td>
                 <table width="5%" style="border-collapse:collapse" border="0">
                    <tr>
                        <td></td>
                     </tr>
                 </table> 
               </td>
            </tr>
         </table>
      </page>
   </div>

<?php
   
   $htmlCustString="<!DOCTYPE html><head>
         <meta charset='utf-8'>
         </head>       
            <style>
               .imageview{
                  width: 300px;
                  } 
               .limage{
                  width: 200px;
                  }
               .title{
                  text-align:center;
                  margin-bottom:5mm;
                  }
                   
               .head{
                       line-height:1mm;
                       font-size: 6px;
                       font-family: DejaVu Sans, Times, serif !important;
                       width: 300px;
                  }
                  
      
                  
               .footer{ 
                       line-height:1mm;
                       font-size: 6px;
                       font-family: DejaVu Sans, Times, serif !important;
                       margin-left:5mm;
                  }
                  
               .purpose{
                  margin-left:17mm;
                  margin-right:5mm;
                  margin-top:5mm;
                  position: absolute;
                  width: 300px;
                  
                  }
                  .qr{
                     margin-top:10mm;
                     }
                  .verify{
                     margin-left:35mm;
                     line-height:2mm;
                     }
                  .footerTitle{
                     
                     border-top: 2px solid #c09155; 
                     width: 100%; 
                     margin-top:5mm;
                     }
                  @page{
                     margin-left: 0px;
                     margin-right: 0px;
                     margin-top: 0px;
                     margin-bottom: 0px;
                  }
                  body{
                       border:none;
                       min-width:10px;
                       font-size: 8px;
                       font-family: DejaVu Sans, Times, serif !important;
                       padding: 5mm 5mm 5mm 5mm; 
                        
                  thead {
                    border: 1px solid #5B5858;
                  }
                  table {
                    border-collapse: collapse;
                    width: 100%;
                  }

           </style>
         <body>";
   $htmlCustString.='
         <h3 align="left">&nbsp;</h3>
         <table width="96%" border="0" id="font1" align="center">
            <tr>
               <td width="224" align="left" style="margin-left: 20px;"><img src="'.$base64.'" height="40" style="opacity:0.6" /></td>
               <td width="369" align="center">&nbsp;</td>
               <td width="176" align="right"><p style="font-size: 10px; color: gray;"></p>
               </td>
            </tr>
            <tr>
               <td>
                  <hr width="346%" size="3px" color="#D49803" >
               </td>
            </tr>
         </table>
         <table width="100%" align="center" id="font1">
            <tr>
               <td width="72%" height="17" align="left" style="font-size:9px">Огноо : '.date("Y").' оны '.date("m").' -р сарын '.date("d").' -ны өдөр</td>
               <td style="font-size: 9px;">'.$getPurpose.'</td>
            </tr>
         </table>
         <br>
         <br>
         <table width="100%" align="center">
            <tr>
               <td align="center" style="font-size:8px"><strong>ВИЗ МЭДҮҮЛЭГЧИЙН ДАНСНЫ ХУУЛГЫН ХУРААНГУЙ</strong></td>
            </tr>
            <tr><td></td></tr>
            <tr>
               <td style="font-size:8px" class="p"><p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Тээвэр Хөгжлийн Банкны харилцагч (ID: '.$idcardNo1.')';?>
               <?php
               $htmlCustString.='-н дансны сүүлийн 6 сарын хугацаанд гарсан орлого, зарлагын гүйлгээ, үлдэгдлийн мэдээллийг дараах байдлаар тодорхойлов.  Энэхүү тодорхойлолтыг харилцагчийн хүсэлтээр гаргасан бөгөөд дансны талаар мэдээллийг задруулсантай холбоотойгоор аливаа хариуцлагыг Тээвэр Хөгжлийн Банк нь хүлээхгүй болно. Дансны тодорхойлолт нь зөвхөн тухайн тодорхойлолт гаргасан өдрөөр хүчинтэй байна.</p></td>
            </tr>
         </table>
         <table width="100%" style="border-collapse:collapse" border="1" align="center" id="font2">
            <tr>
               <td rowspan="3" width="6%"><div align="center">Дансны төрөл, дугаар, валют</div></td>
               <td colspan="7" align="center"><span style="align:center">Орлого</span></td>
               <td colspan="7" align="center"><span style="align:center">Зарлага</span></td>
               <td align="center" width="6%" style="height:30px"><span style="align:center">Одоогийн үлдэгдэл</span></td>
               <td rowspan="3" align="center"><span style="align:center">Орлоготой харьцуулах зарлагын хувь (%)</span></td>
            </tr>
            <tr>
               <td width="6%" align="center" id="font2"><span style="align:center">1 сар</span></td>
               <td width="6%" align="center"><span style="align:center">2 сар</span></td>
               <td width="6%" align="center"><span style="align:center">3 сар</span></td>
               <td width="6%" align="center"><span style="align:center">4 сар</span></td>
               <td width="6%" align="center"><span style="align:center">5 сар</span></td>
               <td width="6%" align="center"><span style="align:center">6 сар</span></td>
               <td width="6%" rowspan="2" align="center"><span style="align:center">Сарын дундаж орлого</span></td>
               <td width="6%" align="center" id="font2"><span style="align:center">1 сар</span></td>
               <td width="6%" align="center"><span style="align:center">2 сар</span></td>
               <td width="6%" align="center"><span style="align:center">3 сар</span></td>
               <td width="6%" align="center"><span style="align:center">4 сар</span></td>
               <td width="6%" align="center"><span style="align:center">5 сар</span></td>
               <td width="6%" align="center"><span style="align:center">6 сар</span></td>
               <td width="6%" rowspan="2" align="center"><span style="align:center">Сарын дундаж зарлага</span></td>
               <td rowspan="2" align="center" width="6%"><span style="align:center">6 сарын өмнөх өдрийн үлдэгдэл</span></div>
            </tr>
            <tr>
               <td colspan="6" align="center"><span style="align:center">Нийт орлого (Сүүлийн 6 сар)</span></td>
               <td colspan="6" align="center"><span style="align:center">Нийт зарлага (Сүүлийн 6 сар)</span></td>
            </tr>';
       
       $sumAvgIN = 0;
       $sumAvgOUT = 0;
       $sumIN = 0;
       $sumOUT = 0;
       $sumBAL = 0;
       $sumPER = 0;

   foreach($rowsCustomer as $key=>$row){

      $acntCode = $row['ACNT_CODE'];
      $acnt_field = $row['ACNT_CODE'];
      $curCode1 = $row['CUR_CODE'];
      $rate1 = $row['RATE'];
      //die(var_dump($curCode));


      

   
   //die(var_dump($data6));
   $acntType = '';
   $acntType = $row['ACNT_TYPE'];
   //die($acntType);
   $data1 = getAcntStatementDetail($conn, $acnt_field, $acntType);
   //die(var_dump($data1));// cif-er
   
   $prod_name2 = '';
   $prod_name2 = $data1['PROD_NAME'];
   
   $curCode = '';
   $curCode = $data1['CUR_CODE'];

   $rate1 = '';
   $rate1 = $data1['RATE'];
   //die(var_dump($rate1));
   //die(var_dump($rate));

   $cramount1 = '';
   $dramount1 = '';
   $cramount1 = $data1['CR1'];
   //die(var_dump($cramount1));
   $dramount1 = $data1['DR1'];

   $cramount2 = '';
   $dramount2 = '';
   $cramount2 = $data1['CR2'];
   $dramount2 = $data1['DR2'];
   //die(var_dump($cramount2));
   
   $cramount3 = '';
   $dramount3 = '';
   $cramount3 = $data1['CR3'];
   $dramount3 = $data1['DR3'];
   
   $cramount4 = '';
   $dramount4 = '';
   $cramount4 = $data1['CR4'];
   $dramount4 = $data1['DR4'];
   
   $cramount5 = '';
   $dramount5 = '';
   $cramount5 = $data1['CR5'];
   $dramount5 = $data1['DR5'];  
   
   $cramount6 = '';
   $dramount6 = '';
   $cramount6 = $data1['CR6'];
   $dramount6 = $data1['DR6'];


   $sumbalance = '';
   $avgbalance = $data1['BALANCE_S'];
   $balance_o = $data1['BALANCE_O'];

      $num1 = $cramount1;
      $num2 = $cramount2;
      $num3 = $cramount3;
      $num4 = $cramount4;
      $num5 = $cramount5;
      $num6 = $cramount6;

         $numbersInSet = 6;
         $suma = $num1 + $num2 + $num3 + $num4 + $num5 + $num6;
         $average = $suma / $numbersInSet;

         $sumIN = $sumIN+$suma;
         $sumAvgIN = $sumAvgIN+$average;
         //die(var_dump($sumIN));


      $numd1 = $dramount1;
      $numd2 = $dramount2;
      $numd3 = $dramount3;
      $numd4 = $dramount4;
      $numd5 = $dramount5;
      $numd6 = $dramount6;
      $numbersInSetd = 6;

         $sumd = $numd1 + $numd2 + $numd3 + $numd4 + $numd5 + $numd6;
         $averaged = $sumd / $numbersInSetd;
         $averagem = ($averaged / $average)*100;

         $sumOUT = $sumOUT+$sumd;
         $sumAvgOUT = $sumAvgOUT+$averaged;

      
         $sumBAL = $sumBAL+$avgbalance;
         $sumPER = $sumPER + $averagem;

            ?>
            <?php
            $htmlCustString.='<tr>
               <td rowspan="2" style="height:30px" align="center"><div>'.$prod_name2.'<br>'.$acnt_field.'</div>'.$curCode.'</td>
               <td height="20px" align="center">';
               ?>

               <?php 
               if($cramount1 == null or $cramount1 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$cramount1",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php 
               if($cramount2 == null or $cramount2 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$cramount2",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($cramount3 == null or $cramount3 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$cramount3",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($cramount4 == null or $cramount4 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$cramount4",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($cramount5 == null or $cramount5 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$cramount5",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($cramount6 == null or $cramount6 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$cramount6",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td rowspan="2" align="center" id="average" name="average">';
               ?>
               <?php if($average == null or $average == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$average",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($dramount1 == null or $dramount1 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$dramount1",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($dramount2 == null or $dramount2 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$dramount2",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($dramount3 == null or $dramount3 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$dramount3",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($dramount4 == null or $dramount4 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$dramount4",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($dramount5 == null or $dramount5 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$dramount5",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($dramount6 == null or $dramount6 == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$dramount6",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td rowspan="2" align="center" id="averaged" >';
               ?>
               <?php if($averaged == null or $averaged == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$averaged",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($avgbalance == null or $avgbalance == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$avgbalance",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($averagem == null or $averagem == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$averagem",'2');}
               $htmlCustString.='%</td>
            </tr>
            <tr>
               <td colspan="6" height="20px" align="center">';
               ?>
               <?php if($suma == null or $suma == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$suma",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td colspan="6" align="center">';
               ?>
               <?php if($sumd == null or $sumd == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$sumd",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($balance_o == null or $balance_o == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$balance_o",'2');}
               $htmlCustString.='</td>
               <td></td>
            </tr>';
         }

         ?>
            <?php 
            $htmlCustString.='      
            <tr>
               <td align="center"><span style="align:center">Нийт</span><div  align="center"></td>
               <td colspan="6" align="center">';
               ?>
               <?php if($sumIN == null or $sumIN == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$sumIN",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($sumAvgIN == null or $sumAvgIN == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$sumAvgIN",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td colspan="6" align="center">';
               ?>
               <?php if($sumOUT == null or $sumOUT == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$sumOUT",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($sumAvgOUT == null or $sumAvgOUT == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$sumAvgOUT",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($sumBAL == null or $sumBAL == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$sumBAL",'2');}
               ?>
               <?php 
               $htmlCustString.='</td>
               <td align="center">';
               ?>
               <?php if($sumPER == null or $sumPER == '0.00'){ $htmlCustString.="-"; } else { $htmlCustString.=number_format("$sumPER",'2');}
               $htmlCustString.='</td>
            </tr>
         </table>
         <table width="100%" id="font2" style="margin-top:2px; margin-bottom: 2px;">
            <tr>
               <td width="96%" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Монгол банкны валютын албан ханш : '.date("Y").' оны '.date("m").' сарын '.date("d").').</td>
            </tr> 
         </table>
         <table width="96%" align="center">';

               foreach($rowscurquery as $key=>$row){
                  $acntCode = $row['ACNT_CODE'];
                  $acnt_field = $row['ACNT_CODE'];

                     $curCode = $row['CUR_CODE'];
                     $rate1 = $row['RATE'];
                  
                  $htmlCustString.='
                  <tr>
                     <td  align="left" id="font3" width="1%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.($key+1).'.</td>
                     <td id="font3" align="left"> 1&nbsp;'.$curCode.' = '.$rate1.' MNT</td>
                  </tr>';
               }
         
         $htmlCustString.='
         </table>
         <table style="" id="font1">
            <tr>
               <td>* Ангилал хэсэгт энгийн харилцах, хугацаагүй хадгаламж, хугацаатай хадагаламж зэргийг тус тус бичнэ<div>- Гэхдээ, Нийт гэдэгт зөвхөн энгийн харилцах дансны хуулгын дүнг бичнэ.</div></td>
            </tr>
         </table>
         <table width="100%" style="margin-left: 0px; border-collapse:collapse"  id="font1">
            <tr>
               <td>
                 <table width="100%" style="border-collapse:collapse" border="1">
                    <tr>
                        <td align="center" style="border-collapse:collapse" border="1">˹Дансны хуулгатай холбоотой мэдээлэл˼ олгохыг зөвшөөрөх (Хувийн мэдээлэл цуглуулах зорилгоㆍмэдээлэл өгөхөөс татгалзаж болох мэдэгдэл)</td>
                     </tr>
                     <tr>
                        <td>
                           <div style="text-align:justify;">
                              * Виз мэдүүлэгчийн ˹Дансны хуулгатай холбоотой мэдээлэл˼ нь Визний материал шалгахаас өөр ямар ч зорилгоор ашиглагдахгүй бөгөөд дотоод журмын дагуу тодорхой хугацаанд хадгалагдсаны дараа устгагдах болно.
                           </div>
                           <div style="text-align:justify; margin-top: 4px;">
                              * Хувь хүн хүсвэл мэдээллээ олгохоос татгалзаж болно. Гэхдээ энэ тохиолдолд виз шалгах үйл явц хязгаарлагдах (үнэн зөвийг шалгах), хариуны үр дүнд сөрөг нөлөөтэйг анхааруулж байна.</div>
                           <div style="text-align:justify;">
                              * Иймд өөрийн ˹Дансны хуулгатай холбоотой мэдээлэл˼-ийг өгөхийг зөвшөөрч байна. [Тийм <span><input type="checkbox" name=""></span>Үгүй <span><input type="checkbox" name=""></span>]
                           </div>
                           <div align="right">Виз мэдүүлэгчийн нэр : .................................................../&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>
                     <div align="right">&emsp;Гарын үсэг&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div>
                           <div align="right">Бэлтгэсэн ажилтны нэр : .................................................../&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                     <div align="right">&emsp;Гарын үсэг, тамга&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div>
                        </td>
                     </tr>
                 </table>
                 <table width="100%" style="border-collapse:collapse;" border="0" >
                     <tr>
                        <td width="75%">
                           <table width="100%">
                              <tr>
                                 <td>
                                   <div><p >※ Тус маягт нь татварын тодорхойлолт (аж ахуй нэгжийн захирал) болон нийгмийн даатгалын лавлагаа (байгууллагын ажилтан) өгч буй виз мэдүүлэгчийн санхүүгийн чадвар нотлох бичиг баримтад тооцогдохгүй.</p></div> 
                                   <div><p style=" ">※ Материал шалгах явцад тус маягтад бичигдсэн үнийн дүнг шалгах зорилгоор <u><b>дансны хуулгыг эх хувиар</b></u> шаардах боломжтой.
                                   <div><p style="">※ Виз мэдүүлэхийн тулд <u><b>түр орлого хийсэн</b></u> тохиолдолд зүй бус гэж үзэн <u><b>визний хариу татгалзах</b></u> боломжтой.</p></div>
                                   </div>
                                   <div><p style="color:red">&emsp;</p></div>
                                   <div><p style="color:red">&emsp;</p></div>
                                   </div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                        <td>
                  <table width="100%" style="border-collapse:collapse; height: 120px; font-size:8px" border="0">
                     <tr>
                        <td>
                           <table style="border-collapse:collapse; height:80px; width:80px; margin-top:0px" border="1">
                              <tr>
                                 <td><img src="'.$qrDir.'">
                                 </td>
                              </tr>
                           </table>
                        </td>
                        <td>
                           <table width="100%" style="margin-top:0px">
                              <tr>
                                 <td width="100%"><div style="margin-top: 0px;">
                                        Тус QR кодыг уншуулан эсвэл дараах холбоосоор баталгаажуулна уу.
                                     </div>
                                     <div>
                                        <a href="https://transbank.mn/verify">https://transbank.mn/verify
                                     </div>
                                     <div>
                                         Баталгаажуулах код:'.$verifyCode.'
                                     </div>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                 </table>
               </td>
                     </tr>
                 </table>
               </td>
            </tr>
         </table>
   ';
   $htmlCustString.='</body>
      </html>';
            

QRcode::png($url, $dirQR, "R", 2, 2);

$dompdf->load_html($htmlCustString, 'UTF-8');
$dompdf->set_paper("a4", "landscape");
$dompdf->set_option('isHtml5ParserEnabled', TRUE);

$dompdf->render();

//$dompdf->stream($dir, array("Attachment"=>0));
$output = $dompdf->output();
file_put_contents($dir, $output);

$content = $htmlString;
$fp = fopen($filePath."myText.html","wb");
fwrite($fp,$content);
fclose($fp);

$sqlInsertAccrecom = "INSERT INTO eoffice.accrecom (id,accnumber, email,username,recom_date,recom_url,verifycode,recomnumber, recom_type, language_type, ORGANIZATION,FILENAME) VALUES (EOFFICE.ACCRECOM_SEQ.nextval,'". str_replace ("'", "", $acntList)."','','', sysdate, '$url', '$verifyCode',lpad(eoffice.RECOM_NUMBER_SEQ.nextval,10,'0'), 1,'0', 'Солонгос элчин','$filename' )";
   //$resultMessage = queryExec($conn, $sqlInsertAccrecom, $PROGRAMID, $PAGENAME, $cmd);
   if(queryExec($sqlInsertAccrecom, $PROGRAMID, $PAGENAME, $cmd)!="S"){
      echo $errorMsg =$sqlInsertAccrecom;
      writeErrorLogPrograms($LOG_PATH."RECOM",$PROGRAMID, $PAGENAME, "ERROR", "$errorMsg sqlInsertAccrecom= $sqlInsertAccrecom");
      exit;
   }



      ?>
      
   
     <?php 
      }
   
      ?> 

      <?php if($cmdaa){
      ?>
       <table width="88%">
         <tr>
            <td>
               <div align="right">
                  <button onclick="window.print()" class="btn btn-primary">Хэвлэх</button>
               </div>
            </td>
         </tr>
      </table>
   <?php 
      }
      ?>       
</body>
</html>