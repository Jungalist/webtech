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
				if(sizeof($authors)>=4){
					//TODO do something to tell user only the first 5 were selected
					break;
				}
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
				$category = $context->postpar('category', '');
				$success = self::formprocess($context, $authors, $instiname, $country, $pubname, $textabstract, $category);
				
			}
			
			//Use session cookies to not show if form not submitted or form validation to show, 'Sorry try again'
			
			$context->local()->addval('success', ($success) ? 'Success' : 'Fail');
			return 'upload.twig';
			
			
		}
		
		static function formprocess($context, $authors, $instiname, $country, $pubname, $textabstract, $category)
		{
			
			$authorsID = array();
			
			//TODO self::exists($author); -- FIND OR CREATE
			// Iterate over authors array and dispense beans
			foreach($authors as $author){
			    $newAuthor = R::dispense('author');
				$newAuthor->name = $author;
				$id = R::store($newAuthor);
				array_push($authorsID, $newAuthor); //TODO change to array[]
			}
			
				//TODO Check name of pub, if exists ask what to do
				//Add Publication
				$newPub = R::dispense('publication');
				$newPub->name = $pubname;
				$newPub->textabstract = $textabstract;
				$newPub->url = self::fileupload();
				$newPub->type =  $_FILES['file']['type'];
				
				
				
				// Junction table Publication_author
				 foreach($authorsID as $author){
				    $newPub->sharedPubAuthor[] = $author;
					$id = R::store($newPub); 
				}
				
				switch ($category) {
					case "Paper":
						self::processpaper();
						break;
					case "Data":
						self::processdata();
						break;
					case "Source code":
					
						self::processsoucre();
						break;
					case "App":
						self::processapp();
						break;
					default:
						// TODO have an alert or something, client side and server
						echo "Select type";
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
		
		static function processpaper($category, $id){
			
		}
		
		/*static function categorise($category, $id){
			//Check type of pub
				switch ($category) {
					case "Paper":
						$paper = R::dispense('paper');
						$paper->pubid = $id;
						//$paper->doi = "Robin Leave me alone!";
						$paper->
						R::store($paper);
						break;
					case "Data":
						$data = R::dispense('data');
						$data->pubid = $id;
						
						$data->doi = "Robin Leave me alone!";
						R::store($data);
						break;
					case "Source code":
						$source = R::dispense('source');
						$source->pubid = $id;
						
						R::store($source);
						break;
					case "App":
						$app = R::dispense('app');
						$app->pubid = $id;
						$app->platform = $platform;
						R::store($app);
						break;
					default:
						// TODO have an alert or something, client side and server
						echo "Select type";
				}
		}*/
		
		/*function ifExists($authorName){
			$a = R::find('author', 'author_name = :author', array(
				':author' => $authorName
			));
			
			return $a;
		}*/
		
	}	
?>