<?php

/* TwigBundle:Exception:exception.atom.twig */
class __TwigTemplate_d984284e259650525708936d3783004e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->env->loadTemplate("TwigBundle:Exception:exception.xml.twig")->display(array_merge($context, array("exception" => (isset($context["exception"]) ? $context["exception"] : null))));
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.atom.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 39,  86 => 6,  79 => 40,  29 => 6,  19 => 1,  23 => 3,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  126 => 46,  120 => 45,  117 => 44,  103 => 36,  74 => 27,  47 => 19,  32 => 11,  24 => 4,  22 => 3,  17 => 1,  69 => 14,  63 => 10,  58 => 9,  49 => 6,  43 => 15,  37 => 8,  20 => 2,  139 => 26,  131 => 48,  128 => 43,  125 => 42,  121 => 40,  115 => 39,  107 => 36,  99 => 34,  96 => 34,  91 => 33,  82 => 30,  77 => 39,  75 => 26,  57 => 22,  50 => 13,  46 => 14,  44 => 8,  39 => 15,  33 => 7,  30 => 4,  27 => 3,  135 => 50,  129 => 47,  122 => 46,  116 => 42,  113 => 43,  108 => 40,  104 => 38,  102 => 37,  94 => 31,  89 => 29,  87 => 32,  84 => 31,  81 => 26,  73 => 21,  70 => 26,  67 => 20,  62 => 24,  59 => 23,  55 => 8,  51 => 11,  48 => 10,  41 => 7,  38 => 8,  35 => 8,  31 => 6,  28 => 3,);
    }
}
