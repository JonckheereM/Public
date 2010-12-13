<?php

/**
 * PublicApp library
 * 
 * @author Jeroen Neyt <jeroen.neyt@kahosl.be>
 * @author Jeroen Maes <jeroen.maes@kahosl.be>
 * @author Maxime Jonckheere <maxime.jonckheere@kahosl.be> 
 * 
 */
class Tab {

    /**
     * The drink of the tab
     *
     * @var	Drink
     */
    public $drink;
    /**
     * The timestamp of the timestamp
     *
     * @var	string
     */
    public $timestamp;

    /**
     * Constructor
     *
     * @param	int $id
     */
    function __construct($drink_id, $time) {

        $this->drink = new Drink($drink_id);
        $this->timestamp = $time;
    }
}

?>