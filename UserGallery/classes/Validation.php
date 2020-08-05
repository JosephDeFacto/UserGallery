<?php

/* NOT USEFUL RIGHT NOW */
 
/*
class Validation {

	public $errors = array();

	public function name($name) {

		$this->name = $name;

		return $this;
	}

	public function value($value) {

		$this->value = $value;

		return $this;
	}

	public function match($value) {

		if ($this->value != $value) {
			$this->errors[] = "Values must match";
		}
	}

	public function isEmail($value) {

		if(filter_var($value, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
	}

	public function success() {

		if (empty($this->errors)) {
			return true;
		}
	}

	public function getErrors() {

		if(!$this->success()) {
			return $this->errors;
		}
	}

	public function showErrors() {

		$output = '<ul>';
		foreach ($this->getErrors() as $error) {
			$output .= '<li>' . $error . '</li>';
		}
		$output .= '</ul>';

		return $output;
	}
}

*/