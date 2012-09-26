<?php

/* BumexBasicBundle::layout.html.twig */
class __TwigTemplate_88b956f88657195b7e17ca553f5db536 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content_header' => array($this, 'block_content_header'),
            'content_header_more' => array($this, 'block_content_header_more'),
            'cabecera' => array($this, 'block_cabecera'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/acmedemo/css/demo.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
        <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <link rel=\"shortcut icon\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />     
    </head>
    <body>
        <div id=\"symfony-wrapper\">
            <div id=\"symfony-header\">
            \t<h1>Búsqueda masiva de expedientes - Gestrafic S.L.</h1>
            </div>

            ";
        // line 15
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flash", array(0 => "notice"), "method")) {
            // line 16
            echo "                <div class=\"flash-message\">
                    <em>Notice</em>: ";
            // line 17
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flash", array(0 => "notice"), "method"), "html", null, true);
            echo "
                </div>
            ";
        }
        // line 20
        echo "
            ";
        // line 21
        $this->displayBlock('content_header', $context, $blocks);
        // line 32
        echo "            
            

            <div class=\"symfony-content\">
                ";
        // line 36
        $this->displayBlock('content', $context, $blocks);
        // line 38
        echo "            </div>

            ";
        // line 40
        if (array_key_exists("code", $context)) {
            // line 41
            echo "                <h2>Code behind this page</h2>
                <div class=\"symfony-content\">";
            // line 42
            echo $this->getContext($context, "code");
            echo "</div>
            ";
        }
        // line 44
        echo "        </div>
    </body>
</html>
";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo "Demo Bundle";
    }

    // line 21
    public function block_content_header($context, array $blocks = array())
    {
        // line 22
        echo "                <ul id=\"menu\">
                    ";
        // line 23
        $this->displayBlock('content_header_more', $context, $blocks);
        // line 26
        echo "                </ul>

                <div style=\"clear: both\"></div>
\t\t\t\t";
        // line 29
        $this->displayBlock('cabecera', $context, $blocks);
        // line 30
        echo "\t\t\t\t<img style=\"margin-bottom: -6px;\" src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/sensiodistribution/webconfigurator/images/notification.gif"), "html", null, true);
        echo "\" alt=\"Ayuda\">
            ";
    }

    // line 23
    public function block_content_header_more($context, array $blocks = array())
    {
        // line 24
        echo "                        <li><a href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("expedientes"), "html", null, true);
        echo "\">Historial</a></li>
                    ";
    }

    // line 29
    public function block_cabecera($context, array $blocks = array())
    {
    }

    // line 36
    public function block_content($context, array $blocks = array())
    {
        // line 37
        echo "                ";
    }

    public function getTemplateName()
    {
        return "BumexBasicBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  138 => 37,  135 => 36,  130 => 29,  123 => 24,  120 => 23,  113 => 30,  111 => 29,  106 => 26,  104 => 23,  101 => 22,  98 => 21,  92 => 6,  85 => 44,  80 => 42,  77 => 41,  75 => 40,  71 => 38,  69 => 36,  63 => 32,  52 => 17,  49 => 16,  36 => 7,  32 => 6,  28 => 5,  22 => 1,  82 => 23,  76 => 20,  72 => 19,  67 => 17,  61 => 21,  58 => 20,  55 => 14,  47 => 15,  41 => 7,  38 => 6,  35 => 5,  29 => 3,);
    }
}
