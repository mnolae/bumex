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
        // line 38
        echo "            
            

            <div class=\"symfony-content\">
                ";
        // line 42
        $this->displayBlock('content', $context, $blocks);
        // line 44
        echo "            </div>

\t\t\t

            ";
        // line 48
        if (array_key_exists("code", $context)) {
            // line 49
            echo "                <h2>Code behind this page</h2>
                <div class=\"symfony-content\">";
            // line 50
            echo $this->getContext($context, "code");
            echo "</div>
            ";
        }
        // line 52
        echo "        </div>
        ";
        // line 53
        $this->displayBlock('javascripts', $context, $blocks);
        // line 54
        echo "        ";
        $this->env->loadTemplate("BumexBasicBundle:Credito:credito.html.twig")->display($context);
        // line 55
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

    // line 31
    public function block_content_header_more($context, array $blocks = array())
    {
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

    // line 53
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
        return array (  170 => 53,  166 => 43,  163 => 42,  158 => 35,  153 => 31,  146 => 36,  139 => 32,  137 => 31,  134 => 30,  125 => 9,  120 => 8,  117 => 7,  111 => 5,  105 => 55,  102 => 54,  100 => 53,  97 => 52,  89 => 49,  81 => 44,  79 => 42,  73 => 38,  71 => 29,  68 => 28,  62 => 25,  59 => 24,  57 => 23,  44 => 13,  40 => 12,  37 => 11,  35 => 7,  24 => 1,  173 => 54,  156 => 51,  152 => 50,  148 => 49,  144 => 35,  140 => 47,  136 => 46,  131 => 29,  114 => 44,  98 => 30,  92 => 50,  90 => 27,  87 => 48,  84 => 25,  76 => 21,  70 => 18,  65 => 16,  58 => 13,  55 => 12,  49 => 10,  43 => 7,  39 => 6,  33 => 4,  30 => 5,);
    }
}
