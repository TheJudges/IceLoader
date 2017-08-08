<div class="row">
	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<?php
			if($message){
				echo '<div class="alert bg-danger" role="alert">Invalid Username/Password, Please try again...</div>
				';
			}
		?>
		<div class="login-panel panel panel-default">
			<div class="panel-heading">Log in</div>
			<div class="panel-body">
				<form role="form" method="post" accept-charset="utf-8" action="">
					<fieldset>
						<div class="form-group">
							<input class="form-control" placeholder="Username" name="identity" type="username" autofocus="">
						</div>
						<div class="form-group">
							<input class="form-control" placeholder="Password" name="password" type="password" value="">
						</div>
						<button type="submit" class="btn btn-primary pull-right">Login</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div><!-- /.col-->
</div><!-- /.row -->	