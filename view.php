<?php
if (!isset($_GET['id'])) {
	header("Location /");
	end;
}

require("common.php");
$conn = open_connection();
$assetId = mysql_escape_string($_GET['id']);

$sql = "select * from assets where asset_id = $assetId";
$query = mysql_query($sql);
if (mysql_num_rows($query)!=1) {
	mysql_free_result($query);
	mysql_close($conn);
	header("Location /");
	end;
}

$assetRow = mysql_fetch_assoc($query);
$assetTitle = $assetRow['title'];
$assetDescr = $assetRow['description'];
mysql_free_result($query);


?>
<html>
<head>
	<title><?php echo ($assetTitle); ?></title>
</head>
<body>
	<div><?php echo ($assetTitle); ?></div>
	<div><?php echo ($assetDescr); ?></div>

	<div>Components</div>
	<table> <!--START components -->
<?php
	$sql = "select ct.title as component_type, c.*, count(constraints.constraint_id) as constraint_count
			  from components as c
			  join component_types as ct on c.component_type_id = ct.component_type_id
			  left join constraints on c.component_id = constraints.components_component_id
			 where c.asset_id = $assetId
			 group by c.component_type_id, c.component_id";
	$query = mysql_query($sql);
	$lastHeadline = "";
	while ($row = mysql_fetch_assoc($query)) {
		if ($row['component_type'] != $lastHeadline) {
			echo("<div>".$row['component_type']."</div>");
			$lastHeadline = $row['component_type'];
		}
?>
	<tr>
		<td>
			<?php echo($row['title']); ?>
<?php
			$sql = "select * from constraints where components_component_id=".$row['component_id'];
			$inner = mysql_query($sql);
			while ($contraint = mysql_fetch_assoc($inner)) {
?>
				<div><?php echo($constraint["title"]) ?></div>
<?php
			} //END of the constraints
?>
		</td>
		<td><?php echo($row['constraint_count']); ?></td>
	</tr>
<?php
	}
	mysql_free_result($query);
?>
	</table> <!--END components -->


	<div>Contributions</div>
	<table> <!--START contributions -->
<?php
	$sql = "select ct.title as contribution_type, c.*, count(constraints.constraint_id) as constraint_count
			  from contributions as c
			  join contribution_types as ct on c.contribution_type_id = ct.contribution_type_id
			  left join constraints on c.contribution_id = constraints.contributions_contribution_id
			 where c.asset_id = $assetId
			 group by c.contribution_type_id, c.contribution_id";
	$query = mysql_query($sql);
	$lastHeadline = "";
	while ($row = mysql_fetch_assoc($query)) {
		if ($row['contribution_type'] != $lastHeadline) {
			echo("<div>".$row['contribution_type']."</div>");
			$lastHeadline = $row['contribution_type'];
		}
?>
	<tr>
		<td>
			<?php echo($row['title']); ?>
<?php
			$sql = "select * from constraints where contributions_contribution_id=".$row['contribution_id'];
			$inner = mysql_query($sql);
			while ($contraint = mysql_fetch_assoc($inner)) {
?>
				<div><?php echo($constraint["title"]) ?></div>
<?php
			} //END of the constraints
?>
		</td>
		<td><?php echo($row['constraint_count']); ?></td>
	</tr>
<?php
	}
	mysql_free_result($query);
?>
	</table> <!--END contributions -->

</body>
</html>
<?php
mysql_close($conn);
?>