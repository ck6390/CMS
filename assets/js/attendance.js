/**
 * [Employee attendance]
 * 
 */
$(document).ready(function() {
	$(':checkbox').on('change', function() {
		var th = $(this), id = th.prop('id');
		if (th.is(':checked')) {
			$(':checkbox[id="' + id + '"]').not($(this)).prop('checked', false);
		}
	});

	$('input.selectedChkBox').on('change', function() {
		$('input.selectedChkBox').not(this).prop('checked', false);
	});

	var parentPresent = $('input[id="presentAll"]');
	var parentAbsent = $('input[id="absentAll"]');	
	var childPresent = $('input[class="presentChkBox"]');
	var childAbsent = $('input[class="absentChkBox"]');
	
	parentPresent.change(function() {
		if (this.checked) {
			childPresent.prop('checked', true);
			childAbsent.prop('checked', false);
		} else {
			childPresent.prop('checked', false);
		}
	});
	parentAbsent.change(function() {
		if (this.checked) {
			childAbsent.prop('checked', true);
			childPresent.prop('checked', false);
		} else {
			childAbsent.prop('checked', false);
		}
	});
	
	childPresent.change(function() {
		parentAbsent.prop($('input[class="presentChkBox"]').length === 0);
	}).change();
	childAbsent.change(function() {
		parentPresent.prop($('input[class="absentChkBox"]').length === 0);
	}).change();
});