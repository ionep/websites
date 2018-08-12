<?php
	include 'webHelper.php';
    session_start();
    if(isset($_SESSION["name"]) && isset($_SESSION["code"]))
    {
        if(isset($_POST['id']))
        {
            $id= htmlentities($_POST['id']);
            $code= htmlentities($_POST['code']);
            
            $database=new Database();
            
            $data=$database->fetchStudent($id,$code);
            if($data==-1)
            {
				header("Location:logged.php?err=-2");
			}
			else
			{
				$name=$data[0];
				$period=$data[1];
				header("Location:logged.php?sname=".$name."&speriod=".$period);
			}
        }
        else{
			header("Location:logged.php?err=-1");
		}
    }
?>
