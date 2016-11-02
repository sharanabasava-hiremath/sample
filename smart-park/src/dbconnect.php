<?php
$conn=mysql_connect("localhost","root","root123","parkingdb");
if(!$conn)
{
echo "connection error";
}
mysql_select_db("parkingdb",$conn) or die(mysql_error());

?>