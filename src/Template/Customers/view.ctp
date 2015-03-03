<div class="customers view large-10 medium-9 columns">    
    <div class="row">
        <div class="large-5 columns strings">
            <h4 class="subheader"><?= __('Nome') ?></h4>
            <?= h($customer->name) ?>
            <h4 class="subheader"><?= __('Número de Registro') ?></h4>
            <?= h($customer->registration) ?>            
            <h4 class="subheader"><?= __('Chave de Acesso') ?></h4>
            <?= h($customer->access_key) ?>
        </div>
        
        <div class="large-2 columns dates end">
            <h4 class="subheader"><?= __('Criado em') ?></h4>
            <?= h($customer->created) ?>            
        </div>
    </div>
</div>
