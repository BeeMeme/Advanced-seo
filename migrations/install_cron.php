<?php
/**
 *
 * Advanced Seo. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2024, P.J.Borgohain, https://bestpickrs.com/memberlist.php?mode=viewprofile&amp;u=2
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace bestpickrs\advseo\migrations;

class install_cron extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['advseo_cron_last_run']);
	}

	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v320\v320'];
	}

	public function update_data()
	{
		return [
			['config.add', ['advseo_cron_last_run', 0, true]],
		];
	}
}
