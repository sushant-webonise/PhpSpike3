<?php

class my_pdo
{
	
	function __construct($hostname,$username,$password) 
	{
        try {
              $dbh = new PDO("mysql:host=$hostname;dbname=students", $username, $password);
              echo 'Connected to database';
            }
	     catch(PDOException $e)
        {
           echo $e->getMessage();
        }
    }
    function fetch_asso()
    {
	    try{
		   	$dbh = new PDO("mysql:host=localhost;dbname=students", 'root','');
			   $sql = "SELECT * FROM stud";
       		$stmt = $dbh->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            foreach($result as $key=>$val)
    		   {
   			   echo $key.' - '.$val.'<br />';
    		   }
   
    
	       }
			catch(PDOException $e)
    		{
    		  echo $e->getMessage();
    		}    	
    	   	
    	
   }
  
  function fetch_num()
  {
  		try{
			$dbh = new PDO("mysql:host=localhost;dbname=students", 'root','');
			$sql = "SELECT * FROM stud";
    		$stmt = $dbh->query($sql);
         $result = $stmt->fetch(PDO::FETCH_NUM);

         foreach($result as $key=>$val)
    		{
   			 echo $key.' - '.$val.'<br />';
    		}
         }
			catch(PDOException $e)
    		{
    		echo $e->getMessage();
    		}    
  	}
  	
  	function fetch_both()
  	{
  			try{
			     $dbh = new PDO("mysql:host=localhost;dbname=students", 'root','');
              $sql = "SELECT * FROM stud";
              $stmt = $dbh->query($sql);
              $result = $stmt->fetch(PDO::FETCH_BOTH);
 
              foreach($result as $key=>$val)
              {
   			  echo $key.' - '.$val.'<br />';
              }
     }
     catch(PDOException $e)
     {
    	echo $e->getMessage();
     }    
		  			
  			
  	}
  		
  	function fetch_obj()
  	{
		try{
			  $dbh = new PDO("mysql:host=localhost;dbname=students", 'root','');
			  $sql = "SELECT * FROM stud";
    		  $stmt = $dbh->query($sql);
    	     $obj = $stmt->fetch(PDO::FETCH_OBJ);
           echo $obj->roll_no.'<br />';
    		  echo $obj->name.'<br />';
         }
			catch(PDOException $e)
    		{
    		  echo $e->getMessage();
    		}    
  			
  	}
  		
  	function fetch_lazy()
  	{
		try{
			$dbh = new PDO("mysql:host=localhost;dbname=students", 'root','');
			$sql = "SELECT * FROM stud";
    		$stmt = $dbh->query($sql);
         $result = $stmt->fetch(PDO::FETCH_LAZY);
 
         foreach($result as $key=>$val)
    		{
   			 echo $key.' - '.$val.'<br />';
    		}
   
    
	     }
			catch(PDOException $e)
    		{
    		echo $e->getMessage();
    		}    
  			
  	}
  			
  			
  				
  	function error_handle()
  	{
  	try {
   
       $dbh = new PDO("mysql:host=localhost;dbname=students", 'root','');
       $sql = "SELECT marks FROM students";

        foreach ($dbh->query($sql) as $row)
        {
         print $row['roll_no'] .' - '. $row['name'] . '<br />';
        }
       }
      catch(PDOException $e)
      {
        echo $e->getMessage();
      }
  	}
  			
  	function get_last_insert_id()
  	{
 		try {
             $dbh = new PDO("mysql:host=localhost;dbname=students", 'root','');
             $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $dbh->exec("INSERT INTO stud VALUES(10,'xyz')");
             echo $dbh->lastInsertId();
             }
    catch(PDOException $e)
    {
    echo $e->getMessage();
    }
  	}
  				
  				
  	function do_transaction()
  	{
  		try {
   
    $dbh = new PDO("mysql:host=localhost;dbname=students", 'root','');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->beginTransaction();
    
    //$table = "CREATE TABLE teacher(t_id int NOT NULL AUTO_INCREMENT PRIMARY KEY,name VARCHAR(25) NOT NULL)";
    //$dbh->exec($table);
    
    $dbh->exec("INSERT INTO stud values(11,'ABC')");
    $dbh->exec("INSERT INTO stud values(12,'XYZ')");
	 $dbh->exec("INSERT INTO stud values(13,'PQR')");
    $dbh->exec("INSERT INTO stud values(14,'CDE')");
    
    $dbh->commit();
    
    echo 'Data entered successfully<br />';
     } 
     catch(PDOException $e)
     {
      $dbh->rollback();
       //echo $sql . '<br />' . 
      $e->getMessage();
     }
}

	function prepared_statement()
	{

	try {
    
    $dbh = new PDO("mysql:host=localhost;dbname=students", 'root','');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $roll_no = 1;
    $name = 'sushant';
    $stmt = $dbh->prepare("SELECT * FROM stud WHERE roll_no = :roll_no AND name = :name");
    $stmt->bindParam(':roll_no', $roll_no, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR, 5);
    $stmt->execute();
    $result = $stmt->fetchAll();
    foreach($result as $row)
    {
        echo $row['roll_no'].'<br />';
	     echo $row['name'].'<br />';
    }

    }
    catch(PDOException $e)
    {
    echo $e->getMessage();
    }		
		
	}
}


class students
{
	public $roll_no;
	public $name;
	
	public function __toString()
   {
      return $this->roll_no;
   }
	function fetch_class()
  	{
				
	try{
			$dbh = new PDO("mysql:host=localhost;dbname=students", 'root','');
			$sql = "SELECT * FROM stud";
    		$stmt = $dbh->query($sql);
    	   $obj = $stmt->fetchALL(PDO::FETCH_CLASS, 'students');
        foreach($obj as $students)
        {
        /*** call the capitalizeType method ***/
        echo $students->__toString().'<br />';
        } 

	}
	catch(PDOException $e)
   {
   	echo $e->getMessage();
   }    
		  				
  				
  	}
	
	
}


?>

<html>
<head>
<style type="text/css">

.head
{
	font-family: arial;
	text-decoration: underline;
	font-size: 18px;
	
}
</style>
</head>
<body>

<h1>PHP Data Objects</h1>
<span class="head">Database Conection Status</span>
<br>
<br>
<?php $pd=new my_pdo('localhost','root','');?>
<br><hr width="400px" align="left">
<br>
<span class="head">Fetch Associative</span>
<br>
<br>
<?php $pd->fetch_asso();?>
<br><hr width="400px" align="left">
<br>
<span class="head">Fetch Num</span>
<br>
<br>
<?php $pd->fetch_num();?>
<br><hr width="400px" align="left">
<br>
<span class="head">Fetch Both</span>
<br>
<br>
<?php $pd->fetch_both();?>
<br><hr width="400px" align="left">
<br>
<span class="head">Fetch Object</span>
<br>
<br>
<?php $pd->fetch_obj();?>
<br><hr width="400px" align="left">
<br>
<span class="head">Fetch Class</span>
<br>
<br>
<?php 
  
  $stud=new students;
  $stud->fetch_class();

?>
<br><hr width="400px" align="left">
<br>
<br>
<span  class="head">Fetch Lazy</span>
<br>
<br>
<?php  
  $pd->fetch_lazy();

?>
<br><hr width="400px" align="left">
<br>
<span class="head">Error Handling</span>
<br>
<br>
<?php $pd->error_handle(); ?>
<br><hr width="400px" align="left">
<br>
<span class="head">Last Insert ID</span>
<br>
<br>
<?php //$pd->get_last_insert_id(); ?>
<br><hr width="400px" align="left">
<br>
<span class="head">Transaction</span>
<br>
<br>
<?php $pd->do_transaction();?>
<br><hr width="400px" align="left">
<br>
<span class="head">Prepared Statement</span>
<br>
<br>
<?php $pd->prepared_statement();?>
<br><hr width="400px" align="left">
<br>

</body>
</html>