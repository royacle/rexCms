@extends('public.front')

@section('content')
<h3>Router point</h3>
<home-main></home-main>
    <!-- <div id="intro" class="section scrollspy">
        <div class="container">
            <div class="row">
                <div  class="col s12">
                    <h2 class="center header text_h2"> Our <span class="span_h2"> Core  </span>Services<span class="span_h2">.</span> </h2>
                </div>

                <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="center promo promo-example card hoverable">
                        <i class="material-icons">web</i>
                        <h5 class="promo-caption">Web App Development</h5>
                        <p class="light center services-p">Just Mention the App to us or show us an example, you can then leave the rest to us.</p>
                    </div>

                </div>
                <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="center promo promo-example card hoverable">
                        <i class="material-icons">panorama</i>
                        <h5 class="promo-caption">Graphics</h5>
                        <p class="light center services-p">You need Photos, Logos? You need your images adjusted? You need a photographer? We'll get it done.</p>
                    </div>
                </div>
                <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="center promo promo-example card hoverable">
                        <i class="material-icons">people</i>
                        <h5 class="promo-caption">Consultancy</h5>
                        <p class="light center services-p">We will provide you support and advice to achieve that Infotech result you highly desire.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                

                <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.8s">
                    <div class="center promo promo-example card hoverable">
                        <i class="material-icons">explore</i>
                        <h5 class="promo-caption">Web App Auditting</h5>
                        <p class="light center services-p">Have you just developed a web app? Is it safe? Is it slow? Is it properly designed? Avail yourself this service to be sure.</p>
                    </div>

                </div>
                <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.9s">
                    <div class="center promo promo-example card hoverable">
                        <i class="material-icons">remove_red_eye</i>
                        <h5 class="promo-caption">Cyber Security</h5>
                        <p class="light center services-p">Have your application been hacked? Are you scared of being hacked? Secure your applications, emails and your devices now!</p>
                    </div>
                </div>
                <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.95s">
                    <div class="center promo promo-example card hoverable">
                        <i class="material-icons">work</i>
                        <h5 class="promo-caption">Research</h5>
                        <p class="light center services-p">So you want to carry on with your project research work? Perhaps you're not sure where to start or how to start. We're here for you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!--Work-->
    <!-- <div class="section scrollspy" id="work">
            <div class="container">
                <h2 class="center header text_h2"> Our <span class="span_h2"> Portfolio  </span></span> </h2>
                <div class="row">
                    <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="front/projects/cpcenter.PNG">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">CP Center Nigeria <i class="material-icons right">more_vert</i></span>

                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">CP Center Nigeria <i class="material-icons right">close</i></span>
                                <p>A web application for an NGO -Cerebral palsy, Nigeria. This web application besides being a website functions like a portal for registration for Events relating to the Center and also has a payment gateway for donations.</p>
                                <p><a target="_blank" href="http://cpcenter.com.ng">View Project</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="front/projects/3ag.PNG">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">3AGlobal Ltd. <i class="material-icons right">more_vert</i></span>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">3AGlobal Ltd. <i class="material-icons right">close</i></span>
                                <p>Here is some more information about this project that is only revealed once clicked on.</p>
                                <p><a target="_blank" href="http://3aglobal.com">View Project</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.9s">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="front/projects/trostech.PNG">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">Tros Technologies Ltd. <i class="material-icons right">more_vert</i></span>

                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">Tros Technologies Ltd. <i class="material-icons right">close</i></span>
                                <p>A corporate website for an IT servicing company in Nigeria.</p>
                                <p><a target="_blank" href="http://trostechnologies.com">View Project</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="front/projects/fixafrica.PNG">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4 flow-text" style="font-size: 22px;">Fix Africa News Magazine. <i class="material-icons right">more_vert</i></span>

                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">Fix Africa News Magazine. <i class="material-icons right">close</i></span>
                                <p>A socio-political platform for discussing social and political matters affecting Africa and the way forward.</p>
                                <p><a target="_blank" href="http://fixafrica.org">Project link</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="front/projects/welldepth.PNG">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">Well depth Ltd.<i class="material-icons right">more_vert</i></span>

                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">Well depth Ltd. <i class="material-icons right">close</i></span>
                                <p>Corporate oil servicing company's website.</p>
                                <p><a target="_blank" href="http://welldepth.com">View Project</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="card">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" src="front/projects/hillside.PNG">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4">Hill Side Gardens <i class="material-icons right">more_vert</i></span>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">Hill Side Gardens, Lagos, Nigeria<i class="material-icons right">close</i></span>
                                <p>A hotel website with booking / reservation engine.</p>
                                <p><a target="_blank" href="http://hillsidegardenslagos.com">View Project</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.8s">
                            <div class="card">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img class="activator" src="front/projects/lavalon.PNG">
                                </div>
                                <div class="card-content">
                                    <span class="card-title activator grey-text text-darken-4">Lavalon Hotels and Suites <i class="material-icons right">more_vert</i></span>
                                </div>
                                <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4">Lavalon Hotels and Suites, Lagos, Nigeria<i class="material-icons right">close</i></span>
                                    <p>A hotel website with booking / reservation engine. Developed from scratch using one of the latest in UI/UX design concepts as propounded by Google.</p>
                                    <p><a target="_blank" href="http://lavalonsuites.com">View Project</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.85s">
                            <div class="card">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img class="activator" src="front/projects/daridal.PNG">
                                </div>
                                <div class="card-content">
                                    <span class="card-title activator grey-text text-darken-4">Daridalideals Nigeria <i class="material-icons right">more_vert</i></span>
                                </div>
                                <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4">Daridal is a real Estate Company, Lagos, Nigeria<i class="material-icons right">close</i></span>
                                    <p>A real estate company website developed using WordPress and some other plugins</p>
                                    <p><a target="_blank" href="http://daridalidealsng.com">View Project</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4 l4 wow fadeInUp" data-wow-delay="0.85s">
                            <div class="card">
                                <div class="card-image waves-effect waves-block waves-light">
                                    <img class="activator" src="front/projects/doofank.JPG">
                                </div>
                                <div class="card-content">
                                    <span class="card-title activator grey-text text-darken-4">Doofanks Arts <i class="material-icons right">more_vert</i></span>
                                </div>
                                <div class="card-reveal">
                                    <span class="card-title grey-text text-darken-4">Doofanks Arts, Abuja, Nigeria<i class="material-icons right">close</i></span>
                                    <p>An Art Gallery on the cloud developed using HTML5, JavaScript, Php and a couple of plugins.</p>
                                    <p><a target="_blank" href="http://doofanksart.com">View Project</a></p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
    </div> -->
@endsection