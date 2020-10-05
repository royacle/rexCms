<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta name="theme-color" content="#2196F3">
    <!-- <meta name="google-site-verification" content="927D0LERtM-72na5rqVQ1EAUfxp-aWfqo2Ob1uyjtGM" /> -->
    <title>Royacle - The IT Mafia</title>

    <!-- CSS  -->
    <link rel="shortcut icon" href="favicon.png">
    <link href="front/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="front/css/materialize.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link href="front/css/plugin-min.css" type="text/css" rel="stylesheet"> -->
    <link href="front/css/custom-min.css" type="text/css" rel="stylesheet">
    <link href="front/css/style.css" type="text/css" rel="stylesheet">
    <link href="front/css/animate.css" type="text/css" rel="stylesheet">
    <style>
      html, body{
            width: 100%;
            height: auto;
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
      }
    </style>
</head>
    <body id="top" class="scrollspy">

        <div id="app">
            <!-- Pre Loader -->
        <div id="loader-wrapper">
            <div id="loader"></div>

            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

        </div>

        <!--Navigation-->
        <div class="navbar-fixed z-depth-3">
            <nav id="nav_f" class="default_color" role="navigation">
                <div class="container">
                    <div class="nav-wrapper">
                    <a href="#" id="logo-container" class="brand-logo">Royacle</a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="#">About</a></li>
                            <li><a href="#intro">Services</a></li>
                            <li><a href="#work">Portfolio</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a target="_blank" href="/blog">Blog</a></li>
                            <li>
                                @if(Route::has('login'))
                                    @auth
                                    <a target="_blank" href="{{ url('/dashboard') }}">Dashboard</a>
                                    @endauth
                                @endif
                            </li>
                        </ul>
                        <ul id="nav-mobile" class="side-nav">
                            <li><a href="#">About</a></li>
                            <li><a href="#intro">Services</a></li>
                            <li><a href="#work">Portfolio</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li><a target="_blank" href="/blog">Blog</a></li>
                            <li>
                                @if(Route::has('login'))
                                    @auth
                                    <a target="_blank" href="{{ url('/dashboard') }}">Dashboard</a>
                                    @endauth
                                @endif
                            </li>
                        </ul>
                    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
                    </div>
                </div>
            </nav>
        </div>

        <!--Hero-->
        <div class="section no-pad-bot" id="index-banner">
            <div class="container">
                <h3 class="text_h center header cd-headline letters type">
                    <span>We</span>
                    <span class="cd-words-wrapper waiting">
                        <b class="is-visible">create</b>
                        <b>design</b>
                        <b>develop</b>
                        <b>secure</b>
                        <b>blog</b>
                        <b>are Techies</b>
                    </span>
                </h3>
            </div>
        </div>

        <!--Intro and service-->
        @yield('content')

        <!-- <div class="section scrollspy" style="background: #170101;">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <form class="col s12" action="" method="post" id="contactForm">
                            <div class="row">
                                <div class="input-field col m6">
                                    <i class="material-icons prefix white-text">account_circle</i>
                                    <input id="icon_prefix" name="name" type="text" class="validate white-text" required>
                                    <label for="icon_prefix" class="white-text">Full Name</label>
                                </div>
                                <div class="input-field col m6">
                                    <i class="material-icons prefix white-text">email</i>
                                    <input id="icon_email" name="email" type="email" class="validate white-text" required>
                                    <label for="icon_email" class="white-text">Email</label>
                                </div>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix white-text">edit</i>
                                    <textarea id="icon_prefix2" name="message" class="materialize-textarea white-text" required></textarea>
                                    <label for="icon_prefix2" class="white-text">Message</label>
                                </div>
                                
                                <div class="col offset-s5 s12">
                                    <button class="btn waves-effect waves-light red darken-1" type="submit" id="subMessage">Submit
                                        <i class="material-icons right white-text">send</i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->


        <!--Footer-->
        <footer id="contact" class="page-footer default_color scrollspy">
            <div class="container">
                <div class="row">
                    <div class="col l4 s12">
                        <h5 class="white-text">Tags</h5>
                        <ul>
                            <li style="border-radius: 5px solid #ffffff;"><a class="white-text" href="">Cybersecurity</a></li>
                            <li><a class="white-text" href="">Web Dev</a></li>
                        </ul>
                    </div>
                    <div class="col l4 s12">
                        <h5 class="white-text">Quick Links</h5>
                        <ul>
                            <li><a class="white-text" href="">Home</a></li>
                            <li><a class="white-text" href="">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col l4 s12">
                        <h5 class="white-text">Social</h5>
                        <ul>
                            <li>
                                <a class="white-text" href="">
                                    <i class="small fa fa-facebook-square white-text"></i> Facebook
                                </a>
                            </li>
                            <li>
                                <a class="white-text" href="https://twitter.com/THE_COMDT">
                                    <i class="small fa fa-twitter-square white-text"></i> Twitter
                                </a>
                            </li>
                            <li>
                                <a class="white-text" href="https://www.linkedin.com/in/ekeroyal">
                                    <i class="small fa fa-linkedin-square white-text"></i> Linkedin
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright default_color">
                <div class="container">
                </div>
            </div>
        </footer>





        </div>
            <!--  Scripts-->
            <script src="{{asset('js/app.js')}}"></script>
            <script src="front/js/plugin-min.js"></script>
            <script src="front/js/custom-min.js"></script>
            <script src="front/js/wow.min.js"></script>
            <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
            <script src="front/js/materialize.min.js"></script>
            <script>
            $(document).ready(function(){
            // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
            $('.modal-trigger').leanModal();
            });

            $('modal-trigger').leanModal({
                closeIcon: true
            });
            </script>
            <script>
            new WOW().init();
            </script>
            <script>
                    wow = new WOW(
                            {
                            boxClass:     'wow',      // default
                            animateClass: 'animated', // default
                            offset:       0,          // default
                            mobile:       true,       // default
                            live:         true        // default
                        }
                        )
                        wow.init();
            </script>
            <script>
                $("#subMessage").click(function(evt){
                    evt.preventDefault();
                    var dataString = $("#contactForm").serialize();
                
                    
                    $.ajax({
                        
                        type: "post",
                        dateType: "json",
                        data: dataString,
                        url: "contact.php",
                        
                        success: function(e){
                            console.log(e);
                            alert("Thank you for contacting me. Will be in touch with you very soon.");
                            setTimeout(function() {
                                        location.reload();
                                    }, 5000);
                        },
                        error: function(){
                            alert("Sorry we could not send your mail. Please try again later.");
                            setTimeout(function() {
                                        location.reload();
                                    }, 5000);
                        },
                    
                        
                    });
                });

            </script>
        
  

    </body>
</html>