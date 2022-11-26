<?php
function call_rating($rate){
	$star='';
	for($i=1; $i<=5; $i++){
		if($rate>=$i) $star .= '<i class = "fa fa-star activate" aria-hidden = "true" id = "st'.$i.'"></i>';
		else $star .= '<i class = "fa fa-star" aria-hidden = "true" id = "st'.$i.'"></i>';
	}
	return $star;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
	
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
	<link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
  .fright{ float: right; margin-top:5px; margin: 2px; }
  .table td, .table th{
	  font-size: 12px;
	  padding: 5px;
  }
  .small{
	height: 70px;
    width: 60px;
  }
  .activate{
	color: #f0ad4e !important;
  }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">

    <div class="col-sm-12">
      <h3><small>ADMIN PANEL</small>
			<a href="<?php echo base_url("Dashboard/logout"); ?>" class="btn btn-warning btn-sm fright">Log Out</a>
			<a href="<?php echo base_url("EmployeeForm/index"); ?>" class="btn btn-info btn-sm fright">Create Employee</a>
	  </h3>
      <hr>
	  <br/>
      
      <div class="row">
        <div class="col-sm-12">
			<table id="example" class="table table-striped table-bordered">
				<thead>
					<th>Emp ID</th>
					<th>Image</th>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Date of Birth</th>
					<th>Join Date</th>
					<th>End Date</th>
					<th>Salary</th>
					<th>Rating</th>
					<th>Action</th>
				</thead>
				<tbody>
				<?php
				if(!empty($employee)){
					$i=1;
					foreach($employee as $emp){
						echo '<tr>
							<td>'.$emp->emp_id.'</td>
							<td><img src="'.base_url('assets/images/').$emp->images.'" class="small"/></td>
							<td>'.$emp->name.'</td>
							<td>'.$emp->email.'</td>
							<td>'.$emp->mobile.'</td>
							<td>'.date("d-m-Y", strtotime($emp->dob)).'</td>
							<td>'.date("d-m-Y", strtotime($emp->start_date)).'</td>
							<td>'.date("d-m-Y", strtotime($emp->end_date)).'</td>
							<td>'.$emp->salary.'</td>
							<td>'.call_rating($emp->rating).'</td>
							<td>
								<a href="'.base_url('EmployeeForm/rate/'.$emp->id).'" class="btn btn-sm btn-primary">Rate</a>
								<a href="'.base_url('EmployeeForm/edit/'.$emp->id).'" class="btn btn-sm btn-success">Edit</a>
								<a href="javascript:void(0);" onClick="openModal(\'Delete Alert!\', \'Do you want to Delete this row?\', \''.base_url('Dashboard/deleteEmp/'.$emp->id).'\');" class="btn btn-sm btn-danger">Delete</a>
							</td>
						</tr>';
						$i++;
					}
				}
				?>
				</tbody>
			</table>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="confirmAlert" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="mtitle">Modal Header</h4>
			</div>
			<div class="modal-body">
				<p id="m_msg">This is a small modal.</p>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-success" data-dismiss="modal" id="mbtn" value="OK">
				<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
			</div>
		</div>
	</div>
</div>



<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );

	function openModal(title, msg, btn){
	document.getElementById("mtitle").innerHTML = title;
	document.getElementById("m_msg").innerHTML = msg;
	document.getElementById("mbtn").setAttribute("onclick","redirect('"+btn+"')");
	$('#confirmAlert').modal({
	    backdrop: 'static',
	    keyboard: false
	});
}

function redirect(url){
	window.location.href = url;
}

</script>
</body>
</html>