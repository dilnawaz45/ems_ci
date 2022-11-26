<?php
$empl = array();
if(isset($employee) && !empty($employee)){
	$empl = $employee;
}
else{
	$empl = (object) array("id"=>"", "name"=>"", "dob"=>"","email"=>"", "mobile"=>"","start_date"=>"", "salary"=>"","end_date"=>"", "image"=>"");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create Employee</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  .fright{ float: right; margin-top:7px; }
  .table td, .table th{
	  font-size: 12px;
	  padding: 5px;
  }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">

    <div class="col-sm-12">
		<div id="messages"></div>
      <h3><small>EMPLOYEE FORM</small>
		<a href="<?php echo base_url("Dashboard/index"); ?>" class="btn btn-info btn-sm fright">Employee Details</a>
	  </h3>
      <hr>
	  <br/>
      <form id="submit" enctype="multipart/form-data" method="POST">

	      <div class="row">

	        <div class="col-sm-3">
				<div class="form-group">
					<label>* Employee Name</label>
					<input type="text" name="name" class="form-control" value="<?php echo set_value('name', $empl->name); ?>"/>
				</div>
	        </div>
	        
	        <div class="col-sm-3">
				<div class="form-group">
					<label>* Date of Birth</label>
					<input type="date" name="dob" onChange="getEndDate(this.value)" class="form-control" value="<?php echo set_value('dob',$empl->dob); ?>"/>
				</div>
	        </div>
	        
	        <div class="col-sm-3">
				<div class="form-group">
					<label>* Email</label>
					<input type="email" name="email" class="form-control" value="<?php echo set_value('email',$empl->email); ?>"/>
				</div>
	        </div>
	        
			<div class="col-sm-3">
				<div class="form-group">
					<label>* Mobile Number</label>
					<input type="number" max-length=10 name="mobile" class="form-control" value="<?php echo set_value('mobile',$empl->mobile); ?>"/>
				</div>
	        </div>
	        
	      </div>

		  
	      <div class="row">

	        <div class="col-sm-3">
				<div class="form-group">
					<label>* Date of Join</label>
					<input type="date" name="doj" class="form-control" value="<?php echo set_value('doj',$empl->start_date); ?>"/>
				</div>
	        </div>
	        
	        <div class="col-sm-3">
				<div class="form-group">
					<label>* Salary</label>
					<input type="number" name="salary" class="form-control" value="<?php echo set_value('salary',$empl->salary); ?>"/>
				</div>
	        </div>
	        
			<div class="col-sm-3">
				<div class="form-group">
					<label>* Retirement Date</label>
					<input type="date" readonly name="end_date" class="form-control" value="<?php echo $empl->end_date; ?>"/>
				</div>
	        </div>
	        
			<div class="col-sm-3">
				<div class="form-group">
					<label><?php if(empty($empl->id)) echo '*'; ?> Upload Imagee</label>
					<input type="file" name="image" class="form-control" accept="Image/*"/>
				</div>
	        </div>
	        
	      </div>


	      <div class="row">
	        
	        <div class="col-sm-12">
						<div class="form-group">
							<input type="hidden" name="edit_id"  value="<?php echo $empl->id; ?>"/>
							<input type="submit" name="save" value="<?php echo (empty($empl->id)?'Create':'Update'); ?>" class="btn btn-success"/>

						</div>
	        </div>
	      </div>
	    </form>
      
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="mtitle">Modal Header</h4>
			</div>
			<div class="modal-body">
				<p id="m_msg">This is a small modal.</p>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-danger" data-dismiss="modal" id="mbtn" value="OK">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

function form_validation(){
	if(field_check("name", "Please Enter Employee Name", 1) == false) return false;
	if(field_check("dob", "Please Enter Date of Birth", 1) == false) return false;
	if(field_check("email", "Please Enter Email Id", 1) == false) return false;
	if(field_check("mobile", "Please Enter Mobile", 1) == false) return false;
	if(field_check("doj", "Please Select Date of Join", 1) == false) return false;
	if(field_check("salary", "Please Enter Salary", 1) == false) return false;
	<?php
	if(empty($empl->id)){
	?>
		if(field_check("image", "Please Select Image", 1) == false) return false;
	<?php } ?>
}

function field_check(name, msg, alrt=null){
	var nm = document.getElementsByName(name)[0];
	if(nm.value == ""){
			if(alrt != null){
				alert(msg);
			}
			nm.focus(); return false;
	}
}



function put_value(name, value){
	var opt = document.getElementsByName(name)[0];
	var items = opt.options.length;
	if(items>1){
		for(var i=0; i<items; i++){
			var str = opt.options[i].text;
			if(str == value){
				opt.selectedIndex = i; 
			}
		}
	}
}


function openModal(title, msg, btn){
	document.getElementById("mtitle").innerHTML = title;
	document.getElementById("m_msg").innerHTML = msg;
	document.getElementById("mbtn").setAttribute("onclick","redirect('"+btn+"')");
	$('#myModal').modal({
	    backdrop: 'static',
	    keyboard: false
	});
}

function redirect(url){
	window.location.href = url;
}

function getEndDate(dob){
	var da = new Date(dob);
	var year = da.getFullYear()+60;
	var month = zno(da.getMonth()+1);
	var date = zno(da.getDate());
	var end_date = year + "-" + month + "-" + date;
	document.getElementsByName("end_date")[0].value = end_date;
}

function zno(no){
	if(no <10) no = "0" + no;
	return no;
}

$('#submit').submit(function(e){
	e.preventDefault(); 
	var x = form_validation();
	
	if(x != false){
		
		$.ajax({
			url:'<?php echo base_url("EmployeeForm/create"); ?>',
			type:"post",
			data:new FormData(this),
			processData:false,
			contentType:false,
			cache:false,
			async:false,
			success: function(data){
				var str = data.split("|");
				if(str[0] == 1){
					$("#messages").html('<div class="alert alert-success">'+str[1]+'</div>');
					$('#submit')[0].reset();
				}
				else{
					$("#messages").html('<div class="alert alert-danger">'+str[1]+'</div>');
				}
				console.log(data);
			}
		});
	}
}); 
</script>

</body>
</html>