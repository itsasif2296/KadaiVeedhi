<?php
require("dbinfo.php");
$query=$_POST["t"];
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}
$con= mysqli_connect ('localhost', $username, $password);
if (!$con) {
  die('Database connection failed : ' . mysqli_error($con));
}
$db = mysqli_select_db($con,$database);
if (!$db) {
  die ('Database selection failed : ' . mysqli_error($con));
}
$result = mysqli_query($con,"SELECT * FROM shopdetails WHERE (`name` LIKE '%".$query."%') OR (`area` LIKE '%".$query."%')");
if (!$result) {
  die('Invalid query: ' . mysqli_error($con));
}
header("Content-type: text/xml");
echo '<shopdetails>';
while ($row =mysqli_fetch_array($result,MYSQLI_ASSOC)){
  echo '<shop ';
  echo 'id="' . $row['id'] . '" ';
  echo 'name="' . parseToXML($row['name']) . '" ';
  echo 'address="' . parseToXML($row['address']) . '" ';
  echo 'area="'.parseToXML($row['area']).'" ';
  if($row['status']==1)
  {echo 'status="Open" ';}
  else{
  echo 'status="Closed" ';}
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lon'] . '" ';
  echo 'type="' . $row['type'] . '" ';
  echo '/>';
}
echo '</shopdetails>';

