<!DOCTYPE html>
<html>
    <head>
        <!--Metadata concerning screen resolution and size-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!--Page information and favicon-->
        <title>Kenny Durkin | Aspiring Developer</title>
        <link rel="icon" type="image/png" href="res/logo/KD-logo.png" />
        <!--Bootstrap stylesheets-->
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
        <link href="/css/style.css" rel="stylesheet" type="text/css" media="screen">
        <!--Google web font-->
        <link href='http://fonts.googleapis.com/css?family=Muli:400,300italic' rel='stylesheet' type='text/css'>
        <!--Google analytics-->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-51243910-1', 'kennydurkin.info');
            ga('send', 'pageview');
        </script>
    </head>

    <body>
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand nav pull-left">
                    <a href="#">Kenny Durkin</a>
                    <a href="Kenny_Durkin_Resume.pdf">
                        <span id="download" class="glyphicon glyphicon-save"></span>
                        <span id="resume"> Resume</span>
                    </a>
                </div>
            </div>
            <div class="navbar-collapse collapse" id="my-navbar-collapse" style="height: 1px;">
                <ul class="nav navbar-nav nav-pills pull-right">
                    <li class="active"><a href="#home">HOME</a></li>
                    <li class=""><a href="#projects">PROJECTS</a></li>
                    <li class=""><a href="#education">EDUCATION</a></li>
                    <li class=""><a href="#experience">EXPERIENCE</a></li>
                    <li class=""><a href="#contact">CONTACT</a></li>
                </ul>
            </div>
        </div>

        <div id="home" class="jumbotron attach">
            <div class="container">
                <h1>Hi, I'm Kenny. I enjoy creating things.</h1>
                <!--p id="greeting"></p-->
            </div>
        </div>

        <div class="learn-more">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>About Me</h3> 
                        <p>Hey there! I am an NYC based developer who has found a passion for writing software that makes a real, quantifiable, and disruptive impact. My goal is to live a career of writing and shipping elegant code that makes peoples' lives easier through technology, and my dream is to one day make mindblowing contributions to the tech industry through my work.</p>
                        <p>When I'm not pursuing those goals, I am usually working on a side project or at a hackathon, a learning experience for which I hold a great enthusiasm.  Right now, I'm holding my position of aspiring software engineer as a Computer Science student at Fordham University.  There, I'm serving as the CS Society's president in the hopes of promoting a bigger hacker and entrepreneurial culture on campus.  This summer, I interned as an Android developer at Grooveshark, helping to develop features on their mobile app and learning countless new skills along the way.</p>
                        <hr>
                        <p>Below are experiences I have had casually, academically and professionally in detail. If you're interested in hiring or simply getting to know me better, <a href="#contact">feel free to drop me a line</a>.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <h3>Projects</h3>
                        <p>From hackathons to homework assignments, I love to design and develop cool hardware and software projects in my free time.</p>
                        <p><a href="#projects">Check some of them out!</a></p>
                    </div>
                    <div class="col-sm-4">
                        <h3>Education</h3>
                        <p>I'm working towards my bachelors in Computer Science at Fordham University, but some of the best learning occurs outside of the classroom.</p>
                        <p><a href="#education">Peruse some of my repertoire!</a></p>
                    </div>
                    <div class="col-sm-4">
                        <h3>Experience</h3>
                        <p>It's been a privilege to contribute to and learn more about the field in several work environments over the beginning of my career.</p>
                        <p><a href="#experience">Learn what I did at those awesome places!</a></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <p style="font-style: italic;">Though I'm beginning this site as a means to showcase my work in development as I gain more experience in the field, it will most likely change and evolve with my skillset and personal development, and become much more. I look forward to seeing that growth and hope that you will, too. Thank you for visiting!</p></div>
                    </div>
                <hr style="margin-top:0;">
            </div>
        </div>

        <div id="projects" class="jumbotron attach">
            <div class="container">
                <h1>A glimpse of my portfolio...</h1>
            </div>
        </div>

        <?php
        #Database configurations
        require('config.php');

        try {
            $conn = new PDO("mysql:host={$dblocation};dbname={$dbname}", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $action = isset($_GET['action']) ? $_GET['action'] : "";

            $order = 'date_created DESC';
            $sql = 'SELECT * 
                    FROM projects
                    ORDER BY '.$order;

            $stmt = $conn->prepare($sql);
            $stmt->execute(array());
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        ?>
    
        <div id="myProjects">
            <div class="container">
                <div class="row">
                    <?php for($i=1; $i <= ($stmt->rowCount()) ;$i++) {
                        $row = $stmt->fetch();
                        extract($row); ?>

                        <div class="proj col-sm-4" style="background-image: url('<?php echo sprintf ('%s',$picture);?>');">
                            <?php echo sprintf('<a href = "%s" >', $link); ?>
                                <div class="desc col-sm-12">
                                    <p style="top:10%;"><?php echo sprintf('%s / ', $name); echo sprintf('%s', $date_created);?></p>
                                    <p style="top:20%;"><?php echo sprintf('%s', $description_1);?></p>
                                    <p style="top:20%;"><?php echo sprintf('%s', $description_2);?></p>
                                    <p style="top:30%;" class="col-xs-6 pull-left"><?php echo sprintf('%s', $tech_used); ?></p>
                                    <p style="top:30%;" class="col-xs-6 pull-right"><?php echo sprintf('%s', $collaborators); ?></p>                                
                                </div>
                            </a>
                        </div>

                        <?php if( $i%3 === 0 && $i != $stmt->rowCount()){
                            echo '</div>
                            <div class="row">';
                        }
                    } ?>
                </div>
            </div>
        </div>

        <div id="education" class="jumbotron attach">
            <div class="container">
                <h1>What I've learned...</h1>
            </div>
        </div>

        <div id="myEducation">
            <div class="container">
                <div class="row">
                    <div id="courses" class="col-sm-6">
                        <ul class="list-group">
                            <a class="list-group-item active">
                                <h4>My relevant coursework</h4>
                            </a>
                            <li class="list-group-item"><strong>MATH 1206/7</strong> - <em>Calculus I & II</em></li>
                            <li class="list-group-item"><strong>PHYS 1601/2</strong> - <em>Physics I & II</em></li>
                            <li class="list-group-item"><strong>MATH 2001</strong> - <em>Discrete Mathematics</em></li>
                            <li class="list-group-item"><strong>CISC 2200</strong> - <em>Data Structures</em></li>
                            <li class="list-group-item"><strong>CISC 3500</strong> - <em>Database Systems</em></li>
                            <li class="list-group-item"><strong>CISC 3580</strong> - <em>Cybersecurity & Applications</em></li>
                            <li class="list-group-item"><strong>CISC 3593</strong> - <em>Computer Organization</em></li>
                            <li class="list-group-item"><strong>CISC 3595</strong> - <em>Operating Systems</em></li>
                            <li class="list-group-item"><strong>CISC 4080</strong> - <em>Computer Algorithms</em></li>
                            <li class="list-group-item"><strong>CISC 4400</strong> - <em>Android Development</em></li>
                        </ul>
                    </div>
                    <div id="skills" class="col-sm-6">
                        <ul class="list-group">
                            <a class="list-group-item active">
                                <h4>My technical skills</h4>
                            </a>
                            <li class="list-group-item">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;">
                                        C/C++
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
                                        Java/Android
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                                        Python (Flask)
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                                        HTML/CSS (LESS,Bootstrap)
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                        SQL (MySQL)
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;">
                                        PHP
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                                        JavaScript / jQuery
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div id="extras" class="col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4>Extracurricular Activities</h4>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Director of Programming, <a href="http://fordhamcss.me/">Computing Sciences Society</a></h3>
                                </div>
                                <div class="panel-body">
                                    Last year, I restarted the CS club from scratch, assembled an executive board, and hosted CS related events during the year.<br>
                                    We're currently working towards fostering a developer/hacker culture on campus via several initiatives.
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Contributor, <a href="http://fordhampoliticalreview.org/">Fordham Political Review</a></h3>
                                </div>
                                <div class="panel-body">
                                    Last semester I began writing for FPR, a popular student-run on campus publication<br>
                                    I currently have <a href="http://fordhampoliticalreview.org/on-the-growth-of-the-hackathon-culture/">one article published</a> on the collegiate hacker culture, but plan on writing several more.
                                </div>
                            </div>
                            <div class="panel panel-default" style="margin-bottom:0;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Marketing Coordinator, <a href="http://fordhamrh.orgsync.com/org/csa/home">Commuting Students Association</a></h3>
                                </div>
                                <div class="panel-body">
                                    Last semester I was elected to the marketing coordinator position on CSA's junior board<br>
                                    This year I'm responsible for several methods of communication and publication with the student body.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="experience" class="jumbotron attach">
            <div class="container">
                <h1>Where I've worked...</h1>
            </div>
        </div>

        <div id="myExperience">
            <div class="container">      
                <!--  Carousel - consult the Twitter Bootstrap docs at 
                  http://twitter.github.com/bootstrap/javascript.html#carousel -->
                <div id="this-carousel-id" class="carousel slide"><!-- class of slide for animation -->
                  <ol class="carousel-indicators">
                    <li data-target="#this-carousel-id" data-slide-to="0" class="active"></li>
                    <li data-target="#this-carousel-id" data-slide-to="1" class=""></li>
                    <li data-target="#this-carousel-id" data-slide-to="2" class=""></li>
                    <li data-target="#this-carousel-id" data-slide-to="3" class=""></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="item active"><!-- class of active since it's the first item -->
                        <img src="/res/experience/grooveshark-logo.png" class="img-rounded"/>
                        <div class="carousel-caption">
                            <div class="description col-xs-12">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Android Dev Intern, <a href="http://grooveshark.com/">Grooveshark</a></h3>
                                    </div>
                                    <div class="panel-body">
                                        <strong>Summer 2014</strong>
                                    </div>
                                    <div class="panel-body">
                                       Through Grooveshark's Summer with the Sharks program, I participated in a month long course covering front-end basics, server side programming, version control, and more advanced topics. Through this, I became fluent in web dev and began to code this site.  For the remainder of the internship, I worked as an Android Developer, implementing features into their redesigned app.  Most notably, another intern and I were in charge of implementing their Chromecast feature, and the project was our largest contribution to the company.
                                    </div>
                                </div>
                            </div>                      
                        </div>
                    </div>
                    <div class="item">
                        <img src="/res/experience/wisdm-logo.jpg" class="img-rounded"/>
                        <div class="carousel-caption">
                            <div class="description col-xs-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Android Developer, <a href="http://www.cis.fordham.edu/wisdm/">WISDM</a></h3>
                                    </div>
                                    <div class="panel-body">
                                        <strong>Spring 2014 - Present</strong>
                                    </div>
                                    <div class="panel-body">
                                        Fordham University's WISDM (Wireless Sensor Data Mining) Lab is concerned with collecting the sensor data from smart phones and other modern mobile devices and mining this sensor data for useful knowledge.  This has manifested in an Android app known on the app store as Actitracker, which needs a constant flow of developers to keep it running and updated.  Upon completing my Android course last semester, I signed on as a full developer for the next school year.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="/res/experience/dreamyard-logo.jpg" class="img-rounded"/>
                        <div class="carousel-caption">
                              <div class="description col-xs-12">
                            <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Maker Intern, <a href="http://dreamyard.com/">Dreamyard</a></h3>
                                    </div>
                                    <div class="panel-body">
                                        <strong>Spring 2014</strong>
                                    </div>
                                    <div class="panel-body">
                                          Dreamyard is an art center committed to providing sustained learning opportunities to communities in the South Bronx.  As an intern for their Maker program, I assisted a skilled maker in designing programs where students learned to code, build robots, and create homemade instruments, among other projects.  I provided most of the documentation for their blog, which can be found <a href="http://dreamityourself.tumblr.com">here</a>.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <img src="/res/experience/make-logo.png" class="img-rounded"/>
                        <div class="carousel-caption">
                         <div class="description col-xs-12">

                            <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Maker Corps Member, <a href="http://makered.org/makercorps/about-maker-corps/">Maker Education Initiative</a></h3>
                                    </div>
                                    <div class="panel-body">
                                        <strong>Summer 2013</strong>
                                    </div>
                                    <div class="panel-body">
                                        Last summer, I signed on as a participant in a nationwide pilot program to bring more Science, Technology, Engineering, and Technology related programs to children.  The particular host site I worked at was a summer camp for underperforming or underprivileged middle school students.  Throughout the summer, we integrated the camp's art program with STEM, introducing them to rudimentary coding, circuit design, and even 3D printing.  We kept a blog that summer which can be found <a href="http://hommocksmakercorps.wordpress.com/page/2">here</a>.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div><!-- /.carousel-inner -->
                  <!--  Next and Previous controls below
                        href values must reference the id for this carousel -->
                    <a class="carousel-control left" href="#this-carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                    <a class="carousel-control right" href="#this-carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div><!-- /.carousel -->
            </div>
        </div>


        <div id="contact" class="jumbotron attach">
            <div class="container">
                <h1>I'm social! Get in touch</h1>
                                    </div>
            </div>
        </div>

        <div id="myContact">
            <div class="container">
                <div class="row">
                    <div id="links" class="col-md-6">
                        <ul>
                            <li class="link"><a href="Kenny_Durkin_Resume.pdf"><img src="/res/contact/resume-icon.png"/></a><span class="icon_description">The one-pager.</span></li>
                            <li class="link"><a href="https://github.com/kennydurkin"><img src="/res/contact/github-icon.png"/></a><span class="icon_description">Where my code lives.</span></li>
                            <li class="link"><a href="https://linkedin.com/in/KennyDurkin"><img src="/res/contact/linkedin-icon.png"/></a><span class="icon_description">Me in a suit.</span></li>
                            <li class="link"><a href="https://twitter.com/KennyDurpin"><img src="/res/contact/twitter-icon.png"/></a><span class="icon_description">Day to day thoughts.</span></li>
                            <li class="link"><a href="https://plus.google.com/+KennethDurkin"><img src="/res/contact/googleplus-icon.png"/></a><span class="icon_description">I'm feeling lucky.</span></li>
                        </ul>
                    </div>
                    <div id="feeds" class="col-md-6">
                        <!--Twitter feed-->
                        <a class="twitter-timeline" href="https://twitter.com/KennyDurpin" data-widget-id="483571572133752832">Tweets by @KennyDurpin</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                </div>

                <div id="form-container" class="container">
                    <div id="contact_form" class="row">
                        <div class="col-12 col-sm-12 col-lg-12">
                            <h2>I'd love to hear from you!</h2>
                            <p>I appreciate any feedback about my site and how to make it better. Please fill in the below form with any comments and I will get back to you.</p>
                            <form role="form" id="feedbackForm">
                                <div class="form-group has-feedback">
                                    <label class="control-label" for="name">Name</label>
                                    <input type="text" class="form-control input-sm" id="name" name="name" />
                                    <span class="help-block" style="display: none;">Please enter your name.</span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="control-label" for="phone">Phone</label>
                                    <input type="tel" class="form-control input-sm optional" id="phone" name="phone" />
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="control-label" for="email">Email Address</label>
                                    <input type="email" class="form-control input-sm" id="email" name="email" />
                                    <span class="help-block" style="display: none;">Please enter a valid e-mail address.</span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="control-label" for="message">Message*</label>
                                    <textarea rows="5" cols="30" class="form-control input-sm" id="message" name="message"></textarea>
                                    <span class="help-block" style="display: none;">Please enter a message.</span>
                                </div>
                                <img id="captcha" src="library/vender/securimage/securimage_show.php" alt="CAPTCHA Image" />
                                <a class="captcha btn btn-info btn-sm" href="#" onclick="document.getElementById('captcha').src = 'library/vender/securimage/securimage_show.php?' + Math.random(); return false">Show a Different Image</a><br/>
                                <div class="form-group has-feedback" style="margin-top: 10px; margin-bottom:20px;">
                                    <label class="control-label" for="captcha_code">Text Within Image</label>
                                    <input type="text" class="form-control input-sm" name="captcha_code" id="captcha_code" placeholder="For security, please enter the code displayed in the box." />
                                    <span class="help-block" style="display: none;">Please enter the code displayed within the image.</span>
                                </div>
                                <span class="help-block" style="display: none;">Please enter a the security code.</span>
                                <button type="submit" id="feedbackSubmit" class="btn btn-primary btn-lg" data-loading-text="Sending..." style="display: block; margin: 0 auto;">Send Feedback</button>
                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>        

        <div class="footer">
            <div class="container page-container">
                <div class="row">
                    <div class="text-center span4 col-4 col-offset-4 offset4">
                        <h5>Find me on</h5>
                        <ul class="unstyled list-unstyled list-inline">
                            <li><a href="https://twitter.com/kennydurpin" target="_blank">
                                Twitter
                            </a></li>
                            <li><a href="https://www.github.com/kennydurkin" target="_blank">
                                Github
                            </a></li>
                            <li><a href="https://plus.google.com/+KennethDurkin" rel="publisher" target="_blank">
                                Google
                            </a></li>
                            <li><a href="http://linkedin.com/in/kennydurkin" target="_blank">
                                LinkedIn
                            </a></li>
                        </ul>
                        <div id="copyright" class="text-contrast">
                            © Copyright Kenny Durkin 2015
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/js/bootstrap.min.js"></script>
        <!-- Include contact form scripts -->
        <script src="assets/js/contact-form.js"></script>
        <!--Carousel script"-->
        <script>
            $(document).ready(function(){
                $('.carousel').carousel({
                    interval:10000
                });
            });
        </script>
        <!-- Smoothscroll/navigation script -->
        <script src="/js/smoothscroll.js"></script>
        <!-- Contact links script -->
        <script src="/js/linkscript.js"></script>   
        <!-- Mobile checker script -->
        <script src="/js/mobilecheck.js"></script>      
    </body>
</html>
