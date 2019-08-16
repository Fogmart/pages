<?php
    /* @var $pages common\models\Page */
    /* @var $groups common\models\Group */
?>
<style>
    td {
        padding: 8px;
    }
</style>
<table cellpadding="3" cellspacing="5" border="1">
    <tr>
        <td></td>
        <?php foreach ($groups as $group){?>
            <td><?=$group->name?></td>
        <?php } ?>
    </tr>
    <?php foreach ($pages as $page){?>
        <tr pg="<?=$page->id?>" >
            <td><?=$page->title?></td>
            <?php

            foreach ($groups as $group){?>
                <td>
                    <input type="checkbox" gr="<?=$group->id?>"
                        <?php if (in_array($group, $page->groups)) {
                            echo "checked";
                        }?>
                            onclick="toggleGroup(this)"
                    >
                </td>
            <?php } ?>
        </tr>
    <?php } ?>

</table>

<script>
    function toggleGroup(cb) {
        var tr = $(cb).parents("tr")
        $.post("/page/assigngroup",{"pageid":$(tr).attr("pg"),"groupid": $(cb).attr("gr"),"set": $(cb).prop("checked")})
    }
</script>

