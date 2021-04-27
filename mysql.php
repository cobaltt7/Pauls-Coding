<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
	header("HTTP/1.1 403 Unauthorized");
	die("Forbidden");
}

$mysql = new mysqli(
	"localhost",
	"rpreidco_paul",
	"4qloK#YxevPu",
	"rpreidco_paul",
);
if ($mysql->connect_error) {
	die('MySQL connection failed');
}
