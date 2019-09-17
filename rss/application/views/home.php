<div class="container">
	<h1 class="page-header text-center">Home</h1>
	<div class="row">
		<div class="col-md-4 col-md-offset-1">
			<h4>Feed: </h4>
			<p>Address: <a href="https://www.theregister.co.uk/software/headlines.atom" target="blank"> - https://www.theregister.co.uk/software/headlines.atom - </a></p>
		
			<button id="parseButton" class="btn btn-primary login-btn btn-block">Parse</button>
		</div>
		<div class="col-md-2 col-md-offset-4">
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
	<div class="col-md-6 col-md-offset-1">
		<span id="response"></span>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var feed = {"url": "https://www.theregister.co.uk/software/headlines.atom"}
		$('#parseButton').on('click', function(){
			var prs = function(){ 
				$.ajax({
					type: 'POST',
					url: 'http://rsstask.test/home/parse',
					dataType: 'json',
					data: feed,
					success:function(response){
						$('#response').html(response.message);
					}
				});
			};
			prs();
		});
	});
</script>