/*!
 * template.js v1.0.0
 * Copyright 2014, Ahmad Firuze
 *
 * Freely distributable under the MIT license.
 * Portions of G.ENE.SYS Ultimate - Manufacturing Systems
 *
 */

$.fn.datebox.defaults.formatter = function(date){
	var y = date.getFullYear();
	var m = date.getMonth()+1;
	var d = date.getDate();
	return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
};

$.fn.datebox.defaults.parser = function(s){
	if (!s) return new Date();
	var ss = s.split('/');
	var d = parseInt(ss[0],10);
	var m = parseInt(ss[1],10);
	var y = parseInt(ss[2],10);
	if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
		return new Date(y,m-1,d);
	} else {
		return new Date();
	}
};

/* function resizelayout(){
	$("#cc").layout('resize', {width: $(window).width(), height: $(window).height()-37});
	$("#cc").layout('resize');
} */

function resizelayout(){
	var ll = $("#cc");
	ll.width($(window).width());
	ll.height($(window).height()-37);
	ll.layout('resize');
}

function getRowIndex(target){  
	var tr = $(target).closest('tr.datagrid-row');  
	return parseInt(tr.attr('datagrid-row-index'));  
}  

function start_month(){
	var date = new Date();
	var y = date.getFullYear();
	var m = date.getMonth();
	
	var f = new Date(y, m, 1);
	var y = f.getFullYear();
	var m = f.getMonth()+1;
	var d = f.getDate();
	
	return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
}

function end_month(){
	var date = new Date();
	var y = date.getFullYear();
	var m = date.getMonth();
	
	var t = new Date(y, m+1, 0);
	var y = t.getFullYear();
	var m = t.getMonth()+1;
	var d = t.getDate();
	
	return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
}

function format_price( value, row ) {
	return accounting.formatMoney(value, '');
}

function format_dmy(tdate){
	if(typeof(tdate)==='undefined') tdate = 0;
	if (tdate==0)
	{
		var f = new Date();
		var y = f.getFullYear();
		var m = f.getMonth()+1;
		var d = f.getDate();
	}
	else
	{
		var ss = tdate.split('-');
		var y = parseInt(ss[0],10);
		var m = parseInt(ss[1],10);
		var d = parseInt(ss[2],10);
	}
	return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
}

function format_checkbox( value, row ) {
	if ( parseInt(value) )
		return "<center><input type='checkbox' onclick='return false' onkeydown='return false' checked></center>";
	else
		return "<center><input type='checkbox' onclick='return false' onkeydown='return false'></center>";
}

function greyField( value, row ) {
	if (value != null)
		return '<span style="color:#ADADAD;">'+value+'</span>'; 
}

function greenField( value, row ) {
	if (value != null)
		return '<span style="color:#00D900;">'+value+'</span>'; 
}

function setKeyTrapping_grid( grid, crud ){
	if(typeof(crud)==='undefined') crud = "";
	
	$(grid).datagrid('getPanel').panel('panel').attr('tabindex',1).bind('keydown',function(e){
		var selected = $(grid).datagrid('getSelected');
		switch(e.keyCode)
		{
			case 38:	// up

				if (selected){
					var index = $(grid).datagrid('getRowIndex', selected);
					if (index==0) return
					$(grid).datagrid('selectRow', index-1);
				} else {
					$(grid).datagrid('selectRow', 0);
				}
				break;
			case 40:	// down
				var lastIndex = $(grid).datagrid('getRows').length-1;
				if (selected){
					var index = $(grid).datagrid('getRowIndex', selected);
					if (index==lastIndex) return
					$(grid).datagrid('selectRow', index+1);
				} else {
					$(grid).datagrid('selectRow', 0);
				}
				break;
			case 45:	// insert
			
				if (crud=="") return;
				if (selected){ window[crud]('c') }
				break;
			case 13:	// enter

				if (crud=="") return;
				if (selected){ window[crud]('u') }
				break;
			case 46:	// delete

				if (crud=="") return;
				if (selected){ window[crud]('d') }
				break;
			case 27:	// esc
			
				$('#grid').edatagrid('cancelRow');
				$('#grid2').datagrid('cancelEdit', target);
				break;
		}
	});
	
}

/* $.download = function(url, data, method, callback){
	//url and data options required
	if( url && data ){
		//data can be string of parameters or array/object
		data = typeof data == 'string' ? data : jQuery.param(data);
		//split params into form inputs
		var inputs = '';
		jQuery.each(data.split('&'), function(){
			var pair = this.split('=');
			inputs+='<input type="hidden" name="'+ pair[0] +'" value="'+ pair[1] +'" />';
		});
		//send request
		jQuery('<form action="'+ url +'" method="'+ (method||'post') +'">'+inputs+'</form>').appendTo('body').submit().remove();
	};
}; */

/* $.download = function(url, data, method, callback){
	//url and data options required
	if( url && data ){
		// remove old iframe if has 
		if($("#iframeX")) $("#iframeX").remove(); 
		
		// creater new iframe 
		iframeX = $('<iframe src="[removed]false;" name="iframeX" id="iframeX"></iframe>').appendTo('body').hide(); 
		iframeX.ready(function(){ 
			callback(); 
		}); 
		
		data = typeof data == 'string' ? data : jQuery.param(data);
		//split params into form inputs
		var inputs = '';
		jQuery.each(data.split('&'), function(){
			var pair = this.split('=');
			inputs+='<input type="hidden" name="'+ pair[0] +'" value="'+ pair[1] +'" />';
		});

		//create form to send request 
		$('<form action="'+ url +'" method="'+ (method||'post') + '" target="iframeX">'+inputs+'</form>').appendTo('body').submit().remove(); 
	};
}; */

