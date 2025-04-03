<!-- Section: Contact Form -->
<section class="content main-content-section">
    <div class="inner inner-narrow clearfix">
        <div class="contact-details" style="margin: 30px 0;">					
            <div class="fieldset clearfix">
                <div><h3>Contact us</h3> <span class="required-text">* required fields</span></div>
                
                <?php
                    $scf = $modules->get('SimpleContactForm');
                    include("./includes/message.php");
                    
                    //$altEmail = $page->alt_recipient!='' ? $page->alt_recipient : "";

                    $options = array(
                        'emailSubject' => 'From the T.E.W Hickton Contact Form',
                        'emailMessage' => $emailMessage,
                        'btnText' => 'Send Enquiry',
                        'emailReplyTo' => $input->c_email,
                        'emailAddTo' => 'developer@tridentmarketingdev.co.uk',
                        'errorMessage' => 'Please check that you have entered all the required fields correctly.',
                        'successMessage' => 'Thank you. Your message has been sent. Someone from our office will contact you soon.'
                    );

                    // Send to additional recipient (if configured)
                    if($page->alt_recipient!='') {
                        $options["emailAddTo"]=$page->alt_recipient;
                    }

                    // If page_link field has a value set, use this as the form redirect location.
                    if($page->page_link){
                        $options['redirectSamePage'] = false;
                        $options['redirectPage'] = $page->page_link->id;
                    }
                ?>

                <!-- Contact Form HTML Output -->
                <div><?php echo $scf->render($options); ?></div>
            </div>
        </div>
    </div>
</section>
<!-- / Section: Contact Form -->
        	