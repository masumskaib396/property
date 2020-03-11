<?php
/*
   Template Name: user-data
 *
 *
 *
 * @package fortun
 */

 get_header('data') ?>



<?php 

$folder = carbon_get_the_post_meta('folder');


 ?>



<div class="vdm-tab-title-wrap">
		<div class="vdm-container">
			<div class="vdm-tab-title-column">
				<div class="vdm-tab-title">
					<h3>the old bakery</h3>
				</div>
				<div class="vdm-tab-title-menu">
					<ul>
						<li><a href="#">files</a></li>
						<li><a href="#">permissions</a></li>
						<li><a href="#">updates</a></li>
						<li><a href="#">activity tracker</a></li>
						<li><a href="#">my downloads</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
<div class="tabbable">
	<div class="vdm-tab-main-wrap">
		<div class="vdm-custom-tab">
			<h4 class="vdmmenu-title">folder</h4>
			<div class="vdm-tab-menu">
				<ul>
					<li><a href="#"><i class="far fa-clock"></i> recent files</a></li>
					<li>
						<a href="#"><i class="fas fa-folder"></i> home</a>
						<ul class="tabs">
							<li class="tab-link current" data-tab="tab-1"><i class="fas fa-chevron-right"></i>folder name</li>
							
						</ul>	
					</li>
				</ul>
			</div>
		</div>
		<div class="vdm-tab-form">
			<div id="tab-1" class="tab-content current">
				<div class="vdm-tab-item">
					<div class="vdm-tab-item-header">
						<div class="header-left">
							<ul>
								<li><a href="#">home. <i class="fas fa-chevron-right"></i></a> 2.Financial information</li>
							</ul>
						</div>
						<div class="header-right">
							<a class="download-all" href="#">download all</a>
						</div>
					</div>
					<div class="vdm-table-wrap">
						<table class="vdm-table">
							<thead>
								<tr>
									<th>
										<form action="#">
											<div class="form-group">
												<input type="checkbox" id="check1">
												<label for="check1"></label>
											</div>
										</form>
									</th>
									<th>Inbox</th>
									<th>Title</th>
									<th>Size</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<form action="#">
											<div class="form-group">
												<input type="checkbox" id="check2">
												<label for="check2"></label>
											</div>
										</form>
									</td>
									<td>2.1</td>
									<td class="fixed-width"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/icon1.png" alt="">Finance Report.xlsx</td>
									<td>235KB</td>
									<td>Feb 16</td>
								</tr>
								<tr>
									<td>
										<form action="#">
											<div class="form-group">
												<input type="checkbox" id="check3">
												<label for="check3"></label>
											</div>
										</form>
									</td>
									<td>2.2</td>
									<td class="fixed-width"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/icon2.png" alt="">Finance Report.doc</td>
									<td>1.4MB</td>
									<td>Feb 20</td>
								</tr>
								<tr>
									<td>
										<form action="#">
											<div class="form-group">
												<input type="checkbox" id="check4">
												<label for="check4"></label>
											</div>
										</form>
									</td>
									<td></td>
									<td class="fixed-width"><img src="<?php echo get_stylesheet_directory_uri() ?>/img/icon3.png" alt="">Historical Finances.pdf</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<form action="#">
											<div class="form-group">
												<input type="checkbox" id="check5">
												<label for="check5"></label>
											</div>
										</form>
									</td>
									<td></td>
									<td class="fixed-width"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<form action="#">
											<div class="form-group">
												<input type="checkbox" id="check6">
												<label for="check6"></label>
											</div>
										</form>
									</td>
									<td></td>
									<td class="fixed-width"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<form action="#">
											<div class="form-group">
												<input type="checkbox" id="check7">
												<label for="check7"></label>
											</div>
										</form>
									</td>
									<td></td>
									<td class="fixed-width"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>
										<form action="#">
											<div class="form-group">
												<input type="checkbox" id="check8">
												<label for="check8"></label>
											</div>
										</form>
									</td>
									<td></td>
									<td class="fixed-width"></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
<?php get_footer('data') ?>