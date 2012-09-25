<?php

/* WebProfilerBundle:Collector:events.html.twig */
class __TwigTemplate_f514b4114894fe63640456da7b39895c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["__internal_e11d7560d6f9a1fa71452534942e80abb0f44286"] = $this;
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/events.png"), "html", null, true);
        echo "\" alt=\"Events\" /></span>
    <strong>Events</strong>
</span>
";
    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        // line 13
        echo "    <h2>Called Listeners</h2>

    <table>
        <tr>
            <th>Event name</th>
            <th>Listener</th>
        </tr>
        ";
        // line 20
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "calledlisteners"));
        foreach ($context['_seq'] as $context["_key"] => $context["listener"]) {
            // line 21
            echo "            <tr>
                <td><code>";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "event"), "html", null, true);
            echo "</code></td>
                <td><code>";
            // line 23
            echo $context["__internal_e11d7560d6f9a1fa71452534942e80abb0f44286"]->getdisplay_listener((isset($context["listener"]) ? $context["listener"] : null));
            echo "</code></td>
            </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['listener'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 26
        echo "    </table>

    ";
        // line 28
        if ($this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "notcalledlisteners")) {
            // line 29
            echo "        <h2>Not Called Listeners</h2>

        <table>
            <tr>
                <th>Event name</th>
                <th>Listener</th>
            </tr>
            ";
            // line 36
            $context["listeners"] = $this->getAttribute((isset($context["collector"]) ? $context["collector"] : null), "notcalledlisteners");
            // line 37
            echo "            ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable(twig_sort_filter(twig_get_array_keys_filter((isset($context["listeners"]) ? $context["listeners"] : null))));
            foreach ($context['_seq'] as $context["_key"] => $context["listener"]) {
                // line 38
                echo "                <tr>
                    <td><code>";
                // line 39
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["listeners"]) ? $context["listeners"] : null), (isset($context["listener"]) ? $context["listener"] : null), array(), "array"), "event"), "html", null, true);
                echo "</code></td>
                    <td><code>";
                // line 40
                echo $context["__internal_e11d7560d6f9a1fa71452534942e80abb0f44286"]->getdisplay_listener($this->getAttribute((isset($context["listeners"]) ? $context["listeners"] : null), (isset($context["listener"]) ? $context["listener"] : null), array(), "array"));
                echo "</code></td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['listener'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 43
            echo "        </table>
    ";
        }
    }

    // line 47
    public function getdisplay_listener($listener = null)
    {
        $context = $this->env->mergeGlobals(array(
            "listener" => $listener,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 48
            echo "    ";
            if (($this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "type") == "Closure")) {
                // line 49
                echo "        Closure
    ";
            } elseif (($this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "type") == "Function")) {
                // line 51
                echo "        ";
                $context["link"] = $this->env->getExtension('code')->getFileLink($this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "file"), $this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "line"));
                // line 52
                echo "        ";
                if ((isset($context["link"]) ? $context["link"] : null)) {
                    echo "<a href=\"";
                    echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "function"), "html", null, true);
                    echo "</a>";
                } else {
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "function"), "html", null, true);
                }
                // line 53
                echo "    ";
            } elseif (($this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "type") == "Method")) {
                // line 54
                echo "        ";
                $context["link"] = $this->env->getExtension('code')->getFileLink($this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "file"), $this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "line"));
                // line 55
                echo "        ";
                echo $this->env->getExtension('code')->abbrClass($this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "class"));
                echo "::";
                if ((isset($context["link"]) ? $context["link"] : null)) {
                    echo "<a href=\"";
                    echo twig_escape_filter($this->env, (isset($context["link"]) ? $context["link"] : null), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "method"), "html", null, true);
                    echo "</a>";
                } else {
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["listener"]) ? $context["listener"] : null), "method"), "html", null, true);
                }
                // line 56
                echo "    ";
            }
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:events.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 56,  157 => 55,  151 => 53,  140 => 52,  100 => 39,  45 => 9,  154 => 54,  150 => 43,  119 => 47,  66 => 23,  68 => 20,  65 => 22,  136 => 40,  114 => 30,  21 => 3,  76 => 39,  56 => 14,  138 => 37,  130 => 48,  106 => 26,  98 => 21,  85 => 28,  61 => 17,  36 => 5,  105 => 36,  101 => 22,  209 => 84,  205 => 82,  196 => 79,  192 => 78,  189 => 77,  178 => 71,  176 => 70,  165 => 63,  161 => 61,  152 => 58,  148 => 57,  145 => 56,  141 => 55,  134 => 50,  132 => 49,  127 => 46,  123 => 35,  109 => 37,  93 => 33,  90 => 36,  54 => 13,  133 => 49,  124 => 41,  111 => 33,  80 => 29,  60 => 16,  52 => 15,  26 => 3,  72 => 17,  64 => 35,  53 => 23,  42 => 8,  34 => 5,  97 => 38,  95 => 47,  88 => 32,  78 => 26,  71 => 21,  40 => 9,  25 => 5,  92 => 37,  86 => 28,  79 => 28,  29 => 5,  19 => 2,  23 => 29,  224 => 96,  215 => 90,  211 => 88,  204 => 84,  200 => 83,  195 => 80,  193 => 79,  190 => 78,  188 => 77,  185 => 76,  179 => 72,  177 => 71,  171 => 67,  162 => 63,  158 => 61,  156 => 60,  153 => 59,  146 => 55,  142 => 54,  137 => 51,  126 => 31,  120 => 23,  117 => 44,  103 => 36,  74 => 38,  47 => 11,  32 => 6,  24 => 3,  22 => 3,  17 => 1,  69 => 21,  63 => 28,  58 => 16,  49 => 16,  43 => 12,  37 => 5,  20 => 2,  139 => 26,  131 => 48,  128 => 43,  125 => 36,  121 => 40,  115 => 39,  107 => 36,  99 => 34,  96 => 34,  91 => 31,  82 => 27,  77 => 24,  75 => 26,  57 => 27,  50 => 12,  46 => 13,  44 => 14,  39 => 12,  33 => 7,  30 => 4,  27 => 3,  135 => 41,  129 => 38,  122 => 46,  116 => 33,  113 => 43,  108 => 28,  104 => 40,  102 => 6,  94 => 32,  89 => 30,  87 => 44,  84 => 29,  81 => 29,  73 => 23,  70 => 24,  67 => 17,  62 => 22,  59 => 21,  55 => 20,  51 => 17,  48 => 10,  41 => 9,  38 => 8,  35 => 7,  31 => 4,  28 => 3,);
    }
}
