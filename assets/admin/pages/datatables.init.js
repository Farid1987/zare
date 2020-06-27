/*
 Template Name: Upcube - Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: Datatable js
 */

$(document).ready(function(){
	$("#datatable").DataTable();
	var a=$("#datatable-buttons").DataTable({
    responsive: true,
    lengthChange:!1,
    buttons:["colvis"]
	});
	a.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
});