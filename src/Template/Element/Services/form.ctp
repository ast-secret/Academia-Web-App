<?php
    $update = !isset($update) ? false : $update;
?>
<?= $this->Form->create($service); ?>
    <div class="row">
        <div class="col-md-6">
            <?php
                echo $update ? $this->Form->input('id', ['type' => 'text']) : '';
                echo $this->Form->input('name', ['label' => 'Nome']);
                echo $this->Form->input('description', ['label' => 'Descrição']);
                echo $this->Form->label('Status');
                echo $this->Form->checkbox('stats');
            ?>  
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <label for="add-weekday">Adicionar Horário</label>
                </div>
            </div>
            <div class="well">
                <div class="row">
                    <div class="col-md-4">
                        <?= $this->Form->input('add-weekday', ['options' => $weekdays, 'label' => 'Dia']); ?>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" >
                        <label for="add-time">Horário</label>
                            <input type="text" class="form-control" id="add-time">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" >
                            <label for="add-duration">Duraçao</label>
                            <input type="text" class="form-control" id="add-duration" placeholder="Em minutos" maxlength="4">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="">&nbsp;</label>
                        <div></div>
                        <button type="button" class="btn btn-primary btn-sm btn-block" id="btn-add">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <?php if (isset($service->errors()['times'])): ?>
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-remove-sign"></span>
                                Ocorreram erros em um ou mais horários que você inseriu.
                            </div>
                        <?php endif ?>
                        
                        <ul id="list-times" class="list-group">
                            <?php if ($service->times): ?>
                                <?php foreach ($service->times as $key => $time): ?>
                                    <?php if (!$time->errors()): ?>
                                        <li class="list-group-item">
                                            <strong><?= $this->Weekdays->getById($time->weekday_id, $weekdays) ?></strong> às <strong><?= $time->start_hour ?></strong> com <strong><?= $time->duration ?></strong> minutos de duração.

                                            <?php
                                                // Hidden Fields
                                                echo $this->Form->hidden("times.{$key}.id",
                                                    ['value' => $time->id]);
                                                echo $this->Form->hidden("times.{$key}.weekday_id",
                                                    ['value' => $time->weekday_id]);
                                                echo $this->Form->hidden("times.{$key}.start_hour", ['value' => $time->start_hour->format('H:i')]);
                                                echo $this->Form->hidden("times.{$key}.duration",
                                                    ['value' => $time->duration]);
                                            ?>

                                            <button
                                                type="button"
                                                id="btn-deletar"
                                                class="btn btn-default btn-xs pull-right"
                                                style="display: none;">

                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>

                                        </li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php else: ?>
                                <em id="text-exercises-empty">Nenhum exercício adicionado</em>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px;">
        <hr>
        <button type="button" class="btn btn-default">
            Cancelar
        </button>
        <button type="submit" class="btn btn-success" style="">
            Salvar Informações
        </button>
    </div>
<?= $this->Form->end() ?>