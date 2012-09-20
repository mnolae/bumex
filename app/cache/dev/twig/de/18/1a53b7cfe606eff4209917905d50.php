<?php

/* GbmIndexBundle:Index:index.html.twig */
class __TwigTemplate_de181a53b7cfe606eff4209917905d50 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("GbmIndexBundle::layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content_header_more' => array($this, 'block_content_header_more'),
            'cabecera' => array($this, 'block_cabecera'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "GbmIndexBundle::layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Inicio";
    }

    // line 5
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 6
        echo "\t<li>Inicio</li>
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
\t<h2>Carga de datos</h2>
";
    }

    // line 14
    public function block_content($context, array $blocks = array())
    {
        // line 15
        echo "
\t<form action=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("expedientes"), "html", null, true);
        echo "\" method=\"POST\" id=\"frm_fichero\" ";
        echo $this->env->getExtension('form')->renderEnctype($this->getContext($context, "form"));
        echo ">
        ";
        // line 17
        echo $this->env->getExtension('form')->renderErrors($this->getContext($context, "form"));
        echo "

        ";
        // line 19
        echo $this->env->getExtension('form')->renderRow($this->getAttribute($this->getContext($context, "form"), "file"));
        echo "
        ";
        // line 20
        echo $this->env->getExtension('form')->renderRow($this->getAttribute($this->getContext($context, "form"), "fecha"));
        echo "
        

        ";
        // line 23
        echo $this->env->getExtension('form')->renderRest($this->getContext($context, "form"));
        echo "
        <br /><input type=\"submit\" value=\"Cargar\" class=\"symfony-button-grey\" />
    </form>
";
    }

    public function getTemplateName()
    {
        return "GbmIndexBundle:Index:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 23,  76 => 20,  72 => 19,  67 => 17,  61 => 16,  58 => 15,  55 => 14,  47 => 10,  41 => 7,  38 => 6,  35 => 5,  29 => 3,);
    }
}