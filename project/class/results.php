<?php


    class Results extends Siteaction
    {
		
		public function handle($context)
        {
			
			$searchphrase = $context->postpar('search', '');
			$results = [];
			if ($searchphrase != '')
			{
				
				$query = R::find('publication',' name LIKE :name ',
					array(':name' => '%' . $searchphrase . '%' )
				);
				$c = 0;
				foreach($query as $q){
					$results[$c]= $q;
					$c++;
					
				}
				
			
			}else{
				$context->local()->addval('results', "Sorry, you need to type in a search phrase");
				return 'results.twig';
			}
			
			// Check for empty results list
			if (!empty($results)){
				$context->local()->addval('results', $results);
			}else {
				$context->local()->addval('empty', True);
			}
			return 'results.twig';
			
		}
		
		
		 
	}
?>
