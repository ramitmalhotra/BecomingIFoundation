<?php
$return = array();

session_start();
// Connect to server and select databse.
$conn_string = "host=localhost port=5432 dbname=becomingidb user=becomingidb password=t49jfd";
$dbconn = pg_connect($conn_string)
or die('Could not connect: ' . pg_last_error());

// Fields sent from form
$firstName = pg_escape_string($_POST['fname']);
$lastName = pg_escape_string($_POST['lname']);
$email = pg_escape_string($_POST['email']);
$dob = pg_escape_string($_POST['dob']);
$sex = pg_escape_string($_POST['sex']);
$studentStatus = pg_escape_string($_POST['student']);
if($studentStatus == 'Nonstudent'){
	$instName = pg_escape_string($_POST['einstName']);
	$instType = pg_escape_string($_POST['InstType']);
	$occDetail = pg_escape_string($_POST['occDetail']);
}
else{
	$instName = pg_escape_string($_POST['instName']);
	$instType = 'Educational institution';
	$occDetail = 'Fulltime Student';
}
$continue = pg_escape_string($_POST['Continue']);
$skills = pg_escape_string($_POST['SkillDesc']);
$skills = str_replace(', ', ',', $skills);
$skills = $trim($skills);
$skillsArray = explode(',',$skills);
$primaryPhone = pg_escape_string($_POST['Phone']);
$address = pg_escape_string($_POST['Address']);
$city = pg_escape_string($_POST['City']);
$state = pg_escape_string($_POST['State']);
$pin = pg_escape_string($_POST['Pin']);
$country = pg_escape_string($_POST['Country']);
$username=pg_escape_string($_POST['username']); 
$password=pg_escape_string($_POST['password']);

function blowfishSalt($cost = 13) {
    if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
        throw new Exception("cost parameter must be between 4 and 31");
    }
    $rand = array();
    for ($i = 0; $i < 8; $i += 1) {
        $rand[] = pack('S', mt_rand(0, 0xffff));
    }
    $rand[] = substr(microtime(), 2, 6);
    $rand = sha1(implode('', $rand), true);
    $salt = '$2a$' . sprintf('%02d', $cost) . '$';
    $salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
    return $salt;
}
function securePassword($password) {
	return crypt($password, blowfishSalt());
}
function checkIfUsernameExists($username) {
	$sql='SELECT * FROM public."Personnel" WHERE "Username" = \''.$username.'\'';
	$result=pg_query($sql);
	$result = pg_query('SELECT 1 FROM public."Personnel" WHERE username ="$username" LIMIT 1');
	if(is_resource($result) && pg_numrows($result) > 0 ){
		$error = 'Sorry, that username is already taken.';
		$return['e'] = $error;
		echo json_encode($return);
		//header("Location: registration.php?e=".urlencode($error));
		exit;
	}
	return;
}
function getCurrentDate() {
	$d = getdate();
	$month = $d[mon];
	$day = $d[mday];
	$year = $d[year];
	return $month."-".$day."-".$year;
}
checkIfUsernameExists($username);
$date = getCurrentDate();
$password = securePassword($password);
/* create a prepared statement */

$sql = "INSERT INTO personnel (fName,sName,gender,occupation,occdetail,memstart,email,phone,address,city,state,country,pinzip,username,password,
        cont,dob,instname,insttype) VALUES ('".$firstName."','".$lastName."','".$sex."','".$studentStatus."','".$occDetail."','".$date."','".$email."','".$phone."','".$address."','".$city."','".$state."','".$country."','".$pin."','".$username."','".$password."','".$continue."','".$dob."','".$instName."','".$instType."')";

$result = pg_query($sql);
if (!$result) {
	$errormessage = pg_last_error();
	$return['e'] = $errormessage;
	echo json_encode($return);
	exit;
}

$sql1 = "Select userid from personnel where username='".$username."'";
$result1 = pg_query($sql1);

if (!$result1) {
	$errormessage = pg_last_error();
	$return=array();
	$return['e'] = $errormessage;
	echo json_encode($return);
	exit;
}
if (pg_numrows($result1) > 0) {
	$row = pg_fetch_array($result1, NULL, PGSQL_ASSOC);
	$userid = $row['userid'];
}

foreach($skillsArray as $skill){
	$sql = "Insert into skills (userid,skill,skilldesc) VALUES ('".$userid."','".$skill."','".$skill."')";
	$result = pg_query($sql);
	if (!$result) {
		$errormessage = pg_last_error();
		$return['e'] = $errormessage;
		echo json_encode($return);
		exit;
	}
}
//$result = pg_query_params($dbconn,$sql,Array($firstName,$lastName,$sex,$studentStatus,$occDetail,$date,$email,$phone,$address,$city,$state,$country,$pin,$username,$password,$continue,$dob,$instName,$instType));


/*
$sql = "INSERT INTO `registration2014`  (`primaryContact`, `primaryEmail`, `primaryPhone`, `university`, `size`, `username`, `password`, `id`, `registrationDate`, `amountPaid`, `proofofpayment`, `address`)
VALUES ('$primaryName','$primaryEmail','$primaryPhone','$university','$size','$username','$password',NULL,'$date','0','0','$address');";
$add_member = mysql_query($sql, $connection) or trigger_error( mysql_error( $connection ), E_USER_ERROR );
mysql_close($connection);
*/




$from = "From: nobody@becomingifoundation.org";
$subject = "[NEW BecomingI registration] ".$firstName.' '.$lastName;
//$pres = "tanvi@becomingifoundation.org";
$vp = "ramit@becomingifoundation.org";


// send the email  
//
mail ($pres, $subject, $email_body, $from);
mail ($vp, $subject, $email_body, $from);


$return['s'] = 's';
echo json_encode($return);
//header("Location: registration.php?s=".urlencode("s")); 
exit;  
?>
