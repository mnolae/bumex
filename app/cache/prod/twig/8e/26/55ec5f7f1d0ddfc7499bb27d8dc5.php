<?php

/* TwigBundle:Exception:trace.txt.twig */
class __TwigTemplate_8e2655ec5f7f1d0ddfc7499bb27d8dc5 extends Twig_Template
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
        if ($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "function")) {
            // line 2
            echo "                at ";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "class") . $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "type")) . $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "function")), "html", null, true);
            echo "(";
            echo twig_escape_filter($this->env, $this->env->getExtension('code')->formatArgsAsText($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "args")), "html", null, true);
            echo ")
";
        } else {
            // line 4
            echo "                at n/a
";
        }
        // line 6
        if (($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "file", array(), "any", true, true) && $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "line", array(), "any", true, true))) {
            // line 7
            echo "                    in ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "file"), "html", null, true);
            echo " line ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "line"), "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:trace.txt.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 7,  27 => 4,  19 => 2,  23 => 3,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  131 => 48,  126 => 46,  120 => 45,  117 => 44,  103 => 36,  99 => 34,  77 => 28,  74 => 27,  57 => 22,  47 => 19,  39 => 15,  32 => 11,  24 => 6,  22 => 3,  20 => 2,  17 => 1,  135 => 50,  129 => 47,  122 => 46,  116 => 42,  113 => 43,  108 => 40,  104 => 38,  102 => 37,  94 => 31,  89 => 29,  87 => 28,  84 => 27,  81 => 26,  73 => 21,  70 => 26,  67 => 19,  62 => 24,  59 => 23,  55 => 13,  51 => 11,  48 => 10,  41 => 9,  38 => 8,  35 => 7,  31 => 6,  28 => 3,);
    }
}
