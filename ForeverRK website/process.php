<?php

	include "dbHelper.php";

	if(isset($_POST['submit']))
	{
		$errCode=0;
		$userName=htmlentities($_POST['username']);
		$email=htmlentities($_POST['email']);
		$phone=htmlentities($_POST['phone']);
		$message=htmlentities($_POST['message']);

		if(empty($userName))
		{
			$errCode=1;
		    header("Location:index.php?code=".$errCode."&pname=".$_POST['username']."&pemail=".$_POST['email']."&pphone=".$_POST['phone']."&pmessage=".$_POST['message']."#contact");
		}
		else if(empty($email) || empty($phone))
		{
			$errCode=2;
			header("Location:index.php?code=".$errCode."&pname=".$_POST['username']."&pemail=".$_POST['email']."&pphone=".$_POST['phone']."&pmessage=".$_POST['message']."#contact");
		}
		else if(empty($message))
		{
			$errCode=3;
			header("Location:index.php?code=".$errCode."&pname=".$_POST['username']."&pemail=".$_POST['email']."&pphone=".$_POST['phone']."&pmessage=".$_POST['message']."#contact");
		}
		else
		{
			$database=new Database();
			if($database->addData($_POST,'submit'))
			{
				$errCode=0;
				$to      = 'foreverrkphotography@gmail.com';
                $subject = 'Message From website';
                $message = "Name: ".$userName."\r\n"."Email: ".$email."\r\n"."Phone: ".$phone."\r\n"."Message: ".$message."\r\n";
                $headers = 'From: ForeverRKWebsite' . "\r\n" .
                'Reply-To: donotreply' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $message, $headers);
                header("Location:index.php?code=".$errCode);
			}
			else{
				$errCode=4;
				header("Location:index.php?code=".$errCode."&pname=".$_POST['username']."&pemail=".$_POST['email']."&pphone=".$_POST['phone']."&pmessage=".$_POST['message']."#contact");
			}
		}
	}
?>