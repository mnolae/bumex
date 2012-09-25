<?php

/* BumexBasicBundle:Index:historial.html.twig */
class __TwigTemplate_0099e166c9d9b7e7cf939ced7b938684 extends Twig_Template
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
        );
    }

    protected function doGetParent(array $context)
    {
        return "BumexBasicBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 18
        $context["code"] = $this->env->getExtension('demo')->getCode($this);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Expedientes";
    }

    // line 5
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 6
        echo "\t<li><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("index"), "html", null, true);
        echo "\">Inicio</a></li>
\t<li>Historial</li>
";
    }

    // line 10
    public function block_cabecera($context, array $blocks = array())
    {
        echo " 
\t<h2>Historial de procesos realizados</h2>
";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "\talgo
";
    }

    public function getTemplateName()
    {
        return "BumexBasicBundle:Index:historial.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 14,  138 => 37,  130 => 29,  106 => 26,  98 => 21,  85 => 44,  61 => 21,  36 => 7,  105 => 36,  101 => 22,  209 => 84,  205 => 82,  196 => 79,  192 => 78,  189 => 77,  178 => 71,  176 => 70,  165 => 63,  161 => 61,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  134 => 50,  132 => 49,  127 => 46,  123 => 24,  109 => 37,  93 => 33,  90 => 32,  54 => 14,  133 => 44,  124 => 41,  111 => 29,  80 => 42,  60 => 15,  52 => 17,  26 => 18,  72 => 16,  64 => 15,  53 => 13,  42 => 7,  34 => 11,  97 => 34,  95 => 21,  88 => 29,  78 => 26,  71 => 38,  40 => 6,  25 => 4,  92 => 6,  86 => 28,  79 => 40,  29 => 3,  19 => 2,  23 => 3,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  126 => 46,  120 => 23,  117 => 44,  103 => 36,  74 => 27,  47 => 15,  32 => 6,  24 => 3,  22 => 1,  17 => 1,  69 => 36,  63 => 32,  58 => 20,  49 => 16,  43 => 7,  37 => 5,  20 => 2,  139 => 26,  131 => 48,  128 => 43,  125 => 42,  121 => 40,  115 => 39,  107 => 36,  99 => 34,  96 => 34,  91 => 30,  82 => 27,  77 => 41,  75 => 40,  57 => 14,  50 => 13,  46 => 10,  44 => 11,  39 => 5,  33 => 5,  30 => 4,  27 => 9,  135 => 36,  129 => 47,  122 => 46,  116 => 42,  113 => 30,  108 => 40,  104 => 23,  102 => 37,  94 => 33,  89 => 20,  87 => 32,  84 => 28,  81 => 26,  73 => 21,  70 => 26,  67 => 19,  62 => 24,  59 => 15,  55 => 14,  51 => 13,  48 => 10,  41 => 9,  38 => 6,  35 => 5,  31 => 3,  28 => 5,);
    }
}
