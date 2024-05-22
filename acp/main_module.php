<?php
/**
 * Advanced SEO. An extension for the phpBB Forum Software package.
 * 
 * @copyright (c) 2024
 * @license GNU General Public License, version 2 (GPL-2.0)
 */

namespace bestpickrs\advseo\acp;

use bestpickrs\advseo\controller\acp_controller;

/**
 * Advanced SEO ACP module.
 */
class main_module
{
    public $page_title;
    public $tpl_name;
    public $u_action;

    /**
     * Main ACP module
     *
     * @param int $id The module ID
     * @param string $mode The module mode (e.g., manage or settings)
     * @throws \Exception
     */
    public function main($id, $mode)
    {
        global $phpbb_container;

        /** @var acp_controller $acp_controller */
        $acp_controller = $phpbb_container->get('bestpickrs.advseo.controller.acp');

        // Set the template for the ACP page
        $this->tpl_name = 'acp_advseo_body';

        // Set the page title for the ACP page
        $this->page_title = 'ACP_ADVSEO_TITLE';

        // Provide the action URL to the ACP controller
        $acp_controller->set_page_url($this->u_action);

        // Display the options in the ACP controller
        $acp_controller->display_options();
    }
}
