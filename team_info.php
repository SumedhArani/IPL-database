
<?php
  $t_name = $_GET['t_name'];
  
echo '<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>'.$t_name.'</title>

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
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#owners">Owners</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#players">Players</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#coaches">Coaches</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#sponsors">Sponsors</a>
                    </li>                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>';    

  $back_image = substr($t_name, 0, 3);

echo'<!-- Intro Header -->
    <header class="intro" style="background: url(img/'.$back_image.'.jpg) no-repeat center scroll;background-size:100%;">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!--h1 class="brand-heading" style="font-size: 50px; top:1000px; color: red">Gujarat Lions</h1-->
                        <p class="intro-text"></p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>';


    include "connect_to_db.php";
    $query= "select * from team where name ='$t_name'";
    $result = mysqli_query($con , $query);  
    $team = mysqli_fetch_array($result , MYSQLI_ASSOC);
    
        $team_name=$team['name'];
        $home_grnd=$team['home_ground'];
        
        $coach_name = "select c.name from team t, coach c where t.t_id=c.t_id and t.name = '$t_name' and domain in('head','batting')";
        $coach_name = mysqli_query($con , $coach_name);  
        $coach_name = mysqli_fetch_array($coach_name , MYSQLI_ASSOC);
        $coach_name = $coach_name['name'];

        $captain_name = "select p.name from team t, player p, captain c where t.t_id=c.t_id and p.p_id=c.p_id and t.name = '$t_name' ";
        $captain_name = mysqli_query($con , $captain_name);  
        $captain_name = mysqli_fetch_array($captain_name , MYSQLI_ASSOC);
        $captain_name = $captain_name['name'];

        
    echo '<!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About '.$t_name.'</h2>'
                .'<p>The '.$team_name.' is a franchise cricket team in Indian Premier League. This is captained by '.$captain_name.' and coached by '.$coach_name.'.'.'</p>
				<p>The team played its home matches at '.$home_grnd.'</p>
				</div>
        </div>
    </section>';

	echo '
        <section id="team stats" class="content-section text-center">
        <div class="download-section"/>
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h3>Stats of '. $t_name.' in IPL</h3>';
		$result = "SELECT t.name , count(ta.t_id) as wins FROM T_award ta, Team t WHERE t.t_id=ta.t_id and ta.name='IPL Winner' and t.name='$t_name'" ;
		$result = mysqli_query($con , $result);
		$result = mysqli_fetch_array($result , MYSQLI_ASSOC);
		$wins = $result['wins'];
		echo "
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Title wins</a> </div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$wins</a></div>
		";
		
		$result = "SELECT t.name , count(ta.t_id) as runners FROM T_award ta, Team t WHERE t.t_id=ta.t_id and ta.name='IPL Runner Up' and t.name='$t_name'";
		$result = mysqli_query($con , $result);
		$result = mysqli_fetch_array($result , MYSQLI_ASSOC);
		$runners = $result['runners'];
		echo "
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">Runners</a> </div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$runners</a></div>
		";
		
		
		$result = "SELECT count(m.m_id) as h_wins FROM C_Match m , Team t , Venue v WHERE t.t_id=m.result and v.v_id IN(SELECT v1.v_id FROM Venue v1 , Team t1 WHERE t1.home_ground=v1.name and t1.name='$t_name')";
		$result = mysqli_query($con , $result);
		$result = mysqli_fetch_array($result , MYSQLI_ASSOC);
		$home_wins = $result['h_wins'];
		
		echo "
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">No of wins at home</a> </div>
		<div class=\"box\"><a href=\"#\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$home_wins</a></div>
		";
    


    ///////Owner

        $owner_name = "select distinct o.name from owner o, team t where o.o_id = t.o_id and t.name = '$t_name'";
        $owner_name = mysqli_query($con , $owner_name);  
        $owner_name = mysqli_fetch_array($owner_name , MYSQLI_ASSOC);
        $owner_name = $owner_name['name'];
   

    echo'<section id="owners" class="content-section text-center">
		<div class="download-section" />
            <div class="container" style = "position:relative;left:-30%">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Owner</h2>
                    <div class="box"><a href="owner.php?o_name=$owner_name" class="btn btn-default btn-lg" style="margin: 5px; width: 120%;position:relative;left:40%">'.$owner_name.'</a> </div>
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
    </section>';


    //////// Players   

    echo '
        <section id="players" class="content-section text-center">
        <div class="download-section"/>
            <div class="container" style = "position:relative;left:-30%">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Players</h2>';



        $players = "select distinct p.name from player p, plays pl, team t where t.name = '$t_name' and t.t_id = pl.t_id and pl.p_id =p.p_id";
        $players = mysqli_query($con , $players);  
        while($single_player = mysqli_fetch_array($players , MYSQLI_ASSOC)) 
        {
        	$team_player = $single_player['name'];
        	echo "
              <div class=\"box\"><a href=\"player.php?p_name=$team_player\" class=\"btn btn-default btn-lg\" style=\"margin: 5px; width: 98%;\">$team_player</a> </div>"  ;      	
        
        }

echo'

                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
    </section>
     <section id="coaches" class="content-section text-center">
		<div class="download-section" />
            <div class="container" style = "position:relative;left:-30%">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Coaches</h2>';

    //////////// coaches  

    $coaches = "select distinct c.name from team t, coach c where t.t_id=c.t_id and t.name = '$t_name'";
        $coaches = mysqli_query($con , $coaches);  
        while($single_coach = mysqli_fetch_array($coaches , MYSQLI_ASSOC)) 
        {
        	$team_coach = $single_coach['name'];

        	echo'<div ><a href="coach.php?c_name=$team_coach" class="btn btn-default btn-lg" style="margin: 5px; width: 70%;">'.$team_coach.'</a> </div>';

        }


echo'
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>	
    </section>

    <section id="sponsors" class="container content-section text-center">
		<h2 style = "position:relative;left:-15%">Sponsors</h2>	
		<div class = "sprs">
			<img src="img/intex.jpg" alt="Sponsor" style="width:200px;height:120px;position:relative;left:-35%;top:20%;"/>
			<img src="img/oxigen.jpeg" alt="Sponsor" style="width:200px;height:120px;position:relative;left:-25%;top:20%;"/>
			<img src="img/tvs.jpg" alt="Sponsor" style="width:240px;height:120px;position:relative;left:-15%;top:20%;"/>
			<img src="img/astral.gif" alt="Sponsor" style="width:240px;height:120px;position:relative;left:-5%;top:20%;"/>
		</div>	
    </section>
 ';


echo '

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p style = "position:relative;left:-15%">Copyright &copy; Team Ghazz</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>

</body>

</html>';        


?>


