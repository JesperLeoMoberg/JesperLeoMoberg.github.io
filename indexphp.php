<?php
ob_start();
 session_start();
 if( isset($_SESSION['user'])!="" ){
  header("Location: index.php");
 }
 include_once 'connect-db.php';

 $error = false;

 if ( isset($_POST['submit-register']) ) {

  // clean user inputs to prevent sql injections
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  $login = trim($_POST['login']);
  $login = strip_tags($login);
  $login = htmlspecialchars($login);
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  $password = trim($_POST['password']);
  $password = strip_tags($password);
  $password = htmlspecialchars($password);
  $day = trim($_POST['day']);
  $day = strip_tags($day);
  $day = htmlspecialchars($day);
  $month = trim($_POST['month']);
  $month = strip_tags($month);
  $month = htmlspecialchars($month);
  $year = trim($_POST['year']);
  $year = strip_tags($year);
  $year = htmlspecialchars($year);

  // basic name validation
  if (empty($name)) {
   $error = true;
   $nameError = "Please enter your full name.";
  } else if (strlen($name) < 3) {
   $error = true;
   $nameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
   $error = true;
   $nameError = "Name must contain alphabets and space.";
  }

  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check email exist or not
   $query = "SELECT email FROM main WHERE email='$email'";
   $result = mysqli_query($query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($password)){
   $error = true;
   $passError = "Please enter password.";
 } else if(strlen($password) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
  // password encrypt using SHA256();
  $passwordEnc = hash('sha256', $password);
  // if there's no error, continue to signup
  if( !$error ) {
   $query = "INSERT INTO main(name,nick,email,pwd,day,month,year) VALUES('$name','$login','$email','$passwordEnc','$day','$month','$year')";
   $res = mysqli_query($query);
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later...";
   }
  }
 }
?>
<html>
  <head>
    <title>Gswipe - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="images/favicon.ico" rel="shortcut icon">
    <!-- Install Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <!-- Install Javascripts -->
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
    <!-- Front -->
    <section id="gswipe-front" class="front">
      <div class="front-container">
        <button class="btn btn-login animated-button sandy-two" onclick="showLogin()">Login</button>
        <button class="btn btn-register animated-button sandy-two" onclick="showRegister()">Register</button>
      </div>
    </section>
    <!-- /Front -->
    <!-- Login -->
    <section id="gswipe-login">
      <div class="login-container">
        <form name="login" method="post">
          <div class="form-group customInput">
            <input type="login" class="form-control input-log" id="login" placeholder="LOGIN">
          </div>
          <div class="form-group">
            <input type="password" class="form-control input-pwd" id="pwd" placeholder="PASSWORD">
          </div>
          <div class="form-group">
            <input type="checkbox" id="check-remember"/>
            <label for="check-remember"><span>Remember Me</span></label>
          </div>
          <!--
          <div class="form-group">
            <label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <span class="custom-control-indicator"></span>
              <span class="custom-control-description">Remember me</span>
            </label>
          </div>
          -->
          <button type="submit" name="login-submit" class="btn btn-login">Login</button>
        </form>
        <button type="none" class="btn btn-register" onclick="showRegister()">Register</button>
        <button type="none" class="btn btn-back" onclick="showFront()">Back</button>
      </div>
    </section>
    <!-- /Login -->
    <!-- Register -->
    <section id="gswipe-register">
      <div class="register-container">
        <form name="register" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
          <div class="form-group">
            <input type="name" name="name" class="form-control" id="name-reg" placeholder="FULL NAME">
          </div>
          <div class="form-group">
            <input type="login" name="login" class="form-control" id="login-reg" placeholder="LOGIN">
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" id="email-reg" placeholder="EMAIL">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="PASSWORD">
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control" id="pwd-reg" placeholder="CONFIRM PASSWORD">
          </div>
          <div class="input-group">
            <input type="number" name="day" class="form-control" id="day-reg" placeholder="DAY">
            <select class="form-control" name="month" id="month-reg">
              <option selected disabled>MONTH</option>
              <option value="01">JAN</option>
              <option value="02">FEB</option>
              <option value="03">MAR</option>
              <option value="04">APR</option>
              <option value="05">MAY</option>
              <option value="06">JUN</option>
              <option value="07">JUL</option>
              <option value="08">AUG</option>
              <option value="09">SEP</option>
              <option value="10">OCT</option>
              <option value="11">NOV</option>
              <option value="12">DEC</option>
            </select>
            <input type="number" name="year" class="form-control" id="year-reg" placeholder="YEAR">
          </div>
          <button type="submit" name="register-submit" class="btn btn-register">Register</button>
        </form>
        <button class="btn btn-back" onclick="showFront()">Back</button>
      </div>
    </section>
    <!-- /Register -->
  </body>
</html>
<?php ob_end_flush(); ?>
