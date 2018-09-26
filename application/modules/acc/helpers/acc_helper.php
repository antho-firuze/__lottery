<?php

if ( ! function_exists('acc_posting'))
{
	function acc_posting($string, $exceptions = array()) {
		$words = explode(" ", $string);
		$newwords = array();

		foreach ($words as $word)
		{
			if (!in_array($word, $exceptions)) {
				$word = strtolower($word);
				$word = ucfirst($word);
			}
			array_push($newwords, $word);

		}

		return ucfirst(join(" ", $newwords));
	}
}

