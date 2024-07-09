        </div> <!-- Closing Barba Container -->
        <div class="footer-sup">
            <div class="footer-sup__side">
                <div class="footer-sup__in">
                    <?php 
                        $newsletterTitle = get_field('newsletter_title', 'option');
                        $newsletterText = get_field('newsletter_text', 'option');
                        $newsletterEmailFieldLabel = get_field('newsletter_email_field_label', 'option');
                        $newsletterPrivacyCheckboxLabel = get_field('newsletter_privacy_checkbox_label', 'option');
                        $newsletterSubscribeLabel = get_field('newsletter_subscribe_label', 'option');

                        $footerSupRightTitle = get_field('footer_sup_right_title', 'option');
                        $footerSupRightText = get_field('footer_sup_right_text', 'option');
                    ?>
                    <div>
                        <?php 
                            if($newsletterTitle) {
                                echo '<h2 class="title">'. $newsletterTitle .'</h2>';
                            };

                            if($newsletterText) {
                                echo '<p>'. $newsletterText . '</p>';
                            }
                        ?>
                    </div>
                    
                    <div id="mc_embed_signup">
                        <form action="https://gmail.us21.list-manage.com/subscribe/post?u=f9138a877b7e33863a21294d7&amp;id=6d661aae6f&amp;f_id=00e867e1f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">
                            <div id="mc_embed_signup_scroll">
                                <!-- <div class="indicates-required"><span class="asterisk">*</span> indicates required</div> -->

                                <div class="mc-field-group">
                                    <label for="mce-EMAIL" class="d-none">Email Address<span class="asterisk">*</span></label>
                                    <div class="mail-and-subscribe">
                                        <input type="email" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Adresse Mail" required="" value="">
                                        <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn--dark" data-text="Subscribe"><span>Subscribe</span></button>

                                    </div>
                                    
                                </div>

                                <div class="mc-field-group input-group">
                                    <input type="checkbox" name="group[3556][1]" id="mce-group[3556]-3556-0" class="required" value="">
                                    <label for="mce-group[3556]-3556-0">
                                        <?php echo $newsletterPrivacyCheckboxLabel; ?>
                                    </label>
                                </div>

                                <div id="mce-responses" class="clear foot">
                                    <div class="response" id="mce-error-response" style="display: none;"></div>
                                    <div class="response" id="mce-success-response" style="display: none;"></div>
                                </div>

                                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                                    /* real people should not fill this in and expect good things - do not remove this or risk form bot signups */
                                    <input type="text" name="b_f9138a877b7e33863a21294d7_6d661aae6f" tabindex="-1" value="">
                                </div>
                                <!-- <div class="optionalParent">
                                    <div class="clear foot">
                                        
                                    </div>
                                </div> -->
                            </div>
                        </form>

                        <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js"></script><script type="text/javascript">(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
                    </div> 
                </div>

                
            </div>
            <div class="footer-sup__side">
                <div class="footer-sup__in">
                    <div>
                        <?php 
                            if($footerSupRightTitle) {
                                echo '<h2 class="title">'. $footerSupRightTitle .'</h2>';
                            };

                            if($footerSupRightText) {
                                echo '<p>'. $footerSupRightText . '</p>';
                            }
                        ?>
                    </div>
                    <div class="cta cta--start"><a href="#" class="btn btn--dark" data-text="En Savoir Plus"><span>En Savoir Plus</span></a></div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="footer__top">

            <div class="footer__logo"><a href="#" title="Blone"><img src="#" alt="Blone"></a></div>

            <nav class="footer__nav">

                <?php 
                    $contactLabel = get_field('contact_label', 'option');
                ?>
                <div class="footer__contact">
                    <?php if($contactLabel): ?>
                        <span><?php echo $contactLabel; ?></span>
                    <?php endif; ?>
                    <?php if( have_rows('address', 'option') ): ?>
                    <ul>
                        <?php while( have_rows('address', 'option') ) : the_row(); ?>
                            <li><?php echo the_sub_field('line'); ?></li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                </div>

                <?php get_template_part( 'template-parts/footer-nav' ); ?>

            </nav>

            </div>
            <div class="footer__bottom">
                <span>Blone <?php echo date("Y"); ?></span>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>

</html>