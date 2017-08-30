<?php
defined('_JEXEC') or die;
if ($info->active == '1' || (ModDirectioninfoHelper::canDo('core.admin'))) :
?>
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
<?php endif; ?>