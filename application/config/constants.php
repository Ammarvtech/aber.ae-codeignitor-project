<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



define("API_KEY","USD");
define("OUTLET_REFERENCE","USD");

define("CREATE_ORDER_URL","https://api-gateway[-uat].ngeniuspayments.com/transactions/outlets/".OUTLET_REFERENCE."/orders");
//define("CREATE_PAYMENT_URL","https://api-gateway[-uat].ngeniuspayments.com/transactions/outlets/".OUTLET_REFERENCE."/orders");

define("MERCHANT_ID","WG35PYMF8YMC1"); // 
define("CURRENCY","USD");
define("API_URL","https://api.clover.com/v3/merchants/");
define("API_BASE_URL","https://api.clover.com/v3/merchants/WG35PYMF8YMC1/"); //WG35PYMF8YMC1 //5X6DTJ914NQH1
define("ACCESS","28bf7b73-b7cb-503a-cbae-b040af30d049");
define("ACCESS_TOKEN","access_token=28bf7b73-b7cb-503a-cbae-b040af30d049"); //28bf7b73-b7cb-503a-cbae-b040af30d049 //6e2b937e-608c-7d85-8cb7-2774e64370c0

define("ALL_EMPLOYEES_URL",API_BASE_URL."employees?".ACCESS_TOKEN);
define("EDIT_EMPLOYEES_URL",API_BASE_URL."employees/empId?".ACCESS_TOKEN);

define("ALL_ROLES_URL",API_BASE_URL."roles?".ACCESS_TOKEN);

define("ADD_CUSTOMERS_URL",API_BASE_URL."customers?expand=emailAddresses&".ACCESS_TOKEN);
define("EDIT_CUSTOMERS_URL",API_BASE_URL."customers/customerId?expand=metadata,emailAddresses,phoneNumbers&".ACCESS_TOKEN);
define("REGISTER_CUSTOMERS_URL",API_BASE_URL."customers?expand=metadata,emailAddresses,phoneNumbers&".ACCESS_TOKEN);
define("GET_CUSTOMERS_URL",API_BASE_URL."customers?expand=metadata,emailAddresses,phoneNumbers&".ACCESS_TOKEN);

define("ALL_MERCHANTS_URL",API_BASE_URL."?".ACCESS_TOKEN);

define("ADD_CATEGORIES_URL",API_BASE_URL."categories?".ACCESS_TOKEN);
define("EDIT_CATEGORIES_URL",API_BASE_URL."categories/catId?".ACCESS_TOKEN);
define("GET_CATEGORIES_URL",API_BASE_URL."categories/catId?expand=items&".ACCESS_TOKEN);
define("GET_ALL_CATEGORIES_URL",API_BASE_URL."categories?expand=items&".ACCESS_TOKEN);

define("GET_INVENTORY_URL",API_BASE_URL."items?expand=tags,taxRates,modifierGroups,itemStock,options,categories&".ACCESS_TOKEN);
define("ADD_INVENTORY_URL",API_BASE_URL."items?expand=categories&".ACCESS_TOKEN);
define("EDIT_INVENTORY_URL",API_BASE_URL."items/itemId?expand=tags,taxRates,modifierGroups,itemStock,options,categories&".ACCESS_TOKEN);
define("DELETE_INVENTORY_URL",API_BASE_URL."items/itemId?".ACCESS_TOKEN);

define("GET_TAGS_URL",API_BASE_URL."tags?".ACCESS_TOKEN);
define("EDIT_TAGS_URL",API_BASE_URL."tags/tagId?".ACCESS_TOKEN);

define("GET_RATES_URL",API_BASE_URL."tax_rates?".ACCESS_TOKEN);
define("EDIT_RATES_URL",API_BASE_URL."tax_rates/taxId?".ACCESS_TOKEN);

define("GET_MG_URL",API_BASE_URL."modifier_groups?".ACCESS_TOKEN);
define("EDIT_MG_URL",API_BASE_URL."modifier_groups/modGroupId?".ACCESS_TOKEN);

define("GET_MODIFIER_URL",API_BASE_URL."modifiers?".ACCESS_TOKEN);
define("EDIT_MODIFIER_URL",API_BASE_URL."modifier_groups/modGroupId/modifiers/modId?".ACCESS_TOKEN);

define("ADD_ORDERTYPE_URL",API_BASE_URL."order_types?".ACCESS_TOKEN);
define("EDIT_ORDERTYPE_URL",API_BASE_URL."order_types/orderTypeId?".ACCESS_TOKEN);
define("GET_ORDERTYPE_URL",API_BASE_URL."order_types/orderTypeId?".ACCESS_TOKEN);
define("GET_ALL_ORDERTYPE_URL",API_BASE_URL."order_types?".ACCESS_TOKEN);

define("ADD_ORDER_URL",API_BASE_URL."orders?expand=lineItems,customers,payments,credits,refunds,serviceCharge,discounts&".ACCESS_TOKEN);
define("GET_ORDER_URL",API_BASE_URL."orders?".ACCESS_TOKEN);
define("EDIT_ORDER_URL",API_BASE_URL."orders/orderId?expand=lineItems,customers,payments,credits,refunds,serviceCharge,discounts&".ACCESS_TOKEN);
define("CREATE_LINE_ITEMS",API_BASE_URL."orders/orderId/bulk_line_items?".ACCESS_TOKEN);

define("CREATE_PAYMENT",API_BASE_URL."orders/orderId/payments?".ACCESS_TOKEN);
define("GET_TENDERS",API_BASE_URL."tenders?".ACCESS_TOKEN);

define("API_V2_URL", "https://sandbox.dev.clover.com/v2/merchant/5X6DTJ914NQH1/pay/key");

define('STRIPE_TOKEN_URI', 'https://connect.stripe.com/oauth/token');
define('STRIPE_AUTHORIZE_URI', 'https://connect.stripe.com/oauth/authorize');
define('STRIPE_SECRET_KEY',"sk_test_xdwNBK1gw83T9P3tyPYpS16y00db5da9Jt");//"37tP6XmxuWPM7eTEDyA88uW2SO73pfuu", //"gn8Lj9EW1y0ncta5ul40Tr7hDvY5OsXQ",
define('STRIPE_PUBLISHABLE_KEY',"pk_test_kyFPzfPNBDilGCP7qahkoEyc00EtneDHpF");//"pk_ZlhI4yEbDZfAzCn1bdsXwColDSg0E" //"pk_F34Z9EEL7zPhz6gqqzUWutn0zGV6A"
//define('WEBSITE_URL',"http://siegedata.azurewebsites.net");
define('STRIPE_CURRENCY',"usd");