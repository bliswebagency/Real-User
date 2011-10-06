<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2003 - 2011, EllisLab, Inc.
 * @license		http://expressionengine.com/user_guide/license.html
 * @link		http://expressionengine.com
 * @since		Version 2.0
 * @filesource
 */
 
// ------------------------------------------------------------------------

/**
 * RealUser Plugin
 *
 * @package		ExpressionEngine
 * @subpackage	Addons
 * @category	Plugin
 * @author		Blis Web Agency
 * @link		http://blis.net.au
 */

$plugin_info = array(
	'pi_name'		=> 'RealUser',
	'pi_version'	=> '1.0',
	'pi_author'		=> 'Blis Web Agency',
	'pi_author_url'	=> 'http://blis.net.au',
	'pi_description'=> 'Checks if a user exists',
	'pi_usage'		=> Realuser::usage()
);


class Realuser {

	public $return_data;
    
	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->EE =& get_instance();
	}
	
	public function check(){
	
		$o = "false";
		
		$username = $this->EE->TMPL->fetch_param('username');
		
		if (isset($_REQUEST['ru_username'])) $username = $_REQUEST['ru_username'];
		
		$query = "SELECT username FROM exp_members WHERE username = \"".$username."\" LIMIT 0,1";
		$results = $this->EE->db->query($query);				
		$source_val = $results->row('username');
		
		if ($source_val != NULL) $o = "true";
		
		return $o;
	
	}
	
	// ----------------------------------------------------------------
	
	/**
	 * Plugin Usage
	 */
	public static function usage()
	{
		ob_start();
?>

{exp:realuser:check username="admin"}

This will output: true (if the username is found)
or: false (if the username isn't found)

Useful for AJAX
<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}


/* End of file pi.realuser.php */
/* Location: /system/expressionengine/third_party/realuser/pi.realuser.php */