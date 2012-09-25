<?php

/* SensioDistributionBundle:Configurator/Step:doctrine.html.twig */
class __TwigTemplate_b80c3f1bcae8ad536ff9c539b02ab21f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SensioDistributionBundle::Configurator/layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SensioDistributionBundle::Configurator/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Symfony - Configure database";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        echo $this->env->getExtension('form')->setTheme((isset($context["form"]) ? $context["form"] : null), array("SensioDistributionBundle::Configurator/form.html.twig", ));
        // line 7
        echo "    ";
        $this->env->loadTemplate("SensioDistributionBundle::Configurator/steps.html.twig")->display(array_merge($context, array("index" => (isset($context["index"]) ? $context["index"] : null), "count" => (isset($context["count"]) ? $context["count"] : null))));
        // line 8
        echo "
    <h1>Configure your Database</h1>
    <p>If your website needs a database connection, please configure it here.</p>

    ";
        // line 12
        echo $this->env->getExtension('form')->renderErrors((isset($context["form"]) ? $context["form"] : null));
        echo "
    <form action=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_configurator_step", array("index" => (isset($context["index"]) ? $context["index"] : null))), "html", null, true);
        echo "\" method=\"POST\">
        <div class=\"symfony-form-column\">
            ";
        // line 15
        echo $this->env->getExtension('form')->renderRow($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "driver"));
        echo "
            ";
        // line 16
        echo $this->env->getExtension('form')->renderRow($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "host"));
        echo "
            ";
        // line 17
        echo $this->env->getExtension('form')->renderRow($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "name"));
        echo "
        </div>
        <div class=\"symfony-form-column\">
            ";
        // line 20
        echo $this->env->getExtension('form')->renderRow($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "user"));
        echo "
            ";
        // line 21
        echo $this->env->getExtension('form')->renderRow($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "password"));
        echo "
        </div>

        ";
        // line 24
        echo $this->env->getExtension('form')->renderRest((isset($context["form"]) ? $context["form"] : null));
        echo "

        <div class=\"symfony-form-footer\">
            <p><input type=\"submit\" value=\"Next Step\" class=\"symfony-button-grey\" /></p>
            <p>* mandatory fields</p>
        </div>
    </form>
";
    }

    public function getTemplateName()
    {
        return "SensioDistributionBundle:Configurator/Step:doctrine.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 39,  235 => 107,  228 => 103,  221 => 99,  214 => 95,  143 => 49,  83 => 26,  332 => 137,  329 => 136,  323 => 135,  321 => 134,  314 => 133,  310 => 132,  306 => 130,  304 => 129,  301 => 128,  298 => 127,  296 => 126,  288 => 124,  286 => 123,  282 => 121,  276 => 117,  271 => 124,  262 => 121,  258 => 120,  255 => 119,  250 => 118,  248 => 117,  238 => 99,  236 => 98,  231 => 95,  229 => 94,  222 => 90,  217 => 87,  213 => 85,  207 => 91,  203 => 81,  201 => 80,  194 => 76,  183 => 69,  180 => 68,  175 => 66,  164 => 63,  118 => 36,  170 => 63,  157 => 55,  151 => 54,  140 => 48,  100 => 32,  45 => 9,  154 => 55,  150 => 43,  119 => 39,  66 => 15,  68 => 20,  65 => 17,  136 => 40,  114 => 34,  21 => 3,  76 => 25,  56 => 14,  138 => 37,  130 => 48,  106 => 35,  98 => 21,  85 => 28,  61 => 16,  36 => 6,  105 => 37,  101 => 22,  209 => 84,  205 => 82,  196 => 77,  192 => 78,  189 => 73,  178 => 71,  176 => 70,  165 => 63,  161 => 58,  152 => 58,  148 => 57,  145 => 49,  141 => 55,  134 => 50,  132 => 44,  127 => 46,  123 => 38,  109 => 36,  93 => 33,  90 => 31,  54 => 13,  133 => 49,  124 => 41,  111 => 37,  80 => 26,  60 => 16,  52 => 13,  26 => 3,  72 => 21,  64 => 35,  53 => 13,  42 => 8,  34 => 5,  97 => 26,  95 => 30,  88 => 32,  78 => 26,  71 => 20,  40 => 9,  25 => 5,  92 => 23,  86 => 30,  79 => 24,  29 => 6,  19 => 1,  23 => 29,  224 => 91,  215 => 90,  211 => 88,  204 => 84,  200 => 87,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 75,  179 => 72,  177 => 67,  171 => 67,  162 => 63,  158 => 57,  156 => 56,  153 => 59,  146 => 55,  142 => 48,  137 => 47,  126 => 39,  120 => 37,  117 => 44,  103 => 28,  74 => 21,  47 => 15,  32 => 5,  24 => 3,  22 => 3,  17 => 1,  69 => 21,  63 => 17,  58 => 16,  49 => 11,  43 => 11,  37 => 5,  20 => 2,  139 => 47,  131 => 48,  128 => 43,  125 => 41,  121 => 40,  115 => 39,  107 => 36,  99 => 33,  96 => 34,  91 => 31,  82 => 25,  77 => 23,  75 => 21,  57 => 15,  50 => 12,  46 => 11,  44 => 10,  39 => 7,  33 => 5,  30 => 4,  27 => 3,  135 => 41,  129 => 43,  122 => 46,  116 => 33,  113 => 40,  108 => 38,  104 => 40,  102 => 6,  94 => 32,  89 => 28,  87 => 44,  84 => 29,  81 => 24,  73 => 23,  70 => 21,  67 => 18,  62 => 17,  59 => 21,  55 => 14,  51 => 17,  48 => 12,  41 => 7,  38 => 8,  35 => 7,  31 => 4,  28 => 3,);
    }
}
