<?php
/**
 * @version		$Id: view.html.php 10094 2008-03-02 04:35:10Z instance $
 * @package		Joomla
 * @subpackage	Contact
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport('joomla.application.component.view');

/**
 * @package		Joomla
 * @subpackage	Contacts
 */
class CatsoneViewCatsone extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$limit				= JRequest::getVar('limit',				$mainframe->getCfg('list_limit'),	'', 'int');
		$limitstart			= JRequest::getVar('limitstart',		0,				'', 'int');
		$options['limit'] = $limit;
		$options['limitstart'] = $limitstart;
		$user		= &JFactory::getUser();
		$pathway	= &$mainframe->getPathway();
		$document	= & JFactory::getDocument();
		$model		= &$this->getModel();

		// Get the parameters of the active menu item
		$menus	= &JSite::getMenu();
		$menu    = $menus->getActive();

		// Push a model into the view
		$model		= &$this->getModel();
		
		$jobType = JRequest::getVar('jobType');
		$options['jobType'] = $jobType;
		$order = Jrequest::getVar('orderby');
		$options['order'] = $order;
		$catsone	= $model->getCatsone( $options );
		$total = count($catsone);
		// Set the document page title
		$document->setTitle(JText::_("Catsone module"));
		jimport('joomla.html.pagination');
		$pagination = new JPagination($total, $limitstart, $limit);
		$this->assignRef('catsone'   , $catsone);
		$this->assignRef('jobType', $jobType);
		$this->assignRef('pagination',	$pagination);
		
				
		
		
		
		//JHTML::_('behavior.formvalidation');

		parent::display($tpl);
	}
}