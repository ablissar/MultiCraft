


<header class='page-header'>
	<h1><?= $page_title ?></h1>
</header>

<main>

	<nav class='search_container'>
		<?= $form['form_open'] ?>
		<?= $form['company_code'] ?>
		<?= $form['division'] ?>
		<?= $advanced_search_form['job_number'] ?>
		<?= $form['submit_button'] ?>
		<?= $form['show_advanced_search_button'] ?>
		<?= $form['form_close'] ?>
		
		<section class='advanced-search-options hidden'>
			<?= $advanced_search_form['form_open'] ?>
			<div class='form-component inline-form flex-container'>
				<?= $advanced_search_form['customer_code'] ?>
			</div>
			
			<div class='form-component inline-form flex-container'>
				<?= $advanced_search_form['created'] ?>
				
				<section class='created-date-selection'>
					<?= $advanced_search_form['created_before'] ?>
					<?= $advanced_search_form['created_after'] ?>
				</section>
			</div>
			
			<div class='flex-container gutter-m form-component'>
				<?php
				/*
				<div class=''>
					<?= $advanced_search_form['company_code'] ?>
					<?= $advanced_search_form['company_code[mcc]'] ?>
					<?= $advanced_search_form['company_code[mcs]'] ?>
				</div>
				
				<div class=''>
					<?= $advanced_search_form['division'] ?>
					<?= $advanced_search_form['division[commercial]'] ?>
					<?= $advanced_search_form['division[crane]'] ?>
					<?= $advanced_search_form['division[electrical]'] ?>
					<?= $advanced_search_form['division[fabrication]'] ?>
					<?= $advanced_search_form['division[mechanical]'] ?>
					<?= $advanced_search_form['division[robotics]'] ?>
					<?= $advanced_search_form['division[service]'] ?>
					<?= $advanced_search_form['division[sheet-metal]'] ?>
				</div>
				*/
				?>
				
				<div class=''>
					<?= $advanced_search_form['job_type'] ?>
					<?= $advanced_search_form['job_type[contract]'] ?>
					<?= $advanced_search_form['job_type[time_and_material]'] ?>
				</div>
				
				<div class=''>
					<?= $advanced_search_form['job_status'] ?>
					<?= $advanced_search_form['job_status[active]'] ?>
					<?= $advanced_search_form['job_status[inactive]'] ?>
					<?= $advanced_search_form['job_status[closed]'] ?>
				</div>
				
				<div class=''>
					<?= $advanced_search_form['tax_code'] ?>
					<?= $advanced_search_form['tax_code[empty]'] ?>
					<?= $advanced_search_form['tax_code[not_empty]'] ?>
				</div>
			</div>		
			<?= $advanced_search_form['form_close'] ?>
		</section>
	</nav>
	
	<?= $job_list_table ?>
	
	<nav class='pagination flex-container flex-space-between flex-vertical-center'>
		<div class='pagination-results'><?= $pagination_results_display ?></div>
		<div class='pagination-links'><?= $pagination ?></div>
	</nav>
	
	<?= $create_new_job ?>
</main>


<script>
var advanced_options_toggle = document.getElementsByName( 'show_advanced_search_options' )[0];
var advanced_search_options = document.getElementsByClassName( 'advanced-search-options' )[0];

advanced_options_toggle.addEventListener( 'click', function() {
	
	toggle_visibility( advanced_search_options );
	
	if ( advanced_search_options.classList.contains( 'hidden' ) )
	{
		this.innerHTML = 'Show Advanced Options';
	}
	else
	{
		this.innerHTML = 'Hide Advanced Options';
	}
});

function toggle_visibility( $element ) {
	$element.classList.toggle( 'hidden' );
}
</script>