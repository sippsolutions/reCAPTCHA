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
        // get request
        $request = Mage::app()->getRequest();

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
                // throw event
                Mage::dispatchEvent('sippsolutions_recaptcha_solved');

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

        // define config object for event
        $config = (object)array(
            'route' => $route,
            'response' => $response,
            'should_redirect' => true,
            'direct_to' => $redirect,
            'message' => $helper->__('Please solve the captcha.'),
        );

        // throw event
        Mage::dispatchEvent('sippsolutions_recaptcha_redirect_before', array('config' => $config));

        /** @var $session Mage_Core_Model_Session */
        $session = Mage::getSingleton('core/session');

        // add error message
        $session->addError($config->message);

        // redirect to page
        if ($config->should_redirect) {
            header('Location: ' . $config->direct_to);
            die();
        }

        // proceed
        return $this;
    }
}
