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
            return new SpoonDatabase('mysql', 'localhost', 'xqdchsmn_public', 'pRAcHU8Ajath7qa3', 'xqdchsmn_public');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}

?>