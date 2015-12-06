<?php
/**
 * Definition of Iterator class helper for $_FILE array values
 *
 * @author Lindsay Marshall <lindsay.marshall@ncl.ac.uk>
 * @copyright 2015 Newcastle University
 */
/**
 * A class to iterate over array values in $_FILES and make them look like singletons
 */
    class FAIterator extends ArrayIterator
    {
/**
 * @var array   The 'error' array fron the named file.
 *
 * This is just used an aiteration control and any of the field arrays could be used.
 */
        private $far;
/**
 *  The constructor
 *
 *  @param string    $name The name of the entry in the $_FILES array
 */
        public function __construct($name)
        {
	    $this->far = $_FILES[$name];
	    parent::_construct($_FILES[$name]['error']);
        }
/**
 * Returns the value of the current element of the "array"
 *
 * This returns an array that looks like what you would get if the file upload was a
 * singleton and not an array. This can simplify coding in certain circumstances even
 * though it invovles restructuring the data and hence is slightly inefficient. Basically
 * the $_FILES array should be made from objects with fields not arrays of keyed values!!!
 *
 * @return array
 */
        public function current()
        {
            $x = $this->far;
	    $k = $this->key();
	    return array(
	        'name'      => $x['name'][$k],
	        'type'      => $x['type'][$k],
	        'size'      => $x['size'][$k],
	        'tmp_name'  => $x['tmp_name'][$k],
	        'error'     => $x['error'][$k],
	    );
        }
    }
?>