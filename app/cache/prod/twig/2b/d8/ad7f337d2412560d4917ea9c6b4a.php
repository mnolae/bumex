<?php

/* GbmIndexBundle::layout.html.twig */
class __TwigTemplate_2bd8ad7f337d2412560d4917ea9c6b4a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content_header' => array($this, 'block_content_header'),
            'content_header_more' => array($this, 'block_content_header_more'),
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
\t\t\t\t<h2>Búsqueda masiva de expedientes y teléfonos - Gestrafic S.L.</h2>
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
        // line 30
        echo "
            <div class=\"symfony-content\">
                ";
        // line 32
        $this->displayBlock('content', $context, $blocks);
        // line 34
        echo "            </div>

            ";
        // line 36
        if (array_key_exists("code", $context)) {
            // line 37
            echo "                <h2>Code behind this page</h2>
                <div class=\"symfony-content\">";
            // line 38
            echo (isset($context["code"]) ? $context["code"] : null);
            echo "</div>
            ";
        }
        // line 40
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
            ";
    }

    // line 23
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 24
        echo "
                    ";
    }

    // line 32
    public function block_content($context, array $blocks = array())
    {
        // line 33
        echo "                ";
    }

    public function getTemplateName()
    {
        return "GbmIndexBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 33,  118 => 32,  110 => 23,  101 => 23,  98 => 22,  68 => 34,  66 => 32,  21 => 1,  43 => 8,  209 => 84,  205 => 82,  196 => 79,  192 => 78,  189 => 77,  178 => 71,  176 => 70,  165 => 63,  161 => 61,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  134 => 50,  132 => 49,  127 => 46,  123 => 44,  109 => 39,  93 => 33,  90 => 32,  54 => 14,  133 => 44,  124 => 41,  111 => 37,  107 => 36,  80 => 26,  69 => 20,  63 => 18,  60 => 21,  52 => 12,  26 => 3,  72 => 36,  64 => 15,  53 => 13,  42 => 7,  34 => 5,  97 => 34,  95 => 21,  88 => 29,  82 => 40,  78 => 25,  75 => 24,  71 => 14,  49 => 11,  40 => 7,  25 => 4,  92 => 20,  86 => 28,  79 => 40,  46 => 15,  37 => 8,  29 => 4,  44 => 11,  30 => 4,  33 => 5,  27 => 5,  19 => 2,  23 => 3,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  131 => 48,  126 => 46,  120 => 39,  117 => 44,  103 => 26,  99 => 34,  77 => 38,  74 => 37,  57 => 20,  47 => 19,  39 => 5,  32 => 11,  24 => 3,  22 => 2,  20 => 2,  17 => 1,  135 => 50,  129 => 47,  122 => 46,  116 => 42,  113 => 24,  108 => 40,  104 => 24,  102 => 37,  94 => 33,  89 => 6,  87 => 28,  84 => 28,  81 => 26,  73 => 21,  70 => 26,  67 => 19,  62 => 30,  59 => 23,  55 => 14,  51 => 17,  48 => 16,  41 => 9,  38 => 8,  35 => 7,  31 => 6,  28 => 3,);
    }
}
