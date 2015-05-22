<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.plugin.plugin' );
jimport( 'joomla.filesystem.file');
jimport( 'joomla.html.parameter' );
class plgPCPCash_On_Delivery extends JPlugin
{
	function plgPCPCash_On_Delivery(& $subject, $config) {
		parent :: __construct($subject, $config);
	}
	
	function PCPbeforeProceedToPayment(&$proceed) {
		$proceed = 0;
		return true;
	}
	
}
?>