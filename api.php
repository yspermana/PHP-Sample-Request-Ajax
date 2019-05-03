<?php 

$conn = mysqli_connect('localhost', 'root', '', 'sample_guestbook');

if (!$conn) {
	die('Cannot connect to DB');
}

switch ($_GET['act']) {

	case 'save':

		$res['status'] = 0;
		
		$name 		= $_POST['name'];
		$phone 		= $_POST['phone'];
		$email 		= $_POST['email'];
		$address 	= $_POST['address'];

		$sql = "INSERT INTO guest VALUES('', '$name', '$phone', '$email', '$address')";

		$query = mysqli_query($conn, $sql);

		if ($query) {
			$res['status'] = 1;
		}

		echo json_encode($res);

		break;
	
	case 'list':
		
		$sql 	= "SELECT * FROM guest";
		$query 	= mysqli_query($conn, $sql);
		$data 	= "";
		$no 	= 1;

		if (mysqli_num_rows($query) > 0) {
			
			while ($row = mysqli_fetch_array($query)) {

				$data .= "
				<tr>
					<td>". $no ."</td>
					<td>". $row['name'] ."</td>
					<td>". $row['phone'] ."</td>
					<td>". $row['email'] ."</td>
					<td>". $row['address'] ."</td>
				</tr>
				";

				$no++;

			}

		}
		else{
			$data .= "<tr><td colspan='5' align='center'>Tamu belum tersedia</td></tr>";
		}

		echo $data;

		break;
}

?>