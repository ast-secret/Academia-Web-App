<?= $this->assign('title', ' - Criar Exercício') ?>

<?php 
	$this->Html->addCrumb('Exercícios', ['action' => 'index']);
    $this->Html->addCrumb('Criar exercício');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Form->create($exercisesSuggestion, ['horizontal' => true, 'novalidate' => true]); ?>
    <?php
        echo $this->Form->input('name', ['label' => 'Nome', 'autocomplete' => 'off']);
        echo $this->Form->hidden('is_active', ['value' => 1]);
    ?>
    <hr>
    <?= $this->Form->submit('Criar Exercício') ?>
<?= $this->Form->end() ?>
