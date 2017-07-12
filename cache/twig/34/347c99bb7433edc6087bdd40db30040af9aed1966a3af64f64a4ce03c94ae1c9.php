<?php

/* partials/navigation.html.twig */
class __TwigTemplate_29e326837fba6485d1f9c4d23d6e089b9050e6da46e6f2ff442ded6bb6523b1e extends Twig_Template
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
        echo "<input type=\"checkbox\" id=\"show-menu\" class=\"show-menu\" />
<div class=\"nav\">
    <h3 class=\"nav-title\">";
        // line 3
        echo $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate("THEME_MASONRY.MENU_TITLE");
        echo "</h3>
    <a href=\"#\" class=\"nav-close\">
        <span class=\"hidden\">Stäng</span>
    </a>
    <ul>

        ";
        // line 9
        $context["navcollection"] = $this->getAttribute((isset($context["page"]) ? $context["page"] : null), "evaluate", array(0 => array(0 => array("@page.children" => "/blog"))), "method");
        // line 10
        echo "
        ";
        // line 11
        $context["tags"] = array();
        // line 12
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["navcollection"]) ? $context["navcollection"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["post"]) {
            // line 13
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["post"], "taxonomy", array()), "tag", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                // line 14
                echo "                ";
                if (!twig_in_filter($context["tag"], (isset($context["tags"]) ? $context["tags"] : null))) {
                    // line 15
                    echo "                    ";
                    $context["tags"] = twig_array_merge((isset($context["tags"]) ? $context["tags"] : null), array(0 => $context["tag"]));
                    // line 16
                    echo "                ";
                }
                // line 17
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 18
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['post'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "
        <li class=\"nav-x ";
        // line 20
        echo (isset($context["current_page"]) ? $context["current_page"] : null);
        echo "\" role=\"presentation\"><a href=\"";
        echo $this->env->getExtension('Grav\Common\Twig\TwigExtension')->urlFunc("./");
        echo "\">Visa alla</a></li>

        ";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["tags"]) ? $context["tags"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
            // line 23
            echo "            <li class=\"nav-x ";
            echo (isset($context["current_page"]) ? $context["current_page"] : null);
            echo "\" role=\"presentation\"><a href=\"";
            echo (isset($context["base_url"]) ? $context["base_url"] : null);
            echo "/tag";
            echo $this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "system", array()), "param_sep", array());
            echo $context["tag"];
            echo "\">";
            echo twig_capitalize_string_filter($this->env, $context["tag"]);
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "
    </ul>
</div>
<span class=\"nav-cover\"></span>
";
    }

    public function getTemplateName()
    {
        return "partials/navigation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 25,  84 => 23,  80 => 22,  73 => 20,  70 => 19,  64 => 18,  58 => 17,  55 => 16,  52 => 15,  49 => 14,  44 => 13,  39 => 12,  37 => 11,  34 => 10,  32 => 9,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<input type=\"checkbox\" id=\"show-menu\" class=\"show-menu\" />
<div class=\"nav\">
    <h3 class=\"nav-title\">{{ 'THEME_MASONRY.MENU_TITLE'|t }}</h3>
    <a href=\"#\" class=\"nav-close\">
        <span class=\"hidden\">Stäng</span>
    </a>
    <ul>

        {% set navcollection = page.evaluate([{'@page.children':'/blog'}]) %}

        {% set tags = [] %}
        {% for post in navcollection %}
            {% for tag in post.taxonomy.tag %}
                {% if tag not in tags %}
                    {% set tags = tags|merge([tag]) %}
                {% endif %}
            {% endfor %}
        {% endfor %}

        <li class=\"nav-x {{ current_page }}\" role=\"presentation\"><a href=\"{{ url('./') }}\">Visa alla</a></li>

        {% for tag in tags %}
            <li class=\"nav-x {{ current_page }}\" role=\"presentation\"><a href=\"{{ base_url }}/tag{{ config.system.param_sep }}{{ tag }}\">{{ tag|capitalize }}</a></li>
        {% endfor %}

    </ul>
</div>
<span class=\"nav-cover\"></span>
", "partials/navigation.html.twig", "/var/www/public/user/themes/masonry/templates/partials/navigation.html.twig");
    }
}
