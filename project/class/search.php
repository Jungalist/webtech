<?php

require_once '/vendor/autoload.php';


    class Search extends Siteaction
    {
		
		public function handle($context)
        {
			$loader	= new Twig_Loader_Filesystem('twigs');
			$twig = new Twig_Environment($loader);
			
			echo $twig->render('search.twig', array(
				'hi' => 'Oi oi'
			));
				
			
		}
		 
	}
?>
