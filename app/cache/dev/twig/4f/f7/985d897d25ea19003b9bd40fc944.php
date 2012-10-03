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
<table>
\t<tbody>
        <tr>
        \t<th colspan=\"2\" style=\"text-align: right;\">Búsqueda realizada el ";
        // line 19
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "fbusqueda"), "r"), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th>Día de búsqueda</th>
            <td>";
        // line 23
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "fecha"), "d-m-Y"), "html", null, true);
        echo "</td>
        </tr>
\t\t<tr>
            <th>Número de edictos</th>
            <td>";
        // line 27
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "nedictos"), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <th>Número de expedientes</th>
            <td>";
        // line 31
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "nexpedientes"), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <th>Número de coincidencias</th>
            <td>";
        // line 35
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "ncoincidencias"), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <th>Número de teléfonos encontrados</th>
            <td>";
        // line 39
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "ntelefonos"), "html", null, true);
        echo "</td>
        </tr>
\t</tbody>
</table>
    
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
        return array (  101 => 39,  94 => 35,  87 => 31,  80 => 27,  73 => 23,  66 => 19,  60 => 15,  57 => 14,  49 => 10,  43 => 7,  38 => 6,  35 => 5,  29 => 3,);
    }
}
