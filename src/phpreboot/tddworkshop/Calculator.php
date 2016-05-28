<?php

	namespace phpreboot\tddworkshop;

	/**
	 * 	Calculator class
	 */
	class Calculator
	{
		/**
		 * Function for addition 
		 * @param string $number
		 * @return integer
		 */
		public function add($numbers = '')
		{
	        if (empty($numbers)) {
            	return 0;
        	}

        	if (!is_string($numbers)) {
        		throw new \InvalidArgumentException('Parameters must be a string');
        	}

			$numbers = str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n", "\\", ";"),",",$numbers);
			$numbers = stripslashes($numbers);
        	$numbersArray = array_filter(explode(",", $numbers));

        	if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
        		throw new \InvalidArgumentException('Parameters string must contain number');
        	}

        	$negetiveNumbers = array_filter( $numbersArray, function( $val ) { return   (0>$val); } );

        	if (count($negetiveNumbers) > 1) {

        		throw new \InvalidArgumentException('Negative numbers (' . implode(',', $negetiveNumbers) . ')not allowed');
        	}

        	$numbersRange = array_filter( $numbersArray, function( $val ) { return   (1000>$val); } );

        	return array_sum($numbersRange);
		}
	}