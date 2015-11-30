<?php

require_once '/vendor/autoload.php';


    class Upload extends Siteaction
    {
		
		public function handle($context)
        {
			$loader	= new Twig_Loader_Filesystem('twigs');
			$twig = new Twig_Environment($loader);
			
			$success = False;
			//$test = 0;
			//formHandling($context, $success);
			//Add comma separated, multiple authors
			
			
			//Make getting vars from form into function?
			if (($authorName = $context->postpar('author', '')) != '' and 
				($iName = $context->postpar('iName', '')) != '' and
				($country = $context->postpar('country', '')) != '' and 
				($pubName = $context->postpar('pubName', '')) != ''){
				//Add author if not exists
				
				//$test = $this->ifexists($authorName);				
				$newAuthor = R::dispense('author');
				$newAuthor->name = $authorName;
				//$newAuthor->main_subject = postpar('subject', '');
				$authID = R::store($newAuthor);
				
				
				//Add intitution if not exists
				$newInsti = R::dispense('institution');
				$newInsti->name = $iName;
				$newInsti->country = $country;
				$instiID = R::store($newInsti);
				
				//Check name of pub, if exists ask what to do
				//Add Publication
				$newPub = R::dispense('publication');
				$newPub->name = $pubName;
				$newPub->authorID = $authID;
				$newPub->institutionID = $instiID;
				// TODO actually upload the file and store url
				$newPub->url = '';
				R::store($newPub);
				
				$success = True;
			}
			
			echo $twig->render('upload.twig', array(
				//Use session cookies to not show if form not submitted or form validation to show, 'Sorry try again'
				'success' => ($success) ? 'Success' : ''
				//,'test' => $test
			)); 
			
			
		}
		
		/*function ifExists($authorName){
			$a = R::find('author', 'author_name = :author', array(
				':author' => $authorName
			));
			
			return $a;
		}*/
		
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