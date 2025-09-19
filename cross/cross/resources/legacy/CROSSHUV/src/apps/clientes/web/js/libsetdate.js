
// function passing selected date to calling window
function set_datetime(n_datetime, b_close) {

	if (!obj_caller) return;

	var dt_datetime = obj_caller.prs_time(
		(document.cal ? document.cal.time.value : ''),
		new Date(n_datetime)
	);

	if (!dt_datetime) return;
	if (b_close) {
		window.close();
		obj_caller.target.value = (document.cal
			? obj_caller.gen_tsmp(dt_datetime)
			: obj_caller.gen_date(dt_datetime)
		);
	}
	else obj_caller.popup(dt_datetime.valueOf(),1);
}