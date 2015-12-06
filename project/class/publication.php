<?php

    class Publication extends Siteaction
    {
		
		public function handle($context)
        {
			$id = $_GET['id'];
			self::getpub($id);
			$context->local()->addval('id', $id);
			
			return 'publication.twig';
			
			
		}
		
		private static function getpub($id)
		{
			return R::findOne('publication', 'id = ? ', [ $id ]);
		}
	}	
?>