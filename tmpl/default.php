<?php
defined('_JEXEC') or die;
if ($info->active == '1' || (ModDirectioninfoHelper::canDo('core.admin'))) :
    if ($cocon == '1') : ?>
        <p style="width: 100%; background-color: #3cbc58; color: #ff2500; text-align: center; font-style: italic; border: 1px solid #ff2500; padding: 2px;">
            <?php
            if ($dir != 0 && $dir != 7) $text = JText::_('MOD_DIRECTIONINFO_COCON_YES');
            if ($dir != 0 && $dir == 7) $text = JText::_('MOD_DIRECTIONINFO_REVISOR_YES');
            echo $text;
            ?>
        </p>
    <?php endif; if (!empty($desc)): ?>
    <p>
        <div class="dir-info-title">
            <h5><?php echo JText::_('MOD_DIRECTIONINFO_STATION_DESC_TIME'),':'; ?></h5>
        </div>
        <table width="100%">
            <?php foreach ($desc as $item => $value): ?>
                <tr>
                    <td class="dir-desc"><?php echo $item;?></td>
                    <td class="dir-desc"><?php echo $value;?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </p>
    <?php endif; if (!empty($turnstiles)): ?>
    <p>
        <div class="dir-info-title">
            <h5><?php echo JText::_('MOD_DIRECTIONINFO_STATIONS_TURNSTILES'),':'; ?></h5>
        </div>
        <ul>
            <?php foreach ($turnstiles as $item):
                $name = (!empty($item->popularName)) ? $item->popularName : $item->name;
                $link = JHtml::link(JRoute::_('index.php?option=com_railway2&view=station&id='.$item->stationID.'&Itemid=236'), $name);
                ?>
                <li style="margin: 1px; 0px;"><?php echo $link; ?></li>
            <?php endforeach;?>
        </ul>
    </p>
    <?php endif; if (!empty($crosses)): ?>
    <p>
        <div class="dir-info-title">
            <h5><?php echo JText::_('MOD_DIRECTIONINFO_CROSSES_METRO'),':'; ?></h5>
        </div>
        <table width="100%">
            <?php foreach ($crosses as $item => $value): ?>
                <tr>
                    <td class="dir-desc"><?php echo $item;?></td>
                    <td class="dir-desc"><?php echo $value;?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </p>
    <?php endif;
endif; ?>