<?php
    session_start();
    if(isset($_SESSION["name"]) && isset($_SESSION["code"]))
    {
        if(isset($_POST['id']))
        {
            $id= htmlentities($_POST['id']);
            $id= htmlentities($_POST['code']);
            
            if($id=="1010")//validate
            {
                //read from db
                $name="Ram";
                $period=2;
                
                header("Location:logged.php?name=".$name."&period=".$period);
            }
            else
            {
                
            }
        }
    }
?>