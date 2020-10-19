<?php
	$userNamesSql = 'SELECT * FROM user';
	$userNamesStatement = $conn->prepare($userNamesSql);
	$userNamesStatement->execute();

	if($userNamesStatement->rowCount() > 0) {
		while($row = $userNamesStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="' .$row['fullName'] . '">' . $row['fullName'] . '</option>';
		}
	}
	$vendorNamesStatement->closeCursor();
?>
