<html>
    <head>
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-3.2.1.min.js"></script>
        
        <link rel="stylesheet" href="css/home.css" />
        <title>Home page</title>
        
    </head>
    <body>
        <div class="container">
            <?php 
                session_start();
                if(isset($_SESSION["name"]) && isset($_SESSION["code"]))
                {
                    header("Location:logged.php");
                }
            ?>
            <form action="login.php" method="post">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Login</h1>
                    </div>
                    <div class="col-md-6 text-center">
                        Teacher name:
                    </div>
                    <div class="col-md-6 text-center">
                        <input type="text" name="name"/>
                    </div>
                    <div class="col-md-6 text-center">
                        Teacher code:
                    </div>
                    <div class="col-md-6 text-center">
                        <input type="password" name="code"/>
                    </div>
                    <div class="col-md-12 text-center">
                        <button class="btn-primary" name="login">Login</button>
                    </div>
                    <?php
                        if(isset($_GET['err']))
                        {
                            if($_GET['err']==1)
                            {
                                echo"
                                    <div class='col-md-12 text-center'>
                                        Incorrect name or code.
                                    </div>
                                    ";
                            }
                            else if($_GET['err']==0)
                            {
                                echo"
                                    <div class='col-md-12 text-center'>
                                        Please Login.
                                    </div>
                                    ";
                            }
                            else if($_GET['err']==2)
                            {
                                echo"
                                    <div class='col-md-12 text-center'>
                                        You are logged out.
                                    </div>
                                    ";
                            }
                        }
                    ?>
                </div>
            </form>
        </div>
    </body>
</html>
