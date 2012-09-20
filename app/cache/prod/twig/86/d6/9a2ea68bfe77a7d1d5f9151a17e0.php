<?php

/* TwigBundle:Exception:traces.html.twig */
class __TwigTemplate_86d69a2ea68bfe77a7d1d5f9151a17e0 extends Twig_Template
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
        echo "<div class=\"block\">
    ";
        // line 2
        if (((isset($context["count"]) ? $context["count"] : null) > 0)) {
            // line 3
            echo "        <h2>
            <span><small>[";
            // line 4
            echo twig_escape_filter($this->env, (((isset($context["count"]) ? $context["count"] : null) - (isset($context["position"]) ? $context["position"] : null)) + 1), "html", null, true);
            echo "/";
            echo twig_escape_filter($this->env, ((isset($context["count"]) ? $context["count"] : null) + 1), "html", null, true);
            echo "]</small></span>
            ";
            // line 5
            echo $this->env->getExtension('code')->abbrClass($this->getAttribute((isset($context["exception"]) ? $context["exception"] : null), "class"));
            echo ": ";
            echo $this->env->getExtension('code')->formatFileFromText(strtr(twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : null), "message")), array("
" => "<br />")));
            echo "&nbsp;
            ";
            // line 6
            ob_start();
            // line 7
            echo "            <a href=\"#\" onclick=\"toggle('traces_";
            echo twig_escape_filter($this->env, (isset($context["position"]) ? $context["position"] : null), "html", null, true);
            echo "', 'traces'); switchIcons('icon_traces_";
            echo twig_escape_filter($this->env, (isset($context["position"]) ? $context["position"] : null), "html", null, true);
            echo "_open', 'icon_traces_";
            echo twig_escape_filter($this->env, (isset($context["position"]) ? $context["position"] : null), "html", null, true);
            echo "_close'); return false;\">
                <img class=\"toggle\" id=\"icon_traces_";
            // line 8
            echo twig_escape_filter($this->env, (isset($context["position"]) ? $context["position"] : null), "html", null, true);
            echo "_close\" alt=\"-\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_less.gif"), "html", null, true);
            echo "\" style=\"visibility: ";
            echo (((0 == (isset($context["count"]) ? $context["count"] : null))) ? ("display") : ("hidden"));
            echo "\" />
                <img class=\"toggle\" id=\"icon_traces_";
            // line 9
            echo twig_escape_filter($this->env, (isset($context["position"]) ? $context["position"] : null), "html", null, true);
            echo "_open\" alt=\"+\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_more.gif"), "html", null, true);
            echo "\" style=\"visibility: ";
            echo (((0 == (isset($context["count"]) ? $context["count"] : null))) ? ("hidden") : ("display"));
            echo "; margin-left: -18px\" />
            </a>
            ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            // line 12
            echo "        </h2>
    ";
        } else {
            // line 14
            echo "        <h2>Stack Trace</h2>
    ";
        }
        // line 16
        echo "
    <a id=\"traces_link_";
        // line 17
        echo twig_escape_filter($this->env, (isset($context["position"]) ? $context["position"] : null), "html", null, true);
        echo "\"></a>
    <ol class=\"traces list_exception\" id=\"traces_";
        // line 18
        echo twig_escape_filter($this->env, (isset($context["position"]) ? $context["position"] : null), "html", null, true);
        echo "\" style=\"display: ";
        echo (((0 == (isset($context["count"]) ? $context["count"] : null))) ? ("block") : ("none"));
        echo "\">
        ";
        // line 19
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["exception"]) ? $context["exception"] : null), "trace"));
        foreach ($context['_seq'] as $context["i"] => $context["trace"]) {
            // line 20
            echo "            <li>
                ";
            // line 21
            $this->env->loadTemplate("TwigBundle:Exception:trace.html.twig")->display(array("prefix" => (isset($context["position"]) ? $context["position"] : null), "i" => (isset($context["i"]) ? $context["i"] : null), "trace" => (isset($context["trace"]) ? $context["trace"] : null)));
            // line 22
            echo "            </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['i'], $context['trace'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 24
        echo "    </ol>
</div>
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:traces.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 22,  95 => 21,  88 => 19,  82 => 18,  78 => 17,  75 => 16,  71 => 14,  49 => 8,  40 => 7,  25 => 4,  92 => 20,  86 => 6,  79 => 40,  46 => 14,  37 => 8,  29 => 6,  44 => 8,  30 => 4,  33 => 7,  27 => 3,  19 => 2,  23 => 3,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  131 => 48,  126 => 46,  120 => 45,  117 => 44,  103 => 36,  99 => 34,  77 => 39,  74 => 27,  57 => 9,  47 => 19,  39 => 15,  32 => 11,  24 => 4,  22 => 3,  20 => 2,  17 => 1,  135 => 50,  129 => 47,  122 => 46,  116 => 42,  113 => 43,  108 => 40,  104 => 24,  102 => 37,  94 => 31,  89 => 29,  87 => 28,  84 => 27,  81 => 26,  73 => 21,  70 => 26,  67 => 12,  62 => 24,  59 => 23,  55 => 13,  51 => 11,  48 => 10,  41 => 7,  38 => 6,  35 => 7,  31 => 5,  28 => 3,);
    }
}
