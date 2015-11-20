# sippsolutions reCAPTCHA
reCAPTCHA Module designed for Magento CE 1.9.x and EE 1.14.x

## Usage
1. Copy the module into your Magento instance.
2. Retrieve your public and private key at https://www.google.com/recaptcha/admin
3. Add the keys to your magento configuration (under System > Configuration > sippsolutions > reCAPTCHA)
4. It's done!

## Configuration
There are a few configuration options:
- Enable or disable the module
- Show the captcha for all visitors or only for guests
- You can switch between theme "light" and "dark"
- You can switch between size "normal" and "compact"

Currently the captcha gets integrated into:
- Login form
- Account register form
- Contact form
- Product review form
- You have the possibility to add your own routes

## Events
`sippsolutions_recaptcha_solved` gets thrown when the captcha was successfully solved.
`sippsolutions_recaptcha_redirect_before` gets thrown when the captcha was unfilled/outdated/incorrectly filled.

## API
You can use `sippsolutions.reCAPTCHA.reset()` to reset the captcha.

## Dependencies
- jQuery must be integrated into Magento (CE 1.9+, EE 1.14+)

Tested with CE 1.9.2.2 and EE 1.14.2.1.

## Pricing
The module is free for private and commercial use (see LICENSE.txt).

Donations are greatly appreciated: https://www.paypal.me/sippert

## Example for ajax actions
When you use reCAPTCHA for ajax-based actions, you probable want to avoid the redirect.

Simple define a new event in your `config.xml`, node config > global > events:

```
<sippsolutions_recaptcha_redirect_before>
    <observers>
        <your_module_captcha_ajax>
            <class>your_module/observer</class>
            <method>ajaxCaptchaFailed</method>
        </your_module_captcha_ajax>
    </observers>
</sippsolutions_recaptcha_redirect_before>
```

and use this as observer method in your `Models/Observer.php`

```

/**
 * Captcha failed to verify
 *
 * @param Varien_Event_Observer $observer
 */
public function ajaxCaptchaFailed(Varien_Event_Observer $observer)
{
    // get event
    $event = $observer->getEvent();

    // get config
    $config = $event->getConfig();

    // check on ajax
    if (stripos($config->route, 'ajax') !== false) {
        // set message
        $config->shouldRedirect = false;

        /** @var $controller Mage_Core_Controller_Front_Action */
        $controller = $event->getController();
        $controller->getResponse()->setBody(json_encode(array(
            'success' => false,
            'message' => $config->message,
        )));
    }
}
```
