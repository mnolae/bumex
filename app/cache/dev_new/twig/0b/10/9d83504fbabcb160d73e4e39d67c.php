<?php

/* WebProfilerBundle:Collector:memory.html.twig */
class __TwigTemplate_0b109d83504fbabcb160d73e4e39d67c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $context["icon"] = ('' === $tmp = "        <img width=\"13\" height=\"28\" alt=\"Memory Usage\" style=\"vertical-align: middle; margin-right: 5px;\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAcCAYAAAC6YTVCAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAJBJREFUeNpi/P//PwOpgImBDDAcNbE4ODiAg+/AgQOC586d+4BLoZGRkQBQ7Xt0mxQIWKCAzXkCBDQJDEBAIHOKiooicSkEBtTz0WQ0xFI5Mqevr285HrUOMAajvb09ySULk5+f3w1SNIDUMwKLsAIg256IrAECoEx6EKQJlLkkgJiDCE0/gPgF4+AuLAECDAAolCeEmdURAgAAAABJRU5ErkJggg==\"/>
    ") ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 7
        echo "    ";
        ob_start();
        // line 8
        echo "        ";
        echo twig_escape_filter($this->env, sprintf("%.0f", ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "memory") / 1024)), "html", null, true);
        echo " KB
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 10
        echo "    ";
        $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => false)));
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:memory.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  154 => 45,  150 => 43,  119 => 34,  66 => 19,  68 => 20,  65 => 22,  136 => 40,  114 => 30,  21 => 3,  76 => 39,  56 => 17,  138 => 37,  130 => 29,  106 => 26,  98 => 21,  85 => 28,  61 => 17,  36 => 8,  105 => 36,  101 => 22,  209 => 84,  205 => 82,  196 => 79,  192 => 78,  189 => 77,  178 => 71,  176 => 70,  165 => 63,  161 => 61,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  134 => 50,  132 => 49,  127 => 46,  123 => 35,  109 => 37,  93 => 33,  90 => 45,  54 => 19,  133 => 39,  124 => 41,  111 => 33,  80 => 29,  60 => 27,  52 => 15,  26 => 3,  72 => 17,  64 => 35,  53 => 23,  42 => 10,  34 => 5,  97 => 34,  95 => 47,  88 => 32,  78 => 26,  71 => 21,  40 => 9,  25 => 5,  92 => 6,  86 => 28,  79 => 20,  29 => 4,  19 => 2,  23 => 29,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  126 => 31,  120 => 23,  117 => 44,  103 => 36,  74 => 38,  47 => 11,  32 => 8,  24 => 9,  22 => 3,  17 => 1,  69 => 36,  63 => 28,  58 => 16,  49 => 16,  43 => 8,  37 => 5,  20 => 2,  139 => 26,  131 => 48,  128 => 43,  125 => 36,  121 => 40,  115 => 39,  107 => 36,  99 => 34,  96 => 34,  91 => 31,  82 => 27,  77 => 24,  75 => 18,  57 => 27,  50 => 12,  46 => 9,  44 => 14,  39 => 12,  33 => 7,  30 => 4,  27 => 3,  135 => 41,  129 => 38,  122 => 46,  116 => 33,  113 => 30,  108 => 28,  104 => 23,  102 => 6,  94 => 32,  89 => 30,  87 => 44,  84 => 28,  81 => 41,  73 => 28,  70 => 24,  67 => 17,  62 => 24,  59 => 19,  55 => 15,  51 => 17,  48 => 10,  41 => 9,  38 => 8,  35 => 6,  31 => 4,  28 => 3,);
    }
}
