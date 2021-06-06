<?php
if(!isset($_SESSION)){
  session_start();
}
//Jika Terdapat Sesi Aktif
if(!isset($_SESSION['PHPSESSID'])){
  header('location: login.php');
}
?>

<!doctype html>
<html lang="en" class="h-100">

    <head>

		<!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>Login | Shelter Feedback</title>

        <!-- CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,600">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">

    </head>
    <body class="h-100">
    	<div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-10 col-md-8 col-lg-6">
					<!-- Form -->
                	<form class="form-example" method="POST" action="login.php">
                		<h1>Shelter Feedback Form</h1>
                		<p class="description">Being people helper by reveal disaster.</p>
                    <input type="hidden" id="_authType" name="_authType" value="_login">
                		
                    <!-- Input fields -->
                		<div class="form-group">
                			<input type="text" class="form-control" placeholder="E-Mail" readonly value="<?= $_SESSION['PHPSESSID'] ?>">
                		</div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">State</label>
                      </div>
                      <select class="custom-select" id="inputGroupSelect01">
                        <option selected>Choose...</option>
                        <option value="Feedback">Feedback</option>
                        <option value="Floods">Floods</option>
                        <option value="Earthquake">Earthquake</option>
                        <option value="Avalanche">Avalanche</option>
                        <option value="Forest fires">Forest fires</option>
                      </select>
                    </div>

                    <div class="input-group  mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Message</span>
                      </div>
                      <textarea class="form-control" aria-label="With textarea" style="height: 200px"></textarea>
                    </div>

                    <div class="input-group mb-4">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02">
                        <label class="custom-file-label" for="inputGroupFile02">Choose Picture</label>
                      </div>
                    </div>
						        
                    <button class="btn btn-success" type="submit">Lapor</button>
                    <button class="btn btn-danger"><a href="logout.php" >Logout</a></button>
                		<!-- End input fields -->
                		<p class="copyright">&copy; Team ID: B21-CAP0111</p>
                	</form>
					<!-- Form end -->
                </div>
            </div>
        </div>
		<!-- Javascript -->
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/jquery-migrate-3.0.0.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>
