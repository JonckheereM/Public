<?php

/**
 * PublicApp library
 * 
 * @author Jeroen Neyt <jeroen.neyt@kahosl.be>
 * @author Jeroen Maes <jeroen.maes@kahosl.be>
 * @author Maxime Jonckheere <maxime.jonckheere@kahosl.be> 
 * 
 */
class User extends PublicApp {

    /**
     * The id of the user
     *
     * @var	integer
     */
    public $user_id;
    /**
     * The name of the user
     *
     * @var	string
     */
    public $username = '';
    /**
     * The first name of the user
     *
     * @var	string
     */
    public $first_name = '';
    /**
     * The last name of the user
     *
     * @var	string
     */
    public $last_name;
    /**
     * The mail address of the user
     *
     * @var	string
     */
    public $mail = '';
    /**
     * The password of the user
     *
     * @var	string
     */
    public $password = '';
    /**
     * The gender of the user
     *
     * @var	integer
     */
    public $gender;
    /**
     * The birth_date of the user
     *
     * @var	string
     */
    public $birth_date = '';
    /**
     * The weight of the user
     *
     * @var	float
     */
    public $weight;
    /**
     * The friends of the user
     *
     * @var	array
     */
    public $friends = array();

    /**
     * Constructor
     *
     * @param	int $id user_id
     */
    function __construct($id) {
        if (isset($id)) {
            //Get the user details from the databank and put them in the variables
            $var = PublicApp::getDB()->getRecord('SELECT * FROM users WHERE user_id = ?', $id);
            $this->user_id = $var['user_id'];
            $this->username = $var['username'];
            $this->first_name = $var['first_name'];
            $this->last_name = $var['last_name'];
            $this->mail = $var['mail'];
            $this->password = $var['password'];
            $this->gender = $var['gender'];
            $this->birth_date = $var['birth_date'];
            $this->weight = $var['weight'];

            //Get the friends and put them in the friends array
            $var = PublicApp::getDB()->getRecords('SELECT * FROM friends WHERE user_id = ?', $id);
            if ($var !== null) {
                foreach ($var as $friend) {
                    $this->friends[] = new User($friend['friend']);
                }
            }
        }
    }

    /**
     * Adds this user object in the databank.
     *
     * @return	int	The id of the new record.
     */
    function Add() {
        $values = array(
            'username' => $this->username,
            'first_Name' => $this->first_name,
            'last_name' => $this->last_name,
            'mail' => $this->mail,
            'password' => $this->password,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'weight' => $this->weight,
        );
        //Adds to the databank
        $this->user_id = PublicApp::getDB()->insert('users', $values);
        return $this->user_id;
    }

    /**
     * Update this user object in the databank.
     *
     * @return	int	The number of affected rows.
     */
    function Update() {
        $values = array(
            'username' => $this->username,
            'first_Name' => $this->first_name,
            'last_name' => $this->last_name,
            'mail' => $this->mail,
            'password' => $this->password,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'weight' => $this->weight,
        );
        //Update the databank
        return PublicApp::getDB()->update('users', $values, 'user_id = ?', $this->user_id);
    }

    /**
     * Delete this user object in the databank.
     *
     * @return	int	The number of affected rows.
     */
    function Delete() {
        //Update the databank
        return PublicApp::getDB()->delete('users', 'user_id = ?', $this->user_id);
    }

    /**
     * Checks if there already exist a user with this username
     *
     * @return	bool	false if a user not exist
     * @return  user    gives the user if he exist
     */
    public static function existsUser($username) {
        $var = PublicApp::getDB()->getRecord('SELECT * FROM users WHERE username = ?', $username);
        $user = new User('');
        $user->user_id = $var['user_id'];
        $user->username = $var['username'];
        $user->first_name = $var['first_name'];
        $user->last_name = $var['last_name'];
        $user->mail = $var['mail'];
        $user->password = $var['password'];
        $user->gender = $var['gender'];
        $user->birth_date = $var['birth_date'];
        $user->weight = $var['weight'];
        if ($var === null) {
            return false;
        } else {
            return $user;
        }
    }

}

?>