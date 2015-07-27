<?php /* Smarty version 2.6.18, created on 20-01-2015 16:09:46
         compiled from pages/publico/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/publico/head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<body style="background-color:#FAFAFA;">

    <div id="topo" class="ui-layout-north">
        
    </div>

    <div class="ui-layout-center ui-corner-right" style="background: url(<?php echo $this->_tpl_vars['IMG']; ?>
topo4.png)">
        <br/><br/><br/>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/publico/login.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

</body>

<script src="<?php echo $this->_tpl_vars['JS']; ?>
publico.js" type="text/javascript"></script>

</html>