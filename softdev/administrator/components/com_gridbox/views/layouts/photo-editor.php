<?php
/**
* @package   Gridbox
* @author    Balbooa http://www.balbooa.com/
* @copyright Copyright @ Balbooa
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/
?>
<div id="photo-editor-dialog" class="ba-modal-lg modal hide" style="display:none">
    <div class="modal-header">
        <span class="ba-dialog-title"><?php echo JText::_('PHOTO_EDITOR'); ?></span>
        <div class="modal-header-icon">
            <i class="zmdi zmdi-close" data-dismiss="modal"></i>
        </div>
    </div>
    <div class="modal-body">
        <div class="general-tabs">
            <ul class="nav nav-tabs uploader-nav">
                <li class="active">
                    <a href="#resize-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-wallpaper"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('RESIZE'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#crop-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-crop"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('CROP'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#flip-rotate-image-options" data-toggle="tab">
                        <i class="zmdi zmdi-flip"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('FLIP_ROTATE'); ?></span>
                    </a>
                </li>
                <span class="photo-editor-save-image" data-context="save-image-context-menu">
                    <span><?php echo JText::_('JTOOLBAR_APPLY'); ?></span>
                    <i class="zmdi zmdi-caret-down"></i>
                </span>
            </ul>
            <div class="tabs-underline"></div>
            <div class="resize-image-wrapper">
                <div>
                    <canvas id="photo-editor"></canvas>
                </div>
                <div class="ba-crop-overlay" style="opacity: 0;">
                    <canvas id="ba-overlay-canvas"></canvas>
                    <span class="ba-crop-overlay-resize-handle" data-resize="top-left"></span>
                    <span class="ba-crop-overlay-resize-handle" data-resize="top-right"></span>
                    <span class="ba-crop-overlay-resize-handle" data-resize="bottom-left"></span>
                    <span class="ba-crop-overlay-resize-handle" data-resize="bottom-right"></span>
                </div>
            </div>
            <div class="tab-content">
                <div id="resize-image-options" class="row-fluid tab-pane active">
                    <div class="ba-settings-group">
                        <div class="ba-settings-toolbar">
                            <div>
                                <span><?php echo JText::_('WIDTH'); ?></span>
                                <input type="number" class="resize-width" data-callback="emptyCallback">
                            </div>
                            <div>
                                <span><?php echo JText::_('HEIGHT'); ?></span>
                                <input type="number" class="resize-height" data-callback="emptyCallback">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('IMAGE_QUALITY'); ?></span>
                            <div class="ba-range-wrapper">
                                <span class="ba-range-liner"></span>
                                <input type="range" class="ba-range" min="0" max="100">
                                <input type="number" class="photo-editor-quality" data-callback="photoEditorQuality">
                            </div>
                        </div>
                    </div>
                    <div class="photo-editor-footer">
                        <a href="#" class="reset-image"><?php echo JText::_('RESET'); ?></a>
                        <a href="#" class="resize-action"><?php echo JText::_('APPLY'); ?></a>
                    </div>
                </div>
                <div id="crop-image-options" class="row-fluid tab-pane">
                    <div class="ba-settings-group">
                        <div class="ba-settings-toolbar">
                            <div>
                                <span><?php echo JText::_('WIDTH'); ?></span>
                                <input type="number" class="crop-width" data-callback="emptyCallback">
                            </div>
                            <div>
                                <span><?php echo JText::_('HEIGHT'); ?></span>
                                <input type="number" class="crop-height" data-callback="emptyCallback">
                            </div>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('KEEP_PROPORTIONS'); ?></span>
                            <label class="ba-checkbox">
                                <input type="checkbox" class="keep-proportions">
                                <span></span>
                            </label>
                        </div>
                        <div class="ba-settings-item">
                            <span><?php echo JText::_('ASPECT_RATIO'); ?></span>
                            <div class="ba-custom-select aspect-ratio-select">
                                <input readonly="" onfocus="this.blur()" type="text" value="">
                                <input type="hidden" value="3">
                                <i class="zmdi zmdi-caret-down"></i>
                                <ul>
                                    <li data-value="original"><?php echo JText::_('ORIGINAL'); ?></li>
                                    <li data-value="1:1">1:1</li>
                                    <li data-value="3:2">3:2</li>
                                    <li data-value="3:4">3:4</li>
                                    <li data-value="16:9">16:9</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="photo-editor-footer">
                        <a href="#" class="reset-image"><?php echo JText::_('RESET'); ?></a>
                        <a href="#" class="crop-action"><?php echo JText::_('APPLY'); ?></a>
                    </div>
                </div>
                <div id="flip-rotate-image-options" class="row-fluid tab-pane">
                    <span>
                        <i class="zmdi zmdi-rotate-left rotate-action" data-rotate="-90"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('ROTATE_LEFT'); ?></span>
                    </span>
                    <span>
                        <i class="zmdi zmdi-rotate-right rotate-action" data-rotate="90"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('ROTATE_RIGHT'); ?></span>
                    </span>
                    <span>
                        <i class="zmdi zmdi-flip flip-action" data-flip="horizontal"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('FLIP_HORIZONTAL'); ?></span>
                    </span>
                    <span>
                        <i class="zmdi zmdi-flip flip-action" data-flip="vertical"></i>
                        <span class="ba-tooltip ba-bottom"><?php echo JText::_('FLIP_VERTICAL'); ?></span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="save-copy-dialog" class="ba-modal-sm modal hide">
    <div class="modal-body">
        <h3 class="ba-modal-title">
            <?php echo JText::_('SAVE_COPY'); ?>
        </h3>
        <div class="ba-input-lg">
            <input type="text" class="photo-editor-file-title" placeholder="<?php echo JText::_('ENTER_FILE_NAME'); ?>">
            <span class="focus-underline"></span>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary disable-button" id="apply-save-copy">
            <?php echo JText::_('JTOOLBAR_APPLY'); ?>
        </a>
    </div>
</div>
<div id="save-copy-notice-dialog" class="ba-modal-sm modal hide">
    <div class="modal-body">
        <h3 class="ba-modal-title">
            <?php echo JText::_('SAVE_COPY'); ?>
        </h3>
        <p class="modal-text"><?php echo JText::_('SAVE_COPY_NOTICE'); ?></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="ba-btn" data-dismiss="modal">
            <?php echo JText::_('CANCEL'); ?>
        </a>
        <a href="#" class="ba-btn-primary red-btn" id="apply-overwrite-copy">
            <?php echo JText::_('JTOOLBAR_APPLY'); ?>
        </a>
    </div>
</div>
<div class="ba-context-menu save-image-context-menu" style="display: none;">
    <span class="photo-editor-save-copy">
        <span><?php echo JText::_('SAVE_COPY'); ?></span>
    </span>
    <span class="save-photo-editor-image">
        <span><?php echo JText::_('JTOOLBAR_APPLY'); ?></span>
    </span>
</div>