			<!-- Main Footer -->
			<footer class="main-footer">
				<canvas id="stars"></canvas>
				<div class="auto-container">
					<!--Widgets Section-->
					<div class="widgets-section">
						<div class="row clearfix">
							<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
								<?php dynamic_sidebar('footer-1'); ?>
							<?php } ?>
							<?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
								<?php dynamic_sidebar('footer-2'); ?>
							<?php } ?>
							<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
								<?php dynamic_sidebar('footer-3'); ?>
							<?php } ?>
							<?php if ( is_active_sidebar( 'footer-4' ) ) { ?>
								<?php dynamic_sidebar('footer-4'); ?>
							<?php } ?>
						</div><!-- Row Section-->
					</div><!--Widgets Section-->
				</div><!-- auto-container -->
			</footer>
			<div class="copyrights_section" style="background-color:#222;padding:20px;text-align:center;">
				<div class="auto-container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<?php if ( is_active_sidebar( 'copyrights' ) ) { ?>
								<?php dynamic_sidebar('copyrights'); ?>
							<?php } else { ?>
								Copyrights &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> All Rights Reserved. | Powered by : <a href="https://easternts.com.au/" title="Eastern Techno Solutions" target="_blank"> Eastern Techno Solutions</a><?php
							} ?>
						</div>
					</div>
				</div>
			</div>
			<!--Scroll to top-->
			<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
			<?php wp_footer(); ?>
		</div><!-- page-wrapper -->
	</body>
</html>