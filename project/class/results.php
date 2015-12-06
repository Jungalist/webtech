<?php


    class Results extends Siteaction
    {
		
		public function handle($context)
        {
			
			$searchphrase = $context->postpar('search', '');
			$query = [];
			$results = [];
			if ($searchphrase != '')
			{
				
				// Publication search
				$query = R::find('publication', 'name = ?', [$searchphrase]);
				
				
				
			}
			$c = 0;
			
			// TODO can be done with one?
			foreach($query as $q){
				$results[$c]= $q;
				$c++;
			}
			$c = 0;
			
			
			
			// Twig for loops going over results? Can you just add array with addval?
			/* foreach($results as $r){
				$context->local()->addval('results' . $c, $r);
				$c++;
			} */
			$context->local()->addval('results', $results);
			
			//$context->local()->addval('result1', $searchphrase);
			
			return 'results.twig';
			
		}
		
		
		 
	}
?>
