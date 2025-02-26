<?php 
/*
 * Template Name: Contact Us
 */
get_header();
?>


<section class="contactus-section">
    <div class="container">
        <div class="row">
            <!-- Content Column -->
            <div class="col-md-6 content-section">
                <h2>About BolsterRx</h2>
                <p>At BolsterRx, we recognize that our responsibility goes beyond the services we offer. It extends to our communities, customers, and employees, where we live and work.</p>
                <p><strong>Phone:</strong> +1 (123) 456-7890</p>
                <p><strong>Email:</strong> <?php the_field('email_address', 'option'); ?></p>
                <p><strong>Address:</strong> 123 Main Street, City, State, ZIP</p>
            </div>

            <!-- Form Column -->
            <div class="col-md-6 contact-form">
                <?php echo do_shortcode('[gravityform id="1" title="false"]'); ?>
            </div>
        </div>
    </div>
</section>



<?php get_footer(); ?>
