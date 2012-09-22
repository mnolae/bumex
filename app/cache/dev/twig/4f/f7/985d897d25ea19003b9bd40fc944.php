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
        echo "\t<div>
\t\t<label>Nombre del fichero: </label><span>";
        // line 16
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "fichero"), "nombre"), "html", null, true);
        echo "</span><br />
\t\t<label>Fecha de búsqueda: </label><span>";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "fichero"), "fecha"), "html", null, true);
        echo "</span><br />
\t\t<label>Número de datos a comparar: </label><span>";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "fichero"), "cantidad"), "html", null, true);
        echo "</span><br />
\t\t<label>Número de edictos: </label><span>";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "fichero"), "edictos"), "html", null, true);
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
        return array (  75 => 19,  71 => 18,  67 => 17,  63 => 16,  60 => 15,  57 => 14,  49 => 10,  43 => 7,  38 => 6,  35 => 5,  29 => 3,);
    }
}
