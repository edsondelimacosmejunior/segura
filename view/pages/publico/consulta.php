<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd" >
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />

        <meta name="description" content="" />
        <meta name="keywords" content="" />

        <title>:. Módulo Administrativo .:</title>


        <link href="{{$CSS}}sunset.css" rel="stylesheet" type="text/css" />
        <link href="{{$CSS}}redmond/jquery-ui-1.7.2.custom.css" rel="stylesheet" type="text/css" />
        <link href="{{$CSS}}layout-default.css" rel="stylesheet" type="text/css" />
        <link href="{{$CSS}}jquery.message.css" rel="stylesheet" type="text/css" />

        <script src="{{$JS}}jquery-1.3.2.min.js" type="text/javascript"></script>
        <script src="{{$JS}}jquery-ui-1.7.2.custom.min.js" type="text/javascript"></script>
        <script src="{{$JS}}jquery.layout.min.js" type="text/javascript"></script>
        <script src="{{$JS}}jquery/jquery.message.min.js" type="text/javascript"></script>

    </head>
<style>

        #minilogo {
            display: block;
            width: 300px;
            height: 100px;
            float: left;
            background: #4e4e4d url('topoLogin1.png') no-repeat;
            text-align: right;
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
        #botao{
            text-align: right;            
        }
</style>
    
<script>
 
    /*Função Pai de Mascaras*/
    function Mascara(o,f){
        v_obj=o
        v_fun=f
        setTimeout("execmascara()",1)
    }

    /*Função que Executa os objetos*/
    function execmascara(){
        v_obj.value=v_fun(v_obj.value)
    }

    /*Função que permite apenas numeros*/
    function Inteiro(v){
        return v.replace(/\D/g,"")
    }

    function Cpf(v){
        v=v.replace(/\D/g,"")
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
        v=v.replace(/(\d{3})(\d)/,"$1.$2")
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
        return v
    }
</script>
    
    <body style="background-color:#FAFAFA;">

        <div id="topo" class="ui-layout-north">

        </div>

        <div class="ui-layout-center ui-corner-right" style="background: url({{$IMG}}topo4.png)">
            <br/><br/><br/>

            <div class="login" style="color:white;">

                <div id="minilogo"></div>

                <form action="consultaResultado.php" method="post" accept-charset="utf-8" >

                    <span clear="all" style="float: left; display: block; width: 300px; height: 10px;"></span>

                    <label for="cpf" style="width: 120px; float: left; line-height: 20px; padding: 0 8px;">CPF:</label> 
                    <input type="text" id="cpf" name="cpf" size="16" class="ui-state-default ui-corner-all" style="text-align: center; padding: 2px;" maxlength="14" onKeyDown="Mascara(this,Cpf);" onKeyPress="Mascara(this,Cpf);" onKeyUp="Mascara(this,Cpf);"/>

                    <p></p>
                    <label for="certificado" style="width: 120px; float: left; line-height: 20px; padding: 0 8px;">Certificado:</label> 
                    <input type="text" id="certificado" name="certificado" size="16" class="ui-state-default ui-corner-all" style="text-align: center; padding: 2px;" onKeyDown="Mascara(this,Inteiro);" onKeyPress="Mascara(this,Inteiro);" onKeyUp="Mascara(this,Inteiro);"/>

                    <br/><br/>
                    <div id="botao">
                    <input type="submit" value="Consultar Certificados"></input>
                    </div>
                </form>
            </div>
        </div>
        
        <!--<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http%3A%2F%2F192.168.0.114%2Fsegura%2Fview%2Fpages%2Fpublico%2FconsultaResultado.php%3Fcpf%3Dteste%26certificado%3D1'/>
        -->
    </body>
</html>
