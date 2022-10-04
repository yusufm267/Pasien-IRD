<!DOCTYPE html>
<html>
<head>
	<!--LOAD VIEW HEADER-->
	<?php
	$this->load->view($header); 
	?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
	 <?php
	 $this->load->view($navbar); 
	 ?>

	 <?php
	 $this->load->view($sidebar); 
	 ?>

	 <!-- MAINBAR -->

	  <!--Content Wrapper. Contains Page Containt -->
	  <div class="content-wrapper">
	  	<!--Content Header (Page Header) -->
	  		<div class="content-header">
	  			<div class="container-fluid">
	  				<div class="row mb-12">
	  					<div class="col-md-12">
	  					<?php
	  						$this->load->view($body); 
	  					?>	
	  					<div class="modal_loading"></div>
	  					</div>
	  				</div><!-- /.Row -->
	  			</div><!-- /.Container Fluid -->
	  		</div><!-- /.Container Header -->
	  </div><!-- /.Content Wrapper -->

	<!-- /.MAINBAR -->
	  	<?php
	  	$this->load->view($footer);
	  	?>

	<!-- /.Wrapper -->
	</div>

</body>
</html>