<div id="terms_of_service_settings">
    <div class="field">
        <label for="terms_of_service_tos">Terms Of Service:</label>
        <?php 
            echo get_view()->formTextarea(
                    'terms_of_service_tos',  
                    get_option('terms_of_service_tos'),
                    array('rows'=>'5')
                 ); 
            ?>
        <p class="explanation">Please enter the Terms Of Service for your website.</p>				
    </div>
				
    <div class="field">
        <label for="terms_of_service_privacy_policy">Privacy Policy:</label>
       	<?php echo get_view()->formTextarea(
                     'terms_of_service_privacy_policy',  
                      get_option('terms_of_service_privacy_policy'),
                      array('rows'=>'5')
                ); 
        ?>
        <p class="explanation">Please enter the Privacy Policy for your website.</p>			
    </div>
</div>
