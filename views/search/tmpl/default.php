<?php defined('_JEXEC') or die('Restricted access'); ?>

<!--[if lte IE 6]>
<link href="/components/com_portaladv/portaladv_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php 
	if(!$this->error && $this->total > 0 && $_GET['task'] == 'search')  {
		if ($this->total == 1) {
			$propText = 'property';
		} else {
			$propText = 'properties';
		}
		echo '<span style="font-weight:normal;">Your search matched</span> <span class="search_heading_count">' . $this->total . '</span><span style="font-weight:normal;"> ' . $propText . '.</span>';
	} else {
		echo PROPERTY_SEARCH_TITLE_TEXT;
	}
	?>
</div>

<form id="adminForm" action="index.php" method="get" name="adminForm" style="padding:0px;margin:0px;">
<input type="hidden" name="option" value="com_portaladv" />
<input type="hidden" name="task" value="search" />
<input type="hidden" name="Itemid" value="<?=$_GET['Itemid']?>" />
<input type="hidden" name="limitstart" />
<div id="portaladv_filter">
<?php  echo $this->loadTemplate('filter'); ?>
</div>
<div style="width:10px;height:400px;float:left;"><!-- --></div>

<div id="portaladv_results">
<?
if ($this->params->get( 'show_startpage' ) && !isset($_GET['task'])) {
	echo $this->loadTemplate('startpage');
}
?>

<? if ($_GET['task'] =='search') {

	if(!$this->error && count($this->listings) > 0) {
		echo $this->loadTemplate('results');
	} else if (!$this->error && count($this->listings) == 0) {
		echo $this->loadTemplate('no_results');
	} else {
		echo $this->loadTemplate('error');
	}

}
?>
</div>
</form>

<!-- cleared in templates/nelson/index.php -->