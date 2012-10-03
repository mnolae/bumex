<?php

/* BumexBasicBundle:Index:index.html.twig */
class __TwigTemplate_cbd9ada13d09d659be7f17a15a24adf8 extends Twig_Template
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
        echo "\">Historial</a></li>
";
    }

    // line 10
    public function block_cabecera($context, array $blocks = array())
    {
        echo " 
\t<h2>Carga de datos</h2>
";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "
\t<form action=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("expedientes"), "html", null, true);
        echo "\" method=\"POST\" id=\"frm_fichero\" style=\"text-align: center;\" ";
        echo $this->env->getExtension('form')->renderEnctype($this->getContext($context, "form"));
        echo ">
        ";
        // line 17
        echo $this->env->getExtension('form')->renderErrors($this->getContext($context, "form"));
        echo "

        ";
        // line 19
        echo $this->env->getExtension('form')->renderRow($this->getAttribute($this->getContext($context, "form"), "file"));
        echo "
        <br />
        ";
        // line 21
        echo $this->env->getExtension('form')->renderRow($this->getAttribute($this->getContext($context, "form"), "frmFecha"));
        echo "
        

        ";
        // line 24
        echo $this->env->getExtension('form')->renderRest($this->getContext($context, "form"));
        echo "

        <br /><input id=\"dialog_button\" type=\"submit\" value=\"Cargar\" class=\"symfony-button-grey\" />
    </form>
    <br />
        
    <div id=\"dialog\" title=\"Proceso de carga\">
    \t<img src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/preload2.gif"), "html", null, true);
        echo "\" alt=\"Cargando...\" style=\"margin-top: 10px; margin-right: 10px; float: left;\" />
\t\t<p style=\"margin-top: 10px;\">Se está realizando la carga de datos y la comprobación de coincidencias.<br />Por favor, espera.</p>
\t</div>
";
    }

    // line 36
    public function block_javascripts($context, array $blocks = array())
    {
        // line 37
        echo "\t<script>
\t
\t\$(function(){
\t\t// Dialog
\t\t\$('#dialog').dialog({
\t\t\tautoOpen: false,
\t\t\twidth: 600,
\t\t\theight: 115,
\t\t\tmodal: true,
\t\t}).parent('.ui-dialog').find('.ui-dialog-titlebar-close').hide();
\t\t
\t\t// Dialog Link
\t\t\$('#frm_fichero').submit(function(){
\t\t\t\$('#dialog').dialog('open');
\t\t});
\t});
\t
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
        return array (  105 => 37,  102 => 36,  94 => 31,  84 => 24,  78 => 21,  73 => 19,  68 => 17,  62 => 16,  59 => 15,  56 => 14,  48 => 10,  42 => 7,  39 => 6,  36 => 5,  30 => 3,);
    }
}
