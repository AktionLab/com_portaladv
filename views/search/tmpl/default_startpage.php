<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php echo PROPERTY_SEARCH_INTRO_TEXT; ?>

<?php
$db =& JFactory::getDBO();
$query = 'SELECT field_value FROM #__js_res_record_values WHERE record_id = 20384 AND field_id = 3';
$db->setQuery($query);
if ($result = $db->loadObject()) {
	echo $result->field_value;
}