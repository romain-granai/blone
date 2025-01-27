        </div> <!-- Closing Barba Container -->
        <?php if(!is_account_page()): ?>
            <div class="footer-sup">
                <div class="footer-sup__side footer-sup__side--left">
                    <div class="footer-sup__in">
                        <?php 

                            $newsletterTitle = get_field('newsletter_title', 'option');
                            $newsletterText = get_field('newsletter_text', 'option');
                            $newsletterEmailFieldLabel = get_field('newsletter_email_field_label', 'option');
                            $newsletterPrivacyCheckboxLabel = get_field('newsletter_privacy_checkbox_label', 'option');
                            $newsletterSubscribeLabel = get_field('newsletter_subscribe_label', 'option');

                            $footerSupRightTitle = get_field('footer_sup_right_title', 'option');
                            $footerSupRightText = get_field('footer_sup_right_text', 'option');
                            $footerSupRightBtnLink = get_field('footer_sup_right_button', 'option');
                            $footerSupRightBtnLabel = get_field('footer_sup_right_button_label', 'option');

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
                                    <div class="mc-field-group">
                                        <label for="mce-EMAIL" class="d-none">Email Address<span class="asterisk">*</span></label>
                                        <div class="mail-and-subscribe">
                                            <input type="email" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Adresse Mail" required="" value="">
                                            <button type="submit" name="subscribe" id="mc-embedded-subscribe" class="btn btn--dark" data-text="<?php echo $newsletterSubscribeLabel; ?>"><span><?php echo $newsletterSubscribeLabel; ?></span></button>

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
                <div class="footer-sup__side footer-sup__side--right">
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
                        <?php if($footerSupRightBtnLink): 
                            $url = $footerSupRightBtnLink['url'];    
                        ?>
                        <div class="cta cta--start"><a href="<?php echo $url; ?>" class="btn btn--dark" data-text="<?php echo $footerSupRightBtnLabel; ?>"><span><?php echo $footerSupRightBtnLabel; ?></span></a></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <footer class="footer">
            <div class="footer__top">

            <div class="footer__logo">
                <a href="#" title="Blone">
                    <svg viewBox="0 0 390 289" xmlns="http://www.w3.org/2000/svg">
                        <path d="M106.65 61.3398C106.75 61.2278 116.506 50.1012 122.696 45.3318C130.61 39.2358 132.494 39.3985 132.944 39.7385C134.072 40.6185 131.62 46.2732 130.437 48.9932C127.991 54.6332 122.601 62.7292 122.546 62.8118C122.396 63.0412 122.446 63.3478 122.66 63.5185C122.869 63.6905 123.188 63.6612 123.374 63.4665C123.611 63.2092 147.548 37.7438 165.482 29.7345C172.832 26.4545 177.667 26.1132 179.891 28.6985C190.12 40.5838 147.212 107.932 146.775 108.612C146.62 108.853 146.688 109.173 146.926 109.336C147.016 109.395 147.12 109.424 147.22 109.424C147.384 109.424 147.548 109.347 147.652 109.201L149.072 107.19C163.24 87.1492 186.946 53.6025 216.495 32.3718C247.46 10.1198 284.678 1.13052 285.051 1.04118C285.315 0.979852 285.488 0.727836 285.451 0.458503C285.419 0.193169 285.211 0.0358438 284.915 -0.000156238C284.378 0.0131771 230.891 1.74785 194.936 38.7345C187.218 46.6745 181.142 54.3585 175.715 62.2065C175.888 61.8918 176.062 61.5785 176.239 61.2678C190.052 36.3318 194.372 21.4265 189.083 16.9625C182.506 11.4158 163.586 24.9585 152.879 33.5252C143.955 40.6652 134.063 50.5692 128.309 56.5372C131.179 52.2412 134.84 46.3492 136.778 41.6158C136.864 41.4078 136.978 41.1505 137.106 40.8638C137.992 38.8492 139.475 35.4758 138.188 33.8385C137.956 33.5438 137.506 33.1785 136.706 33.1318C136.642 33.1265 136.583 33.1238 136.519 33.1238C133.435 33.1238 127.376 37.5252 118.967 45.8732C112.599 52.1985 105.909 60.5785 105.841 60.6625C105.663 60.8878 105.695 61.2118 105.918 61.3972C106.132 61.5785 106.459 61.5532 106.65 61.3398Z"/>
                        <path d="M195.295 144.686C231.908 144.686 261.698 175.791 261.698 214.031C261.698 251.735 231.29 283.587 195.295 283.587C159.303 283.587 128.896 251.735 128.896 214.031C128.896 175.791 158.682 144.686 195.295 144.686ZM195.295 140.154C151.018 140.154 117.631 171.914 117.631 214.031C117.631 256.267 151.018 288.119 195.295 288.119C239.571 288.119 272.959 256.267 272.959 214.031C272.959 171.914 239.571 140.154 195.295 140.154Z"/>
                        <path d="M312.808 257.41L262.963 177.087L262.767 176.766L246.984 168.954L309.79 270.303L310.175 270.93H317.06V158.114H312.808V257.41Z"/>
                        <path d="M389.866 162.366V158.114H324.977V270.93H389.866V266.678H334.382V212.528H389.866V208.436H334.382V162.366H389.866Z"/>
                        <path d="M103.883 266.678V158.114H94.4766V270.93H150.593V266.678H103.883Z"/>
                        <path d="M4.2892 212.62H50.5303C65.436 212.62 77.5589 224.82 77.5589 239.813C77.5589 254.714 65.436 266.838 50.5303 266.838H4.2892V212.62ZM45.3761 208.371H4.2892V162.526H45.3761C57.9684 162.526 68.2147 172.773 68.2147 185.369C68.2147 198.053 57.9684 208.371 45.3761 208.371ZM63.7043 209.306C72.3689 204.593 77.9449 195.447 77.9449 185.369C77.9449 170.43 65.7887 158.274 50.8501 158.274H0.0371094V271.09H56.0043C73.3397 271.09 87.4455 257.057 87.4455 239.813C87.4455 225.179 77.5043 212.754 63.7043 209.306Z"/>
                        <path d="M195.295 144.686C231.908 144.686 261.698 175.791 261.698 214.031C261.698 251.735 231.29 283.587 195.295 283.587C159.303 283.587 128.896 251.735 128.896 214.031C128.896 175.791 158.682 144.686 195.295 144.686ZM195.295 140.154C151.018 140.154 117.631 171.914 117.631 214.031C117.631 256.267 151.018 288.119 195.295 288.119C239.571 288.119 272.959 256.267 272.959 214.031C272.959 171.914 239.571 140.154 195.295 140.154Z"/>
                        <path d="M312.808 257.41L262.963 177.087L262.767 176.766L246.984 168.954L309.79 270.303L310.175 270.93H317.06V158.114H312.808V257.41Z"/>
                        <path d="M389.866 162.366V158.114H324.977V270.93H389.866V266.678H334.382V212.528H389.866V208.436H334.382V162.366H389.866Z"/>
                        <path d="M103.883 266.678V158.114H94.4766V270.93H150.593V266.678H103.883Z"/>
                        <path d="M4.2892 212.62H50.5303C65.436 212.62 77.5589 224.82 77.5589 239.813C77.5589 254.714 65.436 266.838 50.5303 266.838H4.2892V212.62ZM45.3761 208.371H4.2892V162.526H45.3761C57.9684 162.526 68.2147 172.773 68.2147 185.369C68.2147 198.053 57.9684 208.371 45.3761 208.371ZM63.7043 209.306C72.3689 204.593 77.9449 195.447 77.9449 185.369C77.9449 170.43 65.7887 158.274 50.8501 158.274H0.0371094V271.09H56.0043C73.3397 271.09 87.4455 257.057 87.4455 239.813C87.4455 225.179 77.5043 212.754 63.7043 209.306Z"/>
                    </svg>
                </a>
            </div>

            <nav class="footer__nav">
                <div>
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
                </div>
            </nav>

            </div>
            <div class="footer__bottom">
                <span>Blone <?php echo date("Y"); ?></span>
            </div>
        </footer>
        <?php wp_footer(); ?>
    </body>

</html>