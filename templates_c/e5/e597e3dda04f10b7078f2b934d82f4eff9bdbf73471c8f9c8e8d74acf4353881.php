<?php

/* AchievementStats.html */
class __TwigTemplate_19389e046270c9687fefd8a9508effff62520ec36b23089860caad7118ce7973 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>
\t<head>
\t<title>Die Konzertsuche für Wien und Umgebung featuring wienXtra Jugendinfo und last.fm</title>
\t</head>
\t<script type=\"text/javascript\" src=\"../lib/jquery_tablesorter/jquery-latest.js\"></script>
\t<script type=\"text/javascript\" src=\"../lib/jquery_tablesorter/jquery.tablesorter.js\"></script>
\t<script type=\"text/javascript\">
{literal}
\$.tablesorter.addParser({ 
// set a unique id 
  id: 'money', 
  is: function(s) { 
// return false so this parser is not auto detected 
    return false; 
}, 
  format: function(s) { 
// format your data for normalization 
    return s.slice(0,-1); 
}, 
// set type, either numeric or text 
  type: 'numeric' 
}); 
\$(function() {\t\t
  \$(\"#tablesorter-demo\").tablesorter({
  sortList:[[2,0]],
  headers: {3: {sorter:'money'}}
  });
});
\t</script>
\t</head>
<body>
<table id=\"tablesorter-demo\" class=\"tablesorter\">
<thead>
<tr>
  <th>Spielname</th>
  <th>SteamID</th>
  <th>Eigene Achievements</th>
  <th>Gesamt</th>
  <th>Prozentsatz</th>
</tr>
</thead>
<tbody>
";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["games"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["game"]) {
            // line 44
            echo "<tr>
  <td>";
            // line 45
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "name", array()), "html", null, true);
            echo "</td>
  <td>";
            // line 46
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "appId", array()), "html", null, true);
            echo "</td>
  <td>";
            // line 47
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "count_user_achievements", array()), "html", null, true);
            echo "</td>
  <td>";
            // line 48
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "count_games_achievements", array()), "html", null, true);
            echo "</td>
  <td style=\"text-align:right;\">";
            // line 49
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["game"], "achievement_percentage", array()), "html", null, true);
            echo "</td>
</tr>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['game'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "</body>
</html>";
    }

    public function getTemplateName()
    {
        return "AchievementStats.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  99 => 52,  90 => 49,  86 => 48,  82 => 47,  78 => 46,  74 => 45,  71 => 44,  67 => 43,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AchievementStats.html", "C:\\xampp72\\htdocs\\misc\\steam\\templates\\AchievementStats.html");
    }
}
