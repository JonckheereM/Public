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
     * The facebook user id of the user
     */
    public $fb_uid;
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
            $this->fb_uid = $var['fb_uid'];

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
            'fb_uid' => $this->fb_uid
        );
        //Adds to the databank
        $this->user_id = PublicApp::getDB()->insert('users', $values);
        return $this->user_id;
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
        $user->fb_uid = $var['fb_uid'];
        if ($var === null) {
            return false;
        } else {
            return $user;
        }
    }

    /**
     * Function to follow a user
     *
     * @param int the user_id of the user you want to follow
     * @return bool if the insert didn't fail
     */
    public function follow($user_id)
    {
      $values = array(
          'user_id' => $this->user_id,
          'friend'  => $user_id
      );
      return PublicApp::getDb()->insert('friends', $values);
    }

    /**
     * Get all the users that follow this one
     * 
     * @return the users that follow this one 
     */
    public function GetFollowers()
    {
      return PublicApp::getDB()->getRecords('SELECT user_id, friend FROM friends WHERE friend = ?', $this->user_id);
    }

    /**
     * Get all the users that this one is following
     *
     * @return array the users that this one is following
     */
    public function GetFollowing()
    {
      return PublicApp::getDB()->getRecords('SELECT user_id, friend FROM friends WHERE user_id = ?', $this->user_id);
    }
    /**
     * Gets the top places from a user (read: the places where the user checks in the most)
     *
     * @param int $count The number of places you want to retrieve
     */
    public function GetTopPubs($count) {
        return PublicApp::getDB()->getRecords('SELECT pubs.pub_id, pubs.name, count(checkins.pub_id) as count FROM pubs
                                             INNER JOIN checkins on pubs.pub_id = checkins.pub_id
                                             WHERE checkins.user_id = ' . $this->user_id . ' group by pubs.pub_id asc LIMIT ' . $count);
    }

    /**
     *
     * @param int the user_id to check if the logged in user is friends with
     * @return bool if the users are friends or not
     */
    public function isFriend($user_id)
    {
      $value = PublicApp::getDB()->getRecord('SELECT user_id, friend FROM friends WHERE user_id = '.$this->user_id.' AND friend = '.$user_id);
      if($value != null) return true;
      return false;
    }

    /**
     * Calculates if the user is legal to drive or not.
     *
     * @param int $glasses  The number glasses.
     * @param int $hours    Hours from the first glass
     */
    public function isLegalToDrive($glasses, $hours) {
        $gender;

        if ($this->gender === 1) {
            $gender = 0.7;
        } else {
            $gender = 0.5;
        }
        if($hours === 0)$hours = 1;

        $BAG = ($glasses * 10) / ($this->weight * $gender) - ($hours - 0.5) * ($this->weight * 0.002);

        if($BAG <= 0.5)return true;
        else return false;
    }

    /**
     * Function to unfollow a user
     *
     * @param int the user_id of the user you want to unfollow
     * @return bool if the delete didn't fail
     */
    public function unfollow($user_id)
    {
      $values = array(
          'user_id' => $this->user_id,
          'friend'  => $user_id
      );
      return PublicApp::getDB()->delete('friends', 'user_id = ? and friend = ?', array($this->user_id, $user_id));
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
            'fb_uid' => $this->fb_uid
        );
        //Update the databank
        return PublicApp::getDB()->update('users', $values, 'user_id = ?', $this->user_id);
    }
}

?>