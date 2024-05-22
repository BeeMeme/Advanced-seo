<?php
/**
 * Advanced SEO. An extension for the phpBB Forum Software package.
 * 
 * @copyright (c) 2024, P.J.Borgohain
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace bestpickrs\advseo\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use phpbb\event\data;
use phpbb\language\language;
use phpbb\controller\helper;
use phpbb\template\template;

class main_listener implements EventSubscriberInterface
{
    protected $language;
    protected $helper;
    protected $template;
    protected $php_ext;

    public function __construct(language $language, helper $helper, template $template, $php_ext)
    {
        $this->language = $language;
        $this->helper = $helper;
        $this->template = $template;
        $this->php_ext = $php_ext;
    }

    public static function getSubscribedEvents()
    {
        return [
            'core.user_setup'                           => 'load_language_on_setup',
            'core.page_header'                          => 'add_page_header_link',
            'core.viewonline_overwrite_location'        => 'viewonline_page',
            'core.display_forums_modify_template_vars'  => 'display_forums_modify_template_vars',
            'core.permissions'                          => 'add_permissions',
        ];
    }

    public function load_language_on_setup($event)
    {
        $lang_set_ext = $event['lang_set_ext'];
        $lang_set_ext[] = [
            'ext_name' => 'bestpickrs/advseo',
            'lang_set' => 'common',
        ];
        $event['lang_set_ext'] = $lang_set_ext;
    }

    public function add_page_header_link()
    {
        $this->template->assign_vars([
            'U_ADVSEO_PAGE' => $this->helper->route('bestpickrs_advseo_controller', ['name' => 'world']),
        ]);
    }

    public function viewonline_page($event)
    {
        if ($event['on_page'][1] === 'app' && strpos($event['row']['session_page'], 'app.' . $this->php_ext . '/demo') === 0)
        {
            $event['location'] = $this->language->lang('VIEWING_BESTPICKRS_ADVSEO');
            $event['location_url'] = $this->helper->route('bestpickrs_advseo_controller', ['name' => 'world']);
        }
    }

    public function display_forums_modify_template_vars($event)
    {
        $forum_row = $event['forum_row'];
        $forum_row['FORUM_NAME'] .= ' ' . $this->language->lang('ADVSEO_EVENT');
        $event['forum_row'] = $forum_row;
    }

    public function add_permissions($event)
    {
        $permissions = $event['permissions'];

        $permissions['a_new_bestpickrs_advseo'] = [
            'lang' => 'ACL_A_NEW_BESTPICKRS_ADVSEO', 
            'cat' => 'misc'
        ];
        $permissions['m_new_bestpickrs_advseo'] = [
            'lang' => 'ACL_M_NEW_BESTPICKRS_ADVSEO', 
            'cat' => 'post_actions'
        ];
        $permissions['u_new_bestpickrs_advseo'] = [
            'lang' => 'ACL_U_NEW_BESTPICKRS_ADVSEO', 
            'cat' => 'post'
        ];

        $event['permissions'] = $permissions;
    }
}
