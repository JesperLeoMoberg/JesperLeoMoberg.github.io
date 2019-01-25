<?php

/*

EDIT.PHP

Allows user to edit specific entry in database

*/



// creates the edit record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($id, $ltd, $navn, $billedeurl, $mv, $red, $timestamp, $error)

{

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>H2VALUES - Rediger</title>

<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="shortcut icon" href="https://values.peace.wtf/resources/images/favicon.ico" type="image/vnd.microsoft.icon">
<link href="../css/homepage.css" rel="stylesheet" type="text/css">
<link href="../css/edited.css" rel="stylesheet" type="text/css">

</head>

<body>
    <!-- Navigation -->
	<nav id="mainNav" class="navbar navbar-default navbar-fixed-top" data-spy="affix" data-offset-top="100">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><img src="../images/h2val_logo.png"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="../">Prisliste</a>
                    </li>
                    <li>
                        <a href="../ansatte">Ansatte</a>
                    </li>
                    <li>
                        <a href="https://Habbo2.dk/" class="new-button green-button" target="_blank"><img src="../images/til_hotel.png"></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

<div class="container">

<div class='panel panel-info'>

<div class='panel-heading'>

<h3 class='panel-title'>Rediger Møbler:</h3>

</div>

<div class='panel-body'>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>

<table class='table table-hover'>

<tbody class='topBoxes'>

<form action="" method="post">

<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<div>
<tr>
<td><strong>ID:</strong></td><td><?php echo $id; ?></td>
<td></td>
</tr>
<tr>
<td><strong>LTD: *</strong><br /><span style="font-size:80%; color:gray;">0 = Ikke en LTD. ~ 1 = En LTD.</span></td>
<td class="col-sm-6"><input type="number" min="0" max="1" class="form-control trans-input" name="ltd" value="<?php echo $ltd; ?>" /></td>
</tr>
<tr>
<td><strong>Navn: *</strong></td>
<td><input type="text" class="form-control trans-input" name="navn" value="<?php echo $navn; ?>" /></td>
</tr>
<tr>
<td><strong>Billede URL: *</strong></td>
<td><input type="text" class="form-control trans-input" name="billedeurl" value="<?php echo $billedeurl; ?>" /><img src="../<?php echo $billedeurl; ?>"></td>
</tr>
<tr>
<td><strong>Mønt Værdi: *</strong></td>
<td><input type="number" class="form-control trans-input" name="mv" value="<?php echo $mv; ?>" /></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" class="btn btn-primary" value="Gem"></td>
</tr>

</div>

</form>

</div>

</div>

</div>

</body>

</html>

<?php

}







// connect to the database

include('connect-db.php');



// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['id']))

{

// get form data, making sure it is valid

$id = $_POST['id'];

$ltd = mysql_real_escape_string(htmlspecialchars($_POST['ltd']));

$navn = mysql_real_escape_string(htmlspecialchars($_POST['navn']));

$billedeurl = mysql_real_escape_string(htmlspecialchars($_POST['billedeurl']));

$mv = mysql_real_escape_string(htmlspecialchars($_POST['mv']));



// check that firstname/lastname fields are both filled in

if ($ltd == '' || $navn == ''|| $billedeurl == ''|| $mv == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';

//error, display form

renderForm($id, $ltd, $navn, $billedeurl, $mv, $red, $timestamp, $error);

}

else

{

$resultmv = mysql_query("SELECT mv FROM prisliste WHERE id=$id");
if ($_POST['mv'] > $resultmv) {
	$red = 'Op';
}
elseif ($_POST['mv'] < $resultmv) {
	$red = 'Ned';
}
else {
	$red = '';
};

$timestamp = time();

// save the data to the database

mysql_query("UPDATE prisliste SET ltd='$ltd', navn='$navn', billedeurl='$billedeurl', mv='$mv', red='$red', timestamp='$timestamp' WHERE id = '$id'")

or die(mysql_error());



// once saved, redirect back to the view page

header("Location: index");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the db and display the form

{



// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

{

// query db

$id = $_GET['id'];

$result = mysql_query("SELECT * FROM prisliste WHERE id=$id")

or die(mysql_error());

$row = mysql_fetch_array($result);



// check that the 'id' matches up with a row in the databse

if($row)

{



// get data from db

$ltd = $row['ltd'];

$navn = $row['navn'];

$billedeurl = $row['billedeurl'];

$mv = $row['mv'];

$red =  $row['red'];

$timestamp = $row['timestamp'];

// show form

renderForm($id, $ltd, $navn, $billedeurl, $mv, $red, $timestamp, '');

}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}

?>