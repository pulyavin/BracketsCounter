<?php
namespace Project;

class BracketsCounter {
	private $expression;

	public function __construct($expression) {
		$this->expression = str_replace(" ", "", $expression);
	}

	public function count() {
		$stack = [];
		$result = [];

		for ($i = 0, $length = strlen($this->expression); $i < $length; $i++) {
			$char = $this->expression[$i];

			if ($char == "(") {
				array_push($stack, $i);
				continue;
			}

			if ($char == ")") {
				if (empty($stack)) {
					throw new \InvalidArgumentException("Error with parse in position " . $i);
				}

				$position = array_pop($stack);

				$result[$position] = $i;
				continue;
			}
		}

		if (!empty($stack)) {
			throw new \InvalidArgumentException("Error with parse in position " . array_pop($stack));
		}

		return $this->prepare($result);
	}

	private function prepare($result) {
		ksort($result);

		$string = "";
		foreach ($result as $at => $to) {
			$string .= '(' . $at . ', ' . $to . '), '; 
		}

		return trim($string, ", ");
	}
}