<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"> </script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"> </script>
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title> Employee Rating</title>
    <style>
    body {
        background-color: aquamarine;
        margin : 0px;
    }
    .fa-star {
        font-size : 50px;
        align-content: center;
    }
    .container {
        height: 100px;
        width: 600px;
        margin: auto;
    }
    </style>
</head>
<body>
    <div class = "container">
        <h2 style="margin-top: 50px;">Employee: <?= $employee->name; ?> (#<?= $employee->emp_id; ?>)</h2>
       <div class = "con">
        <h3 style = "margin-top : 80px; color: green;">Rate to Employee :-</h3>
        <i class = "fa fa-star" aria-hidden = "true" id = "st1"></i>
       <i class = "fa fa-star" aria-hidden = "true" id = "st2"></i>
       <i class = "fa fa-star" aria-hidden = "true" id = "st3"></i>
       <i class = "fa fa-star" aria-hidden = "true" id = "st4"></i>
       <i class = "fa fa-star" aria-hidden = "true" id = "st5"></i>
       </div>
        <br/>
       <button name="save" class="btn btn-primary" onClick="save_rating()">Save Rating</button>
    </div>
    <input type="hidden" name="rating"/>
    
    <script>
        var rating=0;
        $(document).ready(function() {
          $("#st1").click(function() {
              $(".fa-star").css("color", "black");
              $("#st1").css("color", "yellow");
              document.getElementsByName("rating")[0].value = 1;
          });
          $("#st2").click(function() {
              $(".fa-star").css("color", "black");
              $("#st1, #st2").css("color", "yellow");
              document.getElementsByName("rating")[0].value = 2;
          });
          $("#st3").click(function() {
              $(".fa-star").css("color", "black")
              $("#st1, #st2, #st3").css("color", "yellow");
              document.getElementsByName("rating")[0].value = 3;

          });
          $("#st4").click(function() {
              $(".fa-star").css("color", "black");
              $("#st1, #st2, #st3, #st4").css("color", "yellow");
              document.getElementsByName("rating")[0].value = 4;

          });
          $("#st5").click(function() {
              $(".fa-star").css("color", "black");
              $("#st1, #st2, #st3, #st4, #st5").css("color", "yellow");
              document.getElementsByName("rating")[0].value = 5;

          });
        });

        function save_rating(){
            var rate = document.getElementsByName("rating")[0].value;
            var id = <?= $employee->id; ?>;
            if(rate == ""){
                alert("Please give rate!");
            }
            else{
                var formData = new FormData();
                formData.append("id", id);
                formData.append("rate", rate);
                $.ajax({
                    url:'<?php echo base_url("EmployeeForm/save_rate"); ?>',
                    type:"post",
                    data:formData,
                    processData:false,
                    contentType:false,
                    cache:false,
                    async:false,
                    success: function(data){
                        console.log(data);
                        var str = data.split("|");
                        if(str[0] == 1){
                            alert(str[1]);
                            //window.location.href="<?=base_url('Dashboard/index');?>";
                        }
                        else{
                            alert(str[1]);
                        }
                        window.location.href="<?=base_url('Dashboard/index');?>";
                    }
                });
            }
        }

        <?php
        if($employee->rating > 0){
            echo 'for(var i=1; i<='.$employee->rating.'; i++){
                $("#st"+i).css("color", "yellow");
            }

            document.getElementsByName("rating")[0].value='.$employee->rating.';';
        }
        ?>

    </script>
</body>
</html>