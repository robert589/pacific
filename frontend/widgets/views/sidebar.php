<div id="<?= $id ?>">
    <ul>
        <?php foreach($items as $item) { ?>
            <li class="<?= (array_key_exists("items", $item)) ? "has-sub" : "" ?>">
                <a href="<?= $item['href'] ?>">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="width:15px;">
                            <i class="menu-icon">
                                <img src="../images/menu-icon/04.png" alt="">
                            </i>
                        </td>
                        <td><?= $item['label'] ?></td>
                      </tr>
                    </table>
                </a>
                <ul>

                <?php if(array_key_exists("items", $item)) { ?>
                    <li>
                        <?php foreach($item['items'] as $sub) { ?>
                            <a href="<?= $sub['href'] ?>">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="width:15px;">
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </td>
                                        <td>
                                            <span><?= $sub['label'] ?></span>
                                        </td>
                                    </tr>
                                </table>
                            </a>
                        <?php } ?>
                    </li>
                <?php } ?>
                </ul>
            </li>
        <?php } ?>
    </ul>
</div>