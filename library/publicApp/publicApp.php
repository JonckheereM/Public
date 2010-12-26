<?php

/**
 * PublicApp library
 * 
 * @author Jeroen Neyt <jeroen.neyt@kahosl.be>
 * @author Jeroen Maes <jeroen.maes@kahosl.be>
 * @author Maxime Jonckheere <maxime.jonckheere@kahosl.be> 
 * 
 */
/**x
 * This is the version number for the current version of the
 * PublicApp Library.
 */
define('PUBLICAPP_VERSION', '1.0');

require_once 'publicApp/user.php';
require_once 'publicApp/pub.php';
require_once 'publicApp/drink.php';
require_once 'publicApp/tab.php';
require_once 'publicApp/checkIn.php';

class PublicApp {

    //TODO - Insert your code here

    function __construct() {

    }

    /**
     * Gets the used database Instance
     *
     * @return SpoonDatabase
     */
    public static function getDB() {
        // get it and return it
        try {
            //return new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
            return new SpoonDatabase('mysql', 'localhost', 'root', 'root', 'xqdchsmn_public');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Gets the recent drink activities.
     *
     * @return	array	All the activities.
     */
    public static function getRecentDrinks() {
        return PublicApp::getDB()->getRecords('SELECT tabs.timestamp, tabs.drink_id, drinks.name as drinkname, pubs.pub_id, pubs.name as pubname, users.user_id, users.username, users.fb_uid FROM tabs
                                                INNER JOIN checkins on tabs.checkin_id = checkins.checkin_id
                                                INNER JOIN users on checkins.user_id = users.user_id
                                                INNER JOIN pubs on checkins.pub_id = pubs.pub_id
                                                INNER JOIN drinks on tabs.drink_id = drinks.drink_id
                                                order by tabs.timestamp desc LIMIT 10');
    }

    /**
     * Gets the recent check in activities.
     *
     * @return	array	All the activities.
     */
    public static function getRecentCheckins() {
        return PublicApp::getDB()->getRecords('SELECT checkins.timestamp, checkins.checkin_id, pubs.pub_id, pubs.name AS pubname, users.user_id, users.username, users.fb_uid
                                                FROM checkins
                                                INNER JOIN users ON checkins.user_id = users.user_id
                                                INNER JOIN pubs ON checkins.pub_id = pubs.pub_id
                                                ORDER BY checkins.timestamp DESC LIMIT 10');
    }
	
	public static function getRecentUserDrinks($uid) {
        return PublicApp::getDB()->getRecords('SELECT tabs.timestamp, tabs.drink_id, drinks.name as drinkname, pubs.pub_id, pubs.name as pubname, users.user_id, users.username, users.fb_uid FROM tabs 
                                                INNER JOIN checkins on tabs.checkin_id = checkins.checkin_id
                                                INNER JOIN users on checkins.user_id = users.user_id
                                                INNER JOIN pubs on checkins.pub_id = pubs.pub_id
                                                INNER JOIN drinks on tabs.drink_id = drinks.drink_id
                                                where users.user_id = '.$uid);
    }
	
	public static function getRecentUserCheckins($uid) {
        return PublicApp::getDB()->getRecords('SELECT checkins.timestamp, checkins.checkin_id, pubs.pub_id, pubs.name AS pubname, users.user_id, users.username, users.fb_uid
                                                FROM checkins 
                                                INNER JOIN users ON checkins.user_id = users.user_id
                                                INNER JOIN pubs ON checkins.pub_id = pubs.pub_id
                                                where users.user_id = '.$uid);
    }
}

?>