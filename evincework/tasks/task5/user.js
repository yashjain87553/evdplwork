function readRecords() {
  $.ajax({
   url:"readRecords.php",
   success :function(data){
    $(".ajax_replace").html(data);
  }
});
}
function modalshow(){
  var page=$("#pagenovalue").val();
  $("#check").hide();
  $("#registerbutton").show();
  $("#updatebutton").hide();
  $("#registerusername").val("");
  $("#registerpassword").val("");
  $('input[name=gender]:checked').each(function(){
    $(this).prop('checked', false);  
  });
  
  $("#myModal").modal("show");
}
function registerentry()
{ 
     var page=$("#pagenovalue").val();
  var username=$("#registerusername").val();
  var password=$("#registerpassword").val();
  var gender=$('input[name=gender]:checked').val();
  var combo=$('#sel1');     
  var selectedval = $(combo, 'option:selected').val();
  $.ajax({
    url : "checkrecords.php",
    type:"POST",
    data :{
     username:username
   },
   success:function(data){
     if(data==1)
     { 
      $("#check").show();
      $("#check").text("username already exist");
    }
    else{
      $("#check").hide();
      $.ajax({
       url:"registerentry.php",
       type: "POST",
       data: {
        username : username,
        password : password,
        gender :gender,
        selectedval :selectedval
      },
      success :function(data){
       $("#myModal").modal("hide");
        var slot = $("#numrows option:selected").val();
        $.ajax({
          url:"pagi.php",
          type:"POST",
          data:{slot:slot},
          success:function(data)
          {
            $(".pagi").html(data);
          }

        });
          getdata(page);
     }
   });
    }   
  }

});

}
function getmodaldetail(id)
{
  $("#check").hide();
 $.ajax({
   url: "fillvalue.php",
   type: "POST",
   data: {
    id:id
  },
  success : function(data){
    var user=JSON.parse(data);
    
    var store=user.username;

    $("#registerusername").val(user.username);
    $("#registerpassword").val(user.password);
    $("#togetid").val(user.id);
    $("#updatebutton").attr('data-bind',user.id);
    if (user.gender == 'male')
     { 
       $('#tu').find(':radio[name=gender][value="male"]').prop('checked', true);
     }else if(user.gender == 'female'){
       $('#tu').find(':radio[name=gender][value="female"]').prop('checked', true);
     }else if(user.gender == 'other'){
       $('#tu').find(':radio[name=gender][value="other"]').prop('checked', true);
     }

    if(user.status=='active'){
      $('#sel1 option[value=active]').prop('selected', true);
    }else if(user.status=='deactive'){
      $('#sel1 option[value=deactive]').prop('selected', true);
    }
}   
}); 
  
 $("#updatebutton").show();
 $("#registerbutton").hide();
 $("#myModal").modal("show");


}

  function deleteuser(id)
  {   
      var page=$("#pagenovalue").val();
    if (confirm('Are you sure you want to delete this?')) {
     $.ajax({
      url : "deleteuser.php",
      type:"POST",
      data:{
       id:id
     },
     success:function(data){
      var slot = $("#numrows option:selected").val();
         $.ajax({
          url:"pagi.php",
          type:"POST",
          data:{slot:slot},
          success:function(data)
          {
            $(".pagi").html(data);
          }

        });
       getdata(page);
       
     }
   });

   }
 }

  $("#updatebutton").on('click',function(){
      var page=$("#pagenovalue").val();
       var id=$("#togetid").val();
      var combo=$('#sel1');     
      var selectedval = $(combo, 'option:selected').val();
      var username=$("#registerusername").val();
      $.ajax({
        url : "updatecheckrecords.php",
        type:"POST",
        data :{
         username:username,
         id:id
       },
       success :function(data){
        if(data==1){

          $("#check").show();
          $("#check").text("username already exist");

        }
        else{
              
        $("#check").hide();
         $.ajax({
          url:"updaterecord.php",
          type:"POST",
          data:{
            id:id,
            username: $("#registerusername").val(),
            password: $("#registerpassword").val(),
            gender :    $('input[name=gender]:checked').val(),
            status :selectedval
          },
          success:function(data){
             $.ajax({
          url:"paginate.php",
          type:"POST",
          success:function(data){
          $("#myModal").modal("hide");
              getdata(page);
                                }        
                   });
                                }
                   });
       }
     }
    });
      });
         

  function deleteall()
  {  
     var slot = $("#numrows option:selected").val();
     if (confirm('Are you sure you want to delete all records?')) {
    $.ajax({
      url:"deleteall.php",
      success:function(data){
           $.ajax({

          url:"pagi.php",
          type:"POST",
          data:{
            slot:slot
          },
          success:function(data)
          {
            $(".pagi").html(data);
          }

        });
        readRecords()
      }
    });
  }
  }
  $('.slot').on('change', '.checkrecords', function(event){
    if( $(".checkrecords").is(':checked')){
      $("#deleteselected").show();
    } 
    else{
       
      $("#deleteselected").hide();
    }
 });
     function deleteselected()
     { 

      if (confirm('Are you sure you want to delete all selected records?')) {
          var page=$("#pagenovalue").val();
var allvals = [];  
        $(".checkrecords:checked").each(function() {  
            allvals.push($(this).attr('data-id'));
        });
        if(allvals.length==0)
        {
            alert("no record selected");
            readRecords();
        }
        else{
            var shortvalue=$("#shortvalue").val();
var order=$("#shortorder").val();
var slot = $("#numrows option:selected").val();
         $.ajax({
            url :"deleteselectedrecords.php",
            type:"POST",
            data:{
              allvals: allvals
            },
            success:function(data)
            {  
                 /*  $.ajax({
          url:"pagi.php",
          success:function(data)
          {
            $(".pagi").html(data);*/
              $.ajax({
          url:"getdata.php",
          type:"POST",
          data:{
            shortvalue:shortvalue,
                  page:page,
                  order:order,
                  slot:slot

          },
          success:function(data)
          { 
                
               $(".slot").html(data);
          }
         });
          
}
        });
       
            }
        
       } 
        $("#deleteselected").hide();
        }
      

   function short(shortvalue){
        $("#shortvalue").val(shortvalue);
       var order=$("#shortstatus").val();
       $("#shortorder").val(order);

       var slot = $("#numrows option:selected").val();
         $(".glyphicon").removeClass("glyphicon-arrow-up");
         $(".glyphicon").removeClass("glyphicon-arrow-down");
         if(order=="DESC"){
         $("#"+shortvalue).find(".glyphicon").addClass("glyphicon-arrow-down");   
                          }
        else if(order=="ASC"){
           $("#"+shortvalue).find(".glyphicon").addClass("glyphicon-arrow-up");   
                             }
         $.ajax({
           url :"getdatasort.php",
           type:"POST",
           data:{
                order:order,
                shortvalue:shortvalue,
                page:1,
                slot:slot
                },
                success:function(data){
                 if(order=="ASC")
                   {
                   $("#shortstatus").val("DESC");
                   }
               else{
                     $("#shortstatus").val("ASC");
                   }
                   $(".slot").html(data);
        }
       });
   }
    function getdata(page){
      var shortvalue=$("#shortvalue").val();
    var slot = $("#numrows option:selected").val();
     var order=$("#shortorder").val();
         $("#pagenovalue").val(page);
         $.ajax({
          url:"getdata.php",
          type:"POST",
          data:{ 
                  order:order,
                  shortvalue:shortvalue,
                  page:page,
                  slot:slot
          },
          success:function(data)
          {    
               $(".slot").html(data);
          }
         });
    }

    function prev()
    {

      var shortvalue=$("#shortvalue").val();
var order=$("#shortorder").val();
         var page=$("#pagenovalue").val();
         var slot = $("#numrows option:selected").val();
         if(page==1)
         {
          alert("no prev value");
         }
         else{
         var page1=(--page);
         $("#pagenovalue").val(page1);
           $.ajax({
          url:"getdata.php",
          type:"POST",
          data:{ 
                  shortvalue:shortvalue,
                  order:order,
                  page:page1,
                  slot:slot
          },
          success:function(data)
          { 
                
               $(".slot").html(data);
          }
         });
}

    }

        function next()
    {
       var page=$("#pagenovalue").val();
       var slot = $("#numrows option:selected").val();

    
       $.ajax({
          url:"lastpage.php",
          type:"POST",
          data:{
            slot:slot
          },
          success:function(data)
          {    
              var x=$.trim(page);
              var y=$.trim(data);
            
         if(x==y){
             alert("no more records");
      }
      else
      {  
               var shortvalue=$("#shortvalue").val();
var order=$("#shortorder").val();
           var page1=(++page);
        //getdata(page1);
         $("#pagenovalue").val(page1);
           $.ajax({
          url:"getdata.php",
          type:"POST",
          data:{  
                  shortvalue:shortvalue,
                  order:order,
                  page:page1,
                  slot:slot
          },
          success:function(data)
          { 
                
               $(".slot").html(data);
          }
         });
 
      }

    }
      });
     }

    function first()
    {
         var page1=1;

          var shortvalue=$("#shortvalue").val();
            var order=$("#shortorder").val();
         var slot = $("#numrows option:selected").val();
           $.ajax({
          url:"getdata.php",
          type:"POST",
          data:{
                 shortvalue:shortvalue,
                 order:order,
                  page:page1,
                  slot:slot
          },
          success:function(data)
          { 
                
               $(".slot").html(data);
          }
         });
    }   

     function last()
    {
          
          var slot = $("#numrows option:selected").val();

        $.ajax({
          url:"lastpage.php",
          type:"POST",
           data:{
            slot:slot
           },
          success:function(data)
          {
var shortvalue=$("#shortvalue").val();
var order=$("#shortorder").val();
                var lastpage=data;
                $("#pagenovalue").val(lastpage);
               
                $.ajax({
                  url:"getdata.php",
                  type:"POST",
                  data:{
                          shortvalue:shortvalue,
                          order:order,
                          page:lastpage,
                          slot:slot                   
                  },
                  success:function(data)
                  {
                      $(".slot").html(data);
                  }
                });
          }
        });
    }    


     $("#search").on("keyup", function() {
    var value = $(this).val();
    var slot = $("#numrows option:selected").val();
    var page=$("#pagenovalue").val();
    if(value=="")
    {
       
         var shortvalue=$("#shortvalue").val();
var order=$("#shortorder").val();
         $.ajax({
          url:"getdata.php",
          type:"POST",
          data:{
                  page:page,
                  slot:slot,
                  shortvalue:shortvalue,
                  order:order
          },
          success:function(data)
          { 
                
               $(".slot").html(data);
          }
         });
    }
    else{
    $.ajax({
      url:"search.php",
      type:"POST",
      data:{
              page:1,
             value:value,
             slot:slot
      },
      success:function(data)
      {        
          $(".slot").html(data);
    }
    });
  }
  });  

          function getdatasearch(page){
    var slot = $("#numrows option:selected").val();
    var value = $("#search").val();
         $("#pagenovalue").val(page);
         
         $.ajax({
          url:"getdatasearch.php",
          type:"POST",
          data:{
                  page:page,
                  slot:slot,
                  value:value
          },
          success:function(data)
          { 
                
               $(".slot").html(data);
          }
         });
    }
        $(document).on('change', '#numrows', function() {
          var x=$(this).val();

          $.ajax({
            url:"numofrecords.php",
            type:"POST",
            data:{
              slot:x
            },
            success:function(data)
            {
              
              $(".slot").html(data);
            }
          });
        });

 /*   function shortpagedata(shortvalue)
    {  
       var order=$("#shortstatus").val();
         $(".glyphicon").removeClass("glyphicon-arrow-up");
         $(".glyphicon").removeClass("glyphicon-arrow-down");
         if(order=="DESC"){
         $("#"+shortvalue).find(".glyphicon").addClass("glyphicon-arrow-down");   
                          }
        else if(order=="ASC"){
           $("#"+shortvalue).find(".glyphicon").addClass("glyphicon-arrow-up");   
                             }
       
       var slot = $("#numrows option:selected").val();
       var page=$("#pagenovalue").val();
       $.ajax({
        url: "shortpagedata.php",
        type:"POST",
        data:{
               slot:slot,
               page:page,
               shortvalue:shortvalue,
               order:order
        },
        success:function(data)
        {  
            if(order=="ASC"){
          $("#shortstatus").val("DESC");
        }
        else{
          $("#shortstatus").val("ASC");
        }  
             $(".ajax_replace").html(data);
        }
       });
    }*/