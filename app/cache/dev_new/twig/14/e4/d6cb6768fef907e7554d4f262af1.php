<?php

/* AcmeDemoBundle:Demo:hello.html.twig */
class __TwigTemplate_14e4d6cb6768fef907e7554d4f262af1 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("AcmeDemoBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AcmeDemoBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 9
        $context["code"] = $this->env->getExtension('demo')->getCode($this);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, ("Hello " . (isset($context["name"]) ? $context["name"] : null)), "html", null, true);
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    <h1>Hello ";
        echo twig_escape_filter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true);
        echo "!</h1>
";
    }

    public function getTemplateName()
    {
        return "AcmeDemoBundle:Demo:hello.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  136 => 40,  114 => 30,  21 => 1,  76 => 20,  56 => 17,  138 => 37,  130 => 29,  106 => 26,  98 => 21,  85 => 43,  61 => 23,  36 => 6,  105 => 36,  101 => 22,  209 => 84,  205 => 82,  196 => 79,  192 => 78,  189 => 77,  178 => 71,  176 => 70,  165 => 63,  161 => 61,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  134 => 50,  132 => 49,  127 => 46,  123 => 30,  109 => 37,  93 => 33,  90 => 45,  54 => 14,  133 => 39,  124 => 41,  111 => 29,  80 => 42,  60 => 15,  52 => 17,  26 => 3,  72 => 19,  64 => 24,  53 => 13,  42 => 7,  34 => 5,  97 => 34,  95 => 47,  88 => 29,  78 => 26,  71 => 38,  40 => 6,  25 => 4,  92 => 6,  86 => 28,  79 => 39,  29 => 3,  19 => 2,  23 => 29,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  126 => 31,  120 => 23,  117 => 44,  103 => 36,  74 => 27,  47 => 13,  32 => 6,  24 => 9,  22 => 1,  17 => 1,  69 => 36,  63 => 32,  58 => 15,  49 => 16,  43 => 12,  37 => 5,  20 => 2,  139 => 26,  131 => 48,  128 => 43,  125 => 42,  121 => 40,  115 => 39,  107 => 36,  99 => 34,  96 => 34,  91 => 30,  82 => 23,  77 => 41,  75 => 37,  57 => 14,  50 => 10,  46 => 9,  44 => 8,  39 => 10,  33 => 5,  30 => 4,  27 => 3,  135 => 36,  129 => 47,  122 => 46,  116 => 33,  113 => 30,  108 => 28,  104 => 23,  102 => 6,  94 => 33,  89 => 20,  87 => 44,  84 => 28,  81 => 41,  73 => 28,  70 => 27,  67 => 17,  62 => 24,  59 => 22,  55 => 12,  51 => 13,  48 => 10,  41 => 7,  38 => 6,  35 => 5,  31 => 4,  28 => 3,);
    }
}
