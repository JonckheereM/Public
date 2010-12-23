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
        if (isset($id)) {
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
    function Add() {
        $values = array(
            'name' => $this->name,
            'abv' => $this->abv,
        );
        //Adds to the databank
        return PublicApp::getDB()->insert('drinks', $values);
    }

    /**
     * Update this drink object in the databank.
     *
     * @return	int	The number of affected rows.
     */
    function Update() {
        $values = array(
            'name' => $this->name,
            'abv' => $this->abv,
        );
        //Update the databank
        return PublicApp::getDB()->update('drinks', $values, 'drink_id = ?', $this->drink_id);
    }

    /**
     * Delete this drink object in the databank.
     *
     * @return	int	The number of affected rows.
     */
    function Delete() {
        //Update the databank
        return PublicApp::getDB()->delete('drinks', 'drink_id = ?', $this->drink_id);
    }

    /**
     * Gets all the drinks from the database.
     *
     * @return	array	All the drinks.
     */
    public static function getAllDrinks() {
        return PublicApp::getDB()->getRecords('SELECT * FROM drinks order by name asc');
    }

    /**
     * Gets the recent drinkers of this drink.
     *
     * @return	array	All the drinks.
     */
    function getRecent() {
        return PublicApp::getDB()->getRecords('SELECT tabs.timestamp, tabs.drink_id, pubs.pub_id, users.user_id, users.fb_uid, users.username, pubs.name as pubname FROM tabs
                                                INNER JOIN checkins on tabs.checkin_id = checkins.checkin_id
                                                INNER JOIN users on checkins.user_id = users.user_id
                                                INNER JOIN pubs on checkins.pub_id = pubs.pub_id
                                                WHERE tabs.drink_id = '.$this->drink_id.' order by tabs.timestamp desc LIMIT 10');
    }

    /**
     * Gets the top drinkers of this drink.
     *
     * @return	array	All the drinks.
     */
    function getTop() {
        return PublicApp::getDB()->getRecords('SELECT users.user_id, users.username, count(users.user_id) as count FROM tabs
                                                INNER JOIN checkins on tabs.checkin_id = checkins.checkin_id
                                                INNER JOIN users on checkins.user_id = users.user_id
                                                WHERE tabs.drink_id = '.$this->drink_id.' group by users.user_id asc LIMIT 5');
    }
}

?>