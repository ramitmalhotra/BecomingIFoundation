<?php
$return = array();
session_start();

// Connect to server and select databse.
$conn_string = "host=localhost port=5432 dbname=becomingidb user=becomingidb password=t49jfd";
$dbconn = pg_connect($conn_string)
or die('Could not connect: ' . pg_last_error());

// username and password sent from form 
$myusername=$_POST['username']; 
$mypassword=$_POST['password'];


function findPasswordHash($inputPassword, $storedPassword) {
	return crypt($inputPassword, $storedPassword);
}

$sql = sprintf("SELECT password FROM personnel WHERE username='%s'",pg_escape_string($myusername));

$result = pg_query($sql);
if (pg_numrows($result) > 0) {
	$row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
	$storedPassword = $row['password'];
} else {
	$return['e'] = 'Incorrect Username or Password';
	echo json_encode($return);
	exit;
}
// To protect MySQL injection 
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = pg_escape_string($myusername);
$mypassword = pg_escape_string($mypassword);
$hashedPassword = findPasswordHash($mypassword, $storedPassword);
$sql="SELECT * from personnel WHERE username='".$myusername."' and password='".$hashedPassword."'";

$result=pg_query($sql);
if(!$result){
	$error = pg_last_error();
	$return['e'] = $error;
	echo json_encode($return);
	exit;
}
	
// Mysql_num_row is counting table row
$count=pg_numrows($result);

$row = pg_fetch_array($result, NULL, PGSQL_ASSOC);
$name = $row['fname'] . ' ' . $row['sname'];
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
	// Register $myusername, $mypassword and redirect to file "delegationHome.php"
	$_SESSION['username'] = $myusername;
	$_SESSION['name'] = $name;
	
	$return['s'] = "Success ".$_SESSION['name'];
	echo json_encode($return);
	//header("location:delegationHome.php");
} else {
	$return['e'] = "Incorrect Username or Password: ". $hashedPassword;
	echo json_encode($return);
	//header("location:main_login.php?e=".urlencode("s"));
}
?>