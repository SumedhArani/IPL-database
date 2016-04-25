<?php
$player = $_GET['p_name'];
$p = $_GET['p_name'];
include "connect_to_db.php";

echo '<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>'.$player.'</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        div.box 
        {
         width: 50%;
         float: left;
        }
        div.box1
        {
         width: 50%;
         float: right
        }
    </style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
					<li>
                        <a class="page-scroll" href="index.php">Home</a>
                    </li>                  
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>';
	echo '
        <section id="about" class="content-section text-center">
        <div class="download-section"/>
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Player Info</h3>';
	$player = "select p.name,p.age,p.nationality,t.name as t_name,pl.c_year from player p,team t,plays pl where p.p_id = pl.p_id and t.t_id = pl.t_id and p.name = '$player'";
    $player = mysqli_query($con , $player);
	$i = 0;	
	while($players = mysqli_fetch_array($player , MYSQLI_ASSOC))
	{		
		$name = $players['name'];
		$age = $players['age'];
		$nationality = $players['nationality'];
		$team_name[$i] = $players['t_name'];
		$year[$i] =  $players['c_year'];	    	
		$i++;
	}
	$i--;
	echo "
		 <div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Name</a> </div>
		 <div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$name</a> </div>
		 <div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Age</a> </div>
		 <div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$age</a> </div>
		 <div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Nationality</a> </div>
		 <div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$nationality </a> </div>";
		while($i>=0)
		{
			echo "
				<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">(Team,year)</a> </div>
				<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$team_name[$i],$year[$i]</a> </div>";
			$i--;		
		}
		$player = "SELECT p.name , c.c_year , count(c.p_id) as cpt FROM Captain c , Player p , Team t WHERE c.p_id=p.p_id and t.t_id=c.t_id and p.name = '$p' GROUP BY t.name ";	
		$player = mysqli_query($con , $player);
		$player = mysqli_fetch_array($player , MYSQLI_ASSOC);
		$no_of_cpt = $player['cpt'];
		if(strcmp((string)$no_of_cpt,"") == 0 )
				$no_of_cpt = 0;
		echo "
			<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">No of times as a Captain</a> </div>
			<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$no_of_cpt</a> </div>";
	////////////special stats	
	
	
	if(strcmp((string)$_GET['p_name'],"Virat Kohli") == 0)
	{
		echo '
        <section id="about" class="content-section text-center">
        <div class="download-section"/>
            <div class="container" style = "position:relative;left:-30%;">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Stats when kohli has won a match for the team he has played</h3>';
		$result = "SELECT avg(ps.runs) as runs , avg(ps.strike_rate) as strike_rate FROM Player_stats ps WHERE ps.m_id IN (SELECT m.m_id FROM C_Match m , Team t WHERE m.result=t.t_id and t.name IN (SELECT t.name FROM Team t , Plays py , Player pl WHERE t.t_id=py.t_id and pl.p_id=py.p_id and pl.name='Virat Kohli'))";
		$result = mysqli_query($con , $result);
		$result = mysqli_fetch_array($result , MYSQLI_ASSOC);
		$runs = $result['runs'];
		$strike	= $result['strike_rate'];
		echo "
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Avg Runs</a> </div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\"></a>$runs</div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Strike Rate</a></div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$strike</a> </div>";
	
		echo '
        <section id="about" class="content-section text-center">
        <div class="download-section"/>
            <div class="container" style = "position:relative;left:-30%;">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Average Runs in IPL</h3>';
		$result = "SELECT avg(ps.runs) as runs FROM Player_stats ps , C_Match m , Player p WHERE m.m_id=ps.m_id and m.stage='Group' and ps.p_id=p.p_id and p.name='Virat Kohli' ;";
		$result = mysqli_query($con , $result);
		$result = mysqli_fetch_array($result , MYSQLI_ASSOC);
		$runs = $result['runs'];
		echo "
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Avg Runs</a> </div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$runs</a></div>
		";
	}
		
	if(strcmp((string)$_GET['p_name'],"Shane Watson") == 0)
	{
		echo '
        <section id="about" class="content-section text-center">
        <div class="download-section"/>
            <div class="container" style = "position:relative;left:-30%;">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Average stats at home games</h3>';
		$result = "SELECT avg(ps.runs) as runs , avg(ps.strike_rate) as strike_rate , count(wickets) as wickets FROM Player_stats ps WHERE ps.m_id IN (SELECT m.m_id FROM C_Match m , Team t , Venue v WHERE v.name=t.home_ground and t.name IN (SELECT t.name FROM Team t , Plays py , Player pl WHERE t.t_id=py.t_id and pl.p_id=py.p_id and pl.name='Shane Watson'))";
		$result = mysqli_query($con , $result);
		$result = mysqli_fetch_array($result , MYSQLI_ASSOC);
		$runs = $result['runs'];
		$strike	= $result['strike_rate'];
		$wickets = $result['wickets'];
		echo "
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Avg Runs</a> </div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$runs</a></div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Strike Rate</a></div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$strike</a> </div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Wickets</a></div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$wickets</a> </div>";
	
	}
	if(strcmp((string)$_GET['p_name'],"David Warner") == 0)	
	{
		echo '
        <section id="about" class="content-section text-center">
        <div class="download-section"/>
            <div class="container" style = "position:relative;left:-30%;">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Average Runs in IPL</h3>';
		$result = "SELECT avg(ps.runs) as runs FROM Player_stats ps , C_Match m , Player p WHERE m.m_id=ps.m_id and m.stage='Group' and ps.p_id=p.p_id and p.name='Virat Kohli' ;";
		$result = mysqli_query($con , $result);
		$result = mysqli_fetch_array($result , MYSQLI_ASSOC);
		$runs = $result['runs'];
		echo "
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Avg Runs</a> </div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$runs</a></div>
		";
	}

	if(strcmp((string)$_GET['p_name'],"Lasith Malinga") == 0)
	{
		echo '
        <section id="about" class="content-section text-center">
        <div class="download-section"/>
            <div class="container" style = "position:relative;left:-30%;">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Average wickets in Semi Finals of IPL</h3>';
		$result = "SELECT avg(ps.wickets) as wickets FROM Player_stats ps , C_Match m , Player p WHERE m.m_id=ps.m_id and m.stage='Semi Final' and ps.p_id=p.p_id and p.name='Lasith Malinga'" ;
		$result = mysqli_query($con , $result);
		$result = mysqli_fetch_array($result , MYSQLI_ASSOC);
		$wickets = $result['wickets'];
		echo "
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Avg Wickets</a> </div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$wickets</a></div>
		";
	}		
?>