<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['userDetailsUserID'])){

		$userID = htmlentities($_POST['userDetailsUserID']);

		$userDetailsSql = 'SELECT * FROM user WHERE userID = :userID';
		$userDetailsStatement = $conn->prepare($userDetailsSql);
		$userDetailsStatement->execute(['userID' => $userID]);

		// If data is found for the given vendorID, return it as a json object
		if($userDetailsStatement->rowCount() > 0) {
			$row = $userDetailsStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($row);
		}
		$userDetailsStatement->closeCursor();
	}
?>
