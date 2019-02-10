<?php
$uname = "";
if( isset($_POST['uname'])) $uname = $_POST['uname'];
if( isset($_GET['uname'])) $uname = $_GET['uname'];
if( $uname == ""){
	header('location: login.php');
	exit();
}
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "mydata";
// print_r($uname);
// exit();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// echo "Connected successfully";

$sql = 'SELECT id FROM user WHERE username="' . $uname . '"';
$result = $conn->query($sql);
// print_r($sql);
// echo "<br>";
// print_r($result);
// echo "<br>";
if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    $userId = $row['id'];
    // print_r($row);
    // exit();
} else {
	$sql1 = "INSERT INTO user(username) VALUES ('" . $uname . "')";
	// print_r($sql1);
	// exit();
	if ($conn->query($sql1) === TRUE) {
	    $result = $conn->query($sql);
	    if( $result->num_rows > 0){
	    	$row = $result->fetch_assoc();
	    	$userId = $row['id'];
	    }
	} else {
	    $conn->close();
	    header('location: login.php');
	    exit();
	}
}
$conn->close();
?>
<script type="text/javascript">
	function setCookie(cname, cvalue, exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires="+ d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	var userId = "<?=$userId?>";
	setCookie('messageUserId', userId, 1);
	// alert(userId);
	document.location.href = "text.html";
</script>