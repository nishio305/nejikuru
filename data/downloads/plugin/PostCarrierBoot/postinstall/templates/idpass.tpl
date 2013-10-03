<!--{*
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
 *}-->
<style type="text/css">
  .fullwidth { width: 100%; }
  .box30 { width: 222px; }
</style>
<form name="form1" id="form1" method="post" action="<!--{$smarty.server.PHP_SELF|h}-->">
<input type="hidden" name="mode" value="<!--{$tpl_mode}-->">
<input type="hidden" name="step" value="0">

<!--{foreach key=key item=item from=$arrHidden}-->
<input type="hidden" name="<!--{$key}-->" value="<!--{$item|h}-->">
<!--{/foreach}-->

<div class="contents">
  <div class="message">
    <h2>ご契約情報の入力</h2>
  </div>
  <div class="block">
    <table>
      <colgroup width="25%">
      <colgroup width="75%">
	<tr>
	  <th>接続先サーバーURL</th>
	  <td>
	    <!--{assign var=key value=server_url}-->
	    <span class="red"><!--{$arrErr[$key]}--></span>
	    <input type="text"
		   name="<!--{$key}-->"
		   class="fullwidth"
		   value="<!--{$arrForm[$key].value|h}-->"
		   maxlength="<!--{$arrForm[$key].length|h}-->">
	  </td>
	</tr>
	<tr>
	  <th>ショップID</th>
	  <td>
	    <!--{assign var=key value=shop_id}-->
	    <span class="red"><!--{$arrErr[$key]}--></span>
	    <input type="text"
		   name="<!--{$key}-->"
		   class="box30"
		   value="<!--{$arrForm[$key].value|h}-->"
		   maxlength="<!--{$arrForm[$key].length|h}-->">
	  </td>
	</tr>
	<tr>
	  <th>ショップパスワード</th>
	  <td>
	    <!--{assign var=key value=shop_pass}-->
	    <span class="red"><!--{$arrErr[$key]}--></span>
	    <input type="password"
		   name="<!--{$key}-->"
		   class="box30"
		   value="<!--{$arrForm[$key].value|h}-->"
		   maxlength="<!--{$arrForm[$key].length|h}-->">
	  </td>
	</tr>
    </table>
  </div>

  <div class="message">
    <h3>モジュールのダウンロードを開始します。</h3>
  </div>
</div>
<div class="btn-area-top"></div>
<div class="btn-area">
  <ul>
    <li><a class="btn-action" href="javascript:;" onclick="document.form1['mode'].value='return_welcome';document.form1.submit(); return false;" /><span class="btn-prev">前へ戻る</span></a></li>
    <li><a class="btn-action" href="javascript:;" onclick="document.form1.submit(); return false;"><span class="btn-next">次へ進む</span></a></li>
  </ul>
</div>
<div class="btn-area-bottom"></div>

</from>
