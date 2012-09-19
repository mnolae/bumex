<?php

/* ::base.html.twig */
class __TwigTemplate_c749e15da46871f23938e5f817161ac8 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"shortcut icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "::base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 12,  121 => 33,  118 => 32,  110 => 23,  101 => 23,  98 => 22,  68 => 34,  66 => 32,  21 => 1,  43 => 8,  209 => 84,  205 => 82,  196 => 79,  192 => 78,  189 => 77,  178 => 71,  176 => 70,  165 => 63,  161 => 61,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  134 => 50,  132 => 49,  127 => 46,  123 => 44,  109 => 39,  93 => 33,  90 => 32,  54 => 14,  133 => 44,  124 => 41,  111 => 37,  107 => 36,  80 => 26,  69 => 20,  63 => 18,  60 => 21,  52 => 12,  26 => 3,  72 => 36,  64 => 15,  53 => 13,  42 => 11,  34 => 5,  97 => 34,  95 => 21,  88 => 29,  82 => 40,  78 => 25,  75 => 24,  71 => 14,  49 => 11,  40 => 10,  25 => 4,  92 => 20,  86 => 28,  79 => 40,  46 => 15,  37 => 8,  29 => 4,  44 => 11,  30 => 4,  33 => 7,  27 => 5,  19 => 2,  23 => 3,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  131 => 48,  126 => 46,  120 => 39,  117 => 44,  103 => 26,  99 => 34,  77 => 38,  74 => 37,  57 => 6,  47 => 19,  39 => 5,  32 => 11,  24 => 3,  22 => 2,  20 => 2,  17 => 1,  135 => 50,  129 => 47,  122 => 46,  116 => 42,  113 => 24,  108 => 40,  104 => 24,  102 => 37,  94 => 33,  89 => 6,  87 => 28,  84 => 28,  81 => 26,  73 => 21,  70 => 26,  67 => 11,  62 => 10,  59 => 23,  55 => 14,  51 => 5,  48 => 16,  41 => 9,  38 => 8,  35 => 7,  31 => 6,  28 => 3,);
    }
}
