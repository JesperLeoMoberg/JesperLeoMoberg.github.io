<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Habbo2.dk's Officielle Prisliste</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="shortcut icon" href="https://values.peace.wtf/resources/images/favicon.ico" type="image/vnd.microsoft.icon">
		<link href="css/homepage.css" rel="stylesheet" type="text/css">
		<link href="css/edited.css" rel="stylesheet" type="text/css">
		<!--[if lt IE 9]>
					<script src="https://values.peace.wtf/resources/scripts/html5shiv.js"></script>
					<script src="https://values.peace.wtf/resources/scripts/respond.min.js"></script>
				<![endif]-->
		<meta name="google" content="notranslate">
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
                <a class="navbar-brand page-scroll" href="#page-top"><img src="images/h2val_logo.png"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="selected">Prisliste</a>
                    </li>
                    <li>
                        <a href="/ansatte">Ansatte</a>
                    </li>
                    <li>
                        <a href="https://Habbo2.dk/" class="new-button green-button" target="_blank"><img src="images/til_hotel.png"></a>
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
					<div class="row">
						<div class="col-sm-6">
						<?php
								/*
								VIEW.PHP
								Displays all data from 'players' table
								*/
								// connect to the database
								include('connect-db.php');
								// get results from database
								$result = mysqli_query($con, "SELECT * FROM ( SELECT * FROM prisliste ORDER BY id DESC LIMIT 3 ) sub ORDER BY id DESC");
								// display data in table
								echo "<div class='panel panel-success'>
											<div class='panel-heading'>
												<h3 class='panel-title'>Nyligt Tilføjet</h3>
											</div>
											<div class='panel-body'>
												<table class='table table-hover'>
													<tbody class='topBoxes'>";
								// loop through results of database query, displaying them in the table
								while($row = mysqli_fetch_array( $result )) {
								$id = $row['id'];
								$ltd = $row['ltd'];
								$navn = $row['navn'];
								$billedeurl = $row['billedeurl'];
								$mv = $row['mv'];
								$cv = ($mv) / 5;
								$red = $row['red'];
								// echo out the contents of each row into a table
								echo "<tr>";
								if ($ltd == 1) {
									echo '<td class="ltdrare col-sm-1"><img src="images/ltd.png" class="tip img-responsive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Limited Edition"></td>';
								};
								if ($ltd == 0) {
									echo '<td class="tdrare col-sm-1"></td>';
								};
								echo '<td style="width: 60px;" class="col-sm-1"><img src="' . $billedeurl . '" class="tip img-responsive" data-toggle="tooltip" data-placement="top" title="" data-original-title="' . $navn . '"></td>';
								echo '<td class="col-sm-6">' . $mv . '<img src="images/møntz2.png" class="tip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Møntz"></td>';
								echo '<td class="col-sm-3">' . $cv . '<img src="images/hc_sofa.png" class="tip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Club(s)"></td>';
								echo "</tr>";
								}
								echo "</tbody></table></div></div>";
							?>
						</div>
						<div class="col-sm-6">
							<?php
								/*
								VIEW.PHP
								Displays all data from 'players' table
								*/
								// connect to the database
								include('connect-db.php');
								// get results from database
								$result = mysqli_query($con, "SELECT * FROM ( SELECT * FROM prisliste ORDER BY timestamp DESC LIMIT 3 ) sub ORDER BY id DESC");
								// display data in table
								echo "<div class='panel panel-warning'>
											<div class='panel-heading'>
												<h3 class='panel-title'>Seneste ændringer</h3>
											</div>
											<div class='panel-body'>
												<table class='table table-hover'>
													<tbody class='topBoxes'>";
								// loop through results of database query, displaying them in the table
								while($row = mysqli_fetch_array( $result )) {
								$id = $row['id'];
								$ltd = $row['ltd'];
								$navn = $row['navn'];
								$billedeurl = $row['billedeurl'];
								$mv = $row['mv'];
								$cv = ($mv) / 5;
								$red = $row['red'];
								// echo out the contents of each row into a table
								echo "<tr>";
								if ($ltd == 1) {
									echo '<td class="ltdrare col-sm-1"><img src="images/ltd.png" class="tip img-responsive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Limited Edition"></td>';
								};
								if ($ltd == 0) {
									echo '<td class="tdrare col-sm-1"></td>';
								};
								echo '<td style="width: 60px;" class="col-sm-1"><img src="' . $billedeurl . '" class="tip img-responsive" data-toggle="tooltip" data-placement="top" title="" data-original-title="' . $navn . '"></td>';
								echo '<td class="col-sm-3">' . $mv . '<img src="images/møntz2.png" class="tip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Møntz"></td>';
								echo '<td class="col-sm-3">' . $cv . '<img src="images/hc_sofa.png" class="tip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Club(s)"></td>';
								echo '<td class="col-sm-1">';
									if (!$red == '') {
										echo '<span class="label label-'; if ($red == 'Op') { echo 'success'; }; if ($red != 'Op') { echo 'danger'; }; echo ' tip" data-toggle="tooltip" data-placement="top" title="" data-original-title="">' . $red . '</span>';
									};
									if ($red == '') {
										echo '<span class="label label-info tip" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></span>';
									};
								echo '</td>';
								echo "</tr>";
								}
								echo "</tbody></table></div></div>";
							?>
						</div>
					</div>
				</div>
			</div>
							<?php
								/*
								VIEW.PHP
								Displays all data from 'players' table
								*/
								// connect to the database
								include('connect-db.php');
								// get results from database
								$result = mysqli_query($con, "SELECT * FROM prisliste ORDER BY mv ASC");
								// display data in table
								echo "<div class='panel panel-info'>
											<div class='panel-heading'>
												<h3 class='panel-title'>Alle Møbler</h3>
											</div>
											<div class='panel-body'>
												<table class='table table-hover'>
													<tbody class='topBoxes allfurni'>";
								// loop through results of database query, displaying them in the table
								while($row = mysqli_fetch_array( $result )) {
								$id = $row['id'];
								$ltd = $row['ltd'];
								$navn = $row['navn'];
								$billedeurl = $row['billedeurl'];
								$mv = $row['mv'];
								$cv = ($mv) / 5;
								$red = $row['red'];
								// echo out the contents of each row into a table
								echo "<tr>";
								if ($ltd == 1) {
									echo '<td class="ltdrare col-sm-1"><img src="images/ltd.png" class="tip img-responsive" data-toggle="tooltip" data-placement="top" title="" data-original-title="Limited Edition"></td>';
								};
								if ($ltd == 0) {
									echo '<td class="tdrare col-sm-1"></td>';
								};
								echo '<td style="width: 60px;" class="col-sm-1"><img src="' . $billedeurl . '" class="tip img-responsive" data-toggle="tooltip" data-placement="top" title="" data-original-title="' . $navn . '"></td>';
								echo '<td class="col-sm-6">' . $mv . '<img src="images/møntz2.png" class="tip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Møntz"></td>';
								echo '<td class="col-sm-3">' . $cv . '<img src="images/hc_sofa.png" class="tip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Club(s)"></td>';
								echo '<td class="col-sm-1">';
									if (!$red == '') {
										echo '<span class="label label-'; if ($red == 'Op') { echo 'success'; }; if ($red != 'Op') { echo 'danger'; }; echo ' tip" data-toggle="tooltip" data-placement="top" title="" data-original-title="">' . $red . '</span>';
									};
									if ($red == '') {
										echo '<span class="label label-info tip" data-toggle="tooltip" data-placement="top" title="" data-original-title=""></span>';
									};
								echo '</td>';
								echo "</tr>";
								}
								echo "</tbody></table></div></div>";
							?>
				</div>
			</div>
		</div>
  		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/tooltip.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	</body>
</html>
