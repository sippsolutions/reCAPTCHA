<?php

/**
 * Copyright (c) 2015 sippsolutions
 * All rights reserved
 *
 * This product includes proprietary software developed at sippsolutions
 * For more information see http://www.sippsolutions.de/
 */

/**
 * Implements helper functionality.
 *
 * @category   Sippsolutions
 * @package    Sippsolutions_Recaptcha
 * @subpackage Helper
 * @author     Simon Sippert <s.sippert@sippsolutions.de>
 * @copyright  Copyright (c) 2015 sippsolutions (http://www.sippsolutions.de)
 * @version    1.0.0
 * @link       http://www.sippsolutions.de/
 */
class Sippsolutions_Recaptcha_Helper_Data extends Sippsolutions_Recaptcha_Helper_Config_Abstract
{
    /**
     * Retrieve locations where to put the captcha to
     *
     * @return array
     */
    public function getLocations()
    {
        // define locations
        $locations = array();

        // add locations
        if ($this->getLocationLogin()) {
            $locations[] = 'customer/account/loginPost';
        }
        if ($this->getLocationReview()) {
            $locations[] = 'review/product/post';
        }
        if ($this->getLocationContact()) {
            $locations[] = 'contacts/index/post';
        }
        if ($this->getLocationRegister()) {
            $locations[] = 'customer/account/createpost';
        }

        // add custom locations
        if ($custom = trim($this->getLocationCustom())) {
            $locations = array_merge($locations, explode("\n", $custom));
        }

        // return locations
        return $locations;
    }

    /**
     * Check if module is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        /** @var $customer Mage_Customer_Helper_Data */
        $customer = Mage::helper('customer');

        // check if module is enabled
        return $this->getGeneralEnable() && (!$this->getGeneralOnlyGuests() || !$customer->isLoggedIn());
    }
}
