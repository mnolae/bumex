<?php

/* WebProfilerBundle:Collector:timer.html.twig */
class __TwigTemplate_a798ec0ccbba5b955aa228b7c4806788 extends Twig_Template
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
        $context["icon"] = ('' === $tmp = "        <img width=\"16\" height=\"28\" alt=\"Timers\" style=\"vertical-align: middle; margin-right: 5px;\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAiNJREFUeNpi/P//PwMlgImBQjDwBrCcO3cOq0RRUdF3ZH5fXx8nTVzAePbsWcq8gMwxMjJiSUlJcXv9+nXm169fbf78+SMAVsTC8paXl3ePmJjYjJkzZx4GevsviheAGhmBguL+/v4779y5s/Xjx48+MM0gAGQLv3//PvzmzZv7AwMD19y+fVsEpAfsBWBCYly8eLHcsmXLjnz//l2GGGcDXXM1IyPD2dvb+xXIBTwbN25chU3zgQMHwBgdfP78WXvp0qVzgUwuprq6utg3b96YkRp4z549854wYYI7071791LJjYFLly7lM7148UKHXAOALtdnAYYwCyGFyOHg4OAAZ3/69ImfopTIzMz8j4WVlfXf79+/sRqEbBs2wMfH94tJXV39DbkuUFFReclkb29/jlwDPD09jzGFhoZu0NTU/EKqZktLyzdOTk7bQX4/U1tbu1pcXPwvsZoVFBR+lZeXLwUyz4MMuCMlJbWmv79/o56e3k9Cms3MzL5PmjRphYCAwCYg9wE4MwEZwkBsDsReO3fudN+zZ4/shQsX2ICxA9bEzs7OYGBg8NPHx+eBra3tdqDQVpDLgfgjuEABZk2QS3hBAQvExkBsAHIpMAsLAOP6PzC63gP590FOBmJQCXQPiL8Ai4D/KCUS0CBWIAUqB8SAWAiIQeUgqOIAlY/vgPgVEH8AavyDtUQCSoDc/BqEoQUGLIH9A9mGtUwc8JoJIMAAS9XemfR7crQAAAAASUVORK5CYII=\"/>
    ") ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 7
        echo "    ";
        ob_start();
        // line 8
        echo "        ";
        echo twig_escape_filter($this->env, sprintf("%.0f", ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "time") * 1000)), "html", null, true);
        echo " ms
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 10
        echo "    ";
        $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => false)));
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:timer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  235 => 107,  228 => 103,  221 => 99,  214 => 95,  143 => 49,  83 => 26,  332 => 137,  329 => 136,  323 => 135,  321 => 134,  314 => 133,  310 => 132,  306 => 130,  304 => 129,  301 => 128,  298 => 127,  296 => 126,  288 => 124,  286 => 123,  282 => 121,  276 => 117,  271 => 124,  262 => 121,  258 => 120,  255 => 119,  250 => 118,  248 => 117,  238 => 99,  236 => 98,  231 => 95,  229 => 94,  222 => 90,  217 => 87,  213 => 85,  207 => 91,  203 => 81,  201 => 80,  194 => 76,  183 => 69,  180 => 68,  175 => 66,  164 => 63,  118 => 36,  170 => 63,  157 => 55,  151 => 54,  140 => 48,  100 => 32,  45 => 9,  154 => 55,  150 => 43,  119 => 39,  66 => 15,  68 => 19,  65 => 18,  136 => 40,  114 => 34,  21 => 3,  76 => 39,  56 => 14,  138 => 37,  130 => 48,  106 => 35,  98 => 21,  85 => 28,  61 => 17,  36 => 8,  105 => 36,  101 => 22,  209 => 84,  205 => 82,  196 => 77,  192 => 78,  189 => 73,  178 => 71,  176 => 70,  165 => 63,  161 => 58,  152 => 58,  148 => 57,  145 => 49,  141 => 55,  134 => 50,  132 => 44,  127 => 46,  123 => 38,  109 => 36,  93 => 33,  90 => 36,  54 => 13,  133 => 49,  124 => 41,  111 => 37,  80 => 25,  60 => 16,  52 => 13,  26 => 3,  72 => 17,  64 => 35,  53 => 23,  42 => 10,  34 => 5,  97 => 26,  95 => 30,  88 => 32,  78 => 26,  71 => 20,  40 => 9,  25 => 5,  92 => 23,  86 => 27,  79 => 28,  29 => 4,  19 => 2,  23 => 29,  224 => 91,  215 => 90,  211 => 88,  204 => 84,  200 => 87,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 75,  179 => 72,  177 => 67,  171 => 67,  162 => 63,  158 => 57,  156 => 56,  153 => 59,  146 => 55,  142 => 48,  137 => 47,  126 => 39,  120 => 37,  117 => 44,  103 => 28,  74 => 21,  47 => 11,  32 => 6,  24 => 3,  22 => 3,  17 => 1,  69 => 21,  63 => 28,  58 => 16,  49 => 12,  43 => 10,  37 => 5,  20 => 2,  139 => 47,  131 => 48,  128 => 43,  125 => 41,  121 => 40,  115 => 39,  107 => 36,  99 => 34,  96 => 34,  91 => 31,  82 => 20,  77 => 22,  75 => 18,  57 => 27,  50 => 12,  46 => 11,  44 => 10,  39 => 12,  33 => 7,  30 => 4,  27 => 3,  135 => 41,  129 => 43,  122 => 46,  116 => 33,  113 => 43,  108 => 28,  104 => 40,  102 => 6,  94 => 32,  89 => 28,  87 => 44,  84 => 29,  81 => 29,  73 => 23,  70 => 24,  67 => 17,  62 => 22,  59 => 21,  55 => 14,  51 => 17,  48 => 10,  41 => 9,  38 => 8,  35 => 7,  31 => 4,  28 => 3,);
    }
}
