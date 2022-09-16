# Restrict Access module
author: andreaortogni@gmail.com

This module provides a redirect to login page for all customers who hasn't logged yet.


## Compatibility:
This module is fully tested with Magento 2.4.* versions

## Installation:
Copy the entire Ortodev folder to your Magento `app/code` folder, then run these command from your Magento root:

```
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:flush
```

## Admin panel:
The configuration of this module are in Magento admin under `Stores Settings > Configuration > Ortodev > Restrict Access`.
There are two configurations:
- Module Enable (yes/no): to enable or disable the module;
- Allowed Routes (textarea): to enter full action name of the routes where you don't want a redirect to login page. (ex: customer_account_create);
                             Those routes must be separeted by a comma.
                             Example: 
                             ```
                             customer_account_login, customer_account_loginpost, customer_account_logoutsuccess, customer_account_confirm, customer_account_confirmation, customer_account_forgotpassword, customer_account_forgotpasswordpost, customer_account_createpassword, customer_account_resetpasswordpost, customer_section_load
                             ```