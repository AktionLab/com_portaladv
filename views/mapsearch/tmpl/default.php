<?php defined('_JEXEC') or die('Restricted access'); ?>

<link rel="stylesheet" href="components/com_portaladv/portaladv.css">

<!--[if gte IE 6]>
<link rel="stylesheet" href="components/com_portaladv/portaladv_ie7.css">
<![endif]-->

<div id="portaladv_mapsearch">
	<form id="mapSearchForm" style="margin:0px;padding:0px;" action="<?php echo JRoute::_( 'index.php?option=com_portaladv&view=mapsearch&task=mapsearch' );?>" method="post" name="mapSearchForm">
		<div id="portaladv_map_search_form">
		<?php  echo $this->loadTemplate('form'); ?>
		</div>
	</form>
	<div id="portaladv_map">
	<? echo $this->loadTemplate('map'); ?>
	</div>
</div>
