<div class="login-form">
    <form id="loginForm">
        <h2 class="text-center">Sign in</h2>   
        <div class="form-group">
        	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">				
            </div>
        </div>
		<div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">				
            </div>
        </div>        
        <div class="form-group">
			<button type="submit" class="btn btn-primary login-btn btn-block">Sign in</button>
        </div>
	</form>
	<div>
		<button id="registerButton" type="submit" class="btn btn-primary login-btn btn-block">Register</button>
	</div>
    <div id="response" class="alert text-center" style="margin-top:20px; display:none;">
        <button type="button" class="close" id="clearButton"><span aria-hidden="true">&times;</span></button>
        <span id="message"></span>
    </div>	
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#loginForm').submit(function(e){
			e.preventDefault();
			var user = $('#loginForm').serialize();
			var login = function(){
				$.ajax({
					type: 'POST',
					url: 'http://rsstask.test/login/do',
					dataType: 'json',
					data: user,
					success:function(response){
						$('#message').html(response.message);
						if(response.error){
							$('#response').removeClass('alert-success').addClass('alert-danger').show();
						}
						else{
							$('#response').removeClass('alert-danger').addClass('alert-success').show();
							$('#loginForm')[0].reset();
                            window.location.replace("/home");
						}
					}
				});
			};
			login();
		});
 
		$(document).on('click', '#clearButton', function(){
			$('#response').hide();
		});

		$('#registerButton').on('click', function(){
			location.replace('/register');
		});
	});
</script>