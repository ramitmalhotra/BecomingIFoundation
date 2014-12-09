<?php
session_start();
// Connect to server and select databse.
$conn_string = "host=localhost port=5432 dbname=becomingidb user=becomingidb password=t49jfd";
$dbconn = pg_connect($conn_string) 
or die('Could not connect: ' . pg_last_error());
//get the data from json inside post

$data = array(); 
$data = json_decode($_POST['mydata'],true);

$functionType = $data['functionName'];

if($functionType == "getProjects"){
	getProjects($data['city']);
}
else if($functionType == "getVolunteers"){
	getVolunteers($data['project']);
}
else if($functionType == "getVolunteersBySkill"){
	$skills = $data['skills'];
	$chapter= $data['chapter'];
	getVolunteersBySkills($skills,$chapter);
}
else if($functionType == "getMetrics"){
	getMetrics($data['project']);	
}
else if($functionType == "getPartners"){
	getPartners($data['project']);	
}

	

function getProjects($city){
	$q1 = "Select projectid,chapterid,projectname from project where chapterid='".$city."'";
	$resultProject = pg_query($q1);
	if (!$resultProject) {
		$errormessage = pg_last_error();
		$return=array();
		$return['e'] = $errormessage;
		echo json_encode($return);
		exit;
	}
	$myarray = array();
	while($row = pg_fetch_assoc($resultProject)) {
		$myarray[] = $row;
	}	
	echo json_encode($myarray);
	exit;
}

function getVolunteers($project){
	$q = "Select distinct personnel.fname,personnel.sname,personnel.phone,personnel.email,volunteer.role from personnel,volunteer where personnel.userid = volunteer.userid and volunteer.projectid='".$project."'";
	$resultVolunteers = pg_query($q);
	if (!$resultVolunteers) {
		$errormessage = pg_last_error();
		$return=array();
		$return['e'] = $errormessage;
		echo json_encode($return);
		exit;
	}
	$myarray = array();
	while($row = pg_fetch_assoc($resultVolunteers)) {
		$myarray[] = $row;
	}
	echo json_encode($myarray);
	exit;
}

function getVolunteersBySkills($skills,$chapter){
	if($chapter == 0){
		$myarray = array();
		foreach($skills as $skill){
		$q = "select distinct personnel.userid, fname,sname,phone,email,city,role,projectname,chaptername,skill from skills,personnel,project,volunteer,chapter where LOWER(skill)=LOWER('".$skill."') and skills.userid=personnel.userid and skills.userid = volunteer.userid and skills.projectid=project.projectid and project.chapterid=chapter.chapterid";
		$resultVolunteers = pg_query($q);
		if (!$resultVolunteers) {
			$errormessage = pg_last_error();
			$return=array();
			$return['e'] = $errormessage;
			echo json_encode($return);
			exit;
		}
		while($row = pg_fetch_assoc($resultVolunteers)) {
			$myarray[] = $row;
		}
		}
		echo json_encode($myarray);
		exit;
	}
	else{
		$myarray = array();
		foreach($skills as $skill){ 
			$q = "select distinct personnel.userid, fname,sname,phone,email,city,role,projectname,chaptername,skill from skills,personnel,project,volunteer,chapter where LOWER(skill)=LOWER('".$skill."') and skills.userid=personnel.userid and skills.userid = volunteer.userid and skills.projectid=project.projectid and project.chapterid=chapter.chapterid and chapter.chapterid='".$chapter."'";
			$resultVolunteers = pg_query($q);
			if (!$resultVolunteers) {
				$errormessage = pg_last_error();
				$return=array();
				$return['e'] = $errormessage;
				echo json_encode($return);
				exit;
			}
			while($row = pg_fetch_assoc($resultVolunteers)) {
				$myarray[] = $row;
			}
		}
		echo json_encode($myarray);
		exit;
	}
}

function getMetrics($project){
	$q = "select metric,assessgrade,assessnotes from assessment where assessment.projectid='".$project."'";
	$resultMetrics = pg_query($q);
	if (!$resultMetrics) {
		$errormessage = pg_last_error();
		$return=array();
		$return['e'] = $errormessage;
		echo json_encode($return);
		exit;
	}
	$myarray = array();
	while($row = pg_fetch_assoc($resultMetrics)) {
		$myarray[] = $row;
	}
	echo json_encode($myarray);
	exit;
}

function getPartners($project){
	$q = "select name,fname,sname,phone,email,city from partner,partner_project where partner_project.projectid='".$project."' and partner.partnerid=partner_project.partnerid";
	$resultPartners = pg_query($q);
	if (!$resultPartners) {
		$errormessage = pg_last_error();
		$return=array();
		$return['e'] = $errormessage;
		echo json_encode($return);
		exit;
	}
	$myarray = array();
	while($row = pg_fetch_assoc($resultPartners)) {
		$myarray[] = $row;
	}
	echo json_encode($myarray);
	exit;
}
?>