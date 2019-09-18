<div class="container">
	<h1 class="page-header text-center">Home</h1>
	<div class="row">
		<div class="col-md-5 col-md-offset-1">
			<h4>Feed: </h4>
			<p>Address: <a href="<?php echo $f; ?>" target="blank"> - <?php echo $f; ?> - </a></p>
		
			<button id="parseButton" class="btn btn-primary login-btn btn-block">Parse</button>
		</div>
		<div class="col-md-2 col-md-offset-3">
			<?php
				$user = $this->session->userdata('user');
				extract($user);
			?>
			<h4>User Info:</h4>
			<p>Username: <?php echo $username; ?></p>
			<a href="<?php echo base_url(); ?>/login/out" class="btn btn-danger">Logout</a>
		</div>
	</div>
	<br /><br /><br /><br />
	<div id="responseWordsCont" class="col-md-2" style="display:none;">
		<h4>Top 10 Words:</h4>
		<span id="responseWords"></span>
	</div>
	<div id="responseItemsCont" class="col-md-6 col-md-offset-2" style="display:none;">
		<h4>Feed Titles:</h4>
		<span id="responseItems"></span>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var feed = {"url": "<?php echo $f; ?>"}
		$('#parseButton').on('click', function(){
			var prs = function(){ 
				$.ajax({
					type: 'POST',
					url: 'http://rsstask.test/home/parse',
					dataType: 'json',
					data: feed,
					success:function(response){
						$('#responseItems').html(response.message.items);
						$('#responseItemsCont').show();
						$('#responseWords').html(response.message.words);
						$('#responseWordsCont').show();
					}
				});
			};
			prs();
		});
	});
</script>