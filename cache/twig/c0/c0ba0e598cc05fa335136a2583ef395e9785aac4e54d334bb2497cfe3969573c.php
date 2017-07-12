<?php

/* partials/header.html.twig */
class __TwigTemplate_57fd264299e188ed6da61e8cb77c04742e3ec384afddb9d0b261103a13b8e8ca extends Twig_Template
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
        echo "<header class=\"main-header post-head ";
        if ($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "header", array()), "image", array())) {
            echo "\" style=\"background-image: url(";
            echo $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "media", array()), $this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "header", array()), "image", array()), array(), "array"), "url", array());
            echo ")";
        } else {
            echo "no-cover";
        }
        echo "\">
    <nav class=\"main-nav ";
        // line 2
        if ($this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "header", array()), "image", array())) {
            echo "overlay";
        }
        echo " clearfix\">
        ";
        // line 3
        if ($this->getAttribute((isset($context["site"]) ? $context["site"] : null), "logo", array())) {
            // line 4
            echo "            <a class=\"blog-logo\" href=\"";
            echo (isset($context["base_url"]) ? $context["base_url"] : null);
            echo "\"><img src=\"";
            echo (isset($context["theme_url"]) ? $context["theme_url"] : null);
            echo "/images/";
            echo $this->getAttribute((isset($context["site"]) ? $context["site"] : null), "logo", array());
            echo "\" alt=\"";
            echo $this->getAttribute($this->getAttribute((isset($context["site"]) ? $context["site"] : null), "author", array()), "title", array());
            echo "\" /></a>
        ";
        }
        // line 6
        echo "        <a class=\"menu-button icon-menu\" href=\"#\"><span class=\"word\">";
        echo $this->env->getExtension('Grav\Common\Twig\TwigExtension')->translate("THEME_MASONRY.MENU_TITLE");
        echo "</span></a>
    </nav>
</header>
";
    }

    public function getTemplateName()
    {
        return "partials/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 6,  38 => 4,  36 => 3,  30 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<header class=\"main-header post-head {% if page.header.image %}\" style=\"background-image: url({{ page.media[page.header.image].url }}){% else %}no-cover{% endif %}\">
    <nav class=\"main-nav {% if page.header.image %}overlay{% endif %} clearfix\">
        {% if site.logo %}
            <a class=\"blog-logo\" href=\"{{base_url}}\"><img src=\"{{ theme_url }}/images/{{site.logo}}\" alt=\"{{ site.author.title}}\" /></a>
        {% endif %}
        <a class=\"menu-button icon-menu\" href=\"#\"><span class=\"word\">{{ 'THEME_MASONRY.MENU_TITLE'|t }}</span></a>
    </nav>
</header>
", "partials/header.html.twig", "/var/www/public/user/themes/masonry/templates/partials/header.html.twig");
    }
}
