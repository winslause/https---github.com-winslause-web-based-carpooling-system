<?php
session_start();
include('includes/config.php');
error_reporting(0);
?>
<?php
if (isset($_POST['submit'])) {
	$phone = $_POST['phoneNumber'];
	$email = $_SESSION['login'];
	$code = $_POST['code'];
	$sql = "INSERT INTO  tblpay(UserEmail,phone,code) VALUES(:email,:phone,:code)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':phone', $phone, PDO::PARAM_STR);
	$query->bindParam(':code', $code, PDO::PARAM_STR);
	$query->bindParam(':email', $email, PDO::PARAM_STR);

	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	if ($lastInsertId) {
		$msg = "Payment details saved successfully";
		echo "<script>alert('MPESA PAYMENT DETAILS SAVED SUCCESSFULLY.');</script>";
	} else {
		$error = "Something went wrong. Please try again";
		echo $error;
	}
}
?>

<html>

<head>
	<title>make payment</title>
	<!--Bootstrap -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
	<link rel="stylesheet" href="assets/css/style.css" type="text/css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
	<link href="assets/css/slick.css" rel="stylesheet">
	<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
</head>

<body style="background-color: #008b8b;">





	<center>
		<h2>Pay Booking</h2>
	</center>
	<center>
		<iframe width="400" height="250" src="otherpay.php" frameborder="2" style="margin: left 10px; background-color:white"></iframe>
		<br>
		<br>
		<br>

		<form action="" method="post" style="color:white;">
			<h4>Save Payment Details</h4>

			<strong>Phone Number:</strong><br>
			<input style="color:black;" class="form-group" type="text" name="phoneNumber" placeholder="phone">
			<br>
			<strong>MPESA Message</strong>:<br>
			<br>
			<textarea rows="4" cols="40" style="color:black;" class="form-group" type="text" name="code" placeholder="Pate your mpesa message here"></textarea>
			<br>

			<br><br>
			<input class="btn btn-primary" name="submit" type="submit" value="Confirm Payment" onclick="callAPI()">
			<br>

		</form>

		<a href="my-booking.php" class="btn btn-secondary">See your Bookings</a>
	</center>





	<script>
		function callAPI() {
			// call the API here
			var amount = document.querySelector('input[name="amount"]').value;
			var phoneNumber = document.querySelector('input[name="phoneNumber"]').value;
			var shortCode = document.querySelector('input[name="shortCode"]').value;
			var mpesaSecret = document.querySelector('input[name="mpesaSecret"]').value;

			var timestamp = Date.now();

			var password = btoa(shortCode + mpesaSecret + timestamp);

			var endpoint = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

			var data = {
				//Fill in the request parameters with valid values
				'BusinessShortCode': shortCode,
				'Password': password,
				'Timestamp': timestamp,
				'TransactionType': 'CustomerPayBillOnline',
				'Amount': amount,
				'PartyA': phoneNumber,
				'PartyB': shortCode,
				'PhoneNumber': phoneNumber,
				'CallBackURL': 'http://example.com/callback.php',
				'AccountReference': '12345678',
				'TransactionDesc': 'Test Payment'
			};

			fetch(endpoint, {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
						'Authorization': 'Bearer ' + access_token
					},
					body: JSON.stringify(data)
				})
				.then(response => {
					// handle response
				})
				.catch(err => {
					// handle error
				});
		}
	</script>

</body>

</html>