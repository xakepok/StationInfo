<?php
defined('_JEXEC') or die;
if (!empty($desc)): ?>
    <p>
    <div class="dir-info-title">
        <h5><?php echo JText::_('MOD_STATIONINFO_TURNSTILES'),':'; ?></h5>
    </div>
	<?php echo $turn;?>
    </p>
    <p>
    <div class="dir-info-title">
        <h5><?php echo JText::_('MOD_STATIONINFO_DESC_TIME'),':'; ?></h5>
    </div>
	<?php echo $desc;?>
    </p>
<?php endif; if (!empty($info)): ?>
    <p>
        <table>
            <tr>
                <td><?php echo JText::_('MOD_STATIONINFO_DIRECTION');?></td>
                <td><?php echo $info->direction;?></td>
            </tr>
            <tr>
                <td><?php echo JText::_('MOD_STATIONINFO_RAILWAY');?></td>
                <td><?php echo $info->road;?></td>
            </tr>
            <tr>
                <td><?php echo JText::_('MOD_STATIONINFO_RAILWAY_PART');?></td>
                <td><?php echo $info->division;?></td>
            </tr>
            <?php if (!empty($info->zoneID)) {
                ?>
                <tr>
                    <td><?php echo JText::_('MOD_STATIONINFO_STATION_ZONE');?></td>
                    <td><?php echo $info->zoneID;?></td>
                </tr>
            <?php
            }
            ?>
            <?php if (!empty($info->esr)) {
                ?>
                <tr>
                    <td><?php echo JText::_('MOD_STATIONINFO_CODE_ESR');?></td>
                    <td><?php echo $info->esr;?></td>
                </tr>
                <?php
            }
            ?>
            <?php if (!empty($info->express)) {
                ?>
                <tr>
                    <td><?php echo JText::_('MOD_STATIONINFO_CODE_EXPRESS');?></td>
                    <td><?php echo $info->express;?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </p>
<?php endif; ?>