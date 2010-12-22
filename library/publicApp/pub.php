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
     * @return	string	number of people.
     */
    function getNumberPeople() {
        $value = PublicApp::getDB()->getRecord('SELECT count(pub_id) as count FROM (SELECT DISTINCT user_id, pub_id FROM checkins
                                                WHERE pub_id = ' . $this->pub_id . ' group by user_id) as counter');
        return $value['count'];
    }

    /**
     * Gets the distance between two locations.
     *
     * @return	float   distance in km.
     */
    function calculateDistance($lat, $lon, $unit) {
        return (3958 * 3.1415926 * sqrt(($lat - $this->latitude) * ($lat - $this->latitude) + cos($lat / 57.29578) * cos($this->latitude / 57.29578) * ($lon - $this->longitude) * ($lon - $this->longitude)) / 180);
    }

    /**
     * Gets the number of checkins of this bar.
     *
     * @return	string	number of checkins.
     */
    function getNumberCheckins() {
        $value = PublicApp::getDB()->getRecord('SELECT count(pub_id) as count FROM checkins
                                                WHERE pub_id = ' . $this->pub_id . ' group by pub_id');
        if ($value['count'] === null

            )return 0;
        else
            return $value['count'];
    }

    /**
     * Gets the pubs within your range.
     *
     * @return	array	All the drinks.
     */
    public static function getPubsByLocation($lat, $long) {
        return PublicApp::getDB()->getRecords('SELECT * , (latitude - ' . $lat . ') AS dif_lat, (longitude - ' . $long . ') AS dif_long FROM pubs
                                                WHERE (latitude - ' . $lat . ') < 0.02 AND(longitude - ' . $long . ') < 0.02
                                                GROUP BY (latitude - ' . $lat . ') DESC');
    }

}

?>