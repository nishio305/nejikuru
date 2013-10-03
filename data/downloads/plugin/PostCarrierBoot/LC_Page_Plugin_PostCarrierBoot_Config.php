<?php
/*
 * This file is part of PostCarrier for EC-CUBE
 *
 * Copyright(c) 2010-2012 IPLOGIC CO.,LTD. All Rights Reserved.
 *
 * http://www.iplogic.co.jp/
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
 */

require_once(CLASS_EX_REALDIR . "page_extends/admin/LC_Page_Admin_Ex.php");

define('POSTINSTSTORE_MODULE_PATH',			PLUGIN_UPLOAD_REALDIR.'PostCarrierBoot/');
define('POSTINSTSTORE_TEMPLATES_PATH',		POSTINSTSTORE_MODULE_PATH.'templates/');
define('POSTINSTSTORE_POSTINSTALL_PATH',	POSTINSTSTORE_MODULE_PATH.'postinstall/');

/**
 * postinstallを設置するEC-CUBEストアモジュール
 *
 * $Id: LC_Page_Plugin_PostCarrierBoot_Config.php 4194 2012-05-23 09:48:18Z takashi $
 */
class LC_Page_Plugin_PostCarrierBoot_Config extends LC_Page_Admin_Ex {
    function init() {
        parent::init();
        $this->tpl_mainpage = POSTINSTSTORE_TEMPLATES_PATH . 'config.tpl';
        $this->tpl_subtitle = "PostCarrier for EC-CUBE";
    }

    function process() {
        $this->action();
        $this->sendResponse();
    }

    function action() {
        $mode = isset($_POST['mode']) ? $_POST['mode'] : '';
        switch($mode) {
        case 'setup':
            $this->mess = $this->setupMode();
            if ($this->mess === '') {
                $this->mode = 'complete';
            } else {
                $this->mode = 'setup';
            }
            break;
        default:
            $this->mode = 'setup';
            break;
        }
        $this->setTemplate($this->tpl_mainpage);
    }

    function destroy() {
        parent::destroy();
    }

    function setupMode() {
        $dstPath = USER_REALDIR.'postinstall';

        if (file_exists($dstPath)) {
            $mode = $this->getFileMode($dstPath);
            if (!is_writable($dstPath)) {
                return "$dstPath($mode)に書き込み権限(777,775等)を付与して下さい";
            }
        } else if (!is_writable(USER_REALDIR)) {
            $mode = $this->getFileMode(USER_REALDIR);
            return USER_REALDIR."($mode)に書き込み権限(777,775等)を付与して下さい";
        }

        return $this->recurse_copy(POSTINSTSTORE_POSTINSTALL_PATH, $dstPath);
    }

    function recurse_copy($src,$dst) {
        if (($dir = opendir($src)) === false) {
            return "フォルダ${src}のオープンに失敗しました。";
        }
        if (!file_exists($dst) && !mkdir($dst)) {
            return "フォルダ${dst}の作成に失敗しました。";
        }
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    $mess = $this->recurse_copy($src . '/' . $file,$dst . '/' . $file);
                    if ($mess !== '') {
                        return $mess;
                    }
                }
                else {
                    $srcFile = $src . '/' . $file;
                    $dstFile = $dst . '/' . $file;
                    if (!copy($srcFile, $dstFile)) {
                        return "${srcFile}から${dstFile}のファイルコピーに失敗しました。";
                    }
                }
            }
        }
        closedir($dir);

        return '';
    } 

    function getFileMode($path) {
        $mode = substr(sprintf('%o', fileperms($path)), -3);
        return $mode;
    }
}

?>
