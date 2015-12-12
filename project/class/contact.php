<?php


    class Contact extends Siteaction
    {

        public function handle($context)
        {

            if (($msg = $context->postpar('message', '')) != '')
            { # there is a post
                mail(Config::SYSADMIN, $context->postpar('subject', 'No Subject'), $msg);
            }
                   
		
			//$context->local()->addval('','hello');
			return 'contact.twig';
			
		}
    }
?>
