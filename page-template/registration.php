<?php
/*
   Template Name: Registration Page
 *
 *
 *
 * @package fortun
 */
 

get_header('data');
	
$errors = vdm_user_registration();

?>

	<div class="form-registration">
		<div class="container">
			<div class="row form-inner">
				<div class="col-md-6 col-md-offset-3">
					<div class="vdm-registration-form">
						<div class="vmd-form-heading">
				        	<?php _e("Registration Form",'');?>
				        </div>
						<form method="POST">
							<div class="vdm_reg_erros">
								

								<?php foreach ( (array) $errors as $key => $value) {
									echo '<div class="single-error '.$key.'">'.$value.'</div>';
								};
								?>
							</div>
							<p>
								<label for="uname">Username</label>
								<input type="text" class="form-control" placeholder="Username" id="uname" name="uname" required="">
							</p>

							<p>
								<label for="email">Email</label>
								<input type="email" class="form-control" placeholder="your email" id="email" name="email">
							</p>

							<p>
								<label for="password">Password</label>
								<input type="password" class="form-control" placeholder="your password" id="password" name="password" required="">
							</p>

							<p>
								<label for="cpassword">Conform Password</label>
								<input type="password" class="form-control" placeholder="Conform assword" id="cpassword" name="cpassword" required="">
							</p>

							<button type="submit" name="submitform" class="btn btn-dark mb-5 mt-5">Resistar Now</button>
							<?php wp_nonce_field( 'vdm_user_reg', 'vdm_user_reg_nonce' ); ?>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php get_footer('data'); ?>