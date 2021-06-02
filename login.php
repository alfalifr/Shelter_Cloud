<?php
include 'config/dbConnection.php';
if(!isset($_SESSION)){
    session_start();
}
  
//Jika Terdapat Sesi Aktif
if(isset($_SESSION['PHPSESSID'])){
    header('location: index.php');
}

if(isset($_POST['login'])){
    $usr = $_POST['_email'];
    $pwd = $_POST['_password'];

    //Cek Data
    $qry = "SELECT * FROM user_auth WHERE _email='$usr' AND _passwd='$pwd' ";
    $tmp =  $conn -> query($qry);
    $data = $tmp -> fetch_array();

    //Kondisi
    if($usr == $data['_email'] && $pwd == $data['_passwd']){
        $_SESSION['mail'] = $data['_email'];
        $_SESSION['currloc'] = $data['_addr'];
        $_SESSION['name'] = $data['_fname'];
        $_SESSION['PHPSESSID'] = $data['_fname']." - ".$data['_email'];
        //header('location: index.php');
        echo "<script>if(!alert('Login Berhasil!')){ window.location.replace('index.php'); }</script>";
    }else{
      //Nampilin Info Salah
      
      echo "<script>if(!alert('User Tidak Terdaftar, silahkan Daftar Melalui Aplikasi Kami!')){ window.location.replace('login.php'); }</script>";
      
    }
}else{ ?>
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
                	<form class="form-example" method="post">
                		<h1>Shelter</h1>
                		<p class="description">Being people helper by reveal disaster.</p>
                		<!-- Input fields -->
                		<div class="form-group">
                			<label for="username">E-Mail:</label>
                			<input type="text" class="form-control username" id="username" placeholder="E-Mail" name="_email" autocomplete="off">
                		</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control password" id="password" placeholder="Password..." name="_password" autocomplete="off">
						</div>
						<button class="btn btn-primary btn-customized" type="submit" name="login">Login</button>
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

<?php } ?>
