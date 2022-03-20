
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
//echo session_id();


$message_to_encrypt = "Yoroshikune";
$secret_key = "my-secret-key";
$method = "aes128";
$iv_length = openssl_cipher_iv_length($method);
$iv = 7089371908532113;

$RemoteFolder = "f6F9e9x8L2pAkj6nUTBePKEmLRZvPnfLpSHjN99tndUd5dCE2tRTvwMDFKkhRTtJ";

//Data from other form
if(isset($_REQUEST['QDate']))
	{
	$PDate = ($_REQUEST['QDate']);
	//echo "Downloading data for ".$PDate;
	}
else
	{
	//echo "Please select a date and time";
	}

?>

<?php

// Create a connection to the web service
$ws_username = "4kingdoms";
$ws_password = "sdfsdiF@%@dIAS82729FBX_322";
$ws_url = "https://4kingdoms.fusemetrix.com/ws/soap/";

$client = new FuseMetrixWebService_SOAP($ws_username, $ws_password, $ws_url);
//echo $client->getItWorks(); // Returns 'FMX web service successfully called' if successful

$old_date = explode('/', $PDate);
$PTime = ($_REQUEST['QTime']);
$PTime1 = str_replace(':','',$PTime);
$PDate1 = $old_date[2].'-'.$old_date[1].'-'.$old_date[0]; 

		$PDate = str_replace('/','',$PDate);
		$file = $PDate.$PTime1."Bookings1.txt";
		file_put_contents($file,"");

$saveList = array();
$i=59;
while  ($i<60)
	{
	//echo $PDate1;
	//echo $PTime;
	$response = $client->getChristmasBookings($PDate1,$PTime);
	//echo "<h2>getChristmasBookings(\$date, \$time)</h2>";
	//echo "<pre>".print_r($response, true)."</pre>";
	
	//$write = fopen($file,"a");
	//fwrite($write,$PTime.PHP_EOL);

	$bookings = $response['bookings'];
	
	foreach($bookings as $booking)
	{
	$orderID = $booking['orderId'];
	$orderID1 = "000".$orderID;
	//$write = fopen($file,"a");
	//fwrite($write,$orderID.PHP_EOL);
	fclose($write);
	$response1 = $client->getChristmasBooking($booking['orderId']);
	//echo "<pre>".print_r($response1, true)."</pre>";

		$count = count($response1['booking']);
		$j=0;
		while($j<$count)
		{	
		$decrypted_message = "";
		if(isset($response1['booking'][$j]['25']['answer']))
				{
				
					$var_child = $response1['booking'][$j]['25']['answer'];
					$var_child1 = trim(strtolower($var_child));
					$var_child1=str_replace(' ','-',$var_child1);
				
					$file1 = $orderID1."_".$var_child1.".txt";
					$RemoteFolder = "f6F9e9x8L2pAkj6nUTBePKEmLRZvPnfLpSHjN99tndUd5dCE2tRTvwMDFKkhRTtJ";
					$filename = $RemoteFolder."/".$file1;
					//echo $filename;
					$var_child1 = $orderID.",Child,".$var_child;
					if (file_exists($filename))
						{
						$Ofile = fopen($filename,"r");
						while (! feof($Ofile))
							{
							$line = fgets($Ofile);
							}
						fclose($Ofile);
						$decrypted_message = openssl_decrypt($line, $method, $secret_key, 0, $iv);
						//$decrypted_message = str_replace("\n", ' ', $decrypted_message);
						$decrypted_message = str_replace("\n", ' ', 	$decrypted_message);
						$decrypted_message = str_replace("\r", ' ', 	$decrypted_message);
						$decrypted_message = str_replace("\r\n", ' ', 	$decrypted_message);
						$var_child1 = $var_child1.",".$decrypted_message;
						}
					
					
					
					$write = fopen($file,"a");
					fwrite($write,$var_child1.PHP_EOL);
					fclose($write);
					
				}
		if(isset($response1['booking'][$j]['37']['answer']))
				{
					$var_adult = $response1['booking'][$j]['37']['answer'];
					$var_adult1 = trim(strtolower($var_adult));
					$var_adult1=str_replace(' ','-',$var_adult1);

					$file1 = $orderID1."_".$var_adult1.".txt";
					$RemoteFolder = "tfE4rE3sTV8xdf9Wa7RU3SuxbrwQEXJWf35tfCP5hbyhhUuks4wc7qKGS4Zmv7kU";
					$filename = $RemoteFolder."/".$file1;
					//echo $filename;
					$var_adult1 = $orderID.",Adult,".$var_adult;
					if (file_exists($filename))
						{
						$Ofile = fopen($filename,"r");
						while (! feof($Ofile))
							{
							$line = fgets($Ofile);
							}
						fclose($Ofile);
						$decrypted_message = openssl_decrypt($line, $method, $secret_key, 0, $iv);
						//$decrypted_message = str_replace("\n", ' ', $decrypted_message);
						$decrypted_message = str_replace("\n", ' ', 	$decrypted_message);
						$decrypted_message = str_replace("\r", ' ', 	$decrypted_message);
						$decrypted_message = str_replace("\r\n", ' ', 	$decrypted_message);
						$var_adult1 = $var_adult1.",".$decrypted_message;
						}


					$write = fopen($file,"a");
					fwrite($write,$var_adult1.PHP_EOL);
					fclose($write);				
				}
		$j=$j+1;
		}
			$RemoteFolder = "bCE25DXzGfEfxtQZLQSBv8jmu9FMK932UrvrRcLVHc8JsYzducnCPNvcv6GC8c8x";
			$file1 = $orderID1."_"."Family.txt";
				$filename = $RemoteFolder."/".$file1;
			if (file_exists($filename))
						{
						$Ofile = fopen($filename,"r");
						while (! feof($Ofile))
							{
							$line = fgets($Ofile);
							}
						fclose($Ofile);
						$decrypted_message = openssl_decrypt($line, $method, $secret_key, 0, $iv);
						//$decrypted_message = str_replace("\n", ' ', $decrypted_message);
						$decrypted_message = str_replace("\n", ' ', 	$decrypted_message);
						$decrypted_message = str_replace("\r", ' ', 	$decrypted_message);
						$decrypted_message = str_replace("\r\n", ' ', 	$decrypted_message);
						$var_family = $orderID.",Family,".$decrypted_message;
							$write = fopen($file,"a");
					fwrite($write,$var_family.PHP_EOL);
					fclose($write);		
						}
			$varAddress = $response1['address'];
		
			$varTest = explode(',',$varAddress);
			$varPostcode = $response1['postcode'];
			$first = strtok($varAddress, '/');

			//$varAddress = str_replace(',',' ', $varAddress);
		
			$whatIWant = substr($varAddress, strpos($varAddress, ",") + 1);   
			$varAdd = $orderID.",Address,".$varAddress.",".$varPostcode;
			$write = fopen($file,"a");
					fwrite($write,$varAdd.PHP_EOL);
					fclose($write);		
			
	}


	
	
	

	$i=$i+1;
	$PTime = strtotime("+10 minutes", strtotime($PTime));
	$PTime = date('H:i',$PTime);
	
	}
 


$response = $client->validateChristmasBooking($var_email, $orderID, $var_child);
//echo "<h2>validateChristmasBooking(\$email, \$orderRef, \$childName)</h2>";
//echo "<b>Valid example:</b>";
//echo "<pre>".print_r($response, true)."</pre>";

// Example classes to connect to the web service and call the methods
// You shouldn't need to make any changes to these functions!

class FuseMetrixWebService_SOAP {
    private $client;
    private $username;
    private $password;
    private $token;
    private $headersGenerated;

    function __construct($username, $password, $url) {
        $this->client = new SoapClient(null, array("location" => $url, "uri" => "fusemetrix", "soap_version" => SOAP_1_2));
        $this->username = $username;
        $this->password = $password;
        $this->getToken();
        $this->headersGenerated = false;
    }

    private function getToken($force = false) {
        if($force || !isset($_SESSION["fmxwebservice_soap"]["token"])) {
            $this->token = $this->client->requestToken($this->username);
            $_SESSION["fmxwebservice_soap"]["token"] = $this->token;
        } else {
            $this->token = $_SESSION["fmxwebservice_soap"]["token"];
        }
    }

    private function generateHeaders() {
        $digest = md5($this->password . $this->token);
        $usernameToken = new SoapHeaderUsernameToken($this->username, $digest);
        
        $soapHeaders[] = new SoapHeader("fusemetrix", "auth", $usernameToken);

        $this->client->__setSoapHeaders($soapHeaders);
    }

    public function __call($function, $arguments) {
        if(!$this->headersGenerated) {
            $this->generateHeaders();
        }
        try {
            return $this->client->__soapCall($function, $arguments);
        } catch (SoapFault $e) {
            if($e->faultcode == "0002") {
                $this->client->__setSoapHeaders(null);
                $this->getToken(true);
                $this->generateHeaders();
                return $this->client->__soapCall($function, $arguments);
                throw($e);
            }
        }
    }
}

class SoapHeaderUsernameToken {
    public $digest;
    public $username;

    public function __construct($l, $d) {
        $this->digest = $d;
        $this->username = $l;
    }
}

?>
