<?php

/* BumexBasicBundle:Index:historial.html.twig */
class __TwigTemplate_0099e166c9d9b7e7cf939ced7b938684 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("BumexBasicBundle::layout.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
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
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    <link href=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/makerlabspager/css/clean.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
    <link href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/makerlabspager/css/round.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
";
    }

    // line 10
    public function block_title($context, array $blocks = array())
    {
        echo "Historial";
    }

    // line 12
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 13
        echo "\t<li><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("index"), "html", null, true);
        echo "\" title=\"Página de inicio\">Inicio</a></li>
\t<li>Historial</li>
\t<li>
\t\t<img style=\"margin-bottom: -10px;\" src=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/config.png"), "html", null, true);
        echo "\" alt=\"Configuración básica\">
    </li>
\t";
        // line 18
        $this->displayParentBlock("content_header_more", $context, $blocks);
        echo "
";
    }

    // line 21
    public function block_cabecera($context, array $blocks = array())
    {
        echo " 
\t<h2>Historial de procesos realizados</h2>
";
    }

    // line 25
    public function block_content($context, array $blocks = array())
    {
        // line 26
        echo "\t
\t";
        // line 27
        if ($this->getAttribute($this->getContext($context, "datos"), "isPaginable")) {
            // line 28
            echo "   \t\t";
            echo $this->env->getExtension('pager')->paginate($this->getContext($context, "datos"), "historial");
            echo "
\t";
        }
        // line 30
        echo "
\t<table>
\t<thead>
\t    <tr>
\t    \t<th scope=\"col\">Fecha de búsqueda</th>
\t        <th scope=\"col\">Día</th>
\t        <th scope=\"col\">Edictos</th>
\t        <th scope=\"col\">Expedientes</th>
\t        <th scope=\"col\">Coincidencias</th>
\t        <th scope=\"col\">Teléfonos</th>
\t    </tr>
\t</thead>
\t<tbody>
\t
\t";
        // line 44
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "datos"), "getResults"));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["dato"]) {
            // line 45
            echo "\t\t<tr style=\"text-align: right; background-color: #";
            echo twig_escape_filter($this->env, twig_cycle(array(0 => "F3F7FA", 1 => "FFFFFF"), $this->getAttribute($this->getContext($context, "loop"), "index")), "html", null, true);
            echo ";\">
\t\t\t<td style=\"text-align: center;\">";
            // line 46
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "fbusqueda"), "d/m/Y H:i:s"), "html", null, true);
            echo "</td>
            <td style=\"text-align: center;\">";
            // line 47
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "fecha"), "d-m-Y"), "html", null, true);
            echo "</td>
            <td>";
            // line 48
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "nedictos"), "html", null, true);
            echo "</td>
            <td>";
            // line 49
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "nexpedientes"), "html", null, true);
            echo "</td>
            <td>";
            // line 50
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "ncoincidencias"), "html", null, true);
            echo "</td>
            <td>";
            // line 51
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "ntelefonos"), "html", null, true);
            echo "</td>
\t\t</tr>
\t";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['dato'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 54
        echo "
\t</tbody>
\t</table>

";
    }

    public function getTemplateName()
    {
        return "BumexBasicBundle:Index:historial.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  173 => 54,  156 => 51,  152 => 50,  148 => 49,  144 => 48,  140 => 47,  136 => 46,  131 => 45,  114 => 44,  98 => 30,  92 => 28,  90 => 27,  87 => 26,  84 => 25,  76 => 21,  70 => 18,  65 => 16,  58 => 13,  55 => 12,  49 => 10,  43 => 7,  39 => 6,  33 => 4,  30 => 3,);
    }
}
