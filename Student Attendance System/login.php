<?php
    session_start();
    if(isset($_SESSION["name"]) && isset($_SESSION["code"]))
    {
        header("Location:logged.php");
    }
    else
    {
        if(isset($_POST))
        {
            $name= htmlentities($_POST['name']);
            $code= htmlentities($_POST['code']);
            if($name=="Kamal Gautam" && $code=="0000")//verify database
            {
                session_start();
                $_SESSION['name']=$name;
                $_SESSION['code']=$code;
                header("Location:logged.php");
            }
            else
            {
                header("Location:index.php?err=1");
            }
        }
    }
?>