<?php

include_once ('class/class.Log.php');
include_once ('class/class.ErrorLog.php');
include_once ('class/class.AccessLog.php');

//
// get date time for this transaction
//
$datetime = date("Y-m-d H:i:s");

//------------------------------------------------------
// get passed variables
//------------------------------------------------------

$name = $_GET["email-name"];
$emailaddress = $_GET["email-address"];
$organization = $_GET["email-organization"];
$comment = $_GET["email-comment"];
$interest = $_GET["email-interest"];

$jsonpCallback = $_GET["callback"];

//
// messaging
//
$returnArrayLog = new AccessLog("logs/");

//------------------------------------------------------
// set db user info
//------------------------------------------------------

// open connection to host
$DBhost = "localhost";
$DBschema = "leah";
$DBuser = "leah";
$DBpassword = "leah";

//
// connect to db
//
$status = "";
$dbConn = @mysql_connect($DBhost, $DBuser, $DBpassword);
if (!$dbConn) 
{
	$log = new ErrorLog("logs/");
	$dberr = mysql_error();
	$log->writeLog("DB error: $dberr - Error mysql connect. Unable to insert email for $name and $emailaddress.");

	$status = "Error";
	$rv = "$jsonpCallback($status)";
	exit($rv);
}

if (!mysql_select_db($DBschema, $dbConn)) 
{
	$log = new ErrorLog("logs/");
	$dberr = mysql_error();
	$log->writeLog("DB error: $dberr - Error selecting db Unable to insert email for $name and $emailaddress.");

	$status = "Error";
	$rv = "$jsonpCallback($status)";
	exit($rv);
	exit($status);
}

// create time stamp versions for insert to mysql
// $enterdateTS = date("Y-m-d H:i:s", strtotime($enterdate));

$sql = "INSERT INTO emailcollectortbl 
	(name,
	email,
	organization,
	comment,
	interestlevel)
	VALUES
	(
		'$name',
		'$emailaddress',
		'$organization',
		'$comment',
		$interest
	);";

$status = "Ok";
$sql_result = @mysql_query($sql, $dbConn);
if (!$sql_result)
{
	$log = new ErrorLog("logs/");
	$sqlerr = mysql_error();
	$log->writeLog("SQL error: $sqlerr - Error doing insert to db unable to insert email collector for $name and $emailaddress.");
	$log->writeLog("SQL: $sql");

	$status = "Error";
}

//
// return status
//
$rv = "$jsonpCallback('$status')";

exit($rv);
?>
