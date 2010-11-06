<?php

/** 
 * PublicApp library
 * 
 * @author Jeroen Neyt <jeroen.neyt@kahosl.be>
 * @author Jeroen Maes <jeroen.maes@kahosl.be>
 * @author Maxime Jonckheere <maxime.jonckheere@kahosl.be> 
 * 
 */

class Drink {
	
	/**
	 * The name of the drink
	 *
	 * @var	integer
	 */
	public $drink_id;
	
	/**
	 * The name of the drink
	 *
	 * @var	string
	 */
	public $name = '';
	
	/**
	 * The abv of the drink
	 *
	 * @var	float
	 */
	public $abv;

	/**
	 * Constructor
	 *
	 * @param	int $id
	 */
	function __construct($id) {
		if(isset($id)){
			//Get the drink details from the databank and put them in the variables
			$var = PublicApp::getDB()->getRecord('SELECT * FROM drinks WHERE drink_id = ?', $id);
			$this->drink_id = $var['drink_id'];
			$this->name = $var['name'];
			$this->abv = $var['abv'];
		}
	}
	
	/** 
	 * Adds this drink object in the databank.
	 *
	 * @return	int	The id of the new record.
	 */
	function Add(){
		$values = array(
				'name'	=> $this->name,
				'abv'	=> $this->abv,
			);
		//Adds to the databank
		return PublicApp::getDB()->insert('drinks', $values); 
	}
	
	/** 
	 * Update this drink object in the databank.
	 *
	 * @return	int	The number of affected rows.
	 */
	function Update(){
		$values = array(
				'name'	=> $this->name,
				'abv'	=> $this->abv,
			);
		//Update the databank
		return PublicApp::getDB()->update('drinks', $values, 'drink_id = ?', $this->drink_id); 
	}
	
	/** 
	 * Delete this drink object in the databank.
	 *
	 * @return	int	The number of affected rows.
	 */
	function Delete(){
		//Update the databank
		return PublicApp::getDB()->delete('drinks', 'drink_id = ?', $this->drink_id); 
	}
}

?>