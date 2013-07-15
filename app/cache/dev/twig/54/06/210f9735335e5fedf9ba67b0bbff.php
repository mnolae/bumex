<?php

/* BumexBasicBundle:Index:expedientes.html.twig */
class __TwigTemplate_5406210f9735335e5fedf9ba67b0bbff extends Twig_Template
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
        echo "\" title=\"Página de inicio\">Inicio</a></li>
\t<li><a href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("historial"), "html", null, true);
        echo "\" title=\"Histórico de búsquedas realizadas\">Historial</a></li>
\t<li>
\t\t<img style=\"margin-bottom: -10px;\" src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/config.png"), "html", null, true);
        echo "\" alt=\"Configuración básica\">
\t</li>
";
    }

    // line 13
    public function block_cabecera($context, array $blocks = array())
    {
        echo " 
\t<h2>Información de expedientes revisados</h2>
";
    }

    // line 17
    public function block_content($context, array $blocks = array())
    {
        // line 18
        if (($this->getContext($context, "auto") == true)) {
            // line 19
            echo "<div class=\"ui-widget\">
\t\t<div class=\"ui-state-highlight ui-corner-all\" style=\"border-color: #AACD4E; padding: 0 .7em; font-size: 14px;\">
\t\t\t<p></p>
\t\t\t<p style=\"text-align: center;\">
\t\t\t\t<img src=\"";
            // line 23
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/notification.gif"), "html", null, true);
            echo "\" style=\"margin-bottom: -6px;\" />
\t\t\t\tDatos obtenidos mediante proceso automático en base al fichero: ";
            // line 24
            echo twig_escape_filter($this->env, $this->getContext($context, "nombreFichero"), "html", null, true);
            echo "
\t\t\t</p>
\t</div>
";
        }
        // line 28
        echo "
<table>
\t<tbody>
        <tr>
        \t<th colspan=\"2\" style=\"text-align: right;\">Búsqueda realizada el ";
        // line 32
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "fbusqueda"), "r"), "html", null, true);
        echo "</th>
        </tr>
        <tr>
            <th>Día de búsqueda</th>
            <td style=\"text-align: right;\">";
        // line 36
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "fecha"), "d-m-Y"), "html", null, true);
        echo "</td>
        </tr>
\t\t<tr>
            <th>Número de edictos</th>
            <td style=\"text-align: right;\">";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "nedictos"), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <th>Número de expedientes</th>
            <td style=\"text-align: right;\">";
        // line 44
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "nexpedientes"), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <th>Número de coincidencias</th>
            <td style=\"text-align: right;\">";
        // line 48
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "ncoincidencias"), "html", null, true);
        echo "</td>
        </tr>
        <tr>
            <th>Número de teléfonos encontrados</th>
            <td style=\"text-align: right;\">";
        // line 52
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "datos"), "ntelefonos"), "html", null, true);
        echo "</td>
        </tr>
    ";
        // line 54
        if (($this->getContext($context, "conexion") == true)) {
            // line 55
            echo "        <tr>
        \t<td colspan=\"2\" class=\"ui-state-error\" style=\"border-color: #D0DBB3; text-align: center; color: #df6748; font-size: 14px;\">
        \t\t<img src=\"";
            // line 57
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/notification_red.gif"), "html", null, true);
            echo "\" style=\"margin-bottom: -6px;\" />
        \t\tSe han experimentado errores en la conexión con TESTRA y es posible que existan datos sin registrar.
        \t</td>
        </tr>
\t";
        }
        // line 62
        echo "\t";
        if (($this->getContext($context, "control") == true)) {
            // line 63
            echo "        <tr>
        \t<td colspan=\"2\" class=\"ui-state-error\" style=\"border-color: #D0DBB3; text-align: center; color: #df6748; font-size: 14px;\">
        \t\t<img src=\"";
            // line 65
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("images/notification_red.gif"), "html", null, true);
            echo "\" style=\"margin-bottom: -6px;\" />
        \t\tHay datos que requieren comprobaci&oacute;n manual detallados en 'informe.pdf'.
        \t</td>
        </tr>
\t";
        }
        // line 70
        echo "\t</tbody>
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
        return array (  160 => 70,  152 => 65,  148 => 63,  145 => 62,  137 => 57,  133 => 55,  131 => 54,  126 => 52,  119 => 48,  112 => 44,  105 => 40,  98 => 36,  91 => 32,  85 => 28,  78 => 24,  74 => 23,  68 => 19,  66 => 18,  63 => 17,  55 => 13,  48 => 9,  43 => 7,  38 => 6,  35 => 5,  29 => 3,);
    }
}
