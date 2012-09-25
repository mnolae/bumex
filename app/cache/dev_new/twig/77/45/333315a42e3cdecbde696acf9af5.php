<?php

/* WebProfilerBundle:Profiler:header.html.twig */
class __TwigTemplate_7745333315a42e3cdecbde696acf9af5 extends Twig_Template
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
        echo "<div id=\"header\" class=\"clear_fix\">
    <h1>
        <img src=\"";
        // line 3
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/logo_symfony_profiler.gif"), "html", null, true);
        echo "\" alt=\"Symfony profiler\"/>
    </h1>

    <div class=\"search\">
        <form method=\"get\" action=\"http://symfony.com/search\">
            <div class=\"form_row\">
                <label for=\"search_id\">
                    <img src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/grey_magnifier.png"), "html", null, true);
        echo "\" alt=\"Search on Symfony website\"/>
                </label>

                <input name=\"q\" id=\"search_id\" type=\"search\" placeholder=\"Search on Symfony website\"/>

                <button type=\"submit\">
                    <span class=\"border_l\">
                        <span class=\"border_r\">
                            <span class=\"btn_bg\">OK</span>
                        </span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 21,  68 => 22,  65 => 22,  136 => 40,  114 => 30,  21 => 3,  76 => 39,  56 => 17,  138 => 37,  130 => 29,  106 => 26,  98 => 21,  85 => 31,  61 => 28,  36 => 6,  105 => 36,  101 => 22,  209 => 84,  205 => 82,  196 => 79,  192 => 78,  189 => 77,  178 => 71,  176 => 70,  165 => 63,  161 => 61,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  134 => 50,  132 => 49,  127 => 46,  123 => 30,  109 => 37,  93 => 33,  90 => 45,  54 => 19,  133 => 39,  124 => 41,  111 => 29,  80 => 29,  60 => 20,  52 => 15,  26 => 5,  72 => 19,  64 => 35,  53 => 13,  42 => 7,  34 => 11,  97 => 34,  95 => 47,  88 => 32,  78 => 26,  71 => 37,  40 => 8,  25 => 5,  92 => 6,  86 => 28,  79 => 39,  29 => 4,  19 => 2,  23 => 29,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  126 => 31,  120 => 23,  117 => 44,  103 => 36,  74 => 38,  47 => 17,  32 => 8,  24 => 9,  22 => 3,  17 => 1,  69 => 36,  63 => 32,  58 => 15,  49 => 16,  43 => 8,  37 => 5,  20 => 2,  139 => 26,  131 => 48,  128 => 43,  125 => 42,  121 => 40,  115 => 39,  107 => 36,  99 => 34,  96 => 34,  91 => 30,  82 => 43,  77 => 25,  75 => 37,  57 => 27,  50 => 10,  46 => 9,  44 => 14,  39 => 12,  33 => 9,  30 => 7,  27 => 6,  135 => 36,  129 => 47,  122 => 46,  116 => 33,  113 => 30,  108 => 28,  104 => 23,  102 => 6,  94 => 33,  89 => 20,  87 => 44,  84 => 28,  81 => 41,  73 => 28,  70 => 24,  67 => 17,  62 => 24,  59 => 19,  55 => 19,  51 => 23,  48 => 10,  41 => 7,  38 => 11,  35 => 7,  31 => 10,  28 => 7,);
    }
}
