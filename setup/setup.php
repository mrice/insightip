<?php
$valuesReady=true;
if (!isset($_POST['server'])) {
	$valuesReady = false;	
} else if (!isset($_POST['username'])) {
	$valuesReady = false;	
} else if (!isset($_POST['password'])) {
	$valuesReady = false;	
} else if (!isset($_POST['database'])) {
	$valuesReady = false;	
}
if (!$valuesReady) {
	header("Location /setup");
	end;
}

$dbHost = $_POST['server'];
$dbUser = $_POST['username'];
$dbPassword = $_POST['password'];
$dbDatabase = $_POST['database'];

$databaseReady = false;
$conn = mysql_connect($dbHost, $dbUser, $dbPassword);
if ($conn) {
	$connected = mysql_select_db($dbDatabase);
	if ($connected) {
		$databaseReady = true;
	}
}

if (!$databaseReady) {
	echo("Error. Cannot connect to the database");
	end;
}

$sql = "DROP TABLE IF EXISTS assets ";
mysql_query($sql);
$sql = "CREATE  TABLE IF NOT EXISTS `assets` (
  `asset_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`asset_id`) )";
mysql_query($sql);

$sql = "DROP TABLE IF EXISTS component_types ";
mysql_query($sql);
$sql="CREATE  TABLE IF NOT EXISTS `component_types` (
  `component_type_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  PRIMARY KEY (`component_type_id`) )
ENGINE = InnoDB;";
mysql_query($sql);

$sql = "DROP TABLE IF EXISTS components ";
mysql_query($sql);
$sql="CREATE  TABLE IF NOT EXISTS `components` (
  `component_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  `asset_id` INT NOT NULL ,
  `component_type_id` INT NOT NULL ,
  PRIMARY KEY (`component_id`) )
ENGINE = InnoDB;";
mysql_query($sql);

$sql = "DROP TABLE IF EXISTS contribution_types  ";
mysql_query($sql);
$sql = "CREATE  TABLE IF NOT EXISTS `contribution_types` (
  `contribution_type_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  PRIMARY KEY (`contribution_type_id`) )
ENGINE = InnoDB;";
mysql_query($sql);

$sql = "DROP TABLE IF EXISTS contributions ";
mysql_query($sql);
$sql = "CREATE  TABLE IF NOT EXISTS `contributions` (
  `contribution_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `asset_id` INT NOT NULL ,
  `contribution_type_id` INT NOT NULL ,
  PRIMARY KEY (`contribution_id`) )
ENGINE = InnoDB;";
mysql_query($sql);

$sql = "DROP TABLE IF EXISTS constraint_types ";
mysql_query($sql);
$sql = "CREATE  TABLE IF NOT EXISTS `constraint_types` (
  `constraint_type_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  PRIMARY KEY (`constraint_type_id`) )
ENGINE = InnoDB;";
mysql_query($sql);

$sql = "DROP TABLE IF EXISTS constraints ";
mysql_query($sql);
$sql = "CREATE  TABLE IF NOT EXISTS `constraints` (
  `constraint_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  `description` TEXT NULL ,
  `constraint_type_id` INT NOT NULL ,
  `components_component_id` INT NOT NULL ,
  `contributions_contribution_id` INT NOT NULL ,
  PRIMARY KEY (`constraint_id`) )
ENGINE = InnoDB;";
mysql_query($sql);

mysql_close($conn);

$configFile  = '<?php'; $configFile.="\n";
$configFile .= '$dbHost = "' . $dbHost . '";'; $configFile.="\n";
$configFile .= '$dbUser = "' . $dbUser . '";'; $configFile.="\n";
$configFile .= '$dbPassword = "' . $dbPassword . '";'; $configFile.="\n";
$configFile .= '$dbDatabase = "' . $dbDatabase . '";'; $configFile.="\n";
$configFile .= '?>'; $configFile.="\n";

$file = fopen('../config.php', "w");
fwrite($file, $configFile);
fclose($file);

$setupMsg = "Ok. All set: <a href='/'>go to site</a>. Or, <a href='../sample.php'>setup sample data</a>";
?>
<html>
<head>
	<title>done</title>
</head>
<body>
	<p><?php echo($setupMsg); ?></p>
</body>
</html>