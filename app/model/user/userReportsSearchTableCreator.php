<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');

	$vendorDetailsSearchSql = 'SELECT * FROM user';
	$vendorDetailsSearchStatement = $conn->prepare($vendorDetailsSearchSql);
	$vendorDetailsSearchStatement->execute();

	$output = '<table id="vendorReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>User ID</th>
						<th>Full Name</th>
						<th>Username</th>
						<th>Role</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>';

	// Create table rows from the selected data
	while($row = $vendorDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		$output .= '<tr>' .
		'<td>' . $row['userID'] . '</td>' .
		'<td>' . $row['fullName'] . '</td>' .
		'<td>' . $row['username'] . '</td>' .
		'<td>' . $row['role'] . '</td>' .
		'<td>' . $row['status'] . '</td>' .
					'</tr>';
	}

	$vendorDetailsSearchStatement->closeCursor();

	$output .= '</tbody>
					<tfoot>
						<tr>
						<th>User ID</th>
						<th>Full Name</th>
						<th>Username</th>
						<th>Role</th>
						<th>Status</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>
