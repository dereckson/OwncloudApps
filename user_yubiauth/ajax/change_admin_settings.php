<?php

/**
* ownCloud - user_yubiauth
*
* @author Jarkko Lehtoranta
* @copyright 2013 Jarkko Lehtoranta devel@jlranta.com
*
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
* License as published by the Free Software Foundation; either
* version 3 of the License, or any later version.
*
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU AFFERO GENERAL PUBLIC LICENSE for more details.
*
* You should have received a copy of the GNU Affero General Public
* License along with this library.  If not, see <http://www.gnu.org/licenses/>.
*
*/

// CSRF check
OCP\JSON::checkLoggedIn();
OCP\JSON::checkAdminUser();
OCP\JSON::callCheck();

$params = array('yubiauth_admin_enabled',
			'yubiauth_urls',
			'yubiauth_https',
			'yubiauth_check_crt',
			'yubiauth_client_id',
			'yubiauth_client_hmac'
);

// Save settings
if ($_POST) {
	// Parse parameters
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			if ($param === "yubiauth_admin_enabled") {
				if (OCP\Config::getAppValue('user_yubiauth', $param, 'false') === "false") {
					OCP\Config::setAppValue('user_yubiauth', $param, 'true');
					break;
				}
				else {
					OCP\Config::setAppValue('user_yubiauth', $param, 'true');
				}
			}
			else {
				OCP\Config::setAppValue('user_yubiauth', $param, $_POST[$param]);
			}
		}
		elseif ($param === "yubiauth_admin_enabled") {
			OCP\Config::setAppValue('user_yubiauth', $param, 'false');
		}
		elseif ($param === "yubiauth_https") {
			OCP\Config::setAppValue('user_yubiauth', $param, 'false');
		}
		elseif ($param === "yubiauth_check_crt") {
			OCP\Config::setAppValue('user_yubiauth', $param, 'false');
		}
	}
}

// Return values
OCP\JSON::success(array("data" => array("yubiauth_admin_enabled" => OCP\Config::getAppValue('user_yubiauth', 'yubiauth_admin_enabled', 'false'),
	"yubiauth_urls" => OCP\Config::getAppValue('user_yubiauth', 'yubiauth_urls', ''),
	"yubiauth_https" => OCP\Config::getAppValue('user_yubiauth', 'yubiauth_https', 'true'),
	"yubiauth_check_crt" => OCP\Config::getAppValue('user_yubiauth', 'yubiauth_check_crt', 'true'),
	"yubiauth_client_id" => OCP\Config::getAppValue('user_yubiauth', 'yubiauth_client_id', ''),
	"yubiauth_client_hmac" => OCP\Config::getAppValue('user_yubiauth', 'yubiauth_client_hmac', ''),
)));
