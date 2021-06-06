<?php
if(!isset($_SESSION)){
    session_start();
}
//Jika Terdapat Sesi Aktif
if(isset($_SESSION['PHPSESSID'])){
    header('location: index.php');
}
$API = "http://35.240.165.229/API/v1/shelter_api.php";
if(!empty($_POST)){
    $data = array(
        "_authType" => $_POST["_authType"],
        "_email" => $_POST["_email"],
        "_password" => $_POST["_password"]
    );
    $json_enc = json_encode($data);
    
    $ch = curl_init($API);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_enc);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    
    $val = json_decode($result);
    
    if($val->response == "success"){
        session_start();
        $_SESSION['mail'] = $val->data->email;
        $_SESSION['currloc'] = $val->data->address;
        $_SESSION['name'] = $val->data->full_name;
        $_SESSION['PHPSESSID'] = $val->data->full_name." - ".$val->data->email;
        echo "<script>if(!alert('Login Berhasil!')){ window.location.replace('index.php'); }</script>";
    }else{
        echo "<script>if(!alert('User Tidak Terdaftar, silahkan Daftar Melalui Aplikasi Kami!')){ window.location.replace('login.php'); }</script>";
    }
    curl_close($ch);
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
                		<h1>Shelter</h1>
                		<p class="description">Being people helper by reveal disaster.</p>
                        <input type="hidden" id="_authType" name="_authType" value="_login">
                		<!-- Input fields -->
                        
                		<div class="form-group">
                			<label for="username">E-Mail:</label>
                			<input type="email" class="form-control username" id="_email" placeholder="Email..." name="_email" required >
                		</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control password" id="_password" placeholder="Password..." name="_password" required>
						</div>
						<button class="btn btn-primary btn-customized" type="submit">Login</button>
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