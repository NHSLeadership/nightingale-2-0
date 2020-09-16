<?php
/**
 * View: Top Bar
 *
 * @package nightingale
 *
 * @version 5.0.1
 */

?>
<div class="tribe-events-c-top-bar tribe-events-header__top-bar">

	<?php $this->template( 'day/top-bar/nav' ); ?>

	<?php $this->template( 'components/top-bar/today' ); ?>

	<?php $this->template( 'day/top-bar/datepicker' ); ?>

	<?php $this->template( 'components/top-bar/actions' ); ?>

</div>
