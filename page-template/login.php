<?php
/*
   Template Name: Login Page
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
					<?php if ( !is_user_logged_in() ) : ?>
			        <div class="vmd-form-heading">
			        <?php _e("Login Form");?>
			        </div>
			        <div class="vdm-form-msg"></div>
			        <form id="vdm_login" method="POST">
			        	<p>
			        		<label for="user_login" >User Name</label>
			            	<input type="text"  value="" class="input" id="user_login" required name="user_login" />
			        	</p>
			            
			            <p>
			            	<label for="user_pass" >Password</label>
			             	 <input type="password" value="" class="input" id="user_pass" required name="user_pass" />
			            </p>
						
						<div class="form-footer">
							<p>
				            	<label for="remember">
				            	<input name="remember" type="checkbox" id="remember" value="1"  />
				            	Remember Me</label>
				            </p>
							<p>
				            	<input type="submit" tabindex="100" value="Log In"id="wp-submit" name="wp-submit" />
				            </p>
						</div>

			        </form>
			        <?php else : ?>
				        <div class="vmd-form-heading">
				        	<?php _e("Your are already login.",'');?>
				        </div>
			        <?php endif; ?>
		        </div>
			</div>
		</div>
	</div>
</div>
<?php get_footer('data'); ?>