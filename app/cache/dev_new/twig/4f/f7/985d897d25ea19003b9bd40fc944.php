<?php

/* BumexBasicBundle:Index:expedientes.html.twig */
class __TwigTemplate_4ff7985d897d25ea19003b9bd40fc944 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("BumexBasicBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content_header_more' => array($this, 'block_content_header_more'),
            'cabecera' => array($this, 'block_cabecera'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "BumexBasicBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Expedientes";
    }

    // line 5
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 6
        echo "\t<li><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("index"), "html", null, true);
        echo "\">Inicio</a></li>
\t<li><a href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("historial"), "html", null, true);
        echo "\">Historial</a></li>
";
    }

    // line 10
    public function block_cabecera($context, array $blocks = array())
    {
        echo " 
\t<h2>Información de expedientes revisados</h2>
";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "
\t<table>
\t<thead>
\t    <tr>
\t        <th scope=\"col\">Dato</th>
\t        <th scope=\"col\">Valor</th>
\t    </tr>
\t</thead>
\t<tbody>
\t    ";
        // line 24
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["datos"]) ? $context["datos"] : null));
        foreach ($context['_seq'] as $context["key"] => $context["dato"]) {
            // line 25
            echo "\t        <tr>
\t            <th>";
            // line 26
            echo twig_escape_filter($this->env, (isset($context["key"]) ? $context["key"] : null), "html", null, true);
            echo "</th>
\t            <td>";
            // line 27
            echo twig_escape_filter($this->env, (isset($context["dato"]) ? $context["dato"] : null), "html", null, true);
            echo "</td>
\t        </tr>
\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['key'], $context['dato'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 30
        echo "\t</tbody>
\t</table>
    
\t<div>
\t\t<label>Nombre del fichero: </label><span>";
        // line 34
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), "nombre"), "html", null, true);
        echo "</span><br />
\t\t<label>Fecha de búsqueda: </label><span>";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), "fecha"), "html", null, true);
        echo "</span><br />
\t\t<label>Número de datos a comparar: </label><span>";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), "cantidad"), "html", null, true);
        echo "</span><br />
\t\t<label>Número de edictos: </label><span>";
        // line 37
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), "edictos"), "html", null, true);
        echo "</span><br />
\t\t<label>Número de expedientes: </label><span>";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["datos"]) ? $context["datos"] : null), "expedientes"), "html", null, true);
        echo "</span><br />
\t</div>
";
    }

    public function getTemplateName()
    {
        return "BumexBasicBundle:Index:expedientes.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 36,  101 => 35,  209 => 84,  205 => 82,  196 => 79,  192 => 78,  189 => 77,  178 => 71,  176 => 70,  165 => 63,  161 => 61,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  134 => 50,  132 => 49,  127 => 46,  123 => 44,  109 => 37,  93 => 33,  90 => 32,  54 => 14,  133 => 44,  124 => 41,  111 => 37,  80 => 26,  60 => 15,  52 => 12,  26 => 3,  72 => 16,  64 => 15,  53 => 13,  42 => 7,  34 => 11,  97 => 34,  95 => 21,  88 => 29,  78 => 26,  71 => 24,  40 => 7,  25 => 4,  92 => 20,  86 => 28,  79 => 40,  29 => 3,  19 => 2,  23 => 3,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  126 => 46,  120 => 39,  117 => 44,  103 => 36,  74 => 27,  47 => 15,  32 => 11,  24 => 3,  22 => 2,  17 => 1,  69 => 20,  63 => 18,  58 => 9,  49 => 10,  43 => 7,  37 => 8,  20 => 2,  139 => 26,  131 => 48,  128 => 43,  125 => 42,  121 => 40,  115 => 39,  107 => 36,  99 => 34,  96 => 34,  91 => 30,  82 => 27,  77 => 25,  75 => 25,  57 => 14,  50 => 13,  46 => 10,  44 => 11,  39 => 5,  33 => 5,  30 => 4,  27 => 9,  135 => 50,  129 => 47,  122 => 46,  116 => 42,  113 => 38,  108 => 40,  104 => 24,  102 => 37,  94 => 33,  89 => 20,  87 => 32,  84 => 28,  81 => 26,  73 => 21,  70 => 26,  67 => 19,  62 => 24,  59 => 23,  55 => 14,  51 => 13,  48 => 10,  41 => 9,  38 => 6,  35 => 5,  31 => 10,  28 => 3,);
    }
}
