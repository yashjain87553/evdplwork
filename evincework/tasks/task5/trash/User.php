<?php 

 
class User extends DbConfig {

        //public $db;

        public function __construct()
    {
        parent::__construct();
    }

         public function check_login($emailusername, $password){

            $password = md5($password);
            $sql2="SELECT * from user WHERE email='$emailusername' and password='$password'";

            //checking if the username is available in the table
           $result = $this->connection->query($sql2);
            $count_row = $result->num_rows;
             $user_data = mysqli_fetch_array($result);
            if ($count_row == 1) {
            	
                // this login var will use for the session thing
                //$_SESSION['login'] = "";
                $_SESSION['user_id'] = $user_data['id'];
                return true;
            }
            else{
                return false;
            }
        }

        public function insert_data($title,$image,$description){
        	//echo $title."---".$image."--".$description;exit;
        	$sql = "INSERT INTO post (title,file,descr)
			VALUES ('".$title."', '".$image."', '".$description."')";
			//echo $sql;exit;
			$result = $this->connection->query($sql);
			if($result)
				{
				return "Success";

				}
				else
				{
				return "Error";

				}



        }
         public function select_data($table)
         {  
           $array = array();  
           $query = "SELECT * FROM ".$table."";  
           $result = $this->connection->query($query);
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[] = $row;  
           }  
           return $array;  
      }  
      public function select_data_front($table)
         {  
           $array = array();  
           $query1 = "SELECT * FROM ".$table."";  
           $result = $this->connection->query($query1);
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array[] = $row;  
           }  
           return $array;  
      } 
      public function select_edit_data($table,$id)
         {  
           $array = array();  
           $query2 = "SELECT * FROM $table WHERE id='$id'"; 
           //ECHO  $query2;exit; 
           $result = $this->connection->query($query2);
           while($row = mysqli_fetch_assoc($result))  
           {  
                $array = $row;  
           }  
           return $array;  
      } 
      public function select_update_data($title,$image = NULL,$descr,$id)
         {  
         	//echo $file;exit;
             
           $query3="UPDATE post SET title='$title', file='$image', descr='$descr' WHERE id=".$id;
           //echo $query3;exit;
             
           $result = $this->connection->query($query3);
             
      }  
      public function delete($id)
	{   
		echo $id;
		exit;
		$query="DELETE FROM post WHERE id=".$id;
		$result = $this->connection->query($query);

	} 
}

?>