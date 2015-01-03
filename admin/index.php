<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Kenneth Durkin</title>
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
        <link href="/css/style.css" rel="stylesheet" type="text/css" media="screen"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-51243910-1', 'kennydurkin.info');
            ga('send', 'pageview');
        </script>
        <script>
            $(function() {
                $('a[href*=#]:not([href=#]):not(.carousel-control)').click(function() {
                    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
                        || location.hostname == this.hostname) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                        if (target.length) {
                            $('html,body').animate({
                                 scrollTop: target.offset().top
                            }, 1000);
                        return false;
                        }
                    }
                });
            });
        </script>
    </head>

    <body>
        <div class="navbar navbar-fixed-top" role="navigation">
            <div class="container">
                <ul class ="nav pull-left">
                    <li><a href="#"></a></li>
                </ul>
                <ul class="nav nav-pills pull-right">
                    <li class="active"><a href="#home">HOME</a></li>
                    <li><a href="#projects">PROJECTS</a></li>
                    <li><a href="#education">EDUCATION</a></li>
                    <li><a href="#experience">EXPERIENCE</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                </ul>
            </div>
        </div>

        <div id="home" class="jumbotron">
            <div class="container">
                <h1>Kenny Durkin makes things</h1>
                <p id="greeting"></p>
                <a href="#">Learn more</a>
            </div>
        </div>

        <div class="learn-more">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Projects</h3>
                        <p>From hackathons to homework assignments, I love to design and develop cool hardware and software projects in my free time.</p>
                        <p><a href="#projects">Check some of them out!</a></p>
                    </div>
                    <div class="col-md-4">
                        <h3>Education</h3>
                        <p>I'm working towards my bachelors in Computer Science at Fordham University, but some of the best learning occurs outside of the classroom.</p>
                        <p><a href="#education">Some of my repertoire!</a></p>
                    </div>
                    <div class="col-md-4">
                        <h3>Experience</h3>
                        <p>It's been a privilege to contribute to and learn more about the field in several work environments over the beginning of my career.</p>
                        <p><a href="#experience">A list of those awesome places!</a></p>
                    </div>
                </div>
            </div>
        </div>

        <div id="projects" class="jumbotron">
            <div class="container">
                <h1>A glimpse of my portfolio...</h1>
                <a href="#">Learn more</a>
            </div>
        </div>

        <?php

        $orderBy = array('name', 'date_created','description_1','description_2','tech_used','collaborators');
        $dblocation="localhost";$dbname="portfolio_site";$username='root';$password='924plk546';$table = 'projects';

        try {
            $conn = new PDO("mysql:host={$dblocation};dbname={$dbname}", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $action = isset($_GET['action']) ? $_GET['action'] : "";
            //if redirected from delete.php
            if($action=='deleted'){
                echo '<div style="position:relative;top:50px;">Record was deleted.</div>';
            }

            $order = 'date_created DESC';
            if (isset($_GET['orderBy']) && in_array($_GET['orderBy'], $orderBy)){
               $order = $_GET['orderBy']; 
            }
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
                <div id="buttons">
                    <a id="create" href = 'add.php'>Create New Project</a>
                    <div id="sort" class="dropdown pull-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sort By <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="index.php?orderBy=name">Name</a></li>
                            <li><a href="index.php?orderBy=date_created">Date Created</a></li>
                            <li><a href="index.php?orderBy=description_1">Description 1</a></li>
                            <li><a href="index.php?orderBy=description_2">Description 2</a></li>
                            <li><a href="index.php?orderBy=tech_used">Tech Used</a></li>
                            <li><a href="index.php?orderBy=collaborators">Collaborators</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <?php for($i=1; $i <= ($stmt->rowCount()) ;$i++) {
                        $row = $stmt->fetch();
                        extract($row); ?>

                        <div class="proj col-sm-4" style="background-image: url('../<?php echo sprintf ('%s',$picture);?>');">
                            <?php echo sprintf('<a href = "%s" >', $link); ?>
                                <div class="desc col-sm-12">
                                    <p style="top:10%;"><?php echo sprintf('%s / ', $name); echo sprintf('%s', $date_created); echo sprintf ('<a href=edit.php?id=%s>',$id);?> (Edit)</a></p>
                                    <p style="top:20%;"><?php echo sprintf('%s', $description_1);?></p>
                                    <p style="top:30%;"><?php echo sprintf('%s', $description_2);?></p>
                                    <p style="top:40%;"><?php echo sprintf('%s / ', $tech_used); echo sprintf('%s', $collaborators); ?></p>
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

        <div class="footer">
            <div class="container page-container">
                <div class="row">
                    <div class="text-center span4 col-4 col-offset-4 offset4">
                        <h5>Follow me on</h5>
                        <ul class="unstyled list-unstyled list-inline">
                            <li><a href="https://twitter.com/kennydurpin" target="_blank">
                                Twitter
                            </a></li>
                            <li><a href="https://www.facebook.com/kennydurpin" target="_blank">
                                Facebook
                            </a></li>
                            <li><a href="https://plus.google.com/+KennethDurkin" rel="publisher" target="_blank">
                                Google
                            </a></li>
                            <li><a href="http://www.instagram.com/kennydurpin" target="_blank">
                                Instagram
                            </a></li>
                        </ul>
                        <div id="copyright" class="text-contrast">
                            © Copyright Kenny Durkin 2014
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Delete confirmation window script-->
        <script type='text/JavaScript'>
        function delete_user(id){
            var answer = confirm("Are you sure homie?");
            if (answer){
                //if ok, pass id to delete.php
                window.location = 'delete.php?id=' + id;
            }
        }
        </script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/js/bootstrap.min.js"></script>
        <!--Carousel script"-->
        <script>
            $(document).ready(function(){
                $('.carousel').carousel({
                    interval:10000
                });
            });
        </script>
        <!-- Date Checker script -->
        <script src="/js/script.js"></script>           
    </body>
</html>