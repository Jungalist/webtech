<?php

require_once '/vendor/autoload.php';

    class Contact extends Siteaction
    {

        public function handle($context)
        {
			$loader	= new Twig_Loader_Filesystem('twigs');
			$twig = new Twig_Environment($loader);
			
			
            if (($msg = $context->postpar('message', '')) != '')
            { # there is a post
                mail(Config::SYSADMIN, $context->postpar('subject', 'No Subject'), $msg);
            }
                   
		
			echo $twig->render('contact.twig', array(
				'hi' => 'Hello World',
			));
			
		}
    }
?>
