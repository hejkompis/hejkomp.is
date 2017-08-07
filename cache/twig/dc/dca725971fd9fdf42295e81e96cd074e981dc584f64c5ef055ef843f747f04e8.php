<?php

/* partials/article.html.twig */
class __TwigTemplate_9c29936bf1388c3c2e99b911c043cf219d99d8089606aba54e8ebe65a50a1472 extends Twig_Template
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
        $context["url"] = ((((isset($context["base_url"]) ? $context["base_url"] : null) . "/api/leaving/?for=") . $this->getAttribute($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "header", array()), "source", array())) . "&referrer=Website");
        // line 2
        if (($this->getAttribute($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "header", array()), "image", array()) || twig_first($this->env, $this->getAttribute($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "media", array()), "images", array())))) {
            // line 3
            echo "
    ";
            // line 4
            if (twig_first($this->env, $this->getAttribute($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "media", array()), "images", array()))) {
                // line 5
                echo "        ";
                $context["image"] = twig_first($this->env, $this->getAttribute($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "media", array()), "images", array()));
                // line 6
                echo "    ";
            } elseif ($this->getAttribute($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "header", array()), "image", array())) {
                // line 7
                echo "        ";
                $context["image"] = $this->getAttribute($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "header", array()), "image", array());
                // line 8
                echo "    ";
            }
            // line 9
            echo "
";
        }
        // line 11
        echo "
<article class=\"post\" itemscope itemtype=\"http://schema.org/BlogPosting\" role=\"article\" data-category=\"
    ";
        // line 13
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "taxonomy", array()), "tag", array())) > 0)) {
            // line 14
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "taxonomy", array()), "tag", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                echo $context["tag"];
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    echo ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            echo "    ";
        }
        // line 16
        echo "\">
    ";
        // line 17
        if ((isset($context["image"]) ? $context["image"] : null)) {
            // line 18
            echo "        <figure class=\"post-image hide-on-mobile\" itemprop=\"image\">
            <a href=\"";
            // line 19
            echo (isset($context["url"]) ? $context["url"] : null);
            echo "\" target=\"_blank\" class=\"js-ajax-link\">
                <img class=\"lazy\" data-original=\"";
            // line 20
            echo $this->getAttribute($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "cropResize", array(0 => 350, 1 => 350), "method"), "url", array());
            echo "\" width=\"100%\" height=\"100%\" alt=\"\">
                <noscript>
                    <img src=\"";
            // line 22
            echo $this->getAttribute($this->getAttribute((isset($context["image"]) ? $context["image"] : null), "cropResize", array(0 => 350, 1 => 350), "method"), "url", array());
            echo "\" width=\"100%\" height=\"100%\">
                </noscript>
            </a>
        </figure>
    ";
        }
        // line 27
        echo "    <header class=\"post-header\">
        <h2 class=\"post-title\" itemprop=\"name\"><a href=\"";
        // line 28
        echo (isset($context["url"]) ? $context["url"] : null);
        echo "\" target=\"_blank\" itemprop=\"url\">";
        echo $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "title", array());
        echo "</a></h2>
    </header>
    <footer class=\"post-meta\">
        ";
        // line 31
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "taxonomy", array()), "tag", array())) > 0)) {
            // line 32
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["post"]) ? $context["post"] : null), "taxonomy", array()), "tag", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                echo "<span class=\"post-tag-";
                echo $context["tag"];
                echo "\"><a href=\"";
                echo (isset($context["base_url"]) ? $context["base_url"] : null);
                echo "/tag";
                echo $this->getAttribute($this->getAttribute((isset($context["config"]) ? $context["config"] : null), "system", array()), "param_sep", array());
                echo $context["tag"];
                echo "\">";
                echo twig_capitalize_string_filter($this->env, $context["tag"]);
                echo "</a></span>";
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    echo ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 33
            echo "        ";
        }
        // line 34
        echo "        <time class=\"post-date\" datetime=\"";
        echo twig_date_format_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "date", array()), "Y-m-d H:i");
        echo "\">";
        echo twig_date_format_filter($this->env, $this->getAttribute((isset($context["post"]) ? $context["post"] : null), "date", array()), "Y-m-d H:i");
        echo "</time>
    </footer>
</article>
";
    }

    public function getTemplateName()
    {
        return "partials/article.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  171 => 34,  168 => 33,  125 => 32,  123 => 31,  115 => 28,  112 => 27,  104 => 22,  99 => 20,  95 => 19,  92 => 18,  90 => 17,  87 => 16,  84 => 15,  50 => 14,  48 => 13,  44 => 11,  40 => 9,  37 => 8,  34 => 7,  31 => 6,  28 => 5,  26 => 4,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set url = base_url ~ \"/api/leaving/?for=\" ~ post.header.source ~ \"&referrer=Website\" %}
{% if post.header.image or page.media.images|first %}

    {% if post.media.images|first %}
        {% set image = post.media.images|first %}
    {% elseif post.header.image %}
        {% set image = post.header.image %}
    {% endif %}

{% endif %}

<article class=\"post\" itemscope itemtype=\"http://schema.org/BlogPosting\" role=\"article\" data-category=\"
    {% if post.taxonomy.tag|length > 0 %}
        {% for tag in post.taxonomy.tag %}{{tag}}{%if not loop.last %}, {% endif %}{% endfor %}
    {% endif %}
\">
    {% if image %}
        <figure class=\"post-image hide-on-mobile\" itemprop=\"image\">
            <a href=\"{{ url }}\" target=\"_blank\" class=\"js-ajax-link\">
                <img class=\"lazy\" data-original=\"{{ image.cropResize(350, 350).url }}\" width=\"100%\" height=\"100%\" alt=\"\">
                <noscript>
                    <img src=\"{{ image.cropResize(350, 350).url }}\" width=\"100%\" height=\"100%\">
                </noscript>
            </a>
        </figure>
    {% endif %}
    <header class=\"post-header\">
        <h2 class=\"post-title\" itemprop=\"name\"><a href=\"{{ url }}\" target=\"_blank\" itemprop=\"url\">{{post.title}}</a></h2>
    </header>
    <footer class=\"post-meta\">
        {% if post.taxonomy.tag|length > 0 %}
            {% for tag in post.taxonomy.tag %}<span class=\"post-tag-{{tag}}\"><a href=\"{{ base_url }}/tag{{ config.system.param_sep }}{{ tag }}\">{{ tag|capitalize }}</a></span>{%if not loop.last %}, {% endif %}{% endfor %}
        {% endif %}
        <time class=\"post-date\" datetime=\"{{ post.date | date('Y-m-d H:i') }}\">{{ post.date | date('Y-m-d H:i') }}</time>
    </footer>
</article>
", "partials/article.html.twig", "/var/www/public/user/themes/masonry/templates/partials/article.html.twig");
    }
}
