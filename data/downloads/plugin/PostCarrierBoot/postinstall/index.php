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

$html_relative_path = '';
foreach (array('../', '../../', '../../../') as $ancestor) {
    $require_php_path = $ancestor.'require.php';
    if (file_exists($require_php_path)) {
        require_once($require_php_path);
        $html_relative_path = substr($ancestor, 3); // '../'を一つ削除
        break;
    }
}
if ($html_relative_path === '') {
    echo "require.phpを読み込めませんでした。";
    exit(0);
}
$INSTALL_DIR = realpath(dirname( __FILE__));

//define("INSTALL_INFO_URL", "http://www.postcarrier.jp/install_info/index.php");
define("INSTALL_INFO_URL", "");

ini_set("max_execution_time", 300);

// 初期化
if (file_exists('./LC_MDL_ECQUBELEY_PreSetup.php')) {
    require_once './LC_MDL_ECQUBELEY_PreSetup.php';
} else if (file_exists(MODULE_REALDIR.'mdl_ecqubeley/class/LC_MDL_ECQUBELEY_PreSetup.php')) {
    require_once MODULE_REALDIR.'mdl_ecqubeley/class/LC_MDL_ECQUBELEY_PreSetup.php'; // 開発用
} else {
    SC_Utils_Ex::sfErrorHeader($INSTALL_DIR.'LC_MDL_ECQUBELEY_PreSetup.phpの読み込みに失敗しました。', true);
}

// モジュール展開後にロードされる
if (file_exists(MODULE_REALDIR.'mdl_ecqubeley/class/LC_MDL_ECQUBELEY_Setup.php')) {
    require_once MODULE_REALDIR.'mdl_ecqubeley/class/LC_MDL_ECQUBELEY_Setup.php';
}

$objPage = new StdClass;

// テンプレートコンパイルディレクトリの書込み権限チェック
$temp_dir = $INSTALL_DIR . '/temp';

if(!is_writable($temp_dir)) {
    SC_Utils_Ex::sfErrorHeader($temp_dir . "にユーザ書込み権限(777, 775等)を付与して下さい。", true);
    exit;
}

$objView = new SC_InstallView($INSTALL_DIR . '/templates', $INSTALL_DIR . '/temp');

// パラメータ管理クラス
$objFormParam = new SC_FormParam();
// パラメータ情報の初期化
$objFormParam = lfInitFormParam($objFormParam);

//フォーム配列の取得
$objFormParam->setParam($_POST);

switch($_POST['mode']) {
// ID、パスワードの入力
case 'welcome':
    $objPage = lfDispIdpass($objPage);
    break;
// モジュールのダウンロード
case 'idpass':
    //入力値のエラーチェック
    $objPage->arrErr = lfCheckError($objFormParam);
    if (count($objPage->arrErr) != 0) {
        $objPage = lfDispIdpass($objPage);
    } else {
        // 設定ファイルを生成
        $objPreSetup = new LC_MDL_ECQUBELEY_PreSetup;
        $objPreSetup->saveSetupSettings($objFormParam->getValue('server_url'),
                                        $objFormParam->getValue('shop_id'),
                                        $objFormParam->getValue('shop_pass'));

        $mess = lfDownloadModule();
        //$mess = true;
        $objPage = lfDispDownload($objPage);
        if ($mess !== true) {
            $objPage->mess = $mess;
            $objPage->err_flag = true;
        }
    }
    break;
// モジュールの展開 (展開成功後はモジュールのルーチンを利用可能)
case 'download':
    $mess = lfExtractModule();
    $objPage = lfDispExtract($objPage);
    if ($mess === true) {
        $objPage->mess = '>> ○：展開に成功しました。';
    } else {
        $objPage->mess = $mess;
        $objPage->err_flag = true;
    }
    break;
// アクセス権限のチェック
case 'extract':
    $objPage = lfDispCheck($objPage);
    break;
// ファイルのコピー
case 'return_copy':
case 'check':
    $objPage = lfDispCopy($objPage);

    $backup_mess = lfMakeBackup();
    if ($backup_mess != true) {
        $objPage->err_flag = true;
        $objPage->copy_mess = $backup_mess;
    } else {
        $copy_mess = lfUpdateFiles($isError);
        $objPage->copy_mess = $copy_mess;
        if ($isError) {
            $objPage->err_flag = true;
        }
    }
    break;
// 完了画面
case 'copy':
    $objPage = lfDispDll($objPage);
	 break;
// 完了画面
case 'ddl':
case 'complete':
    $objPage = lfDispComplete($objPage);
    break;
// 手動インストール完了画面
case 'manual_install':
    $objPage = lfDispManualInstall($objPage);
    break;
case 'return_check':
    $objPage = lfDispCheck($objPage);
    break;
case 'return_idpass':
    $objPage = lfDispIdpass($objPage);
    break;
case 'return_download':
    $objPage = lfDispDownload($objPage);
    break;
case 'return_extract':
    $objPage = lfDispExtract($objPage);
    break;
case 'return_welcome':
default:
    $objPage = lfDispWelcome($objPage);
    break;
}
//フォーム用のパラメータを返す
$objPage->arrForm = $objFormParam->getFormParamList();

//静的リソースへの相対位置を補正する
$objPage->html_relative_path = $html_relative_path;

// SiteInfoを読み込まない
$objView->assignobj($objPage);
$objView->display('install_frame.tpl');
//-----------------------------------------------------------------------------------------------------------------------------------
// ようこそ画面の表示
function lfDispWelcome($objPage) {
    global $objFormParam;

    $objPage->arrHidden = $objFormParam->getHashArray();
    $objPage->tpl_mainpage = 'welcome.tpl';
    $objPage->tpl_mode = 'welcome';

    return $objPage;
}

// ID、パスワードの入力
function lfDispIdpass($objPage) {
    global $objFormParam;

    $objPage->arrHidden = $objFormParam->getHashArray();
    $objPage->tpl_mainpage = 'idpass.tpl';
    $objPage->tpl_mode = 'idpass';

    return $objPage;
}

// モジュールのダウンロード
function lfDispDownload($objPage) {
    global $objFormParam;

    $objPage->arrHidden = $objFormParam->getHashArray();
    $objPage->tpl_mainpage = 'download.tpl';
    $objPage->tpl_mode = 'download';

    $objPage->mess = '>> ○：ダウンロードに成功しました。';

    return $objPage;
}

// モジュールの展開
function lfDispExtract($objPage) {
    global $objFormParam;

    $objPage->arrHidden = $objFormParam->getHashArray();
    $objPage->tpl_mainpage = 'extract.tpl';
    $objPage->tpl_mode = 'extract';

    // extractの実行
    $objPage->mess = '展開に成功しました。';

    return $objPage;
}

// CHECK画面の表示(ファイル権限チェック)
function lfDispCheck($objPage) {
    global $objFormParam;

    $objPage->arrHidden = $objFormParam->getHashArray();
    $objPage->tpl_mainpage = 'check.tpl';
    $objPage->tpl_mode = 'check';

    $objSetup = new LC_MDL_ECQUBELEY_Setup;
    $mess = $objSetup->checkInstallPerm();
    if ($mess === true) {
        $objPage->mess = '>> ○：アクセス権限は正常です。';
    } else {
        $objPage->mess = $mess;
        $objPage->err_flag = true;
    }

    return $objPage;
}

// COPY画面の表示(ファイルのコピー)
function lfDispCopy($objPage) {
    global $objFormParam;

    $objPage->arrHidden = $objFormParam->getHashArray();
    $objPage->tpl_mainpage = 'copy.tpl';
    $objPage->tpl_mode = 'copy';

    return $objPage;
}

// 完了画面の表示
function lfDispComplete($objPage) {
    global $objFormParam;
    global $INSTALL_DIR;

    $objPage->arrHidden = $objFormParam->getHashArray();
    $objPage->tpl_mainpage = 'complete.tpl';
    $objPage->tpl_mode = 'complete';

    $secure_url = $objFormParam->getValue('secure_url');
    // 語尾に'/'をつける
    if (!ereg("/$", $secure_url)) {
        $secure_url = $secure_url . "/";
    }
    $objPage->tpl_sslurl = $secure_url;
    //POSTCARRIERオフィシャルサイトからのお知らせURL
    $objPage->install_info_url = INSTALL_INFO_URL;
    $objPage->installer_dir = $INSTALL_DIR;
    return $objPage;
}

// 完了画面の表示
function lfDispManualInstall($objPage) {
    global $objFormParam;
    global $INSTALL_DIR;

    $objPage->arrHidden = $objFormParam->getHashArray();
    $objPage->tpl_mainpage = 'manual_install.tpl';
    $objPage->tpl_mode = 'manual_install';

    $secure_url = $objFormParam->getValue('secure_url');
    // 語尾に'/'をつける
    if (!ereg("/$", $secure_url)) {
        $secure_url = $secure_url . "/";
    }
    $objPage->tpl_sslurl = $secure_url;
    //POSTCARRIERオフィシャルサイトからのお知らせURL
    $objPage->install_info_url = INSTALL_INFO_URL;
    $objPage->installer_dir = $INSTALL_DIR;
    return $objPage;
}

// WEBパラメータ情報の初期化
function lfInitFormParam($objFormParam) {
    $objFormParam->addParam('接続先サーバーURL', 'server_url', 256, '', array('EXIST_CHECK', 'URL_CHECK', 'MAX_LENGTH_CHECK'));
    $objFormParam->addParam('ショップID', 'shop_id', STEXT_LEN, '', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
    $objFormParam->addParam('ショップパスワード', 'shop_pass', STEXT_LEN, '', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));

    return $objFormParam;
}

// 入力内容のチェック
function lfCheckError($objFormParam) {
    $arrRet =  $objFormParam->getHashArray();
    $objErr = new SC_CheckError($arrRet);
    $objErr->arrErr = $objFormParam->checkError();

    return $objErr->arrErr;
}

// モジュールをダウンロードする
function lfDownloadModule() {
    global $objFormParam;

    $objPreSetup = new LC_MDL_ECQUBELEY_PreSetup;
    return $objPreSetup->downloadModule($objFormParam->getValue('server_url'),
                                        $objFormParam->getValue('shop_id'),
                                        $objFormParam->getValue('shop_pass')
                                        );
}

function lfExtractModule() {
    $objPreSetup = new LC_MDL_ECQUBELEY_PreSetup;
    return $objPreSetup->extractModule();
}

function lfMakeBackup() {
    $objSetup = new LC_MDL_ECQUBELEY_Setup;
    return $objSetup->makeBackup();
}

function lfUpdateFiles(&$isError) {
    $objSetup = new LC_MDL_ECQUBELEY_Setup;
    return $objSetup->installUpdates($isError);
}

// DDL画面の表示(テーブルデータの作成)
function lfDispDll($objPage) {
    global $objFormParam;

    $objPage->arrHidden = $objFormParam->getHashArray();
    $objPage->tpl_mainpage = 'ddl.tpl';
    $objPage->tpl_mode = 'ddl';

    $objSetup = new LC_MDL_ECQUBELEY_Setup;
    $mess = $objSetup->doDDL($isError);
    $objPage->mess = $mess;
    if ($isError) {
        $objPage->err_flag = true;
    }

    return $objPage;
}