<style>

    #minilogo {
        display: block;
        width: 300px;
        height: 100px;
        float: left;
        background: #4e4e4d url('{{$IMG}}topoLogin1.png') no-repeat;
    }

    .login {
        background: #FFFFFF;
        border: 1px solid #999;
        border-width: 1px 2px 2px 1px;
        display: block;
        position: relative;
        height: 220px;
        width: 300px;
        margin: auto;
    }

    .login input {
        border: 1px solid #9ac;
        width: 140px;
    }

    .login label {
        font-size: 9pt;
        font-family: verdana;
        font-weight:bold;
        color:#00A859;
        width: 105px;
        display: block;
        float: left;
        text-align: right;
        padding: 2px;
    }
    .login input.texto {
        background: #00A859;
        display: block;
        float: left;
        width: 150px;
    }
    .login .form_container {
        display: block;
        float: left;
        padding: 4px;
    }	
</style>


{{* --------------------------INICIO LOGIN---------------------------- *}}

<div class="login" style="color:white;">

    <div id="minilogo"></div>

    <form action="{{$BASE_PATH}}interno/entrar" method="post" accept-charset="utf-8" >

        <span clear="all" style="float: left; display: block; width: 300px; height: 10px;"></span>

        <label for="de-ano" style="width: 120px; float: left; line-height: 20px; padding: 0 8px;">MODIFICADO</label> 

        <br/><br/>

        <a id="entrar" href="#" style="width: 240px; margin-left: 10px; display: block; text-align: center;" class="fg-button ui-state-default fg-button-icon-right ui-corner-all" ><span class="ui-icon ui-icon-circle-arrow-e"></span>Entrar</a>

    </form>

</div>

{{* --------------------------FIM LOGIN---------------------------- *}}