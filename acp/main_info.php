<?php
/**
 *
 * Advanced Seo. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2024, P.J.Borgohain, https://bestpickrs.com/memberlist.php?mode=viewprofile&amp;u=2
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace bestpickrs\advseo\acp;

/**
 * Advanced Seo ACP module info.
 */
class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\bestpickrs\advseo\acp\main_module',
			'title'		=> 'ACP_ADVSEO_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'ACP_ADVSEO',
					'auth'	=> 'ext_bestpickrs/advseo && acl_a_new_bestpickrs_advseo',
					'cat'	=> ['ACP_ADVSEO_TITLE'],
				],
			],
		];
	}
}
