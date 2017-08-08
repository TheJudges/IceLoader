function clearAllBots() {
	
    $.ajax({
        url: 'task/clearBots',
        data:{
            "L": "l"
        },
        type:"POST",
        error:function(){
            g_lock_ajax = false;
        },
        success: function (resp) {
			console.log("Bots should be cleared!");
        }
    });
	
    $('#dbMessages').html(`
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> All bots have been removed from database!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>
	`);
    
}

function clearAllTasks(){
    $.ajax({
        url: 'task/clearTasks',
        data:{
            "L": "l"
        },
        type:"POST",
        error:function(){
            g_lock_ajax = false;
        },
        success: function (resp) {
			console.log("Tasks should be cleared!");
        }
    });
	
    $('#dbMessages').html(`
		<div class="alert bg-success" role="alert">
			<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> All Tasks have been removed from database!<a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		</div>
	`);
}