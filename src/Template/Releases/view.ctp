<div class="releases view large-10 medium-9 columns">
    <fieldset>
        <legend><?= __('Visualizar Comunicado') ?></legend>
           <div class="row">
            <div class="large-5 columns strings">
                <h5 class="subheader">
                    <?= $this->Form->Label('Titulo:'); ?>
                </h5>
                <p><?= h($release->title) ?></p>
                <h5 class="subheader">
                    <?= $this->Form->Label('Texto:'); ?>
                </h5>
                <p><?= h($release->text) ?></p>
            </div>
            
            <div class="large-2 columns dates end">
                <h5 class="subheader">
                    <?= $this->Form->Label('Criado em:'); ?>
                </h5>
                <p><?= h($release->created) ?></p>            
            </div>
         </div>
    </fieldset>
    <h2></h2>
    
</div>
