<?php

    class Publication extends Siteaction
    {
		
		public function handle($context)
        {
			$id = $_GET['id'];
			$pubdata = self::getpub($id);
			$path = '';
			
			/*
			if (isset($_POST['action'])) {
				switch ($_POST['action']) {
					case 'full':
						full($path);
						break;
					case 'select':
						
						break;
					}
			}
			*/
			
			foreach($pubdata as $key => $value)
			{
				$context->local()->addval($key, $value);
				if($key == 'url')
				{
					$path = $value;
				}
			}
			
			
			//$context->local()->addval('hi', );
			return 'publication.twig';
			
			
		}
		
		private static function getpub($id)
		{
			$pubdata = R::findOne('publication', 'id = ? ', [ $id ]);
			
			return $pubdata;
		}
		
		function full($path)
		{
			$context->sendfile($path, $name = '', $mime = '', $cache	= '', $etag = '');
		}
		
		
	}	
?>