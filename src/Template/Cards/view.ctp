<h3><?= $card->customer->name ?></h3>
<em><?= $card->user->name ?></em>
<h4>Objectivo <small><?= $card->goal ?></small></h4>
<blockquote>
    <p><?= $card->obs ?></p>
</blockquote>
<?php if ($card->exercises_groups): ?>
    <div class="row">
        <?php foreach ($card->exercises_groups as $group): ?>
            <div class="col-md-3">
                <h4><?= $group->name ?></h4>
                <?php if ($group->exercises): ?>
                    <?php foreach ($group->exercises as $exercise): ?>
                        <p><?= $exercise->name ?></p>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>