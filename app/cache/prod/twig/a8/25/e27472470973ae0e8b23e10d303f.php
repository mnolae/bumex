<?php

/* MakerLabsPagerBundle:Pager:paginate.html.twig */
class __TwigTemplate_a825e27472470973ae0e8b23e10d303f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<ul class=\"pager\">
   ";
        // line 2
        if (($this->getAttribute($this->getContext($context, "pager"), "isFirstPage") == false)) {
            echo "    
        <li class=\"first\"><a href=\"";
            // line 3
            echo $this->env->getExtension('pager')->path($this->getContext($context, "route"), $this->getAttribute($this->getContext($context, "pager"), "getFirstPage"), $this->getContext($context, "parameters"));
            echo "\">&laquo;</a></li>
        <li class=\"previous\"><a href=\"";
            // line 4
            echo $this->env->getExtension('pager')->path($this->getContext($context, "route"), $this->getAttribute($this->getContext($context, "pager"), "getPreviousPage"), $this->getContext($context, "parameters"));
            echo "\">&lsaquo;</a></li>
   ";
        }
        // line 6
        echo "   ";
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "pager"), "getPages"));
        foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
            // line 7
            echo "      ";
            if (($this->getContext($context, "page") == $this->getAttribute($this->getContext($context, "pager"), "getPage"))) {
                // line 8
                echo "        <li class=\"selected\">
            <b>";
                // line 9
                echo twig_escape_filter($this->env, $this->getContext($context, "page"), "html", null, true);
                echo "</b>
        </li>      
      ";
            } else {
                // line 12
                echo "        <li>
            <a href=\"";
                // line 13
                echo $this->env->getExtension('pager')->path($this->getContext($context, "route"), $this->getContext($context, "page"), $this->getContext($context, "parameters"));
                echo "\">";
                echo twig_escape_filter($this->env, $this->getContext($context, "page"), "html", null, true);
                echo "</a>
        </li>
      ";
            }
            // line 16
            echo "   ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        echo "  
   ";
        // line 17
        if (($this->getAttribute($this->getContext($context, "pager"), "isLastPage") == false)) {
            // line 18
            echo "        <li class=\"next\"><a href=\"";
            echo $this->env->getExtension('pager')->path($this->getContext($context, "route"), $this->getAttribute($this->getContext($context, "pager"), "getNextPage"), $this->getContext($context, "parameters"));
            echo "\">&rsaquo;</a></li>
        <li class=\"last\"><a href=\"";
            // line 19
            echo $this->env->getExtension('pager')->path($this->getContext($context, "route"), $this->getAttribute($this->getContext($context, "pager"), "getLastPage"), $this->getContext($context, "parameters"));
            echo "\">&raquo;</a></li>
   ";
        }
        // line 21
        echo "</ul>";
    }

    public function getTemplateName()
    {
        return "MakerLabsPagerBundle:Pager:paginate.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 21,  71 => 18,  69 => 17,  61 => 16,  53 => 13,  50 => 12,  44 => 9,  41 => 8,  38 => 7,  28 => 4,  24 => 3,  20 => 2,  17 => 1,  173 => 54,  156 => 51,  152 => 50,  148 => 49,  144 => 48,  140 => 47,  136 => 46,  131 => 45,  114 => 44,  98 => 30,  92 => 28,  90 => 27,  87 => 26,  84 => 25,  76 => 19,  70 => 18,  65 => 16,  58 => 13,  55 => 12,  49 => 10,  43 => 7,  39 => 6,  33 => 6,  30 => 3,);
    }
}
