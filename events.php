<?php
/* Template Name: Events */
get_header(); the_post();
?>
<!-- EOF Header -->

	<div id="container">
		<div class="page-content">

			<div class="content-main events">
				<h2>Events</h2>
				<?php the_content(); ?>
				<h3>Upcoming Events</h3>
				<?php
					if (class_exists('EM_Events')) {
						echo EM_Events::output( array('limit'=>0,'scope'=>'future') );
					}

				?>
				<h3>Past Events</h3>
				<?php
					if (class_exists('EM_Events')) {
						echo EM_Events::output( array('limit'=>20,'scope'=>'past', 'pagination' => 1) );
					}

				?>

			</div>
			<?php get_sidebar(); ?>
		</div>
<?php get_footer(); ?>
