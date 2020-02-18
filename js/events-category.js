jQuery( document ).ready(function( $ ) {

	var dropdown = document.getElementById("select-1");

	function onCatChange() {

		let $dropdown = $( this ).val();

		if ( $dropdown ) {

			location.href = $dropdown;

		}
	}

	$(".nhsuk-width-container").on( "change", "#select-1", onCatChange );

});
