<?php /* Smarty version 2.6.18, created on 20-01-2015 16:09:59
         compiled from pages/interno/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/interno/head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<body style="background-color:#FEFEFE;">

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/interno/dialogs.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <div id="topo" class="ui-layout-north">
        <div id="caixaTopo">
            <span style="float: left; margin-left:43px; margin-top:0px;"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
logoSegura.png" alt="Segura" border="0" /></span>
            <span style="float: right; margin-right:43px; margin-top:3px;"><img src="<?php echo $this->_tpl_vars['IMG']; ?>
logoIso.png" alt="Iso" border="0" /></span>
        </div>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pages/interno/menu2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <div class="ui-layout-center ui-corner-right" style="background-color:#FEFEFE;">
        <!-- add wrapper that Layout will auto-size to 'fill space' -->
        <div id="abas" class="ui-layout-content">
            <div id="tab0" class="aba sunset" >

                <div class="area_descricao" style="position: absolute;">
                    <img src="<?php echo $this->_tpl_vars['IMG']; ?>
icons/001_24.png" align="absmiddle" /> <b>Selecione uma opção no menu superior.</b> <!-- <img src="<?php echo $this->_tpl_vars['IMG']; ?>
petrobras.png" align="absmiddle" /> -->
                </div>

            </div>

        </div>
        <!--- Rodapé Central --->
        <div id="statusInformacao" class="ui-state-default" style="font-size: 14px; color: #3F474A; padding: 3px 5px 5px; text-align: left; margin-top: -1px;">
            Você está em: Home
        </div>

    </div>

</body>

<script src="<?php echo $this->_tpl_vars['JS']; ?>
interno.js" type="text/javascript"></script>

</html>

<script>

            $.fx.speeds._default = 850;
            $(function() {
                $("#dialog").dialog({
                    autoOpen: false,
                    show: "slide",
                    hide: "explode"
                });

                $(".opener").click(function() {
                    $("#dialog").dialog("open");
                    return false;
                });
            });
</script>