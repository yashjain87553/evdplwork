<?php
include "oops.php";
$obj=new hello();
?>

<!doctype html>
<html>
<head>
  <title>user login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <?php
  
  $records=$obj->countrecords();
  $page=ceil($records/2);
  ?>
  
  <div id="hello">
    <select id="numrows" name="selector">
      
      <option value="1">1</option>
      <option value="2" selected>2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="50">50</option>
      <option value="100">100</option>
    </select>
  </div>
  <h4>click here to register  <button  onclick="modalshow()" class="btn btn-success">new user</button></h4>

  <input type="hidden" id="pagenovalue" value="1" >
  <input type="hidden"  id="shortstatus" value="DESC">
  <input type="hidden"  id="shortvalue" value="username">
  <input type="hidden"  id="shortorder" value="ASC">
  <input type="text" id="search" placeholder="search here" name="search">



  <div class="slot">
   <table class="table table-hover">
    <thead>
      <tr>
        <th id="username"><span class="glyphicon"></span><a  onclick="short('username')">username</a></th>
        <th  id="password"><span class="glyphicon"></span><a  onclick="short('password')">password</a></th>
        <th id="gender"><span class="glyphicon"></span><a  onclick="short('gender')">gender</a></th>
        <th  id="status"><span class="glyphicon"></span><a  onclick="short('status')">status</th>
        <th>edit</th>
        <th>delete</th>
        <th>multiple delete</th>
      </tr>
    </thead>
    <tbody class="ajax_replace">
      <?php
      $obj->page=1;
      $obj->slot=2;
      $order="ASC";
      $username="username";
      $obj->order=$order;
      $obj->shortvalue=$username;
      $records=$obj->paginate();
      while($r=mysqli_fetch_assoc($records)){
        ?> 
        <tr>
          <td><?php echo $r['username'];?></td>
          <td><?php echo $r['password'];?></td>
          <td><?php echo $r['gender'];?></td>
          <td><?php echo $r['status'];?></td>
          <td><button onclick="getmodaldetail(<?php echo $r['id'];?>)" class="btn btn-info">edit</button></td>
          <td><button  class="btn btn-danger" id="deleteuser" onclick="deleteuser(<?php echo $r['id'];?>)">delete</button></td>
          <td><input type="checkbox" class="checkrecords" data-id="<?php echo $r['id'];?>"></td>
        </tr>
        
        <?php
      }
      ?>
      
    </tbody>
  </table>
  
  <div class="pagi">
    <ul class="pagination">
      <li><a onclick="first()">first</a></li>
      <li><a  onclick="prev()">prev</a></li>

      <?php if($page>3){
        $page=3;
      }
      for($i=1;$i<=$page;$i++){ ?>
      <li>
        <?php if($i==1){?>
        <span><?php echo $i;?></span>
        <?php }else{?>
        <a onclick="getdata(<?php echo $i;?>)">
          <?php echo $i;?>    
        </a>
        <?php }?>
      </li>
      <?php 
    }
    ?><li><a >----</a></li>
    <li><a onclick="next()">next</a></li>
    <li><a onclick="last()">last</a></li>
    
  </ul>
</div>
</div>

<div class="col-lg-offset-9">
  <button style="display:none;" class="btn btn-danger" id="deleteselected" onclick="deleteselected()">deleteselected</button>
  <button class="btn btn-danger" id="deleteall" onclick="deleteall()">deleteall</button>
</div>

<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">register page</h4>
      </div>
      <div class="modal-body">
        <p id="check" style="color:red;"></p>
        <div  class="input-group" style="margin-top:10px;">
         <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input type="text" id="registerusername" placeholder="username" class="form-control">
       </div>
       <div  class="input-group" style="margin-top:10px;">
        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span><input type="text" id="registerpassword" placeholder="password" class="form-control">
      </div>  

      <div id="tu"> <h4>Gender:</h4>
       <div class="form-group">
        <div class="radio">
          <label ><input type="radio" name="gender" value="male">male</label>
        </div>
        <div class="radio">
          <label><input type="radio" name="gender" value="female">female</label>
        </div>
        <div class="radio">
          <label><input type="radio" name="gender" value="other">other</label>
        </div>
      </div>
    </div>


    <div class="form-group">
      <label for="sel1">status list (select one):</label>
      <select class="form-control" id="sel1">
        <option value="active">active</option>
        <option value="deactive">deactive</option>
      </select>
    </div>
  </div>


  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" onclick="registerentry()" id="registerbutton" class="btn btn-success">register</button>
    <button type="button"  id="updatebutton" data-bind="" class="btn btn-success">update</button>
    <input type="hidden" value="" id="togetid">
  </div>
</div>
</div>
</div>


</body>
<script src="user.js"></script>
</html>