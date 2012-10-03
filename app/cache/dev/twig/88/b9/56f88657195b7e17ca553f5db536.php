<?php

/* BumexBasicBundle::layout.html.twig */
class __TwigTemplate_88b956f88657195b7e17ca553f5db536 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'content_header' => array($this, 'block_content_header'),
            'content_header_more' => array($this, 'block_content_header_more'),
            'cabecera' => array($this, 'block_cabecera'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link rel=\"shortcut icon\" href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        <script src=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-1.8.0.min.js"), "html", null, true);
        echo "\"></script>
        <script src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-ui-1.8.23.custom.min.js"), "html", null, true);
        echo "\"></script>
        ";
        // line 9
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 13
        echo "    </head>
    <body>
        <div id=\"symfony-wrapper\">
            <div id=\"symfony-header\">
            \t<h1>Búmex :: Gestrafic S.L.</h1>
            \t<span>&nbsp;Búsqueda masiva de Expedientes</span>
            </div>

            ";
        // line 21
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flash", array(0 => "notice"), "method")) {
            // line 22
            echo "                <div class=\"flash-message\">
                    <em>Notice</em>: ";
            // line 23
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flash", array(0 => "notice"), "method"), "html", null, true);
            echo "
                </div>
            ";
        }
        // line 26
        echo "
            ";
        // line 27
        $this->displayBlock('content_header', $context, $blocks);
        // line 38
        echo "            
            

            <div class=\"symfony-content\">
                ";
        // line 42
        $this->displayBlock('content', $context, $blocks);
        // line 44
        echo "            </div>

            ";
        // line 46
        if (array_key_exists("code", $context)) {
            // line 47
            echo "                <h2>Code behind this page</h2>
                <div class=\"symfony-content\">";
            // line 48
            echo $this->getContext($context, "code");
            echo "</div>
            ";
        }
        // line 50
        echo "        </div>
    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Demo Bundle";
    }

    // line 9
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 10
        echo "\t        <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/demo.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
\t        <link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/jquery-ui-1.8.23.custom.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />    
        ";
    }

    // line 27
    public function block_content_header($context, array $blocks = array())
    {
        // line 28
        echo "                <ul id=\"menu\">
                    ";
        // line 29
        $this->displayBlock('content_header_more', $context, $blocks);
        // line 32
        echo "                </ul>

                <div style=\"clear: both\"></div>
\t\t\t\t";
        // line 35
        $this->displayBlock('cabecera', $context, $blocks);
        // line 36
        echo "\t\t\t\t<img style=\"margin-bottom: -6px;\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sensiodistribution/webconfigurator/images/notification.gif"), "html", null, true);
        echo "\" alt=\"Ayuda\">
            ";
    }

    // line 29
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 30
        echo "                        <li><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("expedientes"), "html", null, true);
        echo "\">Historial</a></li>
                    ";
    }

    // line 35
    public function block_cabecera($context, array $blocks = array())
    {
    }

    // line 42
    public function block_content($context, array $blocks = array())
    {
        // line 43
        echo "                ";
    }

    public function getTemplateName()
    {
        return "BumexBasicBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 43,  159 => 42,  154 => 35,  147 => 30,  144 => 29,  137 => 36,  135 => 35,  130 => 32,  128 => 29,  125 => 28,  122 => 27,  116 => 11,  111 => 10,  108 => 9,  102 => 5,  95 => 50,  90 => 48,  87 => 47,  85 => 46,  81 => 44,  79 => 42,  73 => 38,  71 => 27,  68 => 26,  62 => 23,  59 => 22,  57 => 21,  47 => 13,  45 => 9,  41 => 8,  37 => 7,  33 => 6,  29 => 5,  23 => 1,);
    }
}
