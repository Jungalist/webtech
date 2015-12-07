<?php

    class Upload extends Siteaction
    {
		
		public function handle($context)
        {
			
			$success = False;
			
			
			$authors = [];
			foreach ($context->postapar('authorArray') as $value)
			{
				$authors[] = $value;
				
			}
			
			
				
			// TODO add validation and then 
			// TODO add all the other fields to if
			if  ((empty($authors) == False) and 
				($instiname = $context->postpar('instiname', '')) != '' and
				//($country = $context->postpar('country', '')) != '' and 
				($pubname = $context->postpar('pubname', '')) != '')
				{
					
				
				
					
				$country = $context->postpar('country', 'UK');
				$textabstract = $context->postpar('textabstract', 'missing abstract');
				$success = self::formprocess($context, $authors, $instiname, $country, $pubname, $textabstract);
				
			}
			
			//Use session cookies to not show if form not submitted or form validation to show, 'Sorry try again'
			
			$context->local()->addval('success', ($success) ? 'Success' : 'Fail');
			return 'upload.twig';
			
			
		}
		
		static function formprocess($context, $authors, $instiname, $country, $pubname, $textabstract)
		{
			//R::nuke(); USE WIPE MOFO
			
			$authorsID = array();
			
			//TODO self::exists($author); -- FIND OR CREATE
			// Iterate over authors array and dispense beans
			foreach($authors as $author){
			    $newAuthor = R::dispense('author');
				$newAuthor->name = $author;
				$id = R::store($newAuthor);
				array_push($authorsID, $newAuthor); //TODO change to array[]
			}
			
				//Check name of pub, if exists ask what to do
				//Add Publication
				$newPub = R::dispense('publication');
				$newPub->name = $pubname;
				$newPub->textabstract = $textabstract;
				$newPub->url = self::fileupload();
			
				
				// Junction table Publication_author
				 foreach($authorsID as $author){
				    $newPub->sharedPubAuthor[] = $author;
					R::store($newPub); 
				}
				
				//Add intitution if not exists
				$newInsti = R::dispense('institution');
				$newInsti->name = $instiname;
				// TODO add Institution or search over institutions to select if already exists with autofill
				$newInsti->country = $country;
				
				//Junction table institution_author
				foreach($authorsID as $author){
				    $newInsti->sharedInstiAuthor[] = $author;
				}
				
				// One to many: one institution can have many publications
				$newInsti->ownInstiPub[] = $newPub;
				
				R::store($newInsti);
				
			
			return True;
		}
		
		static function fileupload()
		{
			//File upload
				$name = $_FILES['file']['name'];
				$size = $_FILES['file']['size'];
				$type = $_FILES['file']['type'];
				$tmp_name = $_FILES['file']['tmp_name'];
				
				
				if(isset($name))
				{
					if(!empty($name))
					{
						$location = 'uploads/';
						$path = $location.$name;
						move_uploaded_file($tmp_name, $path);
					}
				}
			return $path;
		}
		
		/*function ifExists($authorName){
			$a = R::find('author', 'author_name = :author', array(
				':author' => $authorName
			));
			
			return $a;
		}*/
		
	}	
?>