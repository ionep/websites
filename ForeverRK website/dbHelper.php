<?php
	class Database
	{
		private $dbUser='foreverr_admin';
		private $dbPass='tnipib147';
		private $host='mysql:dbname=foreverr_main;host=localhost';
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

		
		public function fetchData($data)
		{
			$dbdata=array();
			$chkmail=$data['email'];
			$conn=$this->conn;
			try{
				$sql="SELECT * FROM users WHERE email='$chkmail' ORDER BY time DESC LIMIT 5";
				$i=0;
				//read the data
				foreach($conn->query($sql) as $row)
				{
					$dbdata[$i]=$row;
					$i++;
				}
				//check for top 5
				if($i>4)
				{
					//check if the latest 5th mail was sent in the recent hour
					if((time()-$dbdata[4]['time'])<3600)
					{
                    	return false;
					}
				}
				//check for identical message
				else if(isset($dbdata[0]))
				{
				    if($dbdata[0]['message']==$data['message'])
				    {
					    return false;
				    }
				}
				return true;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}

		public function addData($data,$btn)
		{
		    $conn=$this->conn;
			$i=count($data);		
			if($i>0)
			{
				try{
					//validate user as authentic
					if($this->fetchData($data))
					{
						//insert data
						$sql="INSERT INTO users(name,email,contact,message,time) VALUES (:username,:email,:phone,:message,:time)";
						$stmt=$conn->prepare($sql);
						foreach($data as $key=>$val)
						{
							if($key!=$btn)
							{
								$stmt->bindValue($key,$val);
							}
						}
						$stmt->bindValue('time',time());
						$stmt->execute();
						return true;
					}
					else{
						return false;
					}
				}
				catch(PDOException $e)
				{
					echo $e->getMessage();
					return false;
				}
			}
			else
			{
				return false;
			}
		}
	}
?>