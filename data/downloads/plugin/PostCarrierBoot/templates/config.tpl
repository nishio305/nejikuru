<!--{*
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
*}-->
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->
<style type="text/css">
  .info { padding: 0 4px; }
</style>
<script type="text/javascript">//<![CDATA[
self.moveTo(20,20);
//self.resizeTo(620, 650);
self.resizeTo(800, 800);
self.focus();
//]]>
</script>
<h2><!--{$tpl_subtitle}--></h2>
<form name="form1" action="<!--{$smarty.server.REQUEST_URI|escape}-->" method="post">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid|escape}-->" />
<input type="hidden" name="mode" value="<!--{$mode}-->">
<p class="remark">
メール配信モジュール「PostCarrier for EC-CUBE」をご利用頂きありがとうございます。<br/>
ご利用にあたり、お申し込みが必要となります。<br/>
ご不明点等ございましたら、御遠慮なくお問い合わせ下さい。
</p>
<p class="center"><a href="mailto:info@iplogic.co.jp">お問い合わせ</a><br/><br/></p>

<h2><!--{if $mode eq 'setup'}-->▼インストーラの設置<!--{else}-->▼インストーラの設置完了<!--{/if}--></h2>
<div>
<!--{if $mode eq 'setup'}-->
<!--{if $mess ne ''}-->
<p class="attention">
エラーが発生しました。解決してから再度実行して下さい。<br/>
<!--{$mess}--><br/><br/>
</p>
<!--{/if}-->
PostCarrier for EC-CUBEのインストーラを設置します。<br/><br/>
インストーラは、サーバー上の「<!--{$smarty.const.USER_REALDIR}-->postinstall/」に設置されます。<br/>
よろしければ、下の「インストーラを設置する」ボタンを押下して下さい。<br/><br/>
<!--{else}-->
インストーラを「<!--{$smarty.const.USER_REALDIR}-->postinstall/」に設置しました。<br/>
下の「インストーラを起動する」ボタンを押下し、インストールを続行して下さい。<br/>
<br/>
<!--{/if}-->
</div>

<div class="btn-area">
  <ul>
    <!--{if $mode eq 'setup'}-->
    <li><a class="btn-action" href="javascript:;" onclick="document.form1.submit(); return false;"><span class="btn-next">インストーラを設置する</span></a></li>
    <!--{else}-->
    <li><a class="btn-action" href="<!--{$smarty.const.HTTP_URL}--><!--{$smarty.const.USER_DIR}-->postinstall/"><span class="btn-next">インストーラを起動する</span></a></li>
    <!--{/if}-->
  </ul>
</div>

</form>
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->
