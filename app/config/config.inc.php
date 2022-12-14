<?php # config.inc.php
/* This script:
 * - define constants and settings
 * - dictates how errors are handled
 * - defines useful functions
 */


// ********************************** //
// ************ SETTINGS ************ //

// Flag variable for site status:
define('LIVE', FALSE);

// Admin contact address:
// define('EMAIL', 'InsertRealAddressHere');

// Site URL (base for all redirections):
define('BASE_URL', 'http://172.16.86.135/');

// Location of the MySQL connection script:
define('MYSQL', $_SERVER['DOCUMENT_ROOT'] . '/../config/db.class.php');

// Location of the temlates folder:
define('TEMPLATES', $_SERVER['DOCUMENT_ROOT'] . '/../templates/');

// Adjust the time zone for PHP 5.1 and greater:
date_default_timezone_set('America/Chicago');

// ************ SETTINGS ************ //
// ********************************** //

// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

// Create the error handler:
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars = null) {

	// Build the error message:
	$message = "An error occurred in script '$e_file' on line $e_line: $e_message\n";

	// Add the date and time:
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";
	if (!LIVE) { // Development (print the error).
		// Show the error message:
		echo '<div class="text-danger">' . nl2br($message);

		// Add the variables and a backtrace:
		echo '<pre>' . print_r ($e_vars, 1) . "\n";
		debug_print_backtrace();
		echo '</pre></div>';

	} else {

		// Show nice error
		$body = "We're sorry, but the site encountered an error. Please notify the site administrator.\n";
		$body .= $message . "\n" . print_r ($e_vars, 1);
		echo $body;

		// Only print an error message if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="text-danger">A system error occurred. We apologize for the inconvenience.</div><br>';
		}
	} // End of !LIVE IF.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler('my_error_handler');

// ************ ERROR MANAGEMENT ************ //
// ****************************************** //
