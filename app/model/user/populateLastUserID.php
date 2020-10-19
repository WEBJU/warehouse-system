<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');

	$sql = "SELECT MAX(userID) FROM user";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	echo $row['MAX(userID)'];
	$stmt->closeCursor();
?>
