<?php

/* AcmeDemoBundle:Secured:layout.html.twig */
class __TwigTemplate_895e36d3a2443c65aba0226704febc88 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("AcmeDemoBundle::layout.html.twig");

        $this->blocks = array(
            'content_header_more' => array($this, 'block_content_header_more'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AcmeDemoBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("content_header_more", $context, $blocks);
        echo "
    <li>logged in as <strong>";
        // line 5
        echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user")) ? ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "user"), "username")) : ("Anonymous")), "html", null, true);
        echo "</strong> - <a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_demo_logout"), "html", null, true);
        echo "\">Logout</a></li>
";
    }

    public function getTemplateName()
    {
        return "AcmeDemoBundle:Secured:layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 20,  56 => 14,  138 => 37,  130 => 29,  106 => 26,  98 => 21,  85 => 44,  61 => 16,  36 => 7,  105 => 36,  101 => 22,  209 => 84,  205 => 82,  196 => 79,  192 => 78,  189 => 77,  178 => 71,  176 => 70,  165 => 63,  161 => 61,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  134 => 50,  132 => 49,  127 => 46,  123 => 24,  109 => 37,  93 => 33,  90 => 32,  54 => 14,  133 => 44,  124 => 41,  111 => 29,  80 => 42,  60 => 15,  52 => 17,  26 => 3,  72 => 19,  64 => 15,  53 => 13,  42 => 7,  34 => 5,  97 => 34,  95 => 21,  88 => 29,  78 => 26,  71 => 38,  40 => 6,  25 => 4,  92 => 6,  86 => 28,  79 => 40,  29 => 4,  19 => 2,  23 => 3,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  126 => 46,  120 => 23,  117 => 44,  103 => 36,  74 => 27,  47 => 10,  32 => 6,  24 => 9,  22 => 1,  17 => 1,  69 => 36,  63 => 32,  58 => 15,  49 => 16,  43 => 7,  37 => 5,  20 => 2,  139 => 26,  131 => 48,  128 => 43,  125 => 42,  121 => 40,  115 => 39,  107 => 36,  99 => 34,  96 => 34,  91 => 30,  82 => 23,  77 => 41,  75 => 40,  57 => 14,  50 => 13,  46 => 10,  44 => 11,  39 => 5,  33 => 5,  30 => 4,  27 => 9,  135 => 36,  129 => 47,  122 => 46,  116 => 42,  113 => 30,  108 => 40,  104 => 23,  102 => 37,  94 => 33,  89 => 20,  87 => 32,  84 => 28,  81 => 26,  73 => 21,  70 => 26,  67 => 17,  62 => 24,  59 => 15,  55 => 14,  51 => 13,  48 => 10,  41 => 7,  38 => 6,  35 => 5,  31 => 3,  28 => 5,);
    }
}