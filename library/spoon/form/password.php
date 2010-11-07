<?php

/**
 * Spoon Library
 *
 * This source file is part of the Spoon Library. More information,
 * documentation and tutorials can be found @ http://www.spoon-library.com
 *
 * @package		spoon
 * @subpackage	form
 *
 *
 * @author		Davy Hellemans <davy@spoon-library.com>
 * @author 		Tijs Verkoyen <tijs@spoon-library.com>
 * @author		Dave Lens <dave@spoon-library.com>
 * @since		0.1.1
 */


/**
 * Create a form password element.
 *
 * @package		spoon
 * @subpackage	form
 *
 *
 * @author		Davy Hellemans <davy@spoon-library.com>
 * @since		0.1.1
 */
class SpoonFormPassword extends SpoonFormInput
{
	/**
	 * Is the content of this field html?
	 *
	 * @var	bool
	 */
	private $isHTML = false;


	/**
	 * Class constructor.
	 *
	 * @return	void
	 * @param	string $name
	 * @param	string[optional] $value
	 * @param	int[optional] $maxlength
	 * @param	string[optional] $class
	 * @param	string[optional] $classError
	 * @param	bool[optional] $HTML
	 */
	public function __construct($name, $value = null, $maxlength = null, $class = 'inputPassword', $classError = 'inputPasswordError', $HTML = false)
	{
		// obligated fields
		$this->attributes['id'] = SpoonFilter::toCamelCase($name, '_', true);
		$this->attributes['name'] = (string) $name;

		// custom optional fields
		if($value !== null) $this->setValue($value);
		if($maxlength !== null) $this->attributes['maxlength'] = (int) $maxlength;
		$this->attributes['class'] = (string) $class;
		$this->classError = (string) $classError;
		$this->isHTML = (bool) $HTML;
	}


	/**
	 * Retrieve the initial or submitted value.
	 *
	 * @return	string
	 * @param	bool[optional] $allowHTML
	 */
	public function getValue($allowHTML = null)
	{
		// redefine html & default value
		$allowHTML = ($allowHTML !== null) ? (bool) $allowHTML : $this->isHTML;
		$value = $this->value;

		// contains html
		if($this->isHTML)
		{
			// set value
			$value = (SPOON_CHARSET == 'utf-8') ? SpoonFilter::htmlspecialchars($value) : SpoonFilter::htmlentities($value);
		}

		// form submitted
		if($this->isSubmitted())
		{
			// post/get data
			$data = $this->getMethod(true);

			// submitted by post (may be empty)
			if(isset($data[$this->getName()]))
			{
				// value
				$value = $data[$this->attributes['name']];

				// maximum length?
				if(isset($this->attributes['maxlength']) && $this->attributes['maxlength'] > 0) $value = mb_substr($value, 0, (int) $this->attributes['maxlength'], SPOON_CHARSET);

				// html allowed?
				if(!$allowHTML) $value = (SPOON_CHARSET == 'utf-8') ? SpoonFilter::htmlspecialchars($value) : SpoonFilter::htmlentities($value);
			}
		}

		return $value;
	}


	/**
	 * Checks if this field contains only letters a-z and A-Z.
	 *
	 * @return	bool
	 * @param	string[optional] $error
	 */
	public function isAlphabetical($error = null)
	{
		// filled
		if($this->isFilled())
		{
			// post/get data
			$data = $this->getMethod(true);

			// validate
			if(!isset($data[$this->attributes['name']]) || !SpoonFilter::isAlphabetical($data[$this->attributes['name']]))
			{
				if($error !== null) $this->setError($error);
				return false;
			}

			return true;
		}

		// not submitted
		if($error !== null) $this->setError($error);
		return false;
	}


	/**
	 * Checks if this field only contains letters & numbers (without spaces).
	 *
	 * @return	bool
	 * @param	string[optional] $error
	 */
	public function isAlphaNumeric($error = null)
	{
		// filled
		if($this->isFilled())
		{
			// post/get data
			$data = $this->getMethod(true);

			// validate
			if(!isset($data[$this->attributes['name']]) || !SpoonFilter::isAlphaNumeric($data[$this->attributes['name']]))
			{
				if($error !== null) $this->setError($error);
				return false;
			}

			return true;
		}

		// not submitted
		if($error !== null) $this->setError($error);
		return false;
	}


	/**
	 * Checks if this field was submitted & filled.
	 *
	 * @return	bool
	 * @param	string[optional] $error
	 */
	public function isFilled($error = null)
	{
		// post/get data
		$data = $this->getMethod(true);

		// validate
		if(!(isset($data[$this->attributes['name']]) && trim($data[$this->attributes['name']]) != ''))
		{
			if($error !== null) $this->setError($error);
			return false;
		}

		return true;
	}


	/**
	 * Checks if this field's length is less (or equal) than the given maximum.
	 *
	 * @return	bool
	 * @param	int $maximum
	 * @param	string[optional] $error
	 */
	public function isMaximumCharacters($maximum, $error = null)
	{
		// filled
		if($this->isFilled())
		{
			// post/get data
			$data = $this->getMethod(true);

			// validate
			if(!isset($data[$this->attributes['name']]) || !SpoonFilter::isMaximumCharacters($maximum, $data[$this->attributes['name']]))
			{
				if($error !== null) $this->setError($error);
				return false;
			}

			return true;
		}

		// not submitted
		if($error !== null) $this->setError($error);
		return false;
	}


	/**
	 * Checks if this field's length is more (or equal) than the given minimum.
	 *
	 * @return	bool
	 * @param	int $minimum
	 * @param	string[optional] $error
	 */
	public function isMinimumCharacters($minimum, $error = null)
	{
		// filled
		if($this->isFilled())
		{
			// post/get data
			$data = $this->getMethod(true);

			// validate
			if(!isset($data[$this->attributes['name']]) || !SpoonFilter::isMinimumCharacters($minimum, $data[$this->attributes['name']]))
			{
				if($error !== null) $this->setError($error);
				return false;
			}

			return true;
		}

		// not submitted
		if($error !== null) $this->setError($error);
		return false;
	}


	/**
	 * Checks if the field validates against the regexp.
	 *
	 * @return	bool
	 * @param	string $regexp
	 * @param	string[optional] $error
	 */
	public function isValidAgainstRegexp($regexp, $error = null)
	{
		// filled
		if($this->isFilled())
		{
			// post/get data
			$data = $this->getMethod(true);

			// validate
			if(!isset($data[$this->attributes['name']]) || !SpoonFilter::isValidAgainstRegexp($regexp, $data[$this->attributes['name']]))
			{
				if($error !== null) $this->setError($error);
				return false;
			}

			return true;
		}

		// not submitted
		if($error !== null) $this->setError($error);
		return false;
	}


	/**
	 * Parses the html for this textfield.
	 *
	 * @return	string
	 * @param	SpoonTemplate[optional] $template
	 */
	public function parse(SpoonTemplate $template = null)
	{
		// name is required
		if($this->attributes['name'] == '') throw new SpoonFormException('A name is required for a password field. Please provide a name.');

		// start html generation
		$output = '<input type="password" value="'. str_replace(array('"', '<', '>'), array('&quot;', '&lt;', '&gt'), $this->getValue()) .'"';

		// add attributes
		$output .= $this->getAttributesHTML(array('[id]' => $this->attributes['id'], '[name]' => $this->attributes['name'], '[value]' => $this->getValue())) .' />';

		// template
		if($template !== null)
		{
			$template->assign('txt'. SpoonFilter::toCamelCase($this->attributes['name']), $output);
			$template->assign('txt'. SpoonFilter::toCamelCase($this->attributes['name']) .'Error', ($this->errors!= '') ? '<span class="formError">'. $this->errors .'</span>' : '');
		}

		return $output;
	}


	/**
	 * Set the initial value.
	 *
	 * @return	void
	 * @param	string $value
	 */
	private function setValue($value)
	{
		$this->value = (string) $value;
	}
}

?>