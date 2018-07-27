<?php
$servername = "localhost";
$username = "root";
$password = '';
$db = "sigmatest";


$conn =  mysqli_connect($servername, $username,$password, $db);
$search = $_POST['search'];
//echo $search;
  $search = str_replace(".", "", $search);

if(!empty($search)){

  if (is_numeric($search))
  {
$query= "SELECT `application`.`mnemonic`, `servers`.`server_name`, `servers`.`server_ip`, `visibility`.`Visibility`, `os`.`os_name`, `critical`.`critical_name`, `lineofbusiness`.`Name`, `application`.`name`
FROM `application`
LEFT JOIN `critical` ON `application`.`fk_critical` = `critical`.`critical_id`
LEFT JOIN `lineofbusiness` ON `application`.`fk_lbus` = `lineofbusiness`.`Lbus_id`
LEFT JOIN `visibility` ON `application`.`fk_vis` = `visibility`.`Vis_id`
LEFT JOIN `servers` ON `application`.`app_id` = `servers`.`fk_app`
LEFT JOIN `os` ON `servers`.`fk_os` = `os`.`os_id`
WHERE servers.server_ref  LIKE '$search%' ";
  }
else{

if($search == "-")
{
$query = "SELECT `application`.`mnemonic`, `servers`.`server_name`, `servers`.`server_ip`, `visibility`.`Visibility`, `os`.`os_name`, `critical`.`critical_name`, `lineofbusiness`.`Name`, `application`.`name`
FROM `application`
LEFT JOIN `critical` ON `application`.`fk_critical` = `critical`.`critical_id`
LEFT JOIN `lineofbusiness` ON `application`.`fk_lbus` = `lineofbusiness`.`Lbus_id`
LEFT JOIN `visibility` ON `application`.`fk_vis` = `visibility`.`Vis_id`
LEFT JOIN `servers` ON `application`.`app_id` = `servers`.`fk_app`
LEFT JOIN `os` ON `servers`.`fk_os` = `os`.`os_id`
WHERE servers.server_name  LIKE '$search%' ";

}
else
{

$query= " SELECT `application`.`mnemonic`, `servers`.`server_name`, `servers`.`server_ip`, `visibility`.`Visibility`, `os`.`os_name`, `critical`.`critical_name`, `lineofbusiness`.`Name`, `application`.`name`
FROM `application`
LEFT JOIN `critical` ON `application`.`fk_critical` = `critical`.`critical_id`
LEFT JOIN `lineofbusiness` ON `application`.`fk_lbus` = `lineofbusiness`.`Lbus_id`
LEFT JOIN `visibility` ON `application`.`fk_vis` = `visibility`.`Vis_id`
LEFT JOIN `servers` ON `application`.`app_id` = `servers`.`fk_app`
LEFT JOIN `os` ON `servers`.`fk_os` = `os`.`os_id`
WHERE application.mnemonic   LIKE '%$search%' ";
}
}

$search_query = mysqli_query($conn,$query);
if(!$search_query){
  die('QUERY FAILED' . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($search_query)){

   echo "<tr>";
   echo "<td> {$row['mnemonic']} </td>";
   echo "<td> {$row['name']} </td>";
   echo "<td>{$row['server_ip']} </td>";
   echo "<td>{$row['server_name']} </td>";
   echo "<td>{$row['os_name']} </td>";
   echo "<td>{$row['Visibility']} </td>";
   echo "<td> {$row['Name']} </td>";
   echo "<td>{$row['critical_name']} </td>";
   echo "</tr>";
 }
}
?>
