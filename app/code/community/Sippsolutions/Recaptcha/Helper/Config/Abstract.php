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
 * @author     Simon Sippert
 * <s.sippert@sippsolutions.de>
 * @copyright  Copyright (c) 2015 sippsolutions (http://www.sippsolutions.de)
 * @version    1.0.0
 * @link       http://www.sippsolutions.de/
 */
abstract class Sippsolutions_Recaptcha_Helper_Config_Abstract extends Mage_Core_Helper_Abstract
{
    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/general/enable.
     *
     * @var string
     */
    const XML_PATH_GENERAL_ENABLE
        = 'sippsolutions_recaptcha/general/enable';

    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/general/only_guests.
     *
     * @var string
     */
    const XML_PATH_GENERAL_ONLY_GUESTS
        = 'sippsolutions_recaptcha/general/only_guests';

    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/general/theme.
     *
     * @var string
     */
    const XML_PATH_GENERAL_THEME
        = 'sippsolutions_recaptcha/general/theme';

    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/general/size.
     *
     * @var string
     */
    const XML_PATH_GENERAL_SIZE
        = 'sippsolutions_recaptcha/general/size';

    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/key/public.
     *
     * @var string
     */
    const XML_PATH_KEY_PUBLIC
        = 'sippsolutions_recaptcha/key/public';

    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/key/private.
     *
     * @var string
     */
    const XML_PATH_KEY_PRIVATE
        = 'sippsolutions_recaptcha/key/private';

    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/location/login.
     *
     * @var string
     */
    const XML_PATH_LOCATION_LOGIN
        = 'sippsolutions_recaptcha/location/login';

    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/location/review.
     *
     * @var string
     */
    const XML_PATH_LOCATION_REVIEW
        = 'sippsolutions_recaptcha/location/review';

    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/location/contact.
     *
     * @var string
     */
    const XML_PATH_LOCATION_CONTACT
        = 'sippsolutions_recaptcha/location/contact';

    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/location/register.
     *
     * @var string
     */
    const XML_PATH_LOCATION_REGISTER
        = 'sippsolutions_recaptcha/location/register';

    /**
     * Holds the xml path to the config value
     * sippsolutions_recaptcha/location/custom.
     *
     * @var string
     */
    const XML_PATH_LOCATION_CUSTOM
        = 'sippsolutions_recaptcha/location/custom';

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/general/enable.
     *
     * @param void
     * @return mixed
     */
    public function getGeneralEnable($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_GENERAL_ENABLE, $storeId);

        return $config;
    }

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/general/only_guests.
     *
     * @param void
     * @return mixed
     */
    public function getGeneralOnlyGuests($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_GENERAL_ONLY_GUESTS, $storeId);

        return $config;
    }

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/general/theme.
     *
     * @param void
     * @return mixed
     */
    public function getGeneralTheme($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_GENERAL_THEME, $storeId);

        return $config;
    }

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/general/size.
     *
     * @param void
     * @return mixed
     */
    public function getGeneralSize($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_GENERAL_SIZE, $storeId);

        return $config;
    }

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/key/public.
     *
     * @param void
     * @return mixed
     */
    public function getKeyPublic($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_KEY_PUBLIC, $storeId);

        return $config;
    }

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/key/private.
     *
     * @param void
     * @return mixed
     */
    public function getKeyPrivate($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_KEY_PRIVATE, $storeId);

        return $config;
    }

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/location/login.
     *
     * @param void
     * @return mixed
     */
    public function getLocationLogin($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_LOCATION_LOGIN, $storeId);

        return $config;
    }

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/location/review.
     *
     * @param void
     * @return mixed
     */
    public function getLocationReview($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_LOCATION_REVIEW, $storeId);

        return $config;
    }

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/location/contact.
     *
     * @param void
     * @return mixed
     */
    public function getLocationContact($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_LOCATION_CONTACT, $storeId);

        return $config;
    }

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/location/register.
     *
     * @param void
     * @return mixed
     */
    public function getLocationRegister($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_LOCATION_REGISTER, $storeId);

        return $config;
    }

    /**
     * Returns the configured value for the config value
     * sippsolutions_recaptcha/location/custom.
     *
     * @param void
     * @return mixed
     */
    public function getLocationCustom($storeId = null)
    {
        $config = Mage::getStoreConfig(self::XML_PATH_LOCATION_CUSTOM, $storeId);

        return $config;
    }
}
