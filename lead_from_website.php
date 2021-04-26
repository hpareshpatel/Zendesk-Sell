<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);

$ACCESS_TOKEN = '********a18cd6db4bd11f8198b2b6ef817e0c1dc81*******************';

if( isset($_POST['form_type']) && $_POST['form_type'] == 'DotCom')
{
	$url = "https://api.getbase.com/v2/leads";
	$header[] = "Content-type: application/json";
	
	$fname = addslashes($_POST['fname']);
	$lname = addslashes($_POST['lname']);
	$email = addslashes($_POST['semail']);
	$phone = addslashes($_POST['scontact']);
	$btype = addslashes($_POST['segment']);
	
	$data = '{
	"data": 
	{
		"first_name": "'.$fname.'",
		"last_name": "'.$lname.'",
		"organization_name": "PHP Web India",
		"title": "TEST LEAD - DOT.com",
		"description": "Its just a test, for request call back form.",
		"phone": "'.$phone.'",
		"email": "'.$email.'",
		"address": {
		  "line1": "2726 Smith Street",
		  "city": "Hyannis",
		  "postal_code": "02601",
		  "state": "MA",
		  "country": "US"
		},
		"tags": [
		  "important"
		],
		"custom_fields": {
		  "3511437": "'.$btype.'"
		}
	}
}';

	$crl = curl_init($url);
	curl_setopt($crl, CURLOPT_HEADER, true);
	curl_setopt($crl, CURLOPT_HEADER, 1);
	curl_setopt($crl, CURLOPT_HTTPHEADER, array(
		'Accept:  application/json',
		'User-agent: '.$_SERVER['HTTP_USER_AGENT'],
		'Content-Type: application/json;',
		'Authorization: Bearer ' .$ACCESS_TOKEN
		)
	);
	curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, TRUE);  
	curl_setopt($crl, CURLOPT_TIMEOUT, 30);
	curl_setopt($crl, CURLOPT_POST, 1);
	curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, TRUE);
	$rest = curl_exec($crl);
	
	if (curl_errno($crl)) {
		$error_msg = curl_error($crl);
	}
	curl_close($crl);
	
	if (isset($error_msg)) {
		print_r($error_msg);
	}
	else
	{
		//print_r($rest);
		echo "Your request received. A member of our support staff will respond as soon as possible";
	}
}
else
{
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h4 style="padding:20px 0px"> REQUEST A CALLBACK </h4>
<p>We can help you make your decision easier. Leave your number and we will call you back </p>
        <form method="post" id="bulk_supplies_form" accept-charset="UTF-8" class="form-horizontal form-row-seperated contact-form" onSubmit="return validations();">
          <div class="error" style="padding:0px 0px 10px 15px;"></div>
          <input type="hidden" name="form_type" value="DotCom" />
          <div class="form-group">
            <label class="control-label"></label>
            <div class="col-md-2">
              <input name="fname" type="text" maxlength="100" placeholder="First Name" value="" class="tReq tName form-control" >
            </div>
            <div class="col-md-2">
              <input name="lname" type="text" maxlength="100" placeholder="Last Name" value="" class="tReq tName form-control" >
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-5">
              <input name="semail" type="text" maxlength="400" placeholder="Email address" value="" class="tReq tEmail form-control" >
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-10"></label>
            <div class="col-md-5">
              <input name="scontact" type="text" maxlength="50" placeholder="Phone No " class="tReq tNum form-control" >
              <div><small>(eg.+91-98xxx98xxx)</small></div>
            </div>
          </div>
          <div class="form-group">

            <label class="control-label col-md-2">Time to Call </label>
            <div class="col-md-5">
              <select name="segment" class="form-control tType tReq">
                <option value="">Time to Call</option>
                <option value="11am - 12pm">11am - 12pm</option>
                <option value="12pm -1pm">12pm -1pm</option>
                <option value="1pm - 2pm">1pm - 2pm</option>
                <option value="2pm - 3pm">2pm - 3pm</option>
                <option value="3pm - 4pm">3pm - 4pm</option>
                <option value="4pm - 5pm">4pm - 5pm</option>
                <option value="5pm - 6pm">5pm - 6pm</option>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-2"></label>
            <div class="col-md-5">
              <button type="submit" class="btn btn-primary">Call back</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script> 
<script>
CKEDITOR.replace( 'sdesc' );
function validations()
{
	var isValid = 1;

	$('.error').html('');
	var vName = $('.tName').val();
	if ( $.trim(vName)!="" )
	{
		isValid = 1;
	}
	else
	{
		isValid = 0;
		$('.error').html("Please provide name");
		$('.tName').focus();
		return false;
	}
	
	var vEmail = $('.tEmail').val();
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if (filter.test(vEmail))
		isValid = 1;
	else{
		isValid = 0;
		$('.error').html("Please provide valid email address");
		$('.tEmail').focus();
		return false;
	}
	
	var vPhone = $('.tNum').val();
	var phoneno = /^(\+91[\-\s]?)?[0]?(91)?[6789]\d{9}$/;
	if( vPhone.match(phoneno) )
	{
		isValid = 1;
	}
	else
	{
		isValid = 0;
		$('.error').html("Please provide valid contact number");
		$('.tNum').focus();
		return false;
	}
	
	var vType = $('.tType').val();
	if ( $.trim(vType)!="" )
	{
		isValid = 1;
	}
	else
	{
		isValid = 0;
		$('.error').html("Please choose your time slot");
		$('.tType').focus();
		return false;
	}
	
	if (isValid == 0) return false;  
	else return;
}

</script> 
<?php
}
?>
