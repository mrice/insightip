<?php
require("./common.php");

$conn = open_connection();

$sql = "insert into assets (title, description) values ('Project management database', 'This is Santa Ana Software\'s project management solution')";
mysql_query($sql);
$asset_id = mysql_insert_id();

$sql = "insert into assets (title, description) values ('Website', 'This is Santa Ana Software\'s website')";
mysql_query($sql);
$asset_id_web_site = mysql_insert_id();

$sql = "insert into assets (title, description) values ('User database', 'The database of users')";
mysql_query($sql);
$asset_id_user_db = mysql_insert_id();

$sql = "insert into component_types (title) values ('Open source library')";
mysql_query($sql);
$open_source_library_id = mysql_insert_id();

$sql = "insert into component_types (title) values ('Third party API')";
mysql_query($sql);
$third_party_id = mysql_insert_id();

$sql = "insert into components (title, asset_id, component_type_id) values ('Jersey JAX-RS implementation', $asset_id, $open_source_library_id)";
mysql_query($sql);
$jersey_component_id = mysql_insert_id();

$sql = "insert into components (title, asset_id, component_type_id) values ('Apache Commons', $asset_id, $open_source_library_id)";
mysql_query($sql);

$sql = "insert into components (title, asset_id, component_type_id) values ('Yahoo Weather service', $asset_id, $third_party_id)";
mysql_query($sql);
$jersey_component_id = mysql_insert_id();


$sql = "insert into contribution_types (title) values ('Employees')";
mysql_query($sql);
$employees_type_id = mysql_insert_id();

$sql = "insert into contribution_types (title) values ('Design Agencies')";
mysql_query($sql);
$design_agencies_type_id = mysql_insert_id();

$sql = "insert into contributions (title, asset_id, contribution_type_id) values ('Roger Klein', $asset_id, $employees_type_id)";
mysql_query($sql);
$roger_cline_id = mysql_insert_id();

$sql = "insert into contributions (title, asset_id, contribution_type_id) values ('Devin Patel', $asset_id, $employees_type_id)";
mysql_query($sql);
$devin_patel_id = mysql_insert_id();

$sql = "insert into contributions (title, asset_id, contribution_type_id) values ('Eyeball Overdrive Design', $asset_id_web_site, $design_agencies_type_id)";
mysql_query($sql);
$eyeball_id = mysql_insert_id();


?>
<html>
<head>
	<title>Ok. </title>
</head>
<body>
	<p>Sample data setup. <a href="/">Go home</a></p>
</body>
</html>