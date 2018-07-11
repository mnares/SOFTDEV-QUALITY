<?php
/**
* @version    CVS: 1.0.0
* @package    com_quix
* @author     ThemeXpert <info@themexpert.com>
* @copyright  Copyright (C) 2015. All rights reserved.
* @license    GNU General Public License version 2 or later; see LICENSE.txt
*/
// No direct access
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
// Import CSS
$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn  = $this->state->get('list.direction');
$canOrder  = $user->authorise('core.edit.state', 'com_quix');
$saveOrder = $listOrder == 'a.`ordering`';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_quix&task=pages.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'pageList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$sortFields = $this->getSortFields();
?>
<script type="text/javascript">
	Joomla.orderTable = function () {
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>') {
			dirn = 'asc';
		} else {
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	};
	jQuery(document).ready(function () {
		jQuery('#clear-search-button').on('click', function () {
		jQuery('#filter_search').val('');
		jQuery('#adminForm').submit();
		});
	});
</script>
<?php
	// Joomla Component Creator code to allow adding non select list filters
	if (!empty($this->extra_sidebar))
	{
		$this->sidebar .= $this->extra_sidebar;
	}
?>
<form action="<?php echo JRoute::_('index.php?option=com_quix&view=pages'); ?>" method="post"
	name="adminForm" id="adminForm" class="clearfix">
	<?php if (!empty($this->sidebar)): ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
		<?php else : ?>
		<div id="j-main-container">
		<?php endif; ?>
		
		<?php echo QuixHelper::randerSysMessage(); ?>
		<?php // echo QuixHelper::getFreeWarning(); ?>
		<?php echo QuixHelper::getUpdateStatus(); ?>
		
		<div id="filter-bar" class="btn-toolbar">
			<div class="filter-search btn-group pull-left">
				<label for="filter_search"
					class="element-invisible">
					<?php echo JText::_('JSEARCH_FILTER'); ?>
				</label>
				<input type="text" name="filter_search" id="filter_search"
				placeholder="<?php echo JText::_('JSEARCH_FILTER'); ?>"
				value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
				title="<?php echo JText::_('JSEARCH_FILTER'); ?>"/>
			</div>
			<div class="btn-group pull-left">
				<button class="btn hasTooltip" type="submit"
				title="<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?>">
				<i class="icon-search"></i></button>
				<button class="btn hasTooltip" id="clear-search-button" type="button"
				title="<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>">
				<i class="icon-remove"></i></button>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="limit"
					class="element-invisible">
					<?php echo JText::_('JFIELD_PLG_SEARCH_SEARCHLIMIT_DESC'); ?>
				</label>
				<?php echo $this->pagination->getLimitBox(); ?>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="directionTable"
					class="element-invisible">
					<?php echo JText::_('JFIELD_ORDERING_DESC'); ?>
				</label>
				<select name="directionTable" id="directionTable" class="input-medium"
					onchange="Joomla.orderTable()">
					<option value=""><?php echo JText::_('JFIELD_ORDERING_DESC'); ?></option>
					<option value="asc" <?php echo $listDirn == 'asc' ? 'selected="selected"' : ''; ?>>
						<?php echo JText::_('JGLOBAL_ORDER_ASCENDING'); ?>
					</option>
					<option value="desc" <?php echo $listDirn == 'desc' ? 'selected="selected"' : ''; ?>>
						<?php echo JText::_('JGLOBAL_ORDER_DESCENDING'); ?>
					</option>
				</select>
			</div>
			<div class="btn-group pull-right hidden-phone">
				<label for="sortTable" class="element-invisible"><?php echo JText::_('JGLOBAL_SORT_BY'); ?></label>
				<select name="sortTable" id="sortTable" class="input-medium" onchange="Joomla.orderTable()">
					<option value=""><?php echo JText::_('JGLOBAL_SORT_BY'); ?></option>
					<?php echo JHtml::_('select.options', $sortFields, 'value', 'text', $listOrder); ?>
				</select>
			</div>
		</div>
		<div class="clearfix"></div>
		
		<div class="item-list">
			<table class="table table-striped" id="pageList">
				<thead>
					<tr>
						<?php if (isset($this->items[0]->ordering)): ?>
						<th width="1%" class="nowrap center hidden-phone">
							<?php echo JHtml::_('grid.sort', '<i class="icon-menu-2"></i>', 'a.`ordering`', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING'); ?>
						</th>
						<?php endif; ?>
						<th width="1%" class="hidden-phone">
							<input type="checkbox" name="checkall-toggle" value=""
							title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)"/>
						</th>
						<?php if (isset($this->items[0]->state)): ?>
						<th width="1%" class="nowrap center">
							<?php echo JHtml::_('grid.sort', 'JSTATUS', 'a.`state`', $listDirn, $listOrder); ?>
						</th>
						<?php endif; ?>
						<th>
							<?php echo JHtml::_('grid.sort',  'COM_QUIX_PAGES_TITLE', 'a.`title`', $listDirn, $listOrder); ?>
						</th>
						<th width="10%" class='left hidden-phone'>
							<?php echo JHtml::_('grid.sort',  'COM_QUIX_PAGES_ACCESS', 'a.`access`', $listDirn, $listOrder); ?>
						</th>
						<th width="10%" class='left hidden-phone'>
							<?php echo JHtml::_('grid.sort',  'COM_QUIX_PAGES_LANGUAGE', 'a.`language`', $listDirn, $listOrder); ?>
						</th>
						<th width="1%" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', 'JGLOBAL_HITS', 'a.hits', $listDirn, $listOrder); ?>
						</th>
						<?php if (isset($this->items[0]->id)): ?>
						<th width="1%" class="nowrap center hidden-phone">
							<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.`id`', $listDirn, $listOrder); ?>
						</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($this->items as $i => $item) :
						$ordering   = ($listOrder == 'a.ordering');
						$canCreate  = $user->authorise('core.create', 'com_quix');
						$canEdit    = $user->authorise('core.edit', 'com_quix');
						$canCheckin = $user->authorise('core.manage', 'com_quix');
						$canChange  = $user->authorise('core.edit.state', 'com_quix');
					?>
					<tr class="row<?php echo $i % 2; ?>">
						<?php if (isset($this->items[0]->ordering)) : ?>
						<td class="order nowrap center hidden-phone">
							<?php if ($canChange) :
								$disableClassName = '';
								$disabledLabel    = '';
								if (!$saveOrder) :
									$disabledLabel    = JText::_('JORDERINGDISABLED');
									$disableClassName = 'inactive tip-top';
							endif; ?>
							<span class="sortable-handler hasTooltip <?php echo $disableClassName ?>"
								title="<?php echo $disabledLabel ?>">
								<i class="icon-menu"></i>
							</span>
							<input type="text" style="display:none" name="order[]" size="5"
							value="<?php echo $item->ordering; ?>" class="width-20 text-area-order "/>
							<?php else : ?>
							<span class="sortable-handler inactive">
								<i class="icon-menu"></i>
							</span>
							<?php endif; ?>
						</td>
						<?php endif; ?>
						<td class="hidden-phone">
							<?php echo JHtml::_('grid.id', $i, $item->id); ?>
						</td>
						<?php if (isset($this->items[0]->state)): ?>
						<td class="center">
							<div class="btn-group">
								<?php echo JHtml::_('jgrid.published', $item->state, $i, 'pages.', $canChange, 'cb'); ?>
								<a class="btn btn-micro" 
									target="_blank" 
									href="<?php echo JUri::root() . 'index.php?option=com_quix&view=page&layout=iframe&tmpl=component&id='.$item->id; ?>">
									<i class="icon-eye"></i>
								</a>
								<?php
								// Create dropdown items
								JHtml::_('actionsdropdown.duplicate', 'cb' . $i, 'pages');
								JHtml::_('actionsdropdown.archive', 'cb' . $i, 'pages');
								
								// Render dropdown list
								echo JHtml::_('actionsdropdown.render', $this->escape($item->title));
								?>
							</div>
						</td>
						<?php endif; ?>
						<td>
							<?php //if (isset($item->checked_out) && $item->checked_out && ($canEdit || $canChange)) : ?>
							<?php //echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'pages.', $canCheckin); ?>
							<?php //endif; ?>
							<?php if ($canEdit) : ?>
								<?php 
								if($item->builder == 'classic'){
									$link = 'index.php?option=com_quix&task=page.edit&id='.(int) $item->id;
								}else{
									$link = JUri::root() . 'index.php?option=com_quix&task=page.edit&id='.(int) $item->id . '&quixlogin=true';
								} ?>
								<a 
									<?php echo ($item->builder == 'frontend' ? 'target="_blank"' : ''); ?>
									href="<?php echo JRoute::_($link); ?>">
									<?php echo $this->escape($item->title); ?>
								</a>
							<?php else : ?>
							<?php echo $this->escape($item->title); ?>
							<?php endif; ?>
							<?php echo ($item->builder == 'classic' ? '<span class="label label-warning">Classic</span>' : ''); ?>
						</td>
						<td class="hidden-phone">
							<?php echo $item->access; ?>
						</td>
						<td class="hidden-phone">
							<?php echo $item->language; ?>
						</td>
						<td class="hidden-phone">
							<?php echo (int) $item->hits; ?>
						</td>
						<?php if (isset($this->items[0]->id)): ?>
						<td class="center hidden-phone">
							<?php echo (int) $item->id; ?>
						</td>
						<?php endif; ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<?php echo $this->pagination->getListFooter(); ?>
			
		</div>

		<?php echo loadClassicBuilderFooterCredit(QuixHelper::isFreeQuix()); ?>
	        
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>