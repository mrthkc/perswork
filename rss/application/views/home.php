<div class="container">
	<h1 class="page-header text-center">Home</h1>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<?php
				$user = $this->session->userdata('user');
				extract($user);
			?>
			<h4>User Info:</h4>
			<p>Email: <?php echo $username; ?></p>
			<p>Password: <?php echo $password; ?></p>
			<a href="<?php echo base_url(); ?>/login/out" class="btn btn-danger">Logout</a>
		</div>
	</div>
</div>