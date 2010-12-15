<?php

/**
 * PublicApp library
 * 
 * @author Jeroen Neyt <jeroen.neyt@kahosl.be>
 * @author Jeroen Maes <jeroen.maes@kahosl.be>
 * @author Maxime Jonckheere <maxime.jonckheere@kahosl.be> 
 * 
 */
class Pub {

    /**
     * The id of the pub
     *
     * @var	integer
     */
    public $pub_id;
    /**
     * The name of the pub
     *
     * @var	string
     */
    public $name = '';
    /**
     * The longitude of the pub
     *
     * @var	float
     */
    public $longitude = 0;
    /**
     * The latitude of the pub
     *
     * @var	float
     */
    public $latitude = 0;

    /**
     * Constructor
     *
     * @param	int $id
     */
    function __construct($id) {
        if (isset($id)) {
            //Get the pub details from the databank and put them in the variables
            $var = PublicApp::getDB()->getRecord('SELECT * FROM pubs WHERE pub_id = ?', $id);
            $this->pub_id = $var['pub_id'];
            $this->name = $var['name'];
            $this->longitude = $var['longitude'];
            $this->latitude = $var['latitude'];
        }
    }

    /**
     * Adds this pub object in the databank.
     *
     * @return	int	The id of the new record.
     */
    function Add() {
        $values = array(
            'name' => $this->name,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        );
        //Adds to the databank
        return PublicApp::getDB()->insert('pubs', $values);
    }

    /**
     * Update this pub object in the databank.
     *
     * @return	int	The number of affected rows.
     */
    function Update() {
        $values = array(
            'name' => $this->name,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
        );
        //Update the databank
        return PublicApp::getDB()->update('pubs', $values, 'pub_id = ?', $this->pub_id);
    }

    /**
     * Delete this pub object in the databank.
     *
     * @return	int	The number of affected rows.
     */
    function Delete() {
        //Update the databank
        return PublicApp::getDB()->delete('pubs', 'pub_id = ?', $this->pub_id);
    }

    /**
     * Gets the number of people who have checked in here.
     *
     * @return	array	All the drinks.
     */
    function getNumberPeople() {
        $value = PublicApp::getDB()->getRecord('SELECT count(pub_id) as count FROM (SELECT DISTINCT user_id, pub_id FROM checkins
                                                WHERE pub_id = '.$this->pub_id.' group by user_id) as counter');
        return $value['count'];
    }

    /**
     * Gets the number of checkins of this bar.
     *
     * @return	array	All the drinks.
     */
    function getNumberCheckins() {
        $value = PublicApp::getDB()->getRecord('SELECT count(pub_id) as count FROM (SELECT pub_id FROM checkins
                                                WHERE pub_id = '.$this->pub_id.' group by pub_id) as counter');
        return $value['count'];
    }
}

?>