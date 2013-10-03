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
<form name="form1" id="form1" method="post" action="<!--{$smarty.server.PHP_SELF|escape}-->">
<input type="hidden" name="mode" value="<!--{$tpl_mode}-->">
<input type="hidden" name="step" value="0">

<!--{foreach key=key item=item from=$arrHidden}-->
<input type="hidden" name="<!--{$key}-->" value="<!--{$item|escape}-->">
<!--{/foreach}-->

<div class="contents">
    <div class="message">
        <h2>モジュールのダウンロード</h2>
    </div>
    <div class="result-info01">
        <textarea name="disp_area" cols="50" rows="20" class="box470"><!--{$mess}--></textarea>
    </div>
    <!--{if !$err_flag}-->
    <div class="result-info02">
	モジュールの展開を開始します。
    </div>
    <!--{/if}-->
</div>
<div class="btn-area-top"></div>
    <div class="btn-area">
        <ul>
        <!--{if !$err_flag}-->
        <li><a class="btn-action" href="javascript:;" onclick="document.form1['mode'].value='return_idpass';document.form1.submit(); return false;" /><span class="btn-prev">前へ戻る</span></a></li>
        <li><a class="btn-action" href="javascript:;" onclick="document.form1.submit(); return false;"><span class="btn-next">次へ進む</span></a></li>
        <!--{else}-->
        <li><a class="btn-action" href="javascript:;" onclick="document.form1['mode'].value='return_idpass';document.form1.submit(); return false;" /><span class="btn-prev">前へ戻る</span></a></li>
        <!--{/if}-->
    </div>
    <div class="btn-area-bottom"></div>
</from>
