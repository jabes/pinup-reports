<?php 

error_reporting(0);
set_time_limit(10);

// WARNING: IF SET TRUE, WILL BREAK FRONTEND
DEFINE("EMMA_DEVMODE", false);
DEFINE("LINE_BREAK", "--------------------------------------------------");

session_name("PinupReportsSession"); // required for cross-subdomain
session_set_cookie_params(0, '/', '.pinup-reports.dev');
session_start();

$BASEURL = "http://pinup-reports.dev"; // exclude trailing slash

$db_info_slave["host"] = "pinup.dev";
$db_info_slave["username"] = "root";
$db_info_slave["password"] = "root";
$db_info_slave["dbname"] = "pinup";

$slave = mysql_connect(
	$db_info_slave["host"],
	$db_info_slave["username"],
	$db_info_slave["password"]
) or die (mysql_error());

mysql_select_db(
	$db_info_slave["dbname"],
	$slave
) or die (mysql_error());

$memCache = false;
if ($memCache)
{
	$memcache = new Memcache;
	$memcache->connect('localhost', 11211) or die('Memcache Connection Failed');
}
