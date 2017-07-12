<?php

/* partials/base.html.twig */
class __TwigTemplate_e4c92adc5f7f75814dabfd35aaa087a99ea32b67453ad16b766c72aaacaa84a2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
            'bottom' => array($this, 'block_bottom'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"";
        // line 2
        echo (($this->getAttribute($this->getAttribute((isset($context["grav"]) ? $context["grav"] : null), "language", array()), "getLanguage", array())) ? ($this->getAttribute($this->getAttribute((isset($context["grav"]) ? $context["grav"] : null), "language", array()), "getLanguage", array())) : ("sv"));
        echo "\">
    <head>
        ";
        // line 4
        $this->displayBlock('head', $context, $blocks);
        // line 50
        echo "    </head>

    ";
        // line 52
        $this->displayBlock('body', $context, $blocks);
        // line 55
        echo "
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=GTM-KRGNN9\"
        height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        ";
        // line 61
        $this->loadTemplate("partials/navigation.html.twig", "partials/base.html.twig", 61)->display($context);
        // line 62
        echo "
        <div class=\"site-wrapper\">

            ";
        // line 65
        $this->displayBlock('content', $context, $blocks);
        // line 66
        echo "
            <footer class=\"site-footer clearfix\">
                <section class=\"copyright\"><a href=\"";
        // line 68
        echo (isset($context["base_url"]) ? $context["base_url"] : null);
        echo "\">";
        echo $this->getAttribute((isset($context["site"]) ? $context["site"] : null), "title", array());
        echo "</a> &copy; 2016</section>
                <section class=\"poweredby\">Proudly published with <a href=\"https://getgrav.org\">Grav</a></section>
                <section class=\"poweredby\"><a href=\"https://github.com/koca/grav-theme-masonry\">Theme</a> Ported by <a href=\"http://mesutkoca.com\">Mesut Koca</a></section>
            </footer>
        </div>

        ";
        // line 75
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 92
        echo "
    </body>
    ";
        // line 94
        $this->displayBlock('bottom', $context, $blocks);
        // line 95
        echo "</html>
";
    }

    // line 4
    public function block_head($context, array $blocks = array())
    {
        // line 5
        echo "        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"HandheldFriendly\" content=\"True\" />
        ";
        // line 9
        if ($this->getAttribute((isset($context["header"]) ? $context["header"] : null), "description", array())) {
            // line 10
            echo "        <meta name=\"description\" content=\"";
            echo $this->getAttribute((isset($context["header"]) ? $context["header"] : null), "description", array());
            echo "\">
        ";
        } else {
            // line 12
            echo "        <meta name=\"description\" content=\"";
            echo $this->getAttribute((isset($context["site"]) ? $context["site"] : null), "description", array());
            echo "\">
        ";
        }
        // line 14
        echo "        ";
        if ($this->getAttribute((isset($context["header"]) ? $context["header"] : null), "robots", array())) {
            // line 15
            echo "        <meta name=\"robots\" content=\"";
            echo $this->getAttribute((isset($context["header"]) ? $context["header"] : null), "robots", array());
            echo "\">
        ";
        }
        // line 17
        echo "
        ";
        // line 19
        echo "        <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"";
        echo (isset($context["theme_url"]) ? $context["theme_url"] : null);
        echo "/images/apple-touch-icon.png\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"";
        // line 20
        echo (isset($context["theme_url"]) ? $context["theme_url"] : null);
        echo "/images/favicon-32x32.png\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"";
        // line 21
        echo (isset($context["theme_url"]) ? $context["theme_url"] : null);
        echo "/images/favicon-16x16.png\">
        <link rel=\"manifest\" href=\"";
        // line 22
        echo (isset($context["theme_url"]) ? $context["theme_url"] : null);
        echo "/images/manifest.json\">
        <link rel=\"mask-icon\" href=\"";
        // line 23
        echo (isset($context["theme_url"]) ? $context["theme_url"] : null);
        echo "/images/safari-pinned-tab.svg\" color=\"#5bbad5\">
        <meta name=\"theme-color\" content=\"#ffffff\">

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KRGNN9');</script>
        <!-- End Google Tag Manager -->

        ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["page"]) ? $context["page"] : null), "metadata", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["meta"]) {
            // line 35
            echo "        <meta ";
            if ($this->getAttribute($context["meta"], "name", array())) {
                echo "name=\"";
                echo $this->getAttribute($context["meta"], "name", array());
                echo "\" ";
            }
            if ($this->getAttribute($context["meta"], "http_equiv", array())) {
                echo "http-equiv=\"";
                echo $this->getAttribute($context["meta"], "http_equiv", array());
                echo "\" ";
            }
            if ($this->getAttribute($context["meta"], "charset", array())) {
                echo "charset=\"";
                echo $this->getAttribute($context["meta"], "charset", array());
                echo "\" ";
            }
            if ($this->getAttribute($context["meta"], "property", array())) {
                echo "property=\"";
                echo $this->getAttribute($context["meta"], "property", array());
                echo "\" ";
            }
            if ($this->getAttribute($context["meta"], "content", array())) {
                echo "content=\"";
                echo $this->getAttribute($context["meta"], "content", array());
                echo "\" ";
            }
            echo "/>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['meta'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "
        <title>";
        // line 38
        if ($this->getAttribute((isset($context["header"]) ? $context["header"] : null), "title", array())) {
            echo $this->getAttribute((isset($context["header"]) ? $context["header"] : null), "title", array());
            echo " | ";
        }
        echo $this->getAttribute((isset($context["site"]) ? $context["site"] : null), "title", array());
        echo "</title>

        ";
        // line 41
        echo "        <link rel=\"stylesheet\" type=\"text/css\" href=\"//fonts.googleapis.com/css?family=Merriweather:300,700,700italic,300italic|Open+Sans:700,400\" />

        ";
        // line 43
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 48
        echo "
        ";
    }

    // line 43
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 44
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "theme://css/screen.css", 1 => 101), "method");
        // line 45
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "theme://css/custom.css", 1 => 101), "method");
        // line 46
        echo "            ";
        echo $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "css", array(), "method");
        echo "
        ";
    }

    // line 52
    public function block_body($context, array $blocks = array())
    {
        // line 53
        echo "    <body class=\"home-template nav-closed\">
    ";
    }

    // line 65
    public function block_content($context, array $blocks = array())
    {
    }

    // line 75
    public function block_javascripts($context, array $blocks = array())
    {
        // line 76
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "jquery", 1 => 101), "method");
        // line 77
        echo "
            ";
        // line 79
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "theme://js/index.js"), "method");
        // line 80
        echo "
            ";
        // line 82
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "theme://js/prism.js"), "method");
        // line 83
        echo "
            ";
        // line 85
        echo "            ";
        if (((($this->getAttribute((isset($context["browser"]) ? $context["browser"] : null), "getBrowser", array()) == "msie") && ($this->getAttribute((isset($context["browser"]) ? $context["browser"] : null), "getVersion", array()) >= 8)) && ($this->getAttribute((isset($context["browser"]) ? $context["browser"] : null), "getVersion", array()) <= 9))) {
            // line 86
            echo "                ";
            $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"), "method");
            // line 87
            echo "                ";
            $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"), "method");
            // line 88
            echo "            ";
        }
        // line 89
        echo "
            ";
        // line 90
        echo $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "js", array(), "method");
        echo "
        ";
    }

    // line 94
    public function block_bottom($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "partials/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  284 => 94,  278 => 90,  275 => 89,  272 => 88,  269 => 87,  266 => 86,  263 => 85,  260 => 83,  257 => 82,  254 => 80,  251 => 79,  248 => 77,  245 => 76,  242 => 75,  237 => 65,  232 => 53,  229 => 52,  222 => 46,  219 => 45,  216 => 44,  213 => 43,  208 => 48,  206 => 43,  202 => 41,  193 => 38,  190 => 37,  157 => 35,  153 => 34,  139 => 23,  135 => 22,  131 => 21,  127 => 20,  122 => 19,  119 => 17,  113 => 15,  110 => 14,  104 => 12,  98 => 10,  96 => 9,  90 => 5,  87 => 4,  82 => 95,  80 => 94,  76 => 92,  73 => 75,  62 => 68,  58 => 66,  56 => 65,  51 => 62,  49 => 61,  41 => 55,  39 => 52,  35 => 50,  33 => 4,  28 => 2,  25 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"{{ grav.language.getLanguage ?: 'sv' }}\">
    <head>
        {% block head %}
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
        <meta name=\"HandheldFriendly\" content=\"True\" />
        {% if header.description %}
        <meta name=\"description\" content=\"{{ header.description }}\">
        {% else %}
        <meta name=\"description\" content=\"{{ site.description }}\">
        {% endif %}
        {% if header.robots %}
        <meta name=\"robots\" content=\"{{ header.robots }}\">
        {% endif %}

        {# <link rel=\"icon\" type=\"image/png\" href=\"{{ theme_url }}/images/favicon.png\"> #}
        <link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"{{ theme_url }}/images/apple-touch-icon.png\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"{{ theme_url }}/images/favicon-32x32.png\">
        <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"{{ theme_url }}/images/favicon-16x16.png\">
        <link rel=\"manifest\" href=\"{{ theme_url }}/images/manifest.json\">
        <link rel=\"mask-icon\" href=\"{{ theme_url }}/images/safari-pinned-tab.svg\" color=\"#5bbad5\">
        <meta name=\"theme-color\" content=\"#ffffff\">

        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KRGNN9');</script>
        <!-- End Google Tag Manager -->

        {% for meta in page.metadata %}
        <meta {% if meta.name %}name=\"{{ meta.name }}\" {% endif %}{% if meta.http_equiv %}http-equiv=\"{{ meta.http_equiv }}\" {% endif %}{% if meta.charset %}charset=\"{{ meta.charset }}\" {% endif %}{% if meta.property %}property=\"{{ meta.property }}\" {% endif %}{% if meta.content %}content=\"{{ meta.content }}\" {% endif %}/>
        {% endfor %}

        <title>{% if header.title %}{{ header.title }} | {% endif %}{{ site.title }}</title>

        {# Fonts #}
        <link rel=\"stylesheet\" type=\"text/css\" href=\"//fonts.googleapis.com/css?family=Merriweather:300,700,700italic,300italic|Open+Sans:700,400\" />

        {% block stylesheets %}
            {% do assets.add('theme://css/screen.css',101) %}
            {% do assets.add('theme://css/custom.css',101) %}
            {{ assets.css() }}
        {% endblock %}

        {% endblock head %}
    </head>

    {% block body %}
    <body class=\"home-template nav-closed\">
    {% endblock %}

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=GTM-KRGNN9\"
        height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        {% include 'partials/navigation.html.twig' %}

        <div class=\"site-wrapper\">

            {% block content %}{% endblock %}

            <footer class=\"site-footer clearfix\">
                <section class=\"copyright\"><a href=\"{{base_url}}\">{{site.title}}</a> &copy; 2016</section>
                <section class=\"poweredby\">Proudly published with <a href=\"https://getgrav.org\">Grav</a></section>
                <section class=\"poweredby\"><a href=\"https://github.com/koca/grav-theme-masonry\">Theme</a> Ported by <a href=\"http://mesutkoca.com\">Mesut Koca</a></section>
            </footer>
        </div>

        {# Footer JS #}
        {% block javascripts %}
            {% do assets.add('jquery', 101) %}

            {# Main JS #}
            {% do assets.add('theme://js/index.js') %}

            {# Highlighting #}
            {% do assets.add('theme://js/prism.js') %}

            {# ... #}
            {% if browser.getBrowser == 'msie' and browser.getVersion >= 8 and browser.getVersion <= 9 %}
                {% do assets.add('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') %}
                {% do assets.add('https://oss.maxcdn.com/respond/1.4.2/respond.min.js') %}
            {% endif %}

            {{ assets.js() }}
        {% endblock %}

    </body>
    {% block bottom %}{% endblock %}
</html>
", "partials/base.html.twig", "/var/www/public/user/themes/masonry/templates/partials/base.html.twig");
    }
}
