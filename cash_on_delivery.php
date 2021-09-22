<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('_JEXEC') or die;
jimport( 'joomla.plugin.plugin' );
jimport( 'joomla.filesystem.file');
jimport( 'joomla.html.parameter' );

JLoader::registerPrefix('Phocacart', JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/phocacart');

class plgPCPCash_On_Delivery extends JPlugin
{

	protected $name 	= 'cash_on_delivery';

	function __construct(& $subject, $config) {
		parent :: __construct($subject, $config);
	}

	/**
	 * Proceed to payment - some method do not have proceed to payment gateway like e.g. cash on delivery
	 *
	 * @param   integer	$proceed  Proceed or not proceed to payment gateway
	 * @param   string	$message  Custom message array set by plugin to override standard messages made by component
	 *
	 * @return  boolean  True
	 */

	function PCPbeforeProceedToPayment(&$proceed, &$message, $eventData) {

		if (!isset($eventData['pluginname']) || isset($eventData['pluginname']) && $eventData['pluginname'] != $this->name) {
			return false;
		}

		$proceed = 0;
		$message = array();

		return true;
	}

	function PCPbeforeSaveOrder(&$statusId, $pid, $eventData) {

		if (!isset($eventData['pluginname']) || isset($eventData['pluginname']) && $eventData['pluginname'] != $this->name) {
			return false;
		}

        // Status set by payment method in case of order (pending, confirmed, completed)
        // In case of POS cash, it is always completed
        $paymentTemp		= new PhocacartPayment();
        $paymentOTemp 		= $paymentTemp->getPaymentMethod((int)$pid );
        $paramsPaymentTemp	= $paymentOTemp->params;
        $statusId		    = $paramsPaymentTemp->get('default_order_status', 1);

		//$statusId = 6;

		return true;
	}

	function PCPbeforeShowPossiblePaymentMethod(&$active, $params, $eventData){

		if (!isset($eventData['pluginname']) || isset($eventData['pluginname']) && $eventData['pluginname'] != $this->name) {
			return false;
		}

		// Payment plugin can disable/deactivate current payment method in possible payment method list based on own rules
		// $active = false;

		return true;

	}

	function PCPonInfoViewDisplayContent($data, $eventData){

		if (!isset($eventData['pluginname']) || isset($eventData['pluginname']) && $eventData['pluginname'] != $this->name) {
			return false;
		}

		$output = array();
		//$output['content'] = '';

		return $output;

	}


	/*
	 * Payment plugin wants to display some information on Item View (Detail View) page
	 * */
	/*
	public function PCPonItemBeforeEndPricePanel($context, &$item, &$params) {
		//return "<div></div>";
	}
	*/

}
?>
