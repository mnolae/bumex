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
\t";
        // line 15
        $this->displayParentBlock("content_header_more", $context, $blocks);
        echo "
";
    }

    // line 18
    public function block_cabecera($context, array $blocks = array())
    {
        echo " 
\t<h2>Historial de procesos realizados</h2>
";
    }

    // line 22
    public function block_content($context, array $blocks = array())
    {
        // line 23
        echo "\t
\t";
        // line 24
        if ($this->getAttribute($this->getContext($context, "datos"), "isPaginable")) {
            // line 25
            echo "   \t\t";
            echo $this->env->getExtension('pager')->paginate($this->getContext($context, "datos"), "historial");
            echo "
\t";
        }
        // line 27
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
        // line 41
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
            // line 42
            echo "\t\t<tr style=\"text-align: right; background-color: #";
            echo twig_escape_filter($this->env, twig_cycle(array(0 => "F3F7FA", 1 => "FFFFFF"), $this->getAttribute($this->getContext($context, "loop"), "index")), "html", null, true);
            echo ";\">
\t\t\t<td style=\"text-align: center;\">";
            // line 43
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "fbusqueda"), "r"), "html", null, true);
            echo "</td>
            <td style=\"text-align: center;\">";
            // line 44
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "fecha"), "d-m-Y"), "html", null, true);
            echo "</td>
            <td>";
            // line 45
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "nedictos"), "html", null, true);
            echo "</td>
            <td>";
            // line 46
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "nexpedientes"), "html", null, true);
            echo "</td>
            <td>";
            // line 47
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "dato"), "ncoincidencias"), "html", null, true);
            echo "</td>
            <td>";
            // line 48
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
        // line 51
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
        return array (  167 => 51,  150 => 48,  146 => 47,  142 => 46,  138 => 45,  134 => 44,  130 => 43,  125 => 42,  108 => 41,  92 => 27,  86 => 25,  84 => 24,  81 => 23,  78 => 22,  70 => 18,  64 => 15,  58 => 13,  55 => 12,  49 => 10,  43 => 7,  39 => 6,  33 => 4,  30 => 3,);
    }
}
