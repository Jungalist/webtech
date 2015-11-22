<?php

require_once '/vendor/autoload.php';


    class Upload extends Siteaction
    {
		
		public function handle($context)
        {
			$loader	= new Twig_Loader_Filesystem('twigs');
			$twig = new Twig_Environment($loader);
			
			$success = False;
			
			//formHandling($context, $success);
			$id = 0;
			if ( ($authorName = $context->postpar('author', '')) != ''){
				$newAuthor = R::dispense('author');
				//$newAuthor->authorId = '71';
				$newAuthor->name = $authorName;
				//$newAuthor->main_subject = postpar('subject', '');
				$id = R::store($newAuthor);
				$success = True;
			}
			
			echo $twig->render('upload.twig', array(
				'success' => ($success) ? 'Success' : 'Sorry, try again',
				'id' => $id
			)); 
			
			
		}
		/*
		public function formHandling($context, $success){
			if ( ($authorName = $context->postpar('author', '')) != ''){
				$newAuthor = R::dispense('author');
				$newAuthor->author_id = '000001';
				$newAuthor->name = $authorName;
				$success = True;
			} 
				$success = False;
			
			
		}*/
		 
	}
?>