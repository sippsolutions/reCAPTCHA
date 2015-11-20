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

## Limitations
The module is free for private and commercial use (see LICENSE.txt).
Donations are greatly appreciated: https://www.paypal.me/sippert
