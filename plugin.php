<?php
/**
 * @version $Id$
 * @copyright Center for History and New Media, 2007-2008
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @package Omeka
 * @subpackage TermsOfService
 **/
define('TERMS_OF_SERVICE_VERSION', get_plugin_ini('TermsOfService', 'version'));
define('TERMS_OF_SERVICE_TOS_PAGE_PATH', 'tos/');
define('TERMS_OF_SERVICE_PRIVACY_POLICY_PAGE_PATH', 'privacy-policy/');

add_plugin_hook('install', 'terms_of_service_install');
add_plugin_hook('uninstall', 'terms_of_service_uninstall');
add_plugin_hook('config', 'terms_of_service_config');
add_plugin_hook('config_form', 'terms_of_service_config_form');
add_plugin_hook('define_routes', 'terms_of_service_routes');

function terms_of_service_install() 
{
	set_option('terms_of_service_version', TERMS_OF_SERVICE_VERSION);
        
}

function terms_of_service_uninstall() 
{
	delete_option('terms_of_service_version');
	delete_option('terms_of_service_tos');
	delete_option('terms_of_service_privacy_policy');
}

function terms_of_service_config($args) 
{
        $post = $args['post'];
	set_option('terms_of_service_tos', $post['terms_of_service_tos']);
	set_option('terms_of_service_privacy_policy', $post['terms_of_service_privacy_policy']);
}

function terms_of_service_config_form() 
{
    include 'config_form.php';
}

/**
 * @internal This could also be loaded from a config file if the relative URLs
 * weren't set as constants in this file.
 * 
 * @param Zend_Controller_Router_Rewrite $router
 * @return void
 **/
function terms_of_service_routes($args) 
{
     $router = $args['router'];
    $routes = array('termsOfService'    => array(TERMS_OF_SERVICE_TOS_PAGE_PATH, 
                                            array('action'=>'tos')),
                    'privacyPolicy'     => array(TERMS_OF_SERVICE_PRIVACY_POLICY_PAGE_PATH,
                                            array('action'=>'privacy-policy')));
    
	foreach ($routes as $routeName => $route) {
	    list($routeUrl, $routeVars) = $route;
	    // The module for this plugin is implied in all of these routes.
	    $routeVars = array_merge(array('module'=>'terms-of-service', 'controller' => 'index'), $routeVars);	    
	    $router->addRoute($routeName, new Zend_Controller_Router_Route($routeUrl, $routeVars));
	}
}

function terms_of_service_h($text) {
    return htmlspecialchars($text, ENT_COMPAT, 'UTF-8');
}

function terms_of_service_link($text = 'Terms Of Service')
{	
    $attribs['href'] = uri(array(), 'termsOfService');
    // Give it a class for styling purposes.
    $attribs['class'] = 'terms-of-service';
	return '<a ' . _tag_attributes($attribs) . '>' . terms_of_service_h($text) . '</a>';
}

function terms_of_service_privacy_policy_link($text = 'Privacy Policy')
{	
	$attribs['href'] = uri(array(), 'privacyPolicy');
    // Give it a class for styling purposes.
    $attribs['class'] = 'privacy-policy';
	return '<a ' . _tag_attributes($attribs) . '>' . terms_of_service_h($text) . '</a>';
}

function terms_of_service_form_input($inputId = 'agreed_to_tos_and_privacy_policy', $labelText = 'I understand and agree to the Terms Of Service and Privacy Policy') 
{
	$html = checkbox(array('name'=> $inputId, 'id'=> $inputId),  FALSE, null);
	$html .= label('agreed_to_tos_and_privacy_policy', $labelText);
	return $html;
}

function terms_of_service_checked_form_input() 
{
 	return (boolean)$_POST['agreed_to_tos_and_privacy_policy'];
}