<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup page</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="./build/css/demo.css" rel="stylesheet">
    <link href="./build/css/intlTelInput.css" rel="stylesheet">
</head>
	<style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            text-decoration: none;
            list-style: none;
            font-family: 'Montserrat', sans-serif;
        }

        :root {
            --bg-color: #1d1e23;
            --main-color: #a6bbcc;
            --text-color: #fff;
            --h1-font: 5.6rem;
            --h2-font: 3.7rem;
            --p-font: 1rem;
        }

        body {
            background-color: var(--bg-color);
            scroll-behavior: smooth;
			color: black;
        }

		.signup {
			color: var(--bg-color);
		}

		.back-btn {
            color: var(--main-color);
            text-decoration: none;
            font-size: 1.2rem;
            margin-bottom: 20px;
            display: inline-block;
        }


		.container {
			margin-top: -50px;
        }

		.card-header {
			background-color: var(--main-color);
		}

		.card-body {
			background-color: var(--main-color);
		}

		.btn-block {
			background-color: var(--bg-color);
			border: 2px solid var(--bg-color);
			margin-top: 30px;
		}

		.btn-block:hover {
			background-color: #36393f;
			border: 2px solid var(--bg-color);
		}

		.btn-outline-primary {
			background-color: var(--bg-color);
			border: 2px solid var(--bg-color);
			color: white;
		}

		.btn-outline-primary:hover {
			background-color: #36393f;
			border: 2px solid var(--bg-color);
			color: white;
		}

		.already-signed-up {
			margin-top: 20px;
		}
    </style>
<body>
	<div class="container">
	<br><br>
	<div class="row justify-content-center">
	<div class="col-md-6">
	<div class="card">
	<header class="card-header">
		<a href="login.php" class="float-right btn btn-outline-primary mt-1">Log in</a>
		<h4 class="card-title mt-2 signup">Sign up</h4>
	</header>
	<article class="card-body">
	<form action="register.php" method="post">
	<?php
		require_once "database.php";
		
		if (isset($_POST["submit"])) {
			$firstname = $_POST["firstname"];
			$lastname = $_POST["lastname"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$repeatpassword = $_POST["repeatpassword"];
			$lot_blk = $_POST["lot_blk"];
			$street = $_POST["street"];
			$phase_subdivision = $_POST["phase_subdivision"];
			$barangay = $_POST["barangay"];
			$province = $_POST["province"];
			$city_municipality = $_POST["city_municipality"];
			$country = $_POST["country"];
			$phone = $_POST["phone"];

			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			$errors = array();

			if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($repeatpassword)|| empty($lot_blk) || empty($street) || empty($phase_subdivision) || empty($barangay) || empty($province) || empty($city_municipality) || empty($country) || empty($phone)) {
				array_push($errors, "All fields are required");
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, "Email is not valid");
			}
			if (strlen($password) < 8) {
				array_push($errors, "Password must be at least 8 characters long");
			}
			if ($password !== $repeatpassword) {
				array_push($errors, "Password does not match");
			}

			// Use prepared statements for email check
			$sqlCheckEmail = "SELECT * FROM account_details_tbl WHERE email = ?";
			$stmtCheckEmail = mysqli_stmt_init($conn);

			if (mysqli_stmt_prepare($stmtCheckEmail, $sqlCheckEmail)) {
				mysqli_stmt_bind_param($stmtCheckEmail, "s", $email);
				mysqli_stmt_execute($stmtCheckEmail);
				$resultCheckEmail = mysqli_stmt_get_result($stmtCheckEmail);

				if (mysqli_num_rows($resultCheckEmail) > 0) {
					array_push($errors, "Email already exists!");
				}
			} else {
				die("Error in preparing SQL statement to check email");
			}

			if (count($errors) > 0) {
				foreach ($errors as  $error) {
					echo "<div class='alert alert-danger'>$error</div>";
				}
			} else {
				// Use prepared statements for insert
				$sqlInsertInfo = "INSERT INTO account_details_tbl (firstname, lastname, email, password, blk_lot, street, phase_subdivision, barangay, city_municipality, province, country, contact_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$stmtInsertInfo = mysqli_stmt_init($conn);

				if (mysqli_stmt_prepare($stmtInsertInfo, $sqlInsertInfo)) {
					mysqli_stmt_bind_param($stmtInsertInfo, "ssssssssssss", $firstname, $lastname, $email, $hashed_password, $lot_blk, $street, $phase_subdivision, $barangay, $city_municipality, $province, $country, $phone);
					mysqli_stmt_execute($stmtInsertInfo);
					echo "<div class='alert alert-success'>You are registered successfully.</div>";
				} else {
					die("Error in preparing SQL statement to insert user account");
				}
			}
		}
		?>
		<div class="form-row">
			<div class="col form-group">
				<label>First name </label>   
				<input type="text" name="firstname" class="form-control" placeholder="" required>
			</div> <!-- form-group end.// -->
			<div class="col form-group">
				<label>Last name</label>
				<input type="text" name="lastname" class="form-control" placeholder=" " required>
			</div> <!-- form-group end.// -->
		</div> <!-- form-row end.// -->


		<div class="form-group">
		<label for="email">Email address</label>
		<input type="email" name="email" class="form-control" placeholder="" id="email" required>
		<small class="form-text text-muted">We'll never share your email with anyone else.</small>
		</div> <!-- form-group end.// -->

		<div class="form-row">
            <div class="col form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="col form-group">
                <label>Repeat Password</label>
                <input type="password" class="form-control" name="repeatpassword" required>
            </div>
        </div>
		

		<div class="form-group">
			<label for="country">Country</label>
			<select name="country" class="form-control country" onchange="loadStates()" id="country">
				<option value="" disabled selected>Select Country</option>
			</select>
		</div> <!-- form-group end.// -->

		<!--provice and city-->
		<div class="form-row">
			<div class="col form-group">
				<label for="province">States</label>
				<select name="province" class="form-control state" onchange="loadCities()" id="province" required>
					<option value="" disabled selected>Select Province</option>
				</select>
			</div> <!-- form-group end.// -->
			<div class="col form-group">
				<label for="city_municipality">City/Municipality</label>
				<select name="city_municipality" class="form-control city" id="city_municipality" required>
					<option value="" disabled selected>Select City/Municipality</option>
				</select>
			</div> <!-- form-group end.// -->
		</div>

		<!--lot/blk and street-->
		<div class="form-row" >
			<div class="col form-group" id="#lot_blk">
				<label for="lot_blk">Lot/Blk</label>   
				<input type="text" name="lot_blk" class="form-control" placeholder="" id="lot_blk" required>
			</div> <!-- form-group end.// -->
		
			<div class="col form-group" id="#street">
				<label for="street">Street</label>
				<input type="text" name="street" class="form-control" placeholder=" " id="street" required>
			</div> <!-- form-group end.// -->
		</div> <!-- form-row end.// -->

		<!--phase/subdivision and barangay-->
		<div class="form-row ">
			<div class="col form-group" id="#phase_subdivision">
				<label for="phase_subdivision">Phase/Subdivision</label>   
				<input type="text" name="phase_subdivision" class="form-control" placeholder="" id="phase_subdivision" required>
			</div> <!-- form-group end.// -->
		</div> <!-- form-row end.// -->

		<div class="form-row">
			<div class="col form-group" id="#barangay">
			<label for="barangay">Barangay</label>   
				<input type="text" name="barangay" class="form-control" placeholder="" required>
			</div> <!-- form-group end.// -->
		</div>

	
		<div class="form-group">
			<input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required maxlength="20">
		</div>

		<div class="form-btn">
			<input type="submit" class="btn btn-primary btn-block" value="Register" name="submit">
		</div> <!-- form-group// -->  
		
		<div class="already-signed-up">
            <p>Go back? <a href="index.php">Click Here</a></p>
        </div>
	</form>
	</article> <!-- card-body end .// -->
	</div> <!-- card.// -->
	</div> <!-- col.//-->
	</div> <!-- row.//-->
	</div> 
<!--container end.//-->
	<br><br>
		<script src="app.js"></script>
		<script src="./build/js/intlTelInput.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				var input = document.querySelector("#phone");
				var iti = window.intlTelInput(input, {
					utilsScript: "./build/js/utils.js", 
					separateDialCode: true,         
				});

				// Event listener for handling changes in the input
				input.addEventListener("change", function() {
					// Check if the input value already contains the dial code
					if (!input.value.startsWith('+')) {
						var selectedCountryData = iti.getSelectedCountryData();
						var countryCode = selectedCountryData.dialCode;

						// Remove leading zeros
						input.value = input.value.replace(/^0+/, '');

						// Add the dial code only if it's not already present
						input.value = '+' + countryCode + input.value;
					}
				});
			});
		</script>
</body>
</html>




