<?php
/**
 * A class that contains code to implement a profile page
 *		CHANGE!!!!!
 * @author Lindsay Marshall <lindsay.marshall@ncl.ac.uk>
 * @copyright 2012-2013 Newcastle University
 *
 */
    class Profile extends Siteaction
    {
/**
 * Handle profile operations /profile/xxxx
 *
 * @param object	$context	The context object for the site
 *
 * @return string	A template name
 */
        public function handle($context)
        {
            if (($email = $context->postpar('email', '')) != '')
            { # there is a post
                $context->local()->addval('done', TRUE);
            }
            return 'profile.twig';
        }
    }
?>
