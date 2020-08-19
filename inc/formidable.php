<?php
/**
 * Customised Formiable Forms output markup
 *
 * @date         Jul 22 2020
 * @version      1.0
 * @author       Thomas Porteus
 * @organisation iatro.
 * @copyright    OGL v3
 * @package      Nightingale Theme
 */

add_action(
	'wp_head',
	function () {
		global $post;
		if ( has_shortcode( $post->post_content, 'formidable' ) || has_block( 'formidable-simple-form', $post ) ) {


			?>
			<style>

				.frm_opt_container > div {
					margin-bottom : 12px !important;
				}

				.frm_form_field select {
					margin-bottom : 9px !important;
				}

				.frm_form_field input {
					margin-bottom : 9px !important;
				}

				.frm_error {
					color         : #d5281b;
					font-weight   : bold;
					margin-bottom : 20px;
				}

				.frm_form_field {
					margin-top : 25px;
				}

			</style>
			<?php
		}
	}
);

add_action(
	'wp_head',
	function () {
		global $post;

	 if ( has_shortcode( $post->post_content, 'formidable') ||  has_block( 'formidable-simple-form', $post ) {
	?>
		<script type="text/javascript">
	  jQuery(document).ready(function($){
		$(".frm_fields_container label input").each(function(){
		  var label = $(this).parent();
		  var ele = $(this).detach();
			  label.before(ele);
		})
	
		  $(".frm_primary_label").addClass("nhsuk-label");
	
		  $(".frm_radio, .frm_scale").each(function(){
		  $(this).addClass("nhsuk-radios__item");
		  $(this).find("input").addClass("nhsuk-radios__input");
		  $(this).find("label").addClass("nhsuk-label nhsuk-radios__label");
		})
	  
		  $(".frm_checkbox").each(function(){
		  $(this).addClass("nhsuk-checkboxes__item");
		  $(this).find("input").addClass("nhsuk-checkboxes__input");
		  $(this).find("label").addClass("nhsuk-label nhsuk-checkboxes__label");
		})
	  
		  
		  $(".frm_form_field select").addClass("nhsuk-select")

		  $("fieldset").addClass("nhsuk-fieldset");

	  })
	
	
	</script>
	<?php } 
       } 
      );
	
