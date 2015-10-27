<?= $this->assign('title', ' - Editar cliente') ?>


<?php 
    $this->Html->addCrumb('Clientes', ['action' => 'index']);
    $this->Html->addCrumb('Editar cliente');
    echo $this->Html->getCrumbList();
?>

<br>

<?php
    echo $this->Form->create($customer, ['novalidate' => true, 'horizontal' => true]);
    echo $this->Form->input('registration', ['label' => 'Matrícula']);
    echo $this->Form->input('name', ['label' => 'Nome']);
    echo $this->Form->input('email');

    echo $this->Form->input('birthdate', [
        'label' => 'Dt. Nascimento',
        'maxYear' => (new Datetime)->format('Y'),
        'minYear' => (new Datetime)->format('Y') - 100,
        'templates' => [
            'dateWidget' => '{{day}}{{month}}{{year}}'
        ]
    ]);
    echo $this->Form->input('gender', ['label' => 'Sexo', 'type' => 'radio', 'options' => ['1' => 'Masculino', '2' => 'Feminino']]);
    
    echo $this->Form->input('is_active', ['label' => 'Ativo']);
    echo '<hr>';
    echo $this->Form->submit('Salvar Alterações');
    echo $this->Form->end();
?>  