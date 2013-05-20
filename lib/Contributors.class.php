<?php
/*
 * @todo Find all users with .org usernames
 * @todo Create count of all users with .org username for num contributors. Transient!
 * @todo Shortcode cs_num_contributors
 */


class CS_Contributors implements CS_Interface {
    
   /**
    * Holds an array of site users with a .org username.
    * Indexed by local user id num
    * @var array 
    */
    private $mContributors = null;
    
    public function __construct() {
	$this->getContributors();
	
	$this->setMeta(1, 'how_awesome', 110);
	
	echo '<pre>'; var_dump($this->mContributors); echo '</pre>';
    }
    
    public function getContributors() {
	// Little short circuit to save processing time
	if( !is_null($this->mContributors)) {
	    return $this->mContributors;
	}
	
	
	$args = array(
            'meta_key' => 'wporg',
            'meta_value' => '',
	    'meta_compare' => '!='
        );
        $query = new WP_User_Query( $args );
        $results = $query->get_results();
	
	// Pull out only details we care about
	$cons = array();
	foreach( $results AS $con) {
	    // One more additional check to ensure user has a .org username
	    if( empty( $con->wporg )) continue;
	    
	    $cons[$con->ID] = array(
		'ID' => $con->ID,
		'display_name' => $con->display_name,
		'user_login' => $con->user_login,
		'wporg' => $con->wporg
	    );
	}
	$this->mContributors = $cons;
    }
    
    /*
     * $user can be user id or ? user_login|wporg?
     */
    public function setMeta( $user, $key, $value ) {
	
	if(is_numeric($user) && isset($this->mContributors[$user])) {
	    $this->mContributors[$user][$key] = $value;
	}
    }
    
} // end class