function create_menu(basepath)
{
	var base = (basepath == 'null') ? '' : basepath;

	document.write(
		'<table cellpadding="0" cellspaceing="0" border="0" style="width:98%"><tr>' +
		'<td class="td" valign="top">' +

		'<ul>' +
		'<li><a href="'+base+'index.html">User Manual Home</a></li>' +
		'<li><a href="'+base+'toc.html">Table of Contents Page</a></li>' +
		'</ul>' +

		'<h3>Basic Info</h3>' +
		'<ul>' +
			'<li><a href="'+base+'general/requirements.html">Server Requirements</a></li>' +
			'<li><a href="'+base+'general/credits.html">Credits</a></li>' +
		'</ul>' +

		'<h3>Installation</h3>' +
		'<ul>' +
			'<li><a href="'+base+'installation/index.html">Installation Instructions</a></li>' +
		'</ul>' +

		'<h3>Module System</h3>' +
		'<ul>' +
			'<li><a href="'+base+'systems/change_password.html">Change Password</a></li>' +
			'<li><a href="'+base+'systems/users.html">Users</a></li>' +
			'<li><a href="'+base+'systems/groups_permissions.html">Groups Permissions</a></li>' +
			'<li><a href="'+base+'systems/modules.html">Modules</a></li>' +
			'<li><a href="'+base+'systems/currency.html">Setup Currency</a></li>' +
			'<li><a href="'+base+'systems/company.html">Setup Company</a></li>' +
			'<li><a href="'+base+'systems/branch.html">Setup Branch</a></li>' +
			'<li><a href="'+base+'systems/department.html">Setup Department</a></li>' +
			'<li><a href="'+base+'systems/documents.html">Setup Documents</a></li>' +
		'</ul>' +
		
		'</td><td class="td_sep" valign="top">' +

		'<h3>Module Master</h3>' +
		'<ul>' +
			'<li><a href="'+base+'master/customer.html">Customer</a></li>' +
			'<li><a href="'+base+'master/stock_category.html">Stock Category</a></li>' +
			'<li><a href="'+base+'master/stock.html">Stock</a></li>' +
			'<li><a href="'+base+'master/measure.html">Measure</a></li>' +
			'<li><a href="'+base+'master/salesman.html">Salesman</a></li>' +
			'<li><a href="'+base+'master/supplier.html">Supplier</a></li>' +
		'</ul>' +
		
		'<h3>Module PHD</h3>' +
		'<ul>' +
			'<li><a href="'+base+'phd/phd_branch.html">PHD Cabang (FBI)</a></li>' +
			'<li><a href="'+base+'phd/phd_branch.html">PHD Cabang (TGS/SIP)</a></li>' +
			'<li><a href="'+base+'phd/phd_ho.html">PHD Pusat (FBI/Marketing)</a></li>' +
			'<li><a href="'+base+'phd/phd_ho.html">PHD Pusat (TGS/Marketing)</a></li>' +
			'<li><a href="'+base+'phd/phd_ho.html">PHD Pusat (PPIC)</a></li>' +
		'</ul>' +

		'</td><td class="td_sep" valign="top">' +

		'</td><td class="td_sep" valign="top">' +
		'</td></tr></table>');
}