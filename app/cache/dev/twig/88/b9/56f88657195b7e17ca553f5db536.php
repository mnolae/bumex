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
            'javascripts' => array($this, 'block_javascripts'),
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
        <link rel=\"shortcut icon\" href=\"http://www.gestrafic.com/images/favicon.ico\" />
        ";
        // line 7
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 11
        echo "
\t\t<script type=\"text/javascript\" src=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-1.8.0.min.js"), "html", null, true);
        echo "\"></script>
\t\t<script type=\"text/javascript\" src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("js/jquery-ui-1.8.23.custom.min.js"), "html", null, true);
        echo "\"></script>
        
    </head>
    <body>
        <div id=\"symfony-wrapper\">
            <div id=\"symfony-header\">
            \t<h1>Búmex :: Gestrafic S.L.</h1>
            \t<span>&nbsp;Búsqueda masiva de Expedientes</span>
            </div>

            ";
        // line 23
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flash", array(0 => "notice"), "method")) {
            // line 24
            echo "                <div class=\"flash-message\">
                    <em>Notice</em>: ";
            // line 25
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flash", array(0 => "notice"), "method"), "html", null, true);
            echo "
                </div>
            ";
        }
        // line 28
        echo "
            ";
        // line 29
        $this->displayBlock('content_header', $context, $blocks);
        // line 43
        echo "            
            

            <div class=\"symfony-content\">
                ";
        // line 47
        $this->displayBlock('content', $context, $blocks);
        // line 49
        echo "            </div>

            ";
        // line 51
        if (array_key_exists("code", $context)) {
            // line 52
            echo "                <h2>Code behind this page</h2>
                <div class=\"symfony-content\">";
            // line 53
            echo $this->getContext($context, "code");
            echo "</div>
            ";
        }
        // line 55
        echo "        </div>
        ";
        // line 56
        $this->displayBlock('javascripts', $context, $blocks);
        // line 57
        echo "    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Demo Bundle";
    }

    // line 7
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 8
        echo "\t        <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/demo.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
    \t\t<link type=\"text/css\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/south-street/jquery-ui-1.8.23.custom.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
        ";
    }

    // line 29
    public function block_content_header($context, array $blocks = array())
    {
        // line 30
        echo "                <ul id=\"menu\">
                    ";
        // line 31
        $this->displayBlock('content_header_more', $context, $blocks);
        // line 37
        echo "                </ul>

                <div style=\"clear: both\"></div>
\t\t\t\t";
        // line 40
        $this->displayBlock('cabecera', $context, $blocks);
        // line 41
        echo "\t\t\t\t<img style=\"margin-bottom: -6px;\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sensiodistribution/webconfigurator/images/notification.gif"), "html", null, true);
        echo "\" alt=\"Ayuda\">
            ";
    }

    // line 31
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 32
        echo "                        <li><a href=\"#\" title=\"Configuración básica\">
                        \t\t<img style=\"margin-bottom: -10px;\" src=\"";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/request.png"), "html", null, true);
        echo "\" alt=\"Configuración básica\">
                        \t</a>
                        </li>
                    ";
    }

    // line 40
    public function block_cabecera($context, array $blocks = array())
    {
    }

    // line 47
    public function block_content($context, array $blocks = array())
    {
        // line 48
        echo "                ";
    }

    // line 56
    public function block_javascripts($context, array $blocks = array())
    {
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
        return array (  174 => 56,  170 => 48,  167 => 47,  162 => 40,  154 => 33,  151 => 32,  148 => 31,  141 => 41,  139 => 40,  134 => 37,  132 => 31,  129 => 30,  126 => 29,  120 => 9,  115 => 8,  112 => 7,  106 => 5,  100 => 57,  98 => 56,  95 => 55,  90 => 53,  87 => 52,  85 => 51,  81 => 49,  79 => 47,  73 => 43,  71 => 29,  68 => 28,  62 => 25,  59 => 24,  57 => 23,  44 => 13,  40 => 12,  37 => 11,  35 => 7,  30 => 5,  24 => 1,);
    }
}
