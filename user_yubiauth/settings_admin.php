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

OCP\User::checkLoggedIn();
OCP\User::checkAdminUser();

OCP\Util::addScript('user_yubiauth', 'settings_admin');

// Fill settings template
$tmpl = new OCP\Template('user_yubiauth', 'settings_admin');
$tmpl->assign('yubiauth_admin_enabled', OCP\Config::getAppValue('user_yubiauth', 'yubiauth_admin_enabled', 'false'));
if (OCP\Config::getAppValue('user_yubiauth', 'yubiauth_admin_enabled', 'false') !== "true") {
	$tmpl->assign('yubiauth_server_settings', 'style=display:none');
}
else {
	$tmpl->assign('yubiauth_server_settings', '');
}
$tmpl->assign('yubiauth_urls', OCP\Config::getAppValue('user_yubiauth', 'yubiauth_urls', ''));
$tmpl->assign('yubiauth_https', OCP\Config::getAppValue('user_yubiauth', 'yubiauth_https', 'true'));
$tmpl->assign('yubiauth_check_crt', OCP\Config::getAppValue('user_yubiauth', 'yubiauth_check_crt', 'true'));
$tmpl->assign('yubiauth_client_id', OCP\Config::getAppValue('user_yubiauth', 'yubiauth_client_id', ''));
$tmpl->assign('yubiauth_client_hmac', OCP\Config::getAppValue('user_yubiauth', 'yubiauth_client_hmac', ''));

return $tmpl->fetchPage();
