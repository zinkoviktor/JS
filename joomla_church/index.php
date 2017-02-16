<?php
/**
*@copyrightCopyright (C) 2016 Zinko Viktor
*@licenseFree
*/
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');
JHtml::_('behavior.framework', true);

$color				= $this->params->get('templatecolor');
$logo				= $this->params->get('logo');
$navposition		= $this->params->get('navposition');
$app				= JFactory::getApplication();
$doc				= JFactory::getDocument();
$templateparams		= $app->getTemplate(true)->params;

$doc->addStyleSheet($this->baseurl.'/templates/'.$this->template.'/css/main.css', $type = 'text/css');
$doc->addScript($this->baseurl.'/calendar/calendar.js', $type ='text/javascript');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<jdoc:include type="head" />
	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.min.js"></script>
	<![endif]-->
</head>
<body>
	<header>
		<nav>
			<jdoc:include type="modules" name="menu"/>
		</nav>
		<h1 class="title"><?php echo JFactory::getApplication()->getCfg('sitename'); ?></h1>
		<h2 class="title2">с.м.т.-містечко Рудне</h2>    
	</header>
	<div class="mol">
	<p>отче наш, що єси на небесах, нехай святиться ім'я Твоє, нехай прийде Царство Твоє, нехай буде воля Твоя, як на небі, так і на землі<p>
	</div>
<div class="page">
	<article>
		<div class="mod-slider" id="article-right">
			<jdoc:include type="modules" name="slider"/>
			<div class="lastnew-build">
				<jdoc:include type="modules" name="build"/>
			</div>
			<div class="lastnew-school">
				<jdoc:include type="modules" name="school"/>
			</div>
		</div>
		<div class="news">
			<jdoc:include type="modules" name="allnews"/>
			<jdoc:include type="component"/>
		</div>
		<div class="end"></div>
	</article>
	<div class="cross"><img src="images/grb.png"></div>
	<aside>
		<jdoc:include type="modules" name="aside"/>
	</aside>
	<div class="end"></div>

</div>
	<footer>
		<div class="clfoo"> 
			<jdoc:include type="modules" name="footer"/>
		</div>
		<p id="hide-button" onclick="hiden()">показати повну версію</p>
		<div class="end"></div>
	</footer>
	
<script>
function hiden(){
	document.getElementById('article-right').style.display='block';
	document.getElementById('article-right').style.maxWidth='100%';
	document.getElementById('article-right').style.float='left';
	document.getElementById('hide-button').style.display='none';
}
</script>
</body>
</html>