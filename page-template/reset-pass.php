<?php
/*
   Template Name: Reset Password
 *
 *
 *
 * @package fortun
 */



get_header('data');

?>
<div class="form-registration">
	<div class="container">
		<div class="row form-inner">
			<div class="col-md-6 col-md-offset-3">
				<div class="vdm-registration-form">
					<div class="reset-form">
						<?php while(have_posts()): the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
			        </div>
		        </div>
			</div>
		</div>
	</div>
</div>


<?php get_footer('data'); ?>