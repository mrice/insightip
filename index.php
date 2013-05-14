<?php
require("common.php");
$conn = open_connection();

?>
<html>
<head>
	<title>index</title>
</head>
<body>

<table>
<?php
	$sql = "select a.*, count(cmp.component_id) as component_count, count(cont.contribution_id) as contribution_count
              from assets as a
              left join components as cmp on a.asset_id = cmp.asset_id
              left join contributions as cont on a.asset_id = cont.asset_id 
             group by a.asset_id";
    $query = mysql_query($sql);
    while ($row = mysql_fetch_assoc($query)) { ?>
    <tr>
    	<td><a href="view.php?id=<?php echo($row['asset_id']) ?>"><?php echo($row['title']) ?></a></td>
    	<td><?php echo($row['component_count']) ?></td>
    	<td><?php echo($row['contribution_count']) ?></td>
    </tr>

<?php
    }
?>
</body>
</html>
<?php
mysql_close($conn);
?>