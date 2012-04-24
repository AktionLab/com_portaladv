<?php defined('_JEXEC') or die('Restricted access'); ?>

<form id="searchForm" action="<?php echo JRoute::_( 'index.php?option=com_portaladv' );?>" method="post" name="searchForm">
	<table class="contentpaneopen<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<? if ($this->params->get( 'show_prop_types' ) == 1) { ?> 
		<tr>
			<td nowrap="nowrap">
				<label for="prop_types">
					<?php echo JText::_( 'Property Type' ); ?>:
				</label>
				<table>
				<?
				echo PortalAdvHelperLayout::displayPropTypes('prop_types',4);
				?>
				</table>
			</td>
		</tr>
<? } ?>
<? if ($this->params->get( 'show_areas' ) == 1) { ?> 
		<tr>
			<td nowrap="nowrap">
				<label for="search_areas">
					<?php echo JText::_( 'Areas' ); ?>:
				</label>
				<table>
				<?
				echo PortalAdvHelperLayout::displayAreas($this->lists['area'],4);
				?>
				</table>
			</td>
		</tr>
<? } ?>
<? if ($this->params->get( 'show_price' ) == 1) { ?> 
		<tr>
			<td>
			<label for="price_min">
					<?php echo JText::_( 'Min' ); ?>:
				</label>
			 <? echo PortalAdvHelperLayout::displaySearchPrices('price_min',50000,2000000); ?>
			 <label for="price_max">
					<?php echo JText::_( 'Max' ); ?>:
				</label>
			 <? echo PortalAdvHelperLayout::displaySearchPrices('price_max',100000,5000000); ?>
			</td>
		</tr>
<? } ?>
<? if ($this->params->get( 'show_bedrooms' ) == 1) { ?> 
		<tr>
			<td>
				<label for="num_bedrooms">
					<?php echo JText::_( 'Bedrooms' ); ?>:
				</label>
				<? echo PortalAdvHelperLayout::displayNumericCheckboxes('num_bedrooms',5); ?>
			</td>
		</tr>
<? } ?>
<? if ($this->params->get( 'show_bathrooms' ) == 1) { ?> 
		<tr>
			<td>
				<label for="num_bedrooms">
					<?php echo JText::_( 'Bathrooms' ); ?>:
				</label>
				<? echo PortalAdvHelperLayout::displayNumericCheckboxes('num_bathrooms',5); ?>
			</td>
		</tr>
<? } ?>
<? if ($this->params->get( 'show_squarefeet' ) == 1) { ?> 
		<tr>
			<td>
				<label for="square_feet">
					<?php echo JText::_( 'Square Feet' ); ?>:
				</label>
				<? echo PortalAdvHelperLayout::displayIncrementalList('square_feet',500,5000,500); ?>
			</td>
		</tr>
<? } ?>
		<tr>
			<td>
				<input type="submit" value= "   Search   " />
			</td>
		</tr>
	</table>

<input type="hidden" name="lat_min" value="0" />
<input type="hidden" name="lat_max" value="0" />
<input type="hidden" name="lng_min" value="0" /> 
<input type="hidden" name="lng_min" value="0" /> 
<input type="hidden" name="task" value="search" />
<input type="hidden" name="limit" value="10" />

</form>
