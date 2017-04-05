<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IPL - Unlimited fun!</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
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

    <script type="text/javascript">
        var obj = 
        {
            xhr : new XMLHttpRequest(),
            set : 0,
            scrollamt : 500,
            getTeam:function()
            {
                if(obj.set == 0)
                {
                    if(document.body.scrollTop>obj.scrollamt || document.documentElement.scrollTop>obj.scrollamt)
                    {
                        obj.xhr.onreadystatechange = obj.showTeam;
                        obj.xhr.open("GET", "team_listing.php", true);
                        obj.xhr.send();
                    }
                }
            },
            showTeam : function()
            {
                if(obj.xhr.readyState ==4 && obj.xhr.status == 200)
                {   
                    var res = obj.xhr.responseText;
                    var loc = document.getElementById("team_list");
                    loc.innerHTML = loc.innerHTML + res;
                    obj.set = 1;
                }
                setTimeout(obj.showSponsors, 500);
            },
            showSponsors : function()
            {
                var sponsor1 = document.getElementById("sponsor1");
                var sponsor2 = document.getElementById("sponsor2");
                var sponsor3 = document.getElementById("sponsor3");
                var sponsor4 = document.getElementById("sponsor4");

                sponsor1.src = "img/intex.jpg"
                sponsor2.src = "img/oxigen.jpeg"
                sponsor3.src = "img/tvs.jpg"
                sponsor4.src = "img/astral.gif"
            }
        }
        window.onscroll = obj.getTeam; 
    </script>

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
                        <a class="page-scroll" href="#page-top">Home</a>
                    </li>	
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#team" onclick="obj.getTeam()">Teams</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#sponsors">Sponsors</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading" style="font-size: 50px">Indian Premier League</h1>
                        <p class="intro-text">A 45 day long extravaganza of mind boggling cricket.<br>Powered by PES University.</p>
                        <a href="#about" class="btn-circle page-scroll" onclick="obj.getTeam()">
                            <i class="fa fa-angle-double-down animated text-center"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- About Section -->
    <section id="about" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>About IPL</h2>
                <p>The Indian Premier League (IPL) is a professional Twenty20 cricket league in India contested annually by franchise teams representing Indian cities. The league, founded by the Board of Control for Cricket in India (BCCI).</p>
                <p>The IPL is the most-attended cricket league in the world and ranks sixth among all sports leagues. Mumbai Indians, Chennai Super Kings and Kolkata Knight Riders have won twice, while Rajasthan Royals and Deccan Chargers have won once.<br>Let's see who takes the cup home this time!!</p>
                <h4> Whose side are you on??</h4>
            </div>
        </div>
    </section>

    <!-- Download Section -->
    <section id="team" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div  id="team_list" class="col-lg-8 col-lg-offset-2">
                    <h2>Teams</h2>
                </div>
                 <!--   <div class="box1"><a href="srh.html" class="btn btn-default btn-lg" style="margin: 5px; width: 98%">Sunrisers Hyderabad</a></div>
                    <div class="box"><a href="dd.html" class="btn btn-default btn-lg" style="margin: 5px; width : 98%">Delhi Daredevils</a></div>
                    <div class="box1"><a href="kxip.html" class="btn btn-default btn-lg" style="margin: 5px; width:98%">Kings XI Punjab</a></div>
                    <div class="box"><a href="kkr.html" class="btn btn-default btn-lg" style="margin: 5px; width : 98%">Kolkata Knight Riders</a></div>
                    <div class="box"><a href="csk.html" class="btn btn-default btn-lg" style="margin: 5px; width : 98%">Chennai Super Kings</a></div>
                    <div class="box1"><a href="mi.html" class="btn btn-default btn-lg" style="margin: 5px; width: 98%">Mumbai Indians</a></div>
                    <div class="box1"><a href="rr.html" class="btn btn-default btn-lg" style="margin: 5px; width: 98%">Rajasthan Royals</a></div>
                    <div style="clear:both;"></div>
                </div>
                -->         
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="sponsors" class="container content-section text-center">
        <h2 >Sponsors</h2>  
        <div class = "sprs">
            <img id="sponsor1" alt="Sponsor" style="width:200px;height:120px;position:relative;left:-15%;top:20%;"/>
            <img id="sponsor2" alt="Sponsor" style="width:200px;height:120px;position:relative;left:-5%;top:20%;"/>
            <img id="sponsor3" alt="Sponsor" style="width:240px;height:120px;position:relative;left:5%;top:20%;"/>
            <img id="sponsor4" alt="Sponsor" style="width:240px;height:120px;position:relative;left:15%;top:20%;"/>
        </div>  
    </section>
    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; Team Ghazz</p>
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

</html>



