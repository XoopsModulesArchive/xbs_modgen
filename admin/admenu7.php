<?php declare(strict_types=1);

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Module generation page
 *
 * @copyright     Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       XBS_MODGEN
 * @subpackage    Admin
 * @version       1
 * @access        private
 */

use XoopsModules\Xbsmodgen\{Utility
};

/**
 * @global array Form Post variables
 */
require_once __DIR__ . '/admin_header.php';
//require_once __DIR__ . '/adminheader.php';
global $_POST;
/**
 * @global array User Session variables
 */
global $_SESSION;
/**
 * Do all the declarations etc needed by an admin page
 */
//require_once __DIR__ . '/adminheader.php';

//check to see if we have a selected module to work with
if (!isset($_SESSION['xbsmodgen_mod'])) {
    //redirect to module choosing page

    redirect_header(XBS_MODGEN_URL . '/admin/admenu1.php', 1, _AM_XBSMODGEN_ADMINMSG3);
}
//Display the admin menu
//xoops_module_admin_menu(7,_AM_XBSMODGEN_ADMENU7);

//get POST data and clean it up
$clean = Utility::cleanInput($_POST);

if (isset($clean['submit'])) {
    //store the requesting page URL

    $requrl = $_REQUEST['original_url'] ?? null;

    //user has clicked GO so generate module scripts

    Utility::adminGenerateModule($_SESSION['xbsmodgen_mod'], $requrl);
} else {
    //display module review screen

    Utility::adminReviewModule($_SESSION['xbsmodgen_mod']);
}//end if

//And put footer in
xoops_cp_footer();
