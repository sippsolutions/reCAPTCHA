// init global object
if (typeof(sippsolutions) == 'undefined') {
    var sippsolutions = {};
}

/**
 * Copyright (c) 2015 sippsolutions
 * All rights reserved
 *
 * This product includes proprietary software developed at sippsolutions
 * For more information see http://www.sippsolutions.de/
 */

/**
 * @category   Sippsolutions
 * @package    Sippsolutions_Recaptcha
 * @subpackage Layout
 * @author     Simon Sippert <s.sippert@sippsolutions.de>
 * @copyright  Copyright (c) 2015 sippsolutions (http://www.sippsolutions.de)
 * @link       http://www.sippsolutions.de/
 */
sippsolutions.reCAPTCHA = {
    /**
     * options
     *
     * @type {object}
     */
    options: {
        // public key
        key: null,
        // theme
        theme: 'light',
        // size
        size: 'normal',
        // locations to init reCAPTCHA
        locations: []
    },

    /**
     * initialize reCAPTCHA
     */
    init: function () {
        // add validation function
        Validation.add('g-recaptcha-response', Translator.translate('Please solve the captcha.'), function (val, item) {
            return !!val;
        });

        // iterate over locations
        jQuery(sippsolutions.reCAPTCHA.options.locations).each(function (i, location) {
            // try to find a form that matches
            var form = jQuery('form[action*="' + location + '"], form[data-matchroute*="' + location + '"]');

            // if a form has been found
            if (form.length) {
                // initialize it
                sippsolutions.reCAPTCHA.initForm(form);

                // currently reCAPTCHA cannot be initialized multiple times, so break the foreach now
                return false;
            }
        });
    },

    /**
     * Initialize a form
     *
     * @param {object} form
     */
    initForm: function (form) {
        // build captcha container
        var captcha = jQuery('<div>')
            .addClass('g-recaptcha')
            .attr('data-sitekey', sippsolutions.reCAPTCHA.options.key)
            .attr('data-theme', sippsolutions.reCAPTCHA.options.theme)
            .attr('data-size', sippsolutions.reCAPTCHA.options.size);

        // insert captcha
        sippsolutions.reCAPTCHA.appendCaptchaToForm(form, captcha);

        // initialize API
        jQuery.getScript('https://www.google.com/recaptcha/api.js');

        // ensure the field is being validated client-side too
        jQuery(form).find('input, button, .button').click(function () {
            jQuery('.g-recaptcha-response').css({
                display: 'block',
                visibility: 'hidden',
                height: '0px',
                width: '0px',
                position: 'absolute'
            });
        });
    },

    /**
     * Append the captcha object to the form
     *
     * @param {object} form
     * @param {object} captcha
     */
    appendCaptchaToForm: function (form, captcha) {
        // define element
        var el = null;

        // find place to insert
        if ((el = form.find('ul.form-list')) && el.length) {
            el.last().append(jQuery('<li>').append(captcha));
        }
        else if ((el = form.find('.button')) && el.length) {
            el.first().before(captcha);
        }
        else {
            form.append(captcha);
        }
    },

    /**
     * Reset the captcha
     */
    reset: function () {
        if (typeof(grecaptcha) == 'undefined') {
            return false;
        }
        return grecaptcha.reset();
    }
};
