<?php

/**
 * Template Activate Theme
 *
 * @link       https://themeforest.net/user/gentechtreedesign
 * @since      1.0.0
 *
 * 
 * 
 */

/**
 * @since      1.0.0
 * 
 * 
 * @author     PeaceFulThemes
 */

$allowed_html = array(
	'a' => array(
		'href' => true,
		'target' => true,
	),
);
?>
<div class="gentech-theme-helper">
	<div class="container-form">
		<h1 class="gentech-title">
			<?php echo esc_html__('Need Help?', 'streamlab');?>
		</h1>
		<div class="gentech-content">
			<p class="gentech-content_subtitle">
				<?php
					echo wp_kses( __( 'Please read a <a target="_blank" href="https://themeforest.net/page/item_support_policy">Support Policy</a> before submitting a ticket and make sure that your question related to our product issues.', 'streamlab' ), $allowed_html);
				?>
				<br/>
					<?php
					echo esc_html__('If you did not find an answer to your question, feel free to contact us.', 'streamlab');
					?>
			</p>
		</div>
		<div class="gentech-row">			
			<div class="gentech-col gentech-col-4">
				<div class="gentech-col_inner">
					<div class="gentech-info-box_wrapper">
						<div class="gentech-info-box">
							<div class="gentech-info-box_icon-wrapper">
								<div class="gentech-info-box_icon">
									<img src="<?php echo STREAMLAB_URI . '/admin/assest/img/doc.png'?>">
								</div>
							</div>
							<div class="gentech-info-box_content-wrapper">	
								<div class="gentech-info-box_title">
									<h3 class="gentech-info-box_icon-heading">
										<?php
											esc_html_e('Documentation', 'streamlab');
										?>
									</h3>
								</div>					
								<div class="gentech-info-box_content">
									<p>
										<?php
										esc_html_e('please read the documentation. All functionality will mension here to resolved you issues.', 'streamlab');
										?>
									</p>
								</div>		
								<div class="gentech-info-box_btn">
									<a target="_blank" href="https://gentechtreethemes.com/data/Documentation/">
										<?php
											esc_html_e('Visit Documentation', 'streamlab');
										?>	
									</a>
								</div>
							</div>
						</div>			
					</div>	
				</div>
			</div>
					
			<div class="gentech-col gentech-col-4">
				<div class="gentech-col_inner">
					<div class="gentech-info-box_wrapper">
						<div class="gentech-info-box">
							<div class="gentech-info-box_icon-wrapper">
								<div class="gentech-info-box_icon">
									<img src="<?php echo STREAMLAB_URI . '/admin/assest/img/mail.png'?>">
								</div>
							</div>
							<div class="gentech-info-box_content-wrapper">	
								<div class="gentech-info-box_title">
									<h3 class="gentech-info-box_icon-heading">
										<?php
											esc_html_e('Support Mail', 'streamlab');
										?>
									</h3>
								</div>					
								<div class="gentech-info-box_content">
									<p>
										<?php
											esc_html_e('If your query not solved., submit a ticket with well describe your issue.', 'streamlab');
										?>
									</p>
									<h2>Email : gentechtreethemes@gmail.com</h2>
								</div>		
								<div class="gentech-info-box_btn">
									<!-- <a target="_blank" href="https://webgeniuslab.ticksy.com"> -->
										<a href="mailto:gentechtreethemes@gmail.com" target="_blank">
										<?php
											esc_html_e('Create a ticket', 'streamlab');
										?>	
										
									</a>
								</div>
							</div>
						</div>			
					</div>	
				</div>
			</div>					
	
		</div>
		
	</div>
</div>

