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
        <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmedemo/css/demo.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
        <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link rel=\"shortcut icon\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />     
    </head>
    <body>
        <div id=\"symfony-wrapper\">
            <div id=\"symfony-header\">
            \t<h1>Búsqueda masiva de expedientes - Gestrafic S.L.</h1>
            </div>

            ";
        // line 15
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session"), "flash", array(0 => "notice"), "method")) {
            // line 16
            echo "                <div class=\"flash-message\">
                    <em>Notice</em>: ";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "session"), "flash", array(0 => "notice"), "method"), "html", null, true);
            echo "
                </div>
            ";
        }
        // line 20
        echo "
            ";
        // line 21
        $this->displayBlock('content_header', $context, $blocks);
        // line 32
        echo "            
            

            <div class=\"symfony-content\">
                ";
        // line 36
        $this->displayBlock('content', $context, $blocks);
        // line 38
        echo "            </div>

            ";
        // line 40
        if (array_key_exists("code", $context)) {
            // line 41
            echo "                <h2>Code behind this page</h2>
                <div class=\"symfony-content\">";
            // line 42
            echo (isset($context["code"]) ? $context["code"] : null);
            echo "</div>
            ";
        }
        // line 44
        echo "        </div>
    </body>
</html>
";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo "Demo Bundle";
    }

    // line 21
    public function block_content_header($context, array $blocks = array())
    {
        // line 22
        echo "                <ul id=\"menu\">
                    ";
        // line 23
        $this->displayBlock('content_header_more', $context, $blocks);
        // line 26
        echo "                </ul>

                <div style=\"clear: both\"></div>
\t\t\t\t";
        // line 29
        $this->displayBlock('cabecera', $context, $blocks);
        // line 30
        echo "\t\t\t\t<img style=\"margin-bottom: -6px;\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sensiodistribution/webconfigurator/images/notification.gif"), "html", null, true);
        echo "\" alt=\"Ayuda\">
            ";
    }

    // line 23
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 24
        echo "                        <li><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("expedientes"), "html", null, true);
        echo "\">Historial</a></li>
                    ";
    }

    // line 29
    public function block_cabecera($context, array $blocks = array())
    {
    }

    // line 36
    public function block_content($context, array $blocks = array())
    {
        // line 37
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
        return array (  138 => 37,  130 => 29,  106 => 26,  98 => 21,  85 => 44,  61 => 21,  36 => 7,  105 => 36,  101 => 22,  209 => 84,  205 => 82,  196 => 79,  192 => 78,  189 => 77,  178 => 71,  176 => 70,  165 => 63,  161 => 61,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  134 => 50,  132 => 49,  127 => 46,  123 => 24,  109 => 37,  93 => 33,  90 => 32,  54 => 14,  133 => 44,  124 => 41,  111 => 29,  80 => 42,  60 => 15,  52 => 17,  26 => 3,  72 => 16,  64 => 15,  53 => 13,  42 => 7,  34 => 11,  97 => 34,  95 => 21,  88 => 29,  78 => 26,  71 => 38,  40 => 7,  25 => 4,  92 => 6,  86 => 28,  79 => 40,  29 => 3,  19 => 2,  23 => 3,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  126 => 46,  120 => 23,  117 => 44,  103 => 36,  74 => 27,  47 => 15,  32 => 6,  24 => 3,  22 => 1,  17 => 1,  69 => 36,  63 => 32,  58 => 20,  49 => 16,  43 => 7,  37 => 8,  20 => 2,  139 => 26,  131 => 48,  128 => 43,  125 => 42,  121 => 40,  115 => 39,  107 => 36,  99 => 34,  96 => 34,  91 => 30,  82 => 27,  77 => 41,  75 => 40,  57 => 14,  50 => 13,  46 => 10,  44 => 11,  39 => 5,  33 => 5,  30 => 4,  27 => 9,  135 => 36,  129 => 47,  122 => 46,  116 => 42,  113 => 30,  108 => 40,  104 => 23,  102 => 37,  94 => 33,  89 => 20,  87 => 32,  84 => 28,  81 => 26,  73 => 21,  70 => 26,  67 => 19,  62 => 24,  59 => 23,  55 => 14,  51 => 13,  48 => 10,  41 => 9,  38 => 6,  35 => 5,  31 => 10,  28 => 5,);
    }
}
