<?php
class hello{ 
  var $search;
  var $shortvalue;
  var $order;
	var $username;
	var $password;
	var $gender;
	var $status;
	var $id;
	var $connection;
  var $page;
  var $slot;
	function __construct()
	{
		$this->connection=new mysqli('localhost','root','');
		   mysqli_select_db($this->connection,'task5');
	}

	function registerentry(){
		$query="INSERT INTO task5table(username,password,gender,status)
		        VALUES('$this->username','$this->password','$this->gender','$this->status')";
		        $run=mysqli_query($this->connection,$query);
		        
	}
	function readrecords()
	{
		$query="SELECT * FROM task5table";
		$run=mysqli_query($this->connection,$query);
		return $run;
	}
	 function getdetailsbyid()
	 {

	    $query="SELECT * FROM task5table WHERE id='$this->id'";
	 	$run=mysqli_query($this->connection,$query);
	 	$records=mysqli_fetch_assoc($run);
	 	return $records;

	 }
    function update()
    {
    	$query="UPDATE task5table SET username='$this->username', password='$this->password', gender='$this->gender', status='$this->status' WHERE id='$this->id'";
    	 $run=mysqli_query($this->connection,$query);
    	 
    }
    function deleteuser()
    {
    	$query="DELETE FROM task5table WHERE id='$this->id'";
    	
    	 mysqli_query($this->connection,$query);
    }
      function checkrecords(){
      	$query="SELECT id FROM task5table WHERE username='$this->username'";
      	$x=mysqli_query($this->connection,$query);
      	$y=mysqli_num_rows($x);
      	if($y>0)
      		return 1;
      	else
      		return 0;
      }
      function updatecheckrecords(){

      	 $query="SELECT password FROM task5table WHERE username='$this->username' AND id !='$this->id'";
      	$x=mysqli_query($this->connection,$query);
      	$y=mysqli_num_rows($x);
      	if($y>0)
      		return 1;
      	else
      		return 0;
      }
      function deleteall()
      {
        $query="TRUNCATE TABLE task5table ";
        mysqli_query($this->connection,$query);
      }

       function deleteselectedrecords()
       {
            $query="DELETE FROM task5table WHERE id='$this->id'";
            mysqli_query($this->connection,$query);
       }

        function shortrecords()
        {
          $query="SELECT * FROM task5table ORDER BY $this->shortvalue $this->order";
          $run=mysqli_query($this->connection,$query);
             return $run;
        } 

           
         function countrecords()
         {
            $query="SELECT COUNT(id) as numofrows FROM task5table";
               $run=mysqli_query($this->connection,$query);
            $num=mysqli_fetch_assoc($run);
            return $num['numofrows'];
          
         }

         function paginate()
         {    
              if($this->page==1)
              {
                $x=$this->page=0;
              }

             else{
                $x=($this->page-1)*$this->slot;
             }
            $query="SELECT * FROM task5table ORDER BY $this->shortvalue $this->order LIMIT $x,$this->slot";
              $run=mysqli_query($this->connection,$query);
              return $run;
         }     
       
         function search()
          { 
            $query="SELECT * FROM task5table  WHERE username LIKE '%$this->search%'";
               $run=mysqli_query($this->connection,$query);
                  return $run;             
          }
          function searchpage()
          { 
            if($this->page==1)
              {
                $x=$this->page=0;
              }

             else{
                $x=($this->page-1)*$this->slot;
             }
               
            $query="SELECT * FROM task5table  WHERE username LIKE '%$this->search%' LIMIT $x,$this->slot ";
               $run=mysqli_query($this->connection,$query);
                  return $run;        
          } 
            function shortvalue()
            { 
              
             if($this->order=="ASC"){
               if($this->page==1)
              {
                $x=$this->page=0;
              }

             else{
                $x=($this->page-1)*$this->slot;
             }
               $query="SELECT * FROM task5table  ORDER BY $this->shortvalue $this->order  LIMIT  $x,$this->slot";
          $run=mysqli_query($this->connection,$query);
             return $run;
            }
            else {
                    $records=$this->countrecords();
             $x=$records-($this->page * $this->slot);
            $query="SELECT * FROM task5table   ORDER BY $this->shortvalue $this->order  LIMIT  $x,$this->slot";
          $run=mysqli_query($this->connection,$query);
             return $run;
            }
        }
        function shortdatapage()
        {
                   if($this->page==1)
              {
                $x=$this->page=0;
              }

             else{
                $x=($this->page-1)*$this->slot;
             }
            $query="SELECT * FROM task5table ORDER BY $this->shortvalue $this->order LIMIT $x,$this->slot";
              $run=mysqli_query($this->connection,$query);
              return $run;
        }
      }
?>
     
      	


