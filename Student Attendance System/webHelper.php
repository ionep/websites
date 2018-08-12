<?php
	class Database
	{
		private $dbUser='root';
		private $dbPass='';
		private $host='mysql:dbname=students;host=localhost';
		private $conn;
		public function __construct()
		{
			try{
				$this->conn=new PDO($this->host,$this->dbUser,$this->dbPass);
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
		
		public function fetchTeacher($name,$code)
		{
			$teacher=[];
			$conn=$this->conn;
			$sql="SELECT period FROM teachers WHERE name='$name' AND code='$code'";
			foreach($conn->query($sql) as $row)
			{
				$teacher=$row;
			}
			if(!empty($teacher))
			{
				return $teacher[0];
			}
			else
			{
				return false;
			}
		}
		
		public function fetchStudent($id,$code)
		{
			$conn=$this->conn;
			$student=[];
			$sql="SELECT name,period FROM students WHERE (roll='$id' OR name='$id') AND code='$code'";
			foreach($conn->query($sql) as $row)
			{
				$student=$row;
			}
			if(!empty($student))
			{
				return $student;
			}
			else
			{
				return -1;
			}
		} 

	}
?>
