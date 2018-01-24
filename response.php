

<html>
<head>

   <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Event Respone</a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="index.php">Home</a></li>
      <li class=""><a href="registration.php">Registration</a></li>
      
    </ul>
  </div>
</nav>

<div class="container">
<h4>Responses</h4>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
        <th>SL</th>
<th>Full name</th>
        <th>University</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Seminar1</th>
        <th>Seminar2</th>
        <th>Workshop</th>
        <th>Reason</th>
      </tr>
        </thead>
     
<tbody>
	 <?php 
	
	$counter=1;
		$con=mysqli_connect("localhost","lol_db","Q.AMv8H0D.fv","jessore_event");
		// Check connection
		if (mysqli_connect_errno())
		{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$result = mysqli_query($con,"SELECT * FROM eventUser");
	
	while($row = mysqli_fetch_array($result))
	{?>
		<tr>
			<td><?php echo$counter?></td>
<td><?php echo$row['Name']?></td>
			<td><?php echo$row['University']?></td>
			<td><?php echo$row['contact_number']?></td>
			<td><?php echo$row['email']?></td>
			<td><?php echo$row['seminar1']?></td>
			<td><?php echo$row['seminar2']?></td>
			<td><?php echo$row['workshop']?></td>
			<td><?php echo$row['reason']?></td>
			
		</tr>
	<?php }?>
	</tbody>
	</table>
	
	
</div>

	<script>
	$(document).ready(function() {
    $('#example').DataTable();
} );
	</script>>