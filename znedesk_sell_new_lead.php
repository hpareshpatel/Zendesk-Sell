<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);

$ACCESS_TOKEN = '********a18cd6db4bd11f8198b2b6ef817e0c1dc81*******************';

$crl = curl_init('https://api.getbase.com/v2/leads');
$headr = array();
$headr[] = 'Accept: application/json';
$headr[] = 'Content-type: application/json';
$headr[] = 'Authorization: Bearer '.$ACCESS_TOKEN;
$headr[] = 'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Safari/537.36';
$data = '{
		  "data": {
		    "first_name": "Paresh",
		    "last_name": "Patel",
		    "organization_name": "phpwebindia",
		    "source_id": 10,
		    "title": "ZneDesk-Sell",
		    "description": "Its just a test",
		    "industry": "Design Services",
		    "website": "http://www.phpwebindia.com",
		    "email": "info@phpwebindia.com",
		    "phone": "508-778-6516",
		    "mobile": "508-778-6516",
		    "fax": "+44-208-1234567",
		    "twitter": "twitter",
		    "facebook": "facebook.com",
		    "linkedin": "linkedin.com",
		    "skype": "skype.com",
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
		      "known_via": "tom",
		    }
		  }
		}';

curl_setopt($crl, CURLOPT_HEADER, true);
curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
curl_setopt($crl, CURLOPT_POSTFIELDS, $data);
curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($crl, CURLOPT_FAILONERROR, true);
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
	print_r($rest);
}


?>
