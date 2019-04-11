@extends('layouts.homepage')

@section('content')
<!--================Home Banner Area =================-->
<section class="home_banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
        <div class="container">
            <div class="banner_content text-center">
                <h3>We Combine <br />Business with Finance</h3>
                <h5>We work hard, we result perfect</h5>
                <a class="org_btn" href="#">Explore Us</a>
                <a class="green_btn" href="#">Get Free Quote</a>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Offer Area =================-->
<section class="offer_area p_120">
    <div class="container">
        <div class="offer_title">
            <h5>What we offer for you</h5>
            <p>Plantronics with its GN Netcom <b>wireless headset</b> creates the next generation of wireless headset and other products such as wireless amplifiers, and <b>wireless headset</b> telephone.</p>
        </div>
        <div class="row offer_inner">
            <div class="col-lg-4">
                <div class="offer_item">
                    <img class="img-fluid" src="homepage/img/offer/offer-1.jpg" alt="">
                    <div class="offer_text">
                        <h4>Addiction Whit Gambling</h4>
                        <p>It is a good idea to think of your PC as an office. It stores files, programs, pictures. This can be compared to an actual.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="offer_item">
                    <img class="img-fluid" src="homepage/img/offer/offer-2.jpg" alt="">
                    <div class="offer_text">
                        <h4>Addiction Whit Gambling</h4>
                        <p>It is a good idea to think of your PC as an office. It stores files, programs, pictures. This can be compared to an actual.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="offer_item">
                    <img class="img-fluid" src="homepage/img/offer/offer-3.jpg" alt="">
                    <div class="offer_text">
                        <h4>Addiction Whit Gambling</h4>
                        <p>It is a good idea to think of your PC as an office. It stores files, programs, pictures. This can be compared to an actual.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Offer Area =================-->

<!--================Feature Area =================-->
<section class="feature_area p_120">
    <div class="container">	
        <div class="main_title">
            <h2>Our Top Rated Features</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
        </div>
        <div class="row feature_inner">
            <div class="col-lg-3 col-sm-6">
                <div class="feature_item">
                    <h4>Unique Design</h4>
                    <p>Most people who work in an office environment, buy computer products, or have a computer at </p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="feature_item">
                    <h4>Appropriate UX</h4>
                    <p>Most people who work in an office environment, buy computer products, or have a computer at </p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="feature_item">
                    <h4>Perfect Visual</h4>
                    <p>Most people who work in an office environment, buy computer products, or have a computer at </p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="feature_item">
                    <h4>Different Layout</h4>
                    <p>Most people who work in an office environment, buy computer products, or have a computer at </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Feature Area =================-->

<!--================Home Gallery Area =================-->
<section class="home_gallery_area p_120">
    <div class="container">
        <div class="main_title">
            <h2>Our Recent Completed Projects</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt</p>
        </div>
        <div class="isotope_fillter">
            <ul class="gallery_filter list">
                <li class="active" data-filter="*"><a href="#">All Categories</a></li>
                <li data-filter=".brand"><a href="#">Branding</a></li>
                <li data-filter=".manipul"><a href="#">Image Manipulation</a></li>
                <li data-filter=".creative"><a href="#">Creative Work</a></li>
                <li data-filter=".design"><a href="#">Web Design</a></li>
                <li data-filter=".print"><a href="#">Print Material</a></li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="gallery_f_inner row imageGallery1">
            <div class="col-lg-4 col-md-4 col-sm-6 brand manipul design print">
                <div class="h_gallery_item">
                    <div class="g_img_item">
                        <img class="img-fluid" src="img/gallery/project-1.jpg" alt="">
                        <a class="light" href="img/gallery/project-1.jpg"><img src="img/gallery/icon.png" alt=""></a>
                    </div>
                    <div class="g_item_text">
                        <h4>3D Helmet Design</h4>
                        <p>Client Project</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 brand manipul creative">
                <div class="h_gallery_item">
                    <div class="g_img_item">
                        <img class="img-fluid" src="img/gallery/project-2.jpg" alt="">
                        <a class="light" href="img/gallery/project-2.jpg"><img src="img/gallery/icon.png" alt=""></a>
                    </div>
                    <div class="g_item_text">
                        <h4>2D Vinyl Design</h4>
                        <p>Client Project</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 manipul creative design print">
                <div class="h_gallery_item">
                    <div class="g_img_item">
                        <img class="img-fluid" src="img/gallery/project-3.jpg" alt="">
                        <a class="light" href="img/gallery/project-3.jpg"><img src="img/gallery/icon.png" alt=""></a>
                    </div>
                    <div class="g_item_text">
                        <h4>Creative Poster Design</h4>
                        <p>Client Project</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 brand creative print">
                <div class="h_gallery_item">
                    <div class="g_img_item">
                        <img class="img-fluid" src="img/gallery/project-4.jpg" alt="">
                        <a class="light" href="img/gallery/project-4.jpg"><img src="img/gallery/icon.png" alt=""></a>
                    </div>
                    <div class="g_item_text">
                        <h4>Embosed Logo Design</h4>
                        <p>Client Project</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 brand manipul design">
                <div class="h_gallery_item">
                    <div class="g_img_item">
                        <img class="img-fluid" src="img/gallery/project-5.jpg" alt="">
                        <a class="light" href="img/gallery/project-5.jpg"><img src="img/gallery/icon.png" alt=""></a>
                    </div>
                    <div class="g_item_text">
                        <h4>3D Disposable Bottle</h4>
                        <p>Client Project</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 brand creative">
                <div class="h_gallery_item">
                    <div class="g_img_item">
                        <img class="img-fluid" src="img/gallery/project-6.jpg" alt="">
                        <a class="light" href="img/gallery/project-6.jpg"><img src="img/gallery/icon.png" alt=""></a>
                    </div>
                    <div class="g_item_text">
                        <h4>3D Logo Design</h4>
                        <p>Client Project</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Gallery Area =================-->

<!--================Home Contact Area =================-->
<section class="home_contact_area">
    <div class="left_img">
        <img src="img/left-img.jpg" alt="">
    </div>
    <div class="h_right_form">
        <div class="h_form_inner">
            <h4>Get a free Quotation</h4>
            <form class="row home_contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
                </div>
                <div class="form-group col-md-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address">
                </div>
                <div class="form-group col-md-12">
                    <textarea class="form-control" name="message" id="message" rows="1" placeholder="Wrtie message"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" value="submit" class="btn submit_btn form-control">Get Free Quote</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!--================End Home Contact Area =================-->

<!--================Latest Blog Area =================-->
<section class="latest_blog_area p_120">
    <div class="container">
        <div class="main_title">
            <h2>Latest Posts from Blog</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididun</p>
        </div>
        <div class="row latest_blog_inner">
            <div class="col-lg-3 col-md-6">
                <div class="l_blog_item">
                    <div class="l_blog_img">
                        <img class="img-fluid" src="img/blog/latest-post/l-post-1.jpg" alt="">
                    </div>
                    <div class="l_blog_text">
                        <div class="date">
                            <a href="#">25 October, 2017  |  By Mark Wiens</a>
                        </div>
                        <a href="#"><h4>Addiction When Gambling Becomes A Problem</h4></a>
                        <p>Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their desktops, while delivery</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="l_blog_item">
                    <div class="l_blog_img">
                        <img class="img-fluid" src="img/blog/latest-post/l-post-2.jpg" alt="">
                    </div>
                    <div class="l_blog_text">
                        <div class="date">
                            <a href="#">25 October, 2017  |  By Mark Wiens</a>
                        </div>
                        <a href="#"><h4>Computer Hardware Desktops And Notebooks And Handhelds</h4></a>
                        <p>Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their desktops, while delivery</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="l_blog_item">
                    <div class="l_blog_img">
                        <img class="img-fluid" src="img/blog/latest-post/l-post-3.jpg" alt="">
                    </div>
                    <div class="l_blog_text">
                        <div class="date">
                            <a href="#">25 October, 2017  |  By Mark Wiens</a>
                        </div>
                        <a href="#"><h4>Make Myspace Your Best Designed Space</h4></a>
                        <p>Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their desktops, while delivery</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="l_blog_item">
                    <div class="l_blog_img">
                        <img class="img-fluid" src="img/blog/latest-post/l-post-4.jpg" alt="">
                    </div>
                    <div class="l_blog_text">
                        <div class="date">
                            <a href="#">25 October, 2017  |  By Mark Wiens</a>
                        </div>
                        <a href="#"><h4>Video Games Playing With Imagination</h4></a>
                        <p>Computers have become ubiquitous in almost every facet of our lives. At work, desk jockeys spend hours in front of their desktops, while delivery</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!--================End Latest Blog Area =================-->
@endsection