 <!--====== CONTACT PART START ======-->
    
    
 <section class="blog-area pt-125" id="contact">
    
	<div class="container fullsize">
        <h2>Contact Us</h2>
    <section class="main-section contact" id="contact">
	
        	<div>
            	<?php 
                $contacts = fopen("text/contacts.txt", "r");
                while(($line=fgets($contacts))!==false){
                    echo $line;
                    echo "<br/>";
                }
                fclose($contacts)
                ?>
            </div>
        	
        
    </section>

    <!--====== CONTACT PART ENDS ======-->