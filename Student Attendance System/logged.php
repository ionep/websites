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
        <?php
			include 'webHelper.php';
            session_start();
            if(isset($_SESSION['name']) && isset($_SESSION['code']))
            {
                $name=$_SESSION['name'];
                $code=$_SESSION['code'];
                $database=new Database();
                $period= $database->fetchTeacher($name,$code);
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>Welcome Mr. 
                        <?php
                            echo $name;
                        ?>
                    </h1>
                </div>
                <div class="col-md-12 text-center">
                    <h3> You have taken
                        <?php
                            echo $period;
                        ?>
                         periods.
                    </h3>
                </div>
                <div class="col-md-8 offset-2">
                    <form action="search.php" method="post" class="row">
                        <input type="hidden" value="<?php echo $code; ?>" name="code" >
                    <div class="col-md-6 text-center">
                        Student name or ID:
                    </div>
                    <div class="col-md-6 text-center">
                        <input type="text" name='id'>
                    </div>
                    <div class="col-md-12 text-center">
                        <button class="btn-normal">Search</button>
                    </div>
                    </form>
				</div>
				<div class="col-md-8 offset-2">
					<?php
						if(isset($_GET['sname']) && isset($_GET['speriod']))
						{
							echo "<hr>";
							$sname=$_GET['sname'];
							$speriod=$_GET['speriod'];
							$percent=ceil($speriod/$period*100);
							if($percent<70)
							{
								$stat="NQ";
							}
							else
							{
								$stat="Qualified";
							}
							echo "<div class='text-center'>".$sname."&nbsp; &nbsp; &nbsp; &nbsp;".$percent."% (".$stat.")</div>";
						echo "<hr>";
						}
						else if(isset($_GET['err']))
						{
							if($_GET['err']==-1){
								echo '<hr><div class="col-md-12 text-center">Error data</div><hr>';
							}
							else if($_GET['err']==-2){
								echo '<hr><div class="col-md-12 text-center">Student Not Found</div><hr>';
							}
						}
					?>
				</div>
                <div class="col-md-12 text-center">
                    <form action="logout.php">
                    <button class="btn-normal">Logout</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
            }
            else 
            {
                header("Location:index.php?err=0");
            }
        ?>
    </body>
</html>
