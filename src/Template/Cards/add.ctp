<?php
    $title = 'Criar ficha de exercícios de ' . $customer->name;
    $this->assign('title', ' - ' . $title)
?>

<?= $this->Html->script('../lib/nice-char-counter/dist/nice-char-counter', ['inline' => false]) ?>

<?php
    $this->Html->scriptStart(['block' => true]);
        echo "$(function(){
            $('#obs').niceCharCounter({
                limit: 400,
                warningPercent: 10,
                warningColor: '#e67e22',
                text: '{{counter}} caractere(s) restante(s).',
                counter: '#container-counter',
            });
        });";
    $this->Html->scriptEnd();
?>

<?php 
    $this->Html->addCrumb('Clientes', ['controller' => 'Customers', 'action' => 'index']);
    $this->Html->addCrumb('Fichas de exercícios', [
        'controller' => 'Cards',
        'action' => 'index',
        'customer_id' => $customer->id
    ]);
    $this->Html->addCrumb($title);
    echo $this->Html->getCrumbList();
?>
<br>

<?php
    echo $this->Form->create($card, [
        'novalidate' => true,
        'horizontal' => true,
        'templates' => [
            'dateWidget' => '{{day}}{{month}}{{year}}'
        ]]);

        echo $this->Form->input('goal', ['label' => 'Objetivo']);
        echo $this->Form->input('obs', ['label' => 'Observação', 'type' => 'textarea']);
?>
        <div class="row" style="margin-bottom: 8px;">
            <div class="col-md-6 col-md-offset-2">
                <p id="container-counter" class="help-block"></p>
            </div>
        </div>
<?php
        echo $this->Form->input('end_date', ['label' => 'Validade']);
        echo '<hr>';
        echo $this->Form->submit('Criar Ficha', ['bootstrap-type' => 'primary', 'class' => 'pull-right']);
    echo $this->Form->end();
?>  