<?php

		class Resource extends Siteaction
		{
			public function handle($context)
			{
				$path = $context->getpar('path', '');
				$context->sendfile($path, $name = '', $mime = '', $cache	= '', $etag = '');
				
			}
		}
		
		
		
?>