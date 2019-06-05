<?php
  class hello{
     var $name;
     var $ph_no;
     var $city;
     var $state;
     var $connection;
     var $id;
        function __construct()
        {         
                $this->connection=new mysqli('localhost','root','');
                 mysqli_select_db($this->connection,'task4');

        }

         function display()
         {
         	$query="SELECT * FROM task4table";
         	$data=mysqli_query($this->connection,$query);
               return $data;
         }
         function getbyid()
         {
         	$query="SELECT * FROM task4table WHERE id = $this->id";
         	 $run=mysqli_query($this->connection,$query);
         	$data=@mysqli_fetch_assoc($run);
         	return $data;
         }
         function update()
         {   
         	
         	/* echo $this->name;
         	 echo $this->ph_no;
         	 echo $this->city;
         	 echo $this->state;
         	 echo $this->id;
         	 exit;*/
         	$query="update task4table SET name='$this->name',ph_no='$this->ph_no',city='$this->city',state='$this->state' WHERE id='$this->id'";
         	   $run=mysqli_query($this->connection,$query);
         	   header('location:display.php');
         }
         function delete(){
         	   $query="DELETE FROM task4table WHERE id='$this->id'";
         	   $run=mysqli_query($this->connection,$query);
         }
         function insert()
         {
              /*echo $this->name;
              echo $this->ph_no;
              echo $this->city;
              echo $this->state;
              exit;*/


         	$query="INSERT INTO task4table(name,ph_no,city,state)
         	         VALUES('$this->name','$this->ph_no','$this->city','$this->state')";
         	         $run=mysqli_query($this->connection,$query);
         	         print_r($run);
         	        
         }
  } 
      

?>