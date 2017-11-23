<?php
defined('_JEXEC') or die;
?>
<?php if (!empty($info->lt) && !empty($info->lg) && $show_map): ?>
    <script type="text/javascript">
        ymaps.ready(init);
        var myMap,
            myPlacemark;

        function init(){
            myMap = new ymaps.Map("yamap", {
                center: [<?php echo $info->lg;?>, <?php echo $info->lt;?>],
                zoom: 12
            });

            myPlacemark = new ymaps.Placemark([<?php echo $info->lg;?>, <?php echo $info->lt;?>], {
                hintContent: '<?php echo $info->name;?>',
                balloonContent: '<?php echo $info->name;?>'
            });

            myMap.geoObjects.add(myPlacemark);
        }
    </script>
<?php endif;
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
    <?php endif; if (!empty($crosses)): ?>
    <p>
    <div class="dir-info-title">
        <h5><?php echo JText::_('MOD_STATIONINFO_METRO_CROSSES'),':'; ?></h5>
    </div>
	<?php echo $crosses;?>
    </p>
    <?php endif; if (!empty($info)): ?>
    <p>
        <div class="dir-info-title">
            <h5><?php echo JText::_('MOD_STATIONINFO_OTHER'),':'; ?></h5>
        </div>
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
<?php endif;
if (!empty($info->lt) && !empty($info->lg) && $show_map): ?>
    <div class="dir-info-title">
        <h5><?php echo JText::_('MOD_STATIONINFO_STATION_ON_MAP');?></h5>
    </div>
    <div id="yamap" style="width: 270px; height: 240px;">
    </div>
<?php endif;?>