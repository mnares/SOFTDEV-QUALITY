<?php
/**
* @package		Quix
* @copyright	Copyright (C) 2010 - 2017 ThemeXpert.com. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Quix is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');

$gd = function_exists('gd_info');
$curl = is_callable('curl_init');
$ctype = extension_loaded('ctype');
############################################
## MySQL info
############################################
$db = JFactory::getDBO();
$mysqlVersion = $db->getVersion();

############################################
## PHP info
############################################
$phpVersion = phpversion();
$uploadLimit = ini_get('upload_max_filesize');
$memoryLimit = ini_get('memory_limit');
$postSize = (int) ini_get('post_max_size');
$max_execution = ini_get('max_execution_time');
$magicQuotes = get_magic_quotes_gpc() && JVERSION > 3;

$hasErrors = false;

if (stripos($memoryLimit, 'G') !== false) {
	list($memoryLimit) = explode('G', $memoryLimit);
	$memoryLimit = $memoryLimit * 1024;
}

if (!$gd || !$curl || !$ctype || $magicQuotes || $postSize < 5 || $max_execution < 30) {
	$hasErrors 	= true;
}

##########################################
## Paths
##########################################
$files = array();

$files['admin']	= new stdClass();
$files['admin']->path = JPATH_ROOT . '/administrator/components';

$files['admin_modules']	= new stdClass();
$files['admin_modules']->path = JPATH_ROOT . '/administrator/modules';

$files['site']	= new stdClass();
$files['site']->path = JPATH_ROOT . '/components';

$files['tmp'] = new stdClass();
$files['tmp']->path = JPATH_ROOT . '/tmp';

$files['media']	= new stdClass();
$files['media']->path 	= JPATH_ROOT . '/media';

$files['libraries']	= new stdClass();
$files['libraries']->path 	= JPATH_ROOT . '/libraries';

$files['system']	= new stdClass();
$files['system']->path 	= JPATH_ROOT . '/plugins/system';

$files['content']	= new stdClass();
$files['content']->path 	= JPATH_ROOT . '/plugins/content';

$files['finder']	= new stdClass();
$files['finder']->path 	= JPATH_ROOT . '/plugins/finder';

$files['quickicon']	= new stdClass();
$files['quickicon']->path 	= JPATH_ROOT . '/plugins/quickicon';

$files['editors_xtd']	= new stdClass();
$files['editors_xtd']->path 	= JPATH_ROOT . '/plugins/editors_xtd';

$files['auth']	= new stdClass();
$files['auth']->path 	= JPATH_ROOT . '/modules';

$files['cache']	= new stdClass();
$files['cache']->path 	= JPATH_ROOT . '/cache';


##########################################
## Determine states
##########################################
// $hasErrors	= false;

foreach ($files as $file) {
	// The only proper way to test this is to not use is_writable
	$contents = "<body></body>";
	$state = JFile::write($file->path . '/tmp.html', $contents);

	// Initialize this to false by default
	$file->writable = false;

	if ($state) {
		JFile::delete($file->path . '/tmp.html');

		$file->writable = true;
	}

	if (!$file->writable) {
		$hasErrors = true;
	}
}
?>
<script type="text/javascript">
jQuery(document).ready(function($){
	<?php if(!empty($hasErrors)): ?>
	console.log('<?php echo $hasErrors; ?>');
	<?php endif; ?>
	$('[data-installation-submit]' ).bind('click', function(){
		$('[data-installation-form]').submit();
	});

	<?php if ($hasErrors) { ?>
	$('[data-installation-submit]').hide();
	$('[data-installation-refresh]').removeClass('hide');

	// now we rebind the click.
	$('[data-installation-refresh]').on('click', function() {
		window.location.reload();
	});
	<?php } ?>
});
</script>
<!-- //loader -->
<div class="installation-methods d-none" data-update-checking>
	<div class="text-center">
		<b class="ui loader" style="width: 48px; height: 48px;"></b>&nbsp;
		<b>Checking update script...</b>
	</div>
</div>

<div class="text-center mb-3">
	<h2>Requirements</h2>
</div>

<form name="installation" method="post" data-installation-form>
	<?php if (!$hasErrors) { ?>
		<p class="alert alert-success">👍 Awesome! The minimum requirements are met. You may proceed with the installation process now.</p>
	<?php } ?>

	<p class="alert alert-danger <?php echo $hasErrors ? '' : 'd-none';?>" data-requirements-error>
		Some of the requirements below are not met. Please ensure that all of the requirements below are met.
	</p>

	<div class="card requirements-table" data-system-requirements>
		<div class="card-header">
			<ul class="nav nav-tabs card-header-tabs">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#settings">Settings</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#directories">Directories</a>
				</li>
			</ul>
		</div>
		<div class="card-body">
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="nav-home-tab">
					<table class="table table-striped mt-20 stats">
						<thead>
							<tr>
								<td width="40%">
									<?php echo JText::_('Settings');?>
								</td>
								<td class="text-center" width="30%">
									<?php echo JText::_('Recommended');?>
								</td>
								<td class="text-center" width="30%">
									<?php echo JText::_('Current');?>
								</td>
							</tr>
						</thead>

						<tbody>
							<tr class="<?php echo version_compare($phpVersion, '5.6.0') == -1 ? 'text-error' : '';?>">
								<td>
									<div class="clearfix">
										<span class="label label-info"><?php echo JText::_('PHP');?></span> Version
										<i class="icon-help hasTooltip" title="<?php echo JText::_( 'COM_QUIX_INSTALLATION_PHP_VERSION_TIPS' );?>"></i>

										<?php if (version_compare($phpVersion, '5.6.0') == -1) { ?>
										<a href="https://stackideas.com/docs/easysocial/administrators/welcome/getting-started" class="pull-right btn btn-es-danger btn-mini"><?php echo JText::_( 'COM_QUIX_INSTALLATION_FIX_THIS' );?></a>
										<?php } ?>
									</div>
								</td>
								<td class="text-center text-success">
									5.6.0
								</td>
								<td class="text-center text-<?php echo version_compare($phpVersion , '5.6.0' ) == -1 ? 'error' : 'success';?>">
									<?php echo $phpVersion;?>
								</td>
							</tr>
							<tr class="<?php echo !$gd ? 'text-error' : '';?>">
								<td>
									<div class="clearfix">
										<span class="label label-info"><?php echo JText::_('PHP');?></span> GD Library
										<i class="icon-help hasTooltip" title="<?php echo JText::_( 'COM_QUIX_INSTALLATION_PHP_GD_TIPS' );?>"></i>

										<?php if( !$gd ){ ?>
										<a href="https://stackideas.com/docs/easysocial/administrators/setup/gd-library" target="_blank" class="pull-right btn btn-es-danger btn-mini"><?php echo JText::_( 'COM_QUIX_INSTALLATION_FIX_THIS' );?></a>
										<?php } ?>
									</div>
								</td>
								<td class="text-center text-success">
									<i class="icon-checkmark"></i>
								</td>
								<?php if( $gd ){ ?>
								<td class="text-center text-success">
									<i class="icon-checkmark"></i>
								</td>
								<?php } else { ?>
								<td class="text-center text-error">
									<i class="icon-cancel-2"></i>
								</td>
								<?php } ?>
							</tr>

							<tr class="<?php echo !$curl ? 'text-error' : '';?>">
								<td>
									<div class="clearfix">
										<span class="label label-info"><?php echo JText::_('PHP');?></span> CURL Library
										<i class="icon-help hasTooltip" title="<?php echo JText::_( 'COM_QUIX_INSTALLATION_PHP_CURL_TIPS' );?>"></i>
										<?php if( !$curl ){ ?>
										<a href="https://stackideas.com/docs/easysocial/administrators/setup/curl-library" target="_blank" class="pull-right btn btn-es-danger btn-mini"><?php echo JText::_( 'COM_QUIX_INSTALLATION_FIX_THIS' );?></a>
										<?php } ?>
									</div>
								</td>
								<td class="text-center text-success">
									<i class="icon-checkmark"></i>
								</td>
								<?php if( $curl ){ ?>
								<td class="text-center text-success">
									<i class="icon-checkmark"></i>
								</td>
								<?php } else { ?>
								<td class="text-center text-error">
									<i class="icon-cancel-2"></i>
								</td>
								<?php } ?>
							</tr>
							<tr class="<?php echo $ctype ? '' : 'text-error';?>">
								<td>
									<div class="clearfix">
										<span class="label label-info"><?php echo JText::_('PHP');?></span> ctype
										<i class="icon-help hasTooltip" title="<?php echo JText::_( 'COM_QUIX_INSTALLATION_PHP_CTYPE_TIPS' );?>"></i>

										<?php if( !$ctype ){ ?>
										<a href="https://stackideas.com/docs/easysocial/administrators/setup/magic-quotes" target="_blank" class="pull-right btn btn-es-danger btn-mini"><?php echo JText::_( 'COM_QUIX_INSTALLATION_FIX_THIS' );?></a>
										<?php } ?>
									</div>
								</td>
								<td class="text-center text-success">
									<?php echo JText::_('Enabled');?>
								</td>
								<td class="text-center text-<?php echo $ctype ? 'success' : 'error';?>">
									<?php if( !$ctype ){ ?>
										<?php echo JText::_('Disabled');?>
									<?php } else { ?>
										<?php echo JText::_('Enabled');?>
									<?php } ?>
								</td>
							</tr>

							<tr class="<?php echo $magicQuotes ? 'text-error' : '';?>">
								<td>
									<div class="clearfix">
										<span class="label label-info"><?php echo JText::_('PHP');?></span> Magic Quotes GPC
										<i class="icon-help hasTooltip" title="<?php echo JText::_( 'COM_QUIX_INSTALLATION_PHP_MAGICQUOTES_TIPS' );?>"></i>

										<?php if( $magicQuotes ){ ?>
										<a href="https://stackideas.com/docs/easysocial/administrators/setup/magic-quotes" target="_blank" class="pull-right btn btn-es-danger btn-mini"><?php echo JText::_( 'COM_QUIX_INSTALLATION_FIX_THIS' );?></a>
										<?php } ?>
									</div>
								</td>
								<td class="text-center text-success">
									<?php echo JText::_('Disabled');?>
								</td>
								<td class="text-center text-<?php echo $magicQuotes ? 'error' : 'success';?>">
									<?php if( !$magicQuotes ){ ?>
										<?php echo JText::_('Disabled');?>
									<?php } else { ?>
										<?php echo JText::_('Enabled');?>
									<?php } ?>
								</td>
							</tr>
							<tr class="<?php echo $memoryLimit < 64 ? 'text-error' : '';?>">
								<td>
									<span class="label label-info"><?php echo JText::_('PHP');?></span> memory_limit
									<i class="icon-help hasTooltip" title="<?php echo JText::_( 'COM_QUIX_INSTALLATION_PHP_MEMORYLIMIT_TIPS' );?>"></i>
								</td>
								<td class="text-center text-success">
									64 <?php echo JText::_( 'M' );?>
								</td>
								<td class="text-center text-<?php echo $memoryLimit < 64 ? 'error' : 'success';?>">
									<?php echo $memoryLimit; ?>
								</td>
							</tr>
							<tr class="<?php echo $postSize < 5 ? 'text-error' : '';?>">
								<td>
									<span class="label label-info"><?php echo JText::_('post_max_size');?></span> 
									<i class="icon-help hasTooltip" title="<?php echo JText::_( 'COM_QUIX_INSTALLATION_PHP_POST_MAX_SIZE_TIPS' );?>"></i>
								</td>
								<td class="text-center text-success">
									5 <?php echo JText::_( 'M' );?>
								</td>
								<td class="text-center text-<?php echo $memoryLimit < 5 ? 'error' : 'success';?>">
									<?php echo $postSize; ?> M
								</td>
							</tr>
							<tr class="<?php echo $max_execution < 60 ? 'text-error' : '';?>">
								<td>
									<span class="label label-info"><?php echo JText::_('max_execution_time');?></span>
									<i class="icon-help hasTooltip" title="<?php echo JText::_( 'COM_QUIX_INSTALLATION_PHP_MAX_EXECUTION_TIPS' );?>"></i>
								</td>
								<td class="text-center text-success">
									60
								</td>
								<td class="text-center text-<?php echo $max_execution < 60 ? 'error' : 'success';?>">
									<?php echo $max_execution; ?>
								</td>
							</tr>
							<tr>
								<td>
									<span class="label label-success"><?php echo JText::_('MySQL');?></span> Version
									<i class="icon-help hasTooltip" title="<?php echo JText::_('COM_QUIX_INSTALLATION_MYSQL_VERSION_TIPS');?>"></i>
								</td>
								<td class="text-center text-success">
									5.0.4
								</td>
								<td class="text-center text-<?php echo !$mysqlVersion || version_compare( $mysqlVersion , '5.0.4' ) == -1 ? 'error' : 'success'; ?>">
									<?php echo !$mysqlVersion ? 'N/A' : $mysqlVersion;?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="tab-pane fade" id="directories" role="tabpanel" aria-labelledby="nav-profile-tab">
					<table class="table table-striped mt-20 stats">
						<thead>
							<tr>
								<td width="75%">
									<?php echo JText::_('Directory'); ?>
								</td>
								<td class="text-center" width="25%">
									<?php echo JText::_('State'); ?>
								</td>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($files as $file) { ?>
							<tr class="<?php echo !$file->writable ? 'text-error' : '';?>">
								<td>
									<?php echo $file->path;?>
								</td>

								<?php if ($file->writable) { ?>
								<td class="text-center text-success">
									<i class="icon-checkmark"></i>
								</td>
								<?php } else { ?>
								<td class="text-center text-error">
									<i class="icon-cancel-2"></i>&nbsp; <?php echo JText::_('Unwritable');?>
								</td>
								<?php } ?>
							</tr>
							<?php } ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<input type="hidden" name="option" value="com_iquix" />
	<input type="hidden" name="active" value="<?php echo $active; ?>" />
</form>

<?php 
$session = JFactory::getSession();
$checkUpdate = $session->get('quix.scriptupdate', false);
if(!$checkUpdate): ?>
<script type="text/javascript">
	jQuery(document).ready( function(){
		// jQuery('[data-installation-form]').addClass('hide');
		qx.ajaxUrl = "<?php echo JURI::root();?>administrator/index.php?option=com_iquix&ajax=1";
		// Immediately proceed with installation
		qx.core.checkUpdate();
	});
</script>
<?php endif; ?>