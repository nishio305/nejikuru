<?php /* Smarty version 2.6.26, created on 2013-10-02 08:43:36
         compiled from /home/prograph2v1y/public_html/subdomain/nejikuru//data/Smarty/templates/default/mypage/change_complete.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/home/prograph2v1y/public_html/subdomain/nejikuru//data/Smarty/templates/default/mypage/change_complete.tpl', 26, false),array('modifier', 'h', '/home/prograph2v1y/public_html/subdomain/nejikuru//data/Smarty/templates/default/mypage/change_complete.tpl', 26, false),)), $this); ?>

<div id="mypagecolumn">
    <h2 class="title"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_title'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</h2>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['tpl_navi'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <div id="mycontents_area">
        <h3><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_subtitle'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</h3>

        <div id="complete_area">
            <div class="message">
                会員登録内容の変更が完了いたしました。<br />
            </div>
            <p>今後ともご愛顧賜りますようよろしくお願い申し上げます。</p>
        </div>
    </div>
</div>