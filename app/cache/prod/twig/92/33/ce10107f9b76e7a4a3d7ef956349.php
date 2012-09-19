<?php

/* TwigBundle:Exception:trace.html.twig */
class __TwigTemplate_9233ce10107f9b76e7a4a3d7ef956349 extends Twig_Template
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
            echo "    at
    <strong>
        <abbr title=\"";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "class"), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "short_class"), "html", null, true);
            echo "</abbr>
        ";
            // line 5
            echo twig_escape_filter($this->env, ($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "type") . $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "function")), "html", null, true);
            echo "
    </strong>
    (";
            // line 7
            echo $this->env->getExtension('code')->formatArgs($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "args"));
            echo ")
";
        }
        // line 9
        echo "
";
        // line 10
        if (((($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "file", array(), "any", true, true) && $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "file")) && $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "line", array(), "any", true, true)) && $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "line"))) {
            // line 11
            echo "    ";
            echo (($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "function")) ? ("<br />") : (""));
            echo "
    in ";
            // line 12
            echo $this->env->getExtension('code')->formatFile($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "file"), $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "line"));
            echo "&nbsp;
    ";
            // line 13
            ob_start();
            // line 14
            echo "    <a href=\"#\" onclick=\"toggle('trace_";
            echo twig_escape_filter($this->env, (((isset($context["prefix"]) ? $context["prefix"] : null) . "_") . (isset($context["i"]) ? $context["i"] : null)), "html", null, true);
            echo "'); switchIcons('icon_";
            echo twig_escape_filter($this->env, (((isset($context["prefix"]) ? $context["prefix"] : null) . "_") . (isset($context["i"]) ? $context["i"] : null)), "html", null, true);
            echo "_open', 'icon_";
            echo twig_escape_filter($this->env, (((isset($context["prefix"]) ? $context["prefix"] : null) . "_") . (isset($context["i"]) ? $context["i"] : null)), "html", null, true);
            echo "_close'); return false;\">
        <img class=\"toggle\" id=\"icon_";
            // line 15
            echo twig_escape_filter($this->env, (((isset($context["prefix"]) ? $context["prefix"] : null) . "_") . (isset($context["i"]) ? $context["i"] : null)), "html", null, true);
            echo "_close\" alt=\"-\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_less.gif"), "html", null, true);
            echo "\" style=\"visibility: ";
            echo (((0 == (isset($context["i"]) ? $context["i"] : null))) ? ("display") : ("hidden"));
            echo "\" />
        <img class=\"toggle\" id=\"icon_";
            // line 16
            echo twig_escape_filter($this->env, (((isset($context["prefix"]) ? $context["prefix"] : null) . "_") . (isset($context["i"]) ? $context["i"] : null)), "html", null, true);
            echo "_open\" alt=\"+\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_more.gif"), "html", null, true);
            echo "\" style=\"visibility: ";
            echo (((0 == (isset($context["i"]) ? $context["i"] : null))) ? ("hidden") : ("display"));
            echo "; margin-left: -18px\" />
    </a>
    ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            // line 19
            echo "    <div id=\"trace_";
            echo twig_escape_filter($this->env, (((isset($context["prefix"]) ? $context["prefix"] : null) . "_") . (isset($context["i"]) ? $context["i"] : null)), "html", null, true);
            echo "\" style=\"display: ";
            echo (((0 == (isset($context["i"]) ? $context["i"] : null))) ? ("block") : ("none"));
            echo "\" class=\"trace\">
        ";
            // line 20
            echo $this->env->getExtension('code')->fileExcerpt($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "file"), $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "line"));
            echo "
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:trace.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 16,  64 => 15,  53 => 13,  42 => 10,  34 => 7,  97 => 22,  95 => 21,  88 => 19,  82 => 19,  78 => 17,  75 => 16,  71 => 14,  49 => 12,  40 => 7,  25 => 4,  92 => 20,  86 => 6,  79 => 40,  46 => 14,  37 => 8,  29 => 5,  44 => 11,  30 => 9,  33 => 7,  27 => 4,  19 => 2,  23 => 4,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  131 => 48,  126 => 46,  120 => 45,  117 => 44,  103 => 36,  99 => 34,  77 => 39,  74 => 27,  57 => 9,  47 => 19,  39 => 9,  32 => 11,  24 => 3,  22 => 4,  20 => 2,  17 => 1,  135 => 50,  129 => 47,  122 => 46,  116 => 42,  113 => 43,  108 => 40,  104 => 24,  102 => 37,  94 => 31,  89 => 20,  87 => 28,  84 => 27,  81 => 26,  73 => 21,  70 => 26,  67 => 12,  62 => 24,  59 => 23,  55 => 14,  51 => 11,  48 => 10,  41 => 7,  38 => 6,  35 => 7,  31 => 5,  28 => 3,);
    }
}
