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
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "datos"));
        foreach ($context['_seq'] as $context["key"] => $context["dato"]) {
            // line 25
            echo "\t        <tr>
\t            <th>";
            // line 26
            echo twig_escape_filter($this->env, $this->getContext($context, "key"), "html", null, true);
            echo "</th>
\t            <td>";
            // line 27
            echo twig_escape_filter($this->env, $this->getContext($context, "dato"), "html", null, true);
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
        return array (  91 => 30,  82 => 27,  78 => 26,  75 => 25,  71 => 24,  60 => 15,  57 => 14,  49 => 10,  43 => 7,  38 => 6,  35 => 5,  29 => 3,);
    }
}
