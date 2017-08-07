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
        // line 55
        echo "    </head>

    ";
        // line 57
        $this->displayBlock('body', $context, $blocks);
        // line 60
        echo "
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=GTM-KRGNN9\"
        height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        ";
        // line 66
        $this->loadTemplate("partials/navigation.html.twig", "partials/base.html.twig", 66)->display($context);
        // line 67
        echo "
        <div class=\"site-wrapper\">

            ";
        // line 70
        $this->displayBlock('content', $context, $blocks);
        // line 71
        echo "
            <footer class=\"site-footer clearfix\">
                <section class=\"copyright\"><a href=\"";
        // line 73
        echo (isset($context["base_url"]) ? $context["base_url"] : null);
        echo "\">";
        echo $this->getAttribute((isset($context["site"]) ? $context["site"] : null), "title", array());
        echo "</a> &copy; 2017</section>
                <section class=\"poweredby\">Leker webbutvecklare via <a href=\"/api/leaving/?for=http://grafikprofil.se&amp;referrer=Website\" target=\"_blank\">Grafik &amp; Profil</a></section>
                <section class=\"poweredby\">Jobbar heltid som konceptutvecklare på <a href=\"/api/leaving/?for=https://digitalstrategi.se&amp;referrer=Website\" target=\"_blank\">Digital Strategi</a></section>
            </footer>
        </div>

        ";
        // line 80
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 109
        echo "
    </body>
    ";
        // line 111
        $this->displayBlock('bottom', $context, $blocks);
        // line 112
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
        echo "        ";
        // line 42
        echo "
        <script src=\"https://use.typekit.net/eho3mak.js\"></script>
        <script>try{Typekit.load({ async: true });}catch(e){}</script>

        <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" />

        ";
        // line 48
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 53
        echo "
        ";
    }

    // line 48
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 49
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "theme://css/screen.css", 1 => 101), "method");
        // line 50
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "theme://css/custom.css"), "method");
        // line 51
        echo "            ";
        echo $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "css", array(), "method");
        echo "
        ";
    }

    // line 57
    public function block_body($context, array $blocks = array())
    {
        // line 58
        echo "    <body class=\"home-template nav-closed\">
    ";
    }

    // line 70
    public function block_content($context, array $blocks = array())
    {
    }

    // line 80
    public function block_javascripts($context, array $blocks = array())
    {
        // line 81
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "jquery", 1 => 101), "method");
        // line 82
        echo "
            ";
        // line 84
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.4/isotope.pkgd.min.js"), "method");
        // line 85
        echo "
            ";
        // line 87
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.3/imagesloaded.pkgd.min.js"), "method");
        // line 88
        echo "
            ";
        // line 90
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"), "method");
        // line 91
        echo "
            ";
        // line 93
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "theme://js/index.js"), "method");
        // line 94
        echo "
            ";
        // line 96
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "theme://js/prism.js"), "method");
        // line 97
        echo "
            ";
        // line 99
        echo "            ";
        $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "theme://js/custom.js"), "method");
        // line 100
        echo "
            ";
        // line 102
        echo "            ";
        if (((($this->getAttribute((isset($context["browser"]) ? $context["browser"] : null), "getBrowser", array()) == "msie") && ($this->getAttribute((isset($context["browser"]) ? $context["browser"] : null), "getVersion", array()) >= 8)) && ($this->getAttribute((isset($context["browser"]) ? $context["browser"] : null), "getVersion", array()) <= 9))) {
            // line 103
            echo "                ";
            $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"), "method");
            // line 104
            echo "                ";
            $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "add", array(0 => "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"), "method");
            // line 105
            echo "            ";
        }
        // line 106
        echo "
            ";
        // line 107
        echo $this->getAttribute((isset($context["assets"]) ? $context["assets"] : null), "js", array(), "method");
        echo "
        ";
    }

    // line 111
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
        return array (  314 => 111,  308 => 107,  305 => 106,  302 => 105,  299 => 104,  296 => 103,  293 => 102,  290 => 100,  287 => 99,  284 => 97,  281 => 96,  278 => 94,  275 => 93,  272 => 91,  269 => 90,  266 => 88,  263 => 87,  260 => 85,  257 => 84,  254 => 82,  251 => 81,  248 => 80,  243 => 70,  238 => 58,  235 => 57,  228 => 51,  225 => 50,  222 => 49,  219 => 48,  214 => 53,  212 => 48,  204 => 42,  202 => 41,  193 => 38,  190 => 37,  157 => 35,  153 => 34,  139 => 23,  135 => 22,  131 => 21,  127 => 20,  122 => 19,  119 => 17,  113 => 15,  110 => 14,  104 => 12,  98 => 10,  96 => 9,  90 => 5,  87 => 4,  82 => 112,  80 => 111,  76 => 109,  73 => 80,  62 => 73,  58 => 71,  56 => 70,  51 => 67,  49 => 66,  41 => 60,  39 => 57,  35 => 55,  33 => 4,  28 => 2,  25 => 1,);
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
        {# <link rel=\"stylesheet\" type=\"text/css\" href=\"//fonts.googleapis.com/css?family=Merriweather:300,700,700italic,300italic|Open+Sans:700,400\" /> #}

        <script src=\"https://use.typekit.net/eho3mak.js\"></script>
        <script>try{Typekit.load({ async: true });}catch(e){}</script>

        <link rel=\"stylesheet\" type=\"text/css\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\" />

        {% block stylesheets %}
            {% do assets.add('theme://css/screen.css',101) %}
            {% do assets.add('theme://css/custom.css') %}
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
                <section class=\"copyright\"><a href=\"{{base_url}}\">{{site.title}}</a> &copy; 2017</section>
                <section class=\"poweredby\">Leker webbutvecklare via <a href=\"/api/leaving/?for=http://grafikprofil.se&amp;referrer=Website\" target=\"_blank\">Grafik &amp; Profil</a></section>
                <section class=\"poweredby\">Jobbar heltid som konceptutvecklare på <a href=\"/api/leaving/?for=https://digitalstrategi.se&amp;referrer=Website\" target=\"_blank\">Digital Strategi</a></section>
            </footer>
        </div>

        {# Footer JS #}
        {% block javascripts %}
            {% do assets.add('jquery', 101) %}

            {# Isotope #}
            {% do assets.add('https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.4/isotope.pkgd.min.js') %}

            {# ImagesLoaded #}
            {% do assets.add('https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.3/imagesloaded.pkgd.min.js') %}

            {# LazyLoad #}
            {% do assets.add('https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js') %}

            {# Main JS #}
            {% do assets.add('theme://js/index.js') %}

            {# Highlighting #}
            {% do assets.add('theme://js/prism.js') %}

            {# Custom JS #}
            {% do assets.add('theme://js/custom.js') %}

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
