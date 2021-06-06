<?php
if(!isset($_SESSION)){
  session_start();
}
//Jika Terdapat Sesi Aktif
if(!isset($_SESSION['PHPSESSID'])){
  header('location: login.php');
}
$IMGUR = "https://api.imgur.com/3/upload";
$API = "http://35.240.165.229/API/v1/shelter_api.php";
if(!empty($_POST)){
  $img=$_FILES['img'];
  $filename = $img['tmp_name'];
  $client_id="e6392bda16ff035";
  $handle = fopen($filename, "r");
  $data = fread($handle, filesize($filename));
  $pvars   = array('image' => base64_encode($data));
  $timeout = 30;
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
  curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
  $out = curl_exec($curl);
  curl_close ($curl);
  $pms = json_decode($out,true);
  $url=$pms['data']['link'];




  $data = array(
    "_feedback" => true,
    "from" => $_POST["userreport"],
    "type" => $_POST["state"],
    "msg" => $_POST["message"],
    "imglink" => $url
  );
  $json_enc = json_encode($data);
    
  $ch = curl_init($API);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json_enc);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_exec($ch);
  echo "<script>if(!alert('Laporan Anda Terkirim')){ window.location.replace('index.php'); }</script>";
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
                	<form class="form-example" method="POST" action="index.php" enctype="multipart/form-data">
                		<h1>Shelter Feedback Form</h1>
                		<p class="description">Being people helper by reveal disaster.</p>
                		
                    <!-- Input fields -->
                		<div class="form-group">
                			<input type="text" class="form-control" name="userreport" placeholder="E-Mail" readonly value="<?= $_SESSION['PHPSESSID'] ?>">
                		</div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">State</label>
                      </div>
                      <select class="custom-select" id="inputGroupSelect01" name="state" required>
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
                      <textarea class="form-control" aria-label="With textarea" style="height: 200px" name="message" required></textarea>
                    </div>

                    <div class="input-group mb-4">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="img" required>
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
