<?php
    $title = 'Editar ficha de exercícios para ' . $customer->name;
    $this->assign('title', ' - ' . $title)
?>

<?= $this->Html->script('../lib/niceCharCounter/dist/jquery.niceCharCounter', ['inline' => false]) ?>

<?php
    $this->Html->scriptStart(['block' => true]);
        echo "$(function(){
            $('#obs').niceCharCounter({
                max: 400,
                warningPercent: 10,
                warningColor: '#e67e22',
                text: '{{residual}} caractere(s) restante(s).',
                containerText: '#container-counter',
            });
        });";
    $this->Html->scriptEnd();
?>

<br>
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
        echo $this->Form->input('obs', ['type' => 'textarea', 'label' => 'Observação']);
        echo '<p id="container-counter" class="help-block"></p>';
        echo $this->Form->input('end_date', ['label' => 'Validade']);
        
        echo $this->Form->submit('Salvar alterações');
    echo $this->Form->end();
?>  