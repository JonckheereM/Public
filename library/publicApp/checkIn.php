<?php

/**
 * PublicApp library
 * 
 * @author Jeroen Neyt <jeroen.neyt@kahosl.be>
 * @author Jeroen Maes <jeroen.maes@kahosl.be>
 * @author Maxime Jonckheere <maxime.jonckheere@kahosl.be> 
 * 
 */
class CheckIn {

    /**
     * The id of the check in
     *
     * @var	integer
     */
    public $checkin_id;
    /**
     * The pub where you have checked in
     *
     * @var	Pub
     */
    public $pub;
    /**
     * The user who has checked in
     *
     * @var	User
     */
    public $user;
    /**
     * The timestamp of the check in
     *
     * @var	string
     */
    public $timestamp;
    /**
     * The tabs of the check in
     *
     * @var	array
     */
    public $tabs = array();

    /**
     * Constructor
     *
     * @param	int $id
     */
    function __construct($id) {
        if (isset($id)) {
            //Get the checkin details from the databank and put them in the variables
            $var = PublicApp::getDB()->getRecord('SELECT * FROM checkins WHERE checkin_id = ?', $id);
            $this->checkin_id = $var['checkin_id'];
            $this->pub = new Pub($var['pub_id']);
            $this->user = new User($var['user_id']);
            $this->timestamp = $var['timestamp'];

            //Get the tabs and put them in the tabs array
            $var = PublicApp::getDB()->getRecords('SELECT * FROM tabs WHERE checkin_id = ?', $id);
            foreach ($var as $tab) {
                $this->tabs[] = new Tab($tab['drink_id'], $tab['timestamp']);
            }
        }
    }

    /**
     * Adds this checkin object in the databank.
     *
     * @return	int	The id of the new record.
     */
    function Add() {
        $values = array(
            'pub_id' => $this->pub->pub_id,
            'user_id' => $this->user->user_id,
            'timestamp' => $this->timestamp,
        );
        //Update the databank
        return PublicApp::getDB()->insert('checkins', $values);
    }

    /**
     * Adds a tab object in the databank.
     *
     * @return	int	The id.
     */
    function AddTab($drink_id) {
        $newTab = new Tab($drink_id, null);
        $this->tabs[] = $newTab;
        $values = array(
            'checkin_id' => $this->checkin_id,
            'drink_id' => $newTab->drink->drink_id,
            'timestamp' => $newTab->timestamp,
        );
        //Update the databank
        return PublicApp::getDB()->insert('tabs', $values);
    }

    /**
     * Update this checkin object in the databank.
     *
     * @return	int	The number of affected rows.
     */
    function Update() {
        $values = array(
            'pub_id' => $this->pub->pub_id,
            'user_id' => $this->user->user_id,
            'timestamp' => $this->timestamp,
        );
        //Update the databank
        return PublicApp::getDB()->update('checkins', $values, 'checkin_id = ?', $this->checkin_id);
    }

    /**
     * Delete this checkin object in the databank.
     *
     * @return	int	The number of affected rows.
     */
    function Delete() {
        //Update the databank
        return PublicApp::getDB()->delete('checkins', 'checkin_id = ?', $this->checkin_id);
    }

    /**
     * Delete a tab object in the databank.
     *
     * @return	void
     * @param 	$id
     */
    function DeleteTab($id) {
        //Update the databank
        PublicApp::getDB()->delete('tabs', 'checkin_id = ? AND drink_id = ? AND timestamp = ?', array($this->checkin_id, $this->tabs[$id]->drink->drink_id, $this->tabs[$id]->timestamp));
        unset($this->tabs[$id]);
    }

}

?>