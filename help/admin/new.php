<?php

/*

NEW.PHP

Allows user to create a new entry in the database

*/



// creates the new record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($ltd, $navn,$billedeurl,$mv, $error)

{

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>

<head>

<title>H2VALUES - Nyt</title>

<link href="../css/homepage.css" rel="stylesheet" type="text/css">
<link href="../css/edited.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../css/bootstrap.min.css">

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

<div class="row">

<div class="col-sm-12">

<div class="panel panel-success">

<div class="panel-heading">

<h3 class="panel-title">Tilføj et møbel:</h3>

</div>

<div class="panel-body">			
		
<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>



<form action="" method="post">

<table class="table table-hover" style="margin-bottom: 0;">

<tbody class="topBoxes">	

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
<td><input type="text" class="form-control trans-input" name="billedeurl" value="<?php echo $billedeurl; ?>" /></td>
</tr>
<tr>
<td><strong>Mønt Værdi: *</strong></td>
<td><input type="number" class="form-control trans-input" name="mv" value="<?php echo $mv; ?>" /></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" class="btn btn-primary" value="Tilføj"></td>
</tr>

</tbody>

</tbody>

</form>

</table>

</div>

</div>

<div class="col-sm-6">

<div class="panel panel-success">

<div class="panel-heading">

<h3 class="panel-title">Liste af Billede URLs:</h3>

</div>

<div class="panel-body">

<table class="table table-hover" style="margin-bottom: 0;">

<tbody class="topBoxes">

<?php
if ($handle = opendir('../images/furni/'))
	{	
		while (false !== ($file = readdir($handle)))
		{
			if ($file == '.' || $file == '..')
			{
				continue;
			}	
	
			echo '<tr><td col-sm-2><img src="../images/furni/' . $file . '"></td><td class="col-sm-4"';
			
			echo '>' . $file . '</td></tr>';
		}
	}
?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

</body>

</html>

<?php

}









// connect to the database

include('connect-db.php');



// check if the form has been submitted. If it has, start to process the form and save it to the database

if (isset($_POST['submit']))

{

// get form data, making sure it is valid

$ltd = mysql_real_escape_string(htmlspecialchars($_POST['ltd']));

$navn = mysql_real_escape_string(htmlspecialchars($_POST['navn']));

$billedeurl = mysql_real_escape_string(htmlspecialchars($_POST['billedeurl']));

$mv = mysql_real_escape_string(htmlspecialchars($_POST['mv']));

$billedeurlfin = 'images/furni/' . $billedeurl;

// check to make sure both fields are entered

if ($ltd == '' || $navn == '' || $billedeurl == '' || $mv == '')

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



// if either field is blank, display the form again

renderForm($ltd, $navn,$billedeurl,$mv, $error);

}

else

{

// save the data to the database

mysql_query("INSERT prisliste SET ltd='$ltd', navn='$navn', billedeurl='$billedeurlfin', mv='$mv'")

or die(mysql_error());



// once saved, redirect back to the view page

header("Location: index");

}

}

else

// if the form hasn't been submitted, display the form

{

renderForm('','','','','');

}

?>