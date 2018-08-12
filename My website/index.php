<!DOCTYPE html>
<html>
    <head>
        <?php 
            include 'head.html';
        ?>
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    </head>
    <body>
        <!-- Top section -->
        <header>
            <div class="container">
                <?php
                    include 'header.php';
                ?>
                <div class="profile">
                    <div class="row">
                        <div class="col-sm-8 col-md-4 col-lg-3">
                            <div class="profile-image">
                                <img src="assets/profile.jpg" alt="image">
                            </div>
                        </div>

                        <div class="col-sm-10 col-md-5 col-lg-6 info">
                            <h2>Bipin Thapa Magar</h2>
                            <h4>Student (B.E. Electronics and Communication)</h4>
                            <ul class="list-unstyled">
                                <li><b>Born</b> : June 18, 1998</li>
                                <li><b>Email</b> : tbipin12@gmail.com</li>
                                <li><b>Age</b> : <script>document.write(new Date().getFullYear()-1998);</script></li>
                            </ul>
                            <ul class="list-unstyled">
                                <li class="list-icons">
                                    <a href="http://facebook.com/bipin.thapa.5680" target="_blank" title="facebook">
                                        <span class="fa-stack fa-1x">
                                            <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                            <i class="fab fa-facebook fa-stack-1x"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-icons">
                                    <a href="https://www.instagram.com/tbipin12/" target="_blank" title="instagram">
                                        <span class="fa-stack fa-1x">
                                            <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                            <i class="fab fa-instagram fa-stack-1x"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-icons">
                                    <a href="https://plus.google.com/104590071122868483126" target="_blank" title="google plus">
                                        <span class="fa-stack fa-1x">
                                            <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                            <i class="fab fa-google fa-stack-1x"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-icons">
                                    <a href="https://github.com/ionep" target="_blank" title="github">
                                        <span class="fa-stack fa-1x">
                                            <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                            <i class="fab fa-github fa-stack-1x"></i>
                                        </span>
                                    </a>
                                </li>
                                <li class="list-icons">
                                    <a href="https://www.linkedin.com/in/bipin-thapa/" target="_blank" title="linked in">
                                        <span class="fa-stack fa-1x">
                                            <i class="fa fa-circle fa-stack-2x icon-background"></i>
                                            <i class="fab fa-linkedin fa-stack-1x"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- About Me-->
        <section id="about">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-3">
                        <h2>About me</h2>
                        <br><span>A little background</span>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        <p>Programming and robotics are both a hobby and something which I have a lot of interest in. Based on programming, I am familiar with a few languages. On web-based applications, I know HTML, CSS, Javascript, Jquery, Bootstrap, PHP and MYSQL as database. I have also learnt C, C++, Java, Python and Android. I also have experience in many electronics components and have done programming and designing on Arduino, 8051, AVR and Raspberry PI. I have also built a few robots, both in categories of semi-autonomous(remote controlled) and fully autonomous.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <?php
                include 'footer.php';
            ?>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>