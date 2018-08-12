<?php
	class Database
	{
		private $dbUser='root';
		private $dbPass='';
		private $host='mysql:dbname=students;host=localhost';
		//private $dbUser='root';
		//private $dbPass='';
		//private $host='mysql:dbname=test;host=127.0.0.1';
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

		
		public function fetchTeacher($data)
		{
			$code=htmlentities($data['code']);
			$periods=htmlentities($data['periods']);
			$exam=$data['exam'];
			$conn=$this->conn;
			try{
				$teacher=[];
				$sql="SELECT * FROM teachers WHERE code='$code'";
				//read the data
				foreach($conn->query($sql) as $row)
				{
					$teacher=$row;
				}
				#print_r($teacher);
				if(!empty($teacher))
				{
					if($exam==0)
					{
						$periods+=(int)$teacher['period'];
						$sql="UPDATE teachers SET period='$periods' WHERE code='$code'";
						$conn->query($sql);
					}
					echo $teacher['name'];
				}
				else
				{
					echo "-1";
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		public function addClass($data)
		{
			$roll=htmlentities($data['roll']);
			$code=htmlentities($data['code']);
			$period=htmlentities($data['period']);
			$old=false;
		    $conn=$this->conn;
			try{
				//validate user as authentic
				$val=$this->validate($roll,$code,$old);
				if($val!=-1 && $val!=-2)
				{
					if(!$old)
					{
						//insert data
						$sql="INSERT INTO students(name,roll,code,period,entry) VALUES (:name,:roll,:code,:period,:entry)";
						$stmt=$conn->prepare($sql);
						$stmt->bindValue('name',$val);
						$stmt->bindValue('roll',$roll);
						$stmt->bindValue('code',$code);
						$stmt->bindValue('period',$period);
						$stmt->bindValue('entry',time());
						$stmt->execute();
						echo $val;
					}
					else
					{
						$student=[];
						$sql="SELECT period FROM students WHERE roll='$roll' AND code='$code'";
						foreach($conn->query($sql) as $row)
						{
							$student=$row;
						}
						if(!empty($student))
						{
							$period+=(int)$student[0];
							$time=time();
							$sql="UPDATE students SET period='$period',entry='$time' WHERE roll='$roll' AND code='$code'";
							$conn->query($sql);
							echo $val;
						}
						else
						{
							echo "-1";
						}
					}
				}
				else if($val==-2){
					echo "-2";
				}
				else{
					echo "-1";
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}
		
		public function addExam($data)
		{
			$roll=htmlentities($_POST['roll']);
			$code=htmlentities($_POST['code']);
			$passed=$_POST['time'];
			if($_POST['number']==2)
			{
				$code2=htmlentities($_POST['code2']);
			}
			else
			{
				$code2="none";
			}
			try{
				$conn=$this->conn;
				
				//validate
				$sql="SELECT name from list WHERE roll='$roll'";
				$verify=[];
				foreach($conn->query($sql) as $row)
				{
					$verify=$row;
				}
				
				if(!empty($verify))
				{
					/*if($_POST['number']==1)
					{
						$sql="SELECT * FROM exam WHERE roll='$roll' AND code1='$code' AND code2='none'";
						$student=[];
						foreach($conn->query($sql) as $row)
						{
							$student=$row;
						}
						if(empty($student))
						{
							if($passed<=30)
							{
								$sql="INSERT INTO exam(name,roll,code1,entry,last) VALUES (:name,:roll,:code1,:entry,:last)";
								$stmt=$conn->prepare($sql);
								$stmt->bindValue('name',$verify['name']);
								$stmt->bindValue('roll',$roll);
								$stmt->bindValue('code1',$code);
								$stmt->bindValue('entry',time());
								$stmt->bindValue('last',time());
								$stmt->execute();
								echo $verify['name'];
							}
							else
							{
								echo "-3";//cant come in
							}
						}
						else{
							if((time()-(int)$student['last'])<10)
							{
								echo "-2";//multiple
								return;
							}
							elseif($passed<=30)
							{
								echo "-4";//cant go out
							}
							else
							{
								if((int)$student['exit']==0)
								{
									if((int)$student['timeout']==0)
									{
										$time=time();
										$sql="UPDATE exam SET timeout='$time',last='$time' WHERE roll='$roll' AND code1='$code' AND code2='none'";
										$conn->query($sql);
										echo "0";//out
									}
									else{
										$ntime=time();
										$time=$ntime-(int)$student['timeout'];
										if($time<20)
										{
											$sql="UPDATE exam SET timein='$ntime',last='$ntime' WHERE roll='$roll' AND code1='$code' AND code2='none'";
											$conn->query($sql);
											echo "1";//welcome back
										}
										else
										{
											$time=time();
											$exit=(int)$student['timeout'];
											$sql="UPDATE exam SET exit='$exit',last='$time' WHERE roll='$roll' AND code1='$code' AND code2='none'";
											$conn->query($sql);
											echo "-5";//already out
										}
									}
								}
								else{
									echo "-5";
								}
							}
						}
					}
					else{*/
						$sql="SELECT * FROM exam WHERE roll='$roll' AND code1='$code' AND code2='$code2'";
						$student=[];
						foreach($conn->query($sql) as $row)
						{
							$student=$row;
						}
						if(empty($student))
						{
							if($passed<=30)
							{
								$sql="INSERT INTO exam(name,roll,code1,code2,entry,last) VALUES (:name,:roll,:code1,:code2,:entry,:last)";
								$stmt=$conn->prepare($sql);
								$stmt->bindValue('name',$verify['name']);
								$stmt->bindValue('roll',$roll);
								$stmt->bindValue('code1',$code);
								$stmt->bindValue('code2',$code2);
								$stmt->bindValue('entry',time());
								$stmt->bindValue('last',time());
								$stmt->execute();
								echo $verify['name'];
							}
							else
							{
								echo "-3";//cant come in
							}
						}
						else{
							if((time()-(int)$student['last'])<10)
							{
								echo "-2";//multiple
								return;
							}
							elseif($passed<=30)
							{
								echo "-4";//cant go out
							}
							else
							{
								if((int)$student['exit']==0)
								{
									if((int)$student['timeout']==0)
									{
										$time=time();
										$sql="UPDATE exam SET timeout='$time',last='$time' WHERE roll='$roll' AND code1='$code' AND code2='$code2'";
										$conn->query($sql);
										echo "0";//out
									}
									else{
										$ntime=time();
										$time=$ntime-(int)$student['timeout'];
										if($time<20)
										{
											$sql="UPDATE exam SET timein='$ntime',last='$ntime' WHERE roll='$roll' AND code1='$code' AND code2='$code2'";
											$conn->query($sql);
											echo "1";//welcome back
										}
										else
										{
											$time=time();
											$exit=(int)$student['timeout'];
											$sql="UPDATE exam SET exit='$exit',last='$time' WHERE roll='$roll' AND code1='$code' AND code2='$code2'";
											$conn->query($sql);
											echo "-5";//already out
										}
									}
								}
								else{
									echo "-5";
								}
							//}
						}
					}
				}
				else{
					echo "-1";// student not found
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		} 
		
		public function validate($roll,$code,&$old)
		{
			try{
				$student=[];
				$conn=$this->conn;
				$sql="SELECT * FROM list WHERE roll='$roll'";
				foreach($conn->query($sql) as $row)
				{
					$student=$row;
				}
				if(!empty($student))
				{
					$check=[];
					$sql="SELECT entry FROM students WHERE roll='$roll' AND code='$code'";
					foreach($conn->query($sql) as $row)
					{
						$check=$row;
					}
					if(!empty($check))
					{
						if((time()-$check[0])<20)#3 mins only need to change
						{
							return -2;
						}
						else
						{
							$old=true;
							return $student['name'];
						}
					}
					else
					{
						return $student['name'];
					}
				}
				else
				{
					return -1;
				}
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
				return false;
			}
		}
	}
?>
