<?php
include_once('lib/includes.php');

//Verificar se existe algum pedido por GET.
//Se Sim popular as variáveis Se Não repetir procedimento para POST
if($_POST) {

	if(isset($_POST['p'])) {
		$current_page = $_POST['p'];
	} else {
		$current_page = 1;
	}

    if(isset($_POST['tp'])) {
        $total_pages = $_POST['tp'];
    } else {
        $total_pages = 10;
    }

    if(isset($_POST['b'])) {
        $boundaries = $_POST['b'];
    } else {
        $boundaries = 2;
    }

    if(isset($_POST['a'])) {
        $around = $_POST['a'];
    } else {
        $around = 1;
    }
} else if($_GET) {

	if(isset($_GET['p'])) {
		$current_page = $_GET['p'];
	} else { 
		$current_page = 1;
	}

    if(isset($_GET['tp'])) {
        $total_pages = $_GET['tp'];
    } else {
        $total_pages = 10;
    }

    if(isset($_GET['b'])) {
        $boundaries = $_GET['b'];
    } else {
        $boundaries = 2;
    }

    if(isset($_GET['a'])) {
        $around = $_GET['a'];
    } else {
        $around = 1;
    }
}   else {

    // Definir valores por defeito de acordo com os requisitos do exercício
     $total_pages = 5;
     $current_page  = 4;
     $boundaries = 1;
     $around = 0;

}



$pagination = new Pagination();
$pagination->setTotalPages($total_pages);
$pagination->setCurrentPage($current_page);
$pagination->setBoundaries($boundaries);
$pagination->setAround($around);


?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Paginação em php</title>
        <meta name="description" content="">
        <meta name="author" content="ink, cookbook, recipes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- Place favicon.ico and apple-touch-icon(s) here 

        <link rel="shortcut icon" href="http://cdn.ink.sapo.pt/3.1.0/img/favicon.ico">
        <link rel="apple-touch-icon-precomposed" href="http://cdn.ink.sapo.pt/3.1.0/img/touch-icon.57.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://cdn.ink.sapo.pt/3.1.0/img/touch-icon.72.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://cdn.ink.sapo.pt/3.1.0/img/touch-icon.114.png">
        <link rel="apple-touch-startup-image" href="http://cdn.ink.sapo.pt/3.1.0/img/splash.320x460.png" media="screen and (min-device-width: 200px) and (max-device-width: 320px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="http://cdn.ink.sapo.pt/3.1.0/img/splash.768x1004.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="http://cdn.ink.sapo.pt/3.1.0/img/splash.1024x748.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
         -->
        <!-- load inks css from the cdn -->
        <link rel="stylesheet" type="text/css" href="http://cdn.ink.sapo.pt/3.1.0/css/ink-flex.min.css">
        <link rel="stylesheet" type="text/css" href="http://cdn.ink.sapo.pt/3.1.0/css/font-awesome.min.css">

        <!-- load inks css for IE8 -->
        <!--[if lt IE 9 ]>
            <link rel="stylesheet" href="http://cdn.ink.sapo.pt/3.1.0/css/ink-ie.min.css" type="text/css" media="screen" title="no title" charset="utf-8">
        <![endif]-->

        <!-- test browser flexbox support and load legacy grid if unsupported -->
        <script type="text/javascript" src="http://cdn.ink.sapo.pt/3.1.0/js/modernizr.js"></script>
        <script type="text/javascript">
            Modernizr.load({
              test: Modernizr.flexbox,
              nope : 'http://cdn.ink.sapo.pt/3.1.0/css/ink-legacy.min.css'
            });
        </script>

        <!-- load inks javascript files from the cdn -->
        <script type="text/javascript" src="http://cdn.ink.sapo.pt/3.1.0/js/holder.js"></script>
        <script type="text/javascript" src="http://cdn.ink.sapo.pt/3.1.0/js/ink-all.min.js"></script>
        <script type="text/javascript" src="http://cdn.ink.sapo.pt/3.1.0/js/autoload.js"></script>


        <style type="text/css">

            body {
                background: #ededed;
            }

            header h1 small:before  {
                content: "|";
                margin: 0 0.5em;
                font-size: 1.6em;
            }

            article header{
                padding: 0;
                overflow: hidden;
            }

            article footer {
                background: none;
            }

            article {
                padding-bottom: 2em;
                border-bottom: 1px solid #ccc;
            }

            .date {
                float: right;
            }

            summary {
                font-weight: 700;
                line-height: 1.5;
            }

            footer {
                background: #ccc;
            }
        </style>
    </head>

    <body>

        <div class="ink-grid">

            <!--[if lte IE 9 ]>
            <div class="ink-alert basic" role="alert">
                <button class="ink-dismiss">&times;</button>
                <p>
                    <strong>You are using an outdated Internet Explorer version.</strong>
                    Please <a href="http://browsehappy.com/">upgrade to a modern browser</a> to improve your web experience.
                </p>
            </div>
            -->

            <!-- Add your site or application content here -->

            <header class="clearfix align-center vertical-padding">

                <h1 class="logo">
                    Paginação<small>em php</small>
                </h1>
            </header>

            <section class="column-group gutters article">
                <div class="push-center xlarge-70 large-70 medium-60 small-100 tiny-100">
                    <h1>Introduza as definições da sua paginação.</h1>
                    <form class="ink-form" method="post">
                        <div class="column-group gutters">
                            <div class="control-group all-25">
                                <label for="p">$current_page</label>
                                <div class="control">
                                    <input type="text" id="p" name="p" value="<?php echo $current_page ?>">
                                </div>
                            </div>
                            <div class="control-group all-25">
                                <label for="tp">$total_pages</label>
                                <div class="control">
                                    <input type="text" id="tp" name="tp" value="<?php echo $total_pages ?>">
                                </div>
                            </div>
                            <div class="control-group all-25">
                                <label for="b">$boundaries</label>
                                <div class="control">
                                    <input type="text" id="b" name="b" value="<?php echo $boundaries ?>">
                                </div>
                            </div>
                            <div class="control-group all-25">
                                <label for="a">$around</label>
                                <div class="control">
                                    <input type="text" id="a" name="a" value="<?php echo $around ?>">
                                </div>
                            </div>
                            <div class="control-group all-100">
                                <div class="control">
                                    <input type="submit" value="Gerar paginação" class="ink-button orange">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="column-group" style="padding-bottom: 30px;">
                <div class="push-center">
                            <?php echo $pagination->render(); ?>
                </div>
            </section>
        </div>
        <footer class="clearfix">
            <div class="ink-grid">
                <p></p>
                <address class="note">
                    <h6>Francisco Barrento</h6>
                    <p>932577999</p>
                    <p><a href="mailto:francisco.barrento@gmail.com">francisco.barrento@gmail.com</a></p>
                </address>
                 
            </div>
        </footer>
    </body>
</html>