<?php

/* BumexBasicBundle:Index:index.html.twig */
class __TwigTemplate_b2627c4659cf45a9d6906c3b4307f0bf extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("BumexBasicBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content_header_more' => array($this, 'block_content_header_more'),
            'cabecera' => array($this, 'block_cabecera'),
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "BumexBasicBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Inicio";
    }

    // line 5
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 6
        echo "\t<li>Inicio</li>
\t<li><a href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("historial"), "html", null, true);
        echo "\" title=\"Histórico de búsquedas realizadas\">Historial</a></li>
\t<li>
    \t<img id=\"dialog_link\" style=\"cursor: pointer; margin-bottom: -10px;\" src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/config.png"), "html", null, true);
        echo "\" title=\"Configuración básica\" alt=\"Configuración básica\">
    </li>
";
    }

    // line 13
    public function block_cabecera($context, array $blocks = array())
    {
        echo " 
\t<h2>Carga de datos</h2>
";
    }

    // line 17
    public function block_content($context, array $blocks = array())
    {
        // line 18
        echo "

\t<form action=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("expedientes"), "html", null, true);
        echo "\" method=\"POST\" id=\"frm_fichero\" style=\"text-align: center;\" ";
        echo $this->env->getExtension('form')->renderEnctype($this->getContext($context, "form"));
        echo ">
        ";
        // line 21
        echo $this->env->getExtension('form')->renderErrors($this->getContext($context, "form"));
        echo "

        ";
        // line 23
        echo $this->env->getExtension('form')->renderRow($this->getAttribute($this->getContext($context, "form"), "file"));
        echo "
        <br />
        ";
        // line 25
        echo $this->env->getExtension('form')->renderRow($this->getAttribute($this->getContext($context, "form"), "frmFecha"));
        echo "
        

        ";
        // line 28
        echo $this->env->getExtension('form')->renderRest($this->getContext($context, "form"));
        echo "
\t\t<input type=\"hidden\" id=\"autoDir\" />
        <br /><input id=\"dialog_button\"\tonclick=\"variablesReloj(); contador();\" type=\"submit\" value=\"Cargar\" class=\"symfony-button-green\" />
    </form>
    <br />
    ";
        // line 33
        if (($this->getContext($context, "testraok") == false)) {
            // line 34
            echo "\t<div class=\"ui-widget\">
\t\t<div class=\"ui-state-error ui-corner-all\" style=\"color: #df6748; border-color: #df6748; padding: 0 .7em; font-size: 14px;\">
\t\t\t<p></p>
\t\t\t<p style=\"text-align: center;\">
\t\t\t\t<img src=\"";
            // line 38
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/notification_red.gif"), "html", null, true);
            echo "\" style=\"margin-bottom: -6px;\" />
\t\t\t\t<strong>Aviso:</strong> Parece que TESTRA no carga correctamente, espera unos minutos y recarga la página.
\t\t\t</p>
\t</div>
    ";
        }
        // line 43
        echo "    <br />
    ";
        // line 44
        if (($this->getContext($context, "dirMod") == true)) {
            // line 45
            echo "\t<div class=\"ui-widget\">
\t\t<div class=\"ui-state-error ui-corner-all\" style=\"color: #df6748; border-color: #df6748; padding: 0 .7em; font-size: 14px;\">
\t\t\t<p></p>
\t\t\t<p style=\"text-align: center;\">
\t\t\t\t<img src=\"";
            // line 49
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/notification_red.gif"), "html", null, true);
            echo "\" style=\"margin-bottom: -6px;\" />
\t\t\t\t<strong>Aviso:</strong> El nuevo directorio seleccionado no es válido y no se ha realizado el cambio.
\t\t\t</p>
\t</div>
    ";
        }
        // line 54
        echo "    ";
        if (($this->getContext($context, "autoMod") == true)) {
            // line 55
            echo "\t<div class=\"ui-widget\">
\t\t<div class=\"ui-state-error ui-corner-all\" style=\"color: #df6748; border-color: #df6748; padding: 0 .7em; font-size: 14px;\">
\t\t\t<p></p>
\t\t\t<p style=\"text-align: center;\">
\t\t\t\t<img src=\"";
            // line 59
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/notification_red.gif"), "html", null, true);
            echo "\" style=\"margin-bottom: -6px;\" />
\t\t\t\t<strong>Aviso:</strong> El nuevo directorio seleccionado para el proceso automático no es válido y no se ha realizado el cambio.
\t\t\t</p>
\t</div>
    ";
        }
        // line 64
        echo "    <div id=\"dialog\" title=\"Proceso de carga\">
    \t<img src=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/preload2.gif"), "html", null, true);
        echo "\" alt=\"Cargando...\" style=\"margin-top: 10px; margin-right: 10px; float: left;\" />
\t\t<p style=\"margin-top: 10px;\">Se está realizando la carga de datos y la comprobación de coincidencias.<br />Por favor, espera.</p>
\t\t<p style=\"color: #5292CC; font-size: 10px; text-align: center;\">Tiempo transcurrido: <span id=\"tiempo\"></span></p>
\t</div>
\t
\t<div id=\"config_dialog\" title=\"Configuración básica\">
\t\t<form id=\"frm_directorio\" method=\"post\" action=\"\">
\t\t\t<p>Ruta en la que se buscarán datos para realizar el proceso automático:</p>
\t\t\t<input name=\"auto_ruta\" type=\"text\" value=\"";
        // line 73
        echo twig_escape_filter($this->env, $this->getContext($context, "autoruta"), "html", null, true);
        echo "\" maxlength=\"200\" size=\"49\" /><br /><br />
\t\t\t<p>Ruta en la que se almacenará toda la documentación generada:</p>
\t\t\t<input name=\"ruta\" type=\"text\" value=\"";
        // line 75
        echo twig_escape_filter($this->env, $this->getContext($context, "directorio"), "html", null, true);
        echo "\" maxlength=\"200\" size=\"49\" />
\t\t</form>
\t\t<p style=\"padding-top: 25px; font-size: 12px;\">Para modificarlas, escribe la ruta nueva en el campo de texto y pulsa el botón 'Aceptar'.</p>
\t</div>
";
    }

    // line 81
    public function block_javascripts($context, array $blocks = array())
    {
        // line 82
        echo "\t";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "
\t<script>
\t
\t
\t\$(function(){
\t\t// Dialog
\t\t\$('#config_dialog').dialog({
\t\t\tautoOpen: false,
\t\t\twidth: 505,
\t\t\tmodal: true,
\t\t\tbuttons: {
\t\t\t\tAceptar: function() {
\t\t\t\t\tdocument.getElementById('frm_directorio').submit();
\t\t\t\t},
\t\t\t\tCancelar: function() {
\t\t\t\t\t\$(this).dialog( \"close\" );
\t\t\t\t}
\t\t\t}
\t\t}).parent('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
\t\t
\t\t// Dialog Link
\t\t\$('#dialog_link').click(function(){
\t\t\t\$('#config_dialog').dialog('open');
\t\t});
\t});
\t
\t\$(function(){
\t\t// Dialog
\t\t\$('#dialog').dialog({
\t\t\tautoOpen: false,
\t\t\twidth: 600,
\t\t\theight: 160,
\t\t\tmodal: true,
\t\t}).parent('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
\t\t
\t\t// Dialog Link
\t\t\$('#frm_fichero').submit(function(){
\t\t\t\$('#dialog').dialog('open');
\t\t});
\t});
\t
\tfunction variablesReloj(){
\t\tsegundos = 0
\t\tminutos = 0  
\t\thoras = 0
\t}
\tfunction contador(){
\t\tsegundos++\t
\t        if ( segundos > 59 ) {  
\t            segundos = 0  
\t            minutos++  
\t            if ( minutos > 59 ) {
\t\t\tminutos = 0;
\t                horas++ 
\t            }  
\t        }  
\t  
\t    var ValorCrono = \"\"
\t    ValorCrono = (horas < 10) ? \"0\" + horas : horas  
\t    ValorCrono += (minutos < 10) ? \":0\" + minutos : \":\" + minutos  
\t    ValorCrono += (segundos < 10) ? \":0\" + segundos : \":\" + segundos  
\t              
\t    document.getElementById('tiempo').innerHTML = ValorCrono  
\t
\t    setTimeout(\"contador()\", 1000)
\t    return true 
\t}
\t
\t";
        // line 150
        if (($this->getContext($context, "auto") != false)) {
            // line 151
            echo "\t\t\t\tdocument.getElementById('frm_fichero').submit();

\t";
        }
        // line 154
        echo "\t
\t</script>

";
    }

    public function getTemplateName()
    {
        return "BumexBasicBundle:Index:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  261 => 154,  256 => 151,  254 => 150,  182 => 82,  179 => 81,  170 => 75,  165 => 73,  154 => 65,  151 => 64,  143 => 59,  137 => 55,  134 => 54,  126 => 49,  120 => 45,  118 => 44,  115 => 43,  107 => 38,  101 => 34,  99 => 33,  91 => 28,  85 => 25,  80 => 23,  75 => 21,  69 => 20,  65 => 18,  62 => 17,  54 => 13,  47 => 9,  42 => 7,  39 => 6,  36 => 5,  30 => 3,);
    }
}
