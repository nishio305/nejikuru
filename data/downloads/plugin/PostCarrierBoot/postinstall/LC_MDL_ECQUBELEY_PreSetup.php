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

// インストーラ(モジュール展開前)とモジュール本体共通の初期化コード
//
// 本ファイルは最初にロードされるモジュールファイルである。従って、
// 他のモジュール内コードに依存することはできない。
// 本ファイルをロードする前に、EC-CUBEの'require.php'がロード済であること。

// 基本定数の定義
define('POSTCARRIER_MODULE_NAME',		'mdl_ecqubeley');
define('POSTCARRIER_CONFIG_NAME',		'postcarrier.php');

define('POSTCARRIER_MODULE_DIR',		POSTCARRIER_MODULE_NAME.'/');
define('POSTCARRIER_MODULE_REALDIR',		MODULE_REALDIR.POSTCARRIER_MODULE_DIR);
define('POSTCARRIER_MODULE_VAR_DIR',	POSTCARRIER_MODULE_NAME.'_var/');
define('POSTCARRIER_MODULE_VAR_PATH',	MODULE_REALDIR.POSTCARRIER_MODULE_VAR_DIR);
define('POSTCARRIER_BACKUPS_PATH',		POSTCARRIER_MODULE_VAR_PATH.'backups/');

define("POSTCARRIER_DOWNLOADS_TMP_PATH",DATA_REALDIR."downloads/tmp/");
define("POSTCARRIER_MODULE_ECCUBE_PATH",str_replace("\\", "/", realpath(DATA_REALDIR."downloads/module/mdl_ecqubeley/updates/")));

define("POSTCARRIER_INSTALL_LOG_PATH",	DATA_REALDIR."logs/postcarrier_install.log");
define('POSTCARRIER_CONFIG_PATH',		POSTCARRIER_MODULE_VAR_PATH.POSTCARRIER_CONFIG_NAME);

define('POSTCARRIER_DOC_INSTALL_PATH',	POSTCARRIER_MODULE_REALDIR.'doc/install.pdf');
define('POSTCARRIER_DOC_OP_PATH',		POSTCARRIER_MODULE_REALDIR.'doc/operation.pdf');

require_once DATA_REALDIR.'module/HTTP/Request.php';
require_once DATA_REALDIR.'module/Archive/Tar.php';
require_once CLASS_REALDIR.'pages/upgrade/helper/LC_Upgrade_Helper_Log.php';
require_once CLASS_REALDIR.'pages/upgrade/helper/LC_Upgrade_Helper_Json.php';

function PostCarrierInstallLog($msg) {
    GC_Utils_Ex::gfPrintLog($msg, POSTCARRIER_INSTALL_LOG_PATH);
}

class LC_MDL_ECQUBELEY_PreSetup {
    function downloadModule($server_url, $shop_id, $shop_pass) {
        PostCarrierInstallLog("downloadModule: start");

        $params = array('shopName' => $shop_id, 'apikey' => $shop_pass, 'eccube_version' => ECCUBE_VERSION);

        // ダウンロード情報を取得

        $req = new HTTP_Request($server_url);
        $req->setMethod(HTTP_REQUEST_METHOD_GET); 
        foreach ($params as $key => $val) {
            $req->addQueryString($key, $val);
        }

        $res = $req->sendRequest();
        if (PEAR::isError($res)) {
            $mess = ">> ×：サーバーに接続できませんでした。\nURL:".$server_url."\nメッセージ:".$res->getMessage();
            PostCarrierInstallLog("downloadModule: failure mess=".$mess);
            return $mess;
        } 

        $resCode = $req->getResponseCode();
        $json = new LC_Upgrade_Helper_Json();
        $decoded = $json->decode($req->getResponseBody());
        if (floor($resCode/100) != 2) {
            $mess = ">> ×：ダウンロード情報の取得に失敗しました。\nURL:".$server_url."\nステータス:".$resCode."\nメッセージ:".$decoded->error;
            PostCarrierInstallLog("downloadModule: failure mess=".$mess);
            return $mess;
        } else {
            $download_url = $decoded->download_url;
            $download_hash = $decoded->download_hash;
            PostCarrierInstallLog("downloadModule: download_url='$download_url', download_hash='$download_hash'");
        }

        // モジュールをダウンロードする

        $req = new HTTP_Request($download_url);
        $req->setMethod(HTTP_REQUEST_METHOD_POST); 
        foreach ($params as $key => $val) {
            $req->addPostData($key, $val);
        }

        $res = $req->sendRequest();
        if (PEAR::isError($res)) {
            $mess = ">> ×：サーバーに接続できませんでした。\nURL:".$download_url."\nメッセージ:".$res->getMessage(); 
            PostCarrierInstallLog("downloadModule: failure mess=".$mess);
            return $mess;
        }

        $resCode = $req->getResponseCode();
        if (floor($resCode/100) != 2) {
            $json = new LC_Upgrade_Helper_Json();
            $decoded = $json->decode($req->getResponseBody());
            $mess = ">> ×：サーバーからエラーレスポンスを受信しました。\nURL:".$download_url."\nステータス:".$resCode."\nメッセージ:".$decoded->error;
            PostCarrierInstallLog("downloadModule: failure mess=".$mess);
            return $mess;
        }

        $download_path = POSTCARRIER_DOWNLOADS_TMP_PATH."mdl_ecqubeley.tar";
        if (!($fp = fopen($download_path, "w"))) {
            $mess = ">> ×：ダウンロードファイルのオープンに失敗しました。\nファイル:".$download_path; 
            PostCarrierInstallLog("downloadModule: failure mess=".$mess);
            return $mess;
        }
        if (fwrite($fp, $req->getResponseBody()) === false) {
            $mess = ">> ×：ダウンロードファイルの書き込みに失敗しました。\nファイル:".$download_path;
            PostCarrierInstallLog("downloadModule: failure mess=".$mess);
            return $mess;
        }
        fclose($fp);

        // ハッシュを検証する。

        $hash = sha1_file($download_path);
        if ($hash !== $download_hash) {
            $mess = ">> ×：ダウンロードファイルの検証に失敗しました。\nHASH:".$hash."\nEXPECT:".$download_hash;
            PostCarrierInstallLog("downloadModule: failure mess=".$mess);
            return $mess;
        }

        PostCarrierInstallLog("downloadModule: success");
        return true;
    }

    function extractModule() {
        PostCarrierInstallLog("extractModule: start");

        $download_path = POSTCARRIER_DOWNLOADS_TMP_PATH."mdl_ecqubeley.tar";
        $tar = new Archive_Tar($download_path);

        $ls = $tar->listContent();

        // archiveの内容をログ出力する。
        PostCarrierInstallLog("tar: ".count($ls));
        for ($i = 0; $i < count($ls); $i++) {
            PostCarrierInstallLog("tar$i: ".$ls[$i]['filename']);
        }

        $tar->extract(MODULE_REALDIR);

        if (!file_exists(POSTCARRIER_MODULE_REALDIR)) {
            $mess = "モジュールの展開に失敗しました。モジュール:".$download_path.", 場所:".POSTCARRIER_MODULE_REALDIR;
            PostCarrierInstallLog("extractModule: failure mess=".$mess);
            return $mess;
        }

        PostCarrierInstallLog("extractModule: success");
        return true;
    }

    function saveSetupSettings($server_url, $shop_id, $shop_pass) {
        $config = array(
            'server_url' => $server_url,
            'shop_id' => $shop_id,
            'shop_pass' => $shop_pass );

        return $this->saveSettings($config, 'CONFIG_REQUIRED');
    }

    function saveSettings($config, $mode = 'ON') {
        PostCarrierInstallLog("saveSettings: start");

        $config_php .= "<?php\n\tdefine ('POSTCARRIER_INSTALL', '$mode');\n\n";
        $config_php .= "\t\$postCarrierConfig = array(\n";
        foreach ($config as $key => $value) {
            $config_php .= "\t\t'${key}' => '" . str_replace("'", "\\'", $value) . "',\n";
        }
        $config_php .= "\t\t'EOL' => 'EOL'\n";
        $config_php .= "\t);\n?>\n";

        if (!is_dir(POSTCARRIER_MODULE_VAR_PATH) && (mkdir(POSTCARRIER_MODULE_VAR_PATH) === false)) {
            $mess = "フォルダ" . POSTCARRIER_MODULE_VAR_PATH . "の作成に失敗しました。";
            PostCarrierInstallLog("saveSettings: failure mess=".$mess);
            return $mess;
        }

        if (($fp = fopen(POSTCARRIER_CONFIG_PATH, "w")) === false) {
            $mess = "ファイル" . POSTCARRIER_CONFIG_PATH . "のオープンに失敗しました。";
            PostCarrierInstallLog("saveSettings: failure mess=".$mess);
            return $mess;
        }

        if (fwrite($fp, $config_php) === false) {
            $mess = "ファイル" . POSTCARRIER_CONFIG_PATH . "の書き込みに失敗しました。";
            PostCarrierInstallLog("saveSettings: failure mess=".$mess);
            return $mess;
        }

        fclose($fp);

        PostCarrierInstallLog("saveSettings: success");
        return true;
    }

    function loadSettings() {
        if (!file_exists(POSTCARRIER_CONFIG_PATH)) {
            return array();
        }

        require POSTCARRIER_CONFIG_PATH;
        return $postCarrierConfig;
    }
}

?>
