<?php

    class Publication extends Siteaction
    {
		
		public function handle($context)
        {
			$id = $_GET['id'];
			$pubdata = self::getpub($id);
			$path = '';
			
			foreach($pubdata as $key => $value)
			{
				$context->local()->addval($key, $value);
			}
			
			
			
			//Find instutution name
			$institution = R::find('institution', 'id = ? ', [ $pubdata['institution_id'] ]);
			
			foreach($institution as $key => $value)
			{
				$context->local()->addval('instiname', $value['name'].', '.$value['country']);
				
			}
			
			//Find authors
			
			$authors = R::find('author_publication', 'publication_id = ?', [ $pubdata['institution_id'] ]);
			$authids = [];
			foreach($authors as $key => $value)
			{
				
				$authids[] = $value['author_id'];
				
			}
			
			foreach($authids as $key => $value)
			{
				
					$autharr = R::find('author', 'id = ?', [ $value ]);
					foreach($autharr as $key2 => $value2)
					{
						$authornames[] = $value2['name'];
					}
				
			}
			
			$name = $pubdata['name'];
			$mime = $pubdata['type'];
			$path = $pubdata['url'];
			$name = substr($path, 8);
			
			
			
			if($context->postpar('resource', '') != ''){
				$context->sendfile($path, $name, $mime, '', '');
			
			}
			
			
			// TODO just author.id in .twig?
			// Also use the getrow from redbean
			
			$context->local()->addval('authors', $authornames);
			
			
			return 'publication.twig';
			
			
		}
		
		private static function getpub($id)
		{
			// TODO change to find, will return an array not a bean
			$pubdata = R::findOne('publication', 'id = ? ', [ $id ]);
			
			return $pubdata;
		}
		
		
	}	
?>