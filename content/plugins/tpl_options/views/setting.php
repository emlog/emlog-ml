<?php
!defined('EMLOG_ROOT') && exit('access deined!');
?>
<div id="tpl-options">
<!--vot-->    <div class="tpl-options-close"><?= lang('back') ?></div>
<!--vot-->    <div class="tpl-options-btns" data-type="1"><?=lang('shrink_all')?></div>
    <?php
    $tplget = $this->getTemplateDefinedOptions($template);
    if (array_key_exists('TplOptionsNavi', $tplget)):
        $tplnavi = $tplget['TplOptionsNavi']['values'];
        ?>
<!--vot-->        <div class="tpl-options-menubtn"><?=lang('short_menu')?></div>
        <div class="tpl-options-menu">
            <ul>
<!--vot-->                <li onClick="TplShow('tpl-system')" class="active"><?=lang('settings_help')?></li>
                <?php
                foreach ($tplnavi as $key => $v):
                    ?>
                    <li onClick="TplShow('<?php echo $key; ?>')"><?php echo $v; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <style>.option {
                display: block !important
            }</style>
    <?php endif; ?>
    <form action="<?php echo $this->url(array('template' => $template)); ?>" method="post" class="tpl-options-form">
        <?php if (array_key_exists('TplOptionsNavi', $tplget)): ?>
            <div class="option tpl-system" style="display:block;">
                <div class="option-body depend-none"><?php echo $tplget['TplOptionsNavi']['description']; ?></div>
            </div>
        <?php endif; ?>
        <?php $this->renderOptions(); ?>
    </form>
</div>
