// $("#bologna-list a").on("click", function(e) {
// 	e.preventDefault();
// 	$(this).tab("show");
// });

function caltotal() {
	var type = 0;
	$("#typemotor option:selected").each(function () {
		type = parseInt($(this).val());
		console.log(type);
	});
	$("input[name=tot_cost]").val(type);
}

$().ready(function () {
	$("#typemotor").change(function () {
		caltotal();
	});
});

$("#myTab a").on("click", function (e) {
	e.preventDefault();
	$(this).tab("show");
});
