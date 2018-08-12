<?php

include "dbHelper.php";
$database=new Database();
if(isset($_POST['code']) && isset($_POST['periods']) && isset($_POST['exam']))
{
	$database->fetchTeacher($_POST);
}
else if(isset($_POST['roll']) && isset($_POST['mode']) && isset($_POST['code']) && isset($_POST['period']))
{
	if($_POST['mode']==1)
	{
		$database->addClass($_POST);
	}
	else
	{
		$database->addExam($_POST);
	}
}
?>
