<?php

/**
 * Copyright (c) 2015 sippsolutions
 * All rights reserved
 *
 * This product includes proprietary software developed at sippsolutions
 * For more information see http://www.sippsolutions.de/
 */

/**
 * Observer functionality for reCAPTCHA.
 *
 * @category   Sippsolutions
 * @package    Sippsolutions_Recaptcha
 * @subpackage Model
 * @author     Simon Sippert <s.sippert@sippsolutions.de>
 * @copyright  Copyright (c) 2015 sippsolutions (http://www.sippsolutions.de)
 * @version    1.0.0
 * @link       http://www.sippsolutions.de/
 */
class Sippsolutions_Recaptcha_Model_Observer
{
    /**
     * Check the captcha
     *
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function checkCaptcha(Varien_Event_Observer $observer)
    {
        // get event
        $event = $observer->getEvent();

        /** @var $controller Mage_Core_Controller_Front_Action */
        $controller = $event->getControllerAction();

        // get request
        $request = $controller->getRequest();

        /** @var $helper Sippsolutions_Recaptcha_Helper_Data */
        $helper = Mage::helper('sippsolutions_recaptcha');

        // check if module is enabled
        if (!$helper->isEnabled()) {
            return $this;
        }

        // get enabled locations
        $locations = $helper->getLocations();

        // get route
        $route = $request->getModuleName() . '/' . $request->getControllerName() . '/' . $request->getActionName();

        // check if the current route is in locations array
        if (!in_array($route, $locations)) {
            return $this;
        }

        // get client response
        $response = $request->getParam('g-recaptcha-response');

        // define params object for event
        $params = (object)array(
            'route' => $route,
            'response' => $response,
        );

        // check client response
        if ($response) {
            // create stream context
            $context = stream_context_create(array(
                'http' => array(
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'method' => 'POST',
                    'content' => http_build_query(array(
                        'secret' => $helper->getKeyPrivate(),
                        'response' => $response,
                    )),
                ),
            ));

            // verify with google
            $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);

            // check response
            if ($response && ($response = json_decode($response)) && $response->success) {
                // set response
                $params->response = $response;

                // throw event
                Mage::dispatchEvent('sippsolutions_recaptcha_solved', array('config' => $params, 'controller' => $controller));

                // proceed
                return $this;
            }
        }

        // get referrer
        $redirect = $request->getServer('HTTP_REFERER');

        // check if referrer is internal
        if (
            strpos($redirect, Mage::app()->getStore()->getBaseUrl()) !== 0 &&
            strpos($redirect, Mage::app()->getStore()->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK, true) !== 0)
        ) {
            // else set default url
            $redirect = Mage::getUrl();
        }

        // set redirect
        $params->shouldRedirect = true;
        $params->redirectTo = $redirect;
        $params->message = $helper->__('Please solve the captcha.');

        // throw event
        Mage::dispatchEvent('sippsolutions_recaptcha_redirect_before', array('config' => $params, 'controller' => $controller));

        /** @var $session Mage_Core_Model_Session */
        $session = Mage::getSingleton('core/session');

        // add error message
        $session->addError($params->message);

        // set dispatched
        $request->setDispatched(true);
        $controller->setFlag('', Mage_Core_Controller_Varien_Action::FLAG_NO_DISPATCH, true);

        // redirect to page
        if ($params->shouldRedirect) {
            $controller->getResponse()->setRedirect($params->redirectTo)->sendResponse();
        }

        // proceed
        return $this;
    }
}
