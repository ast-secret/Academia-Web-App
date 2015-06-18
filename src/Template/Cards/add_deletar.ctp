<?= $this->Html->script('Cards/addExercises.js', ['inline' => false]) ?>

<?= $this->element('common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<?= $this->Form->create($card/*['templates' => $bootstrapFormTemplate]*/); ?>
    <fieldset>
        <div class="row">
            <div class="col-md-6">
                <?php
                    echo $this->Form->input('end_date', ['label' => 'Data de vencimento']);
                    echo $this->Form->input('goal', ['label' => 'Objetivo']);
                    echo $this->Form->input('obs', ['label' => 'Observação']);
                ?>            
            </div>
            <div class="col-md-5 col-md-offset-1">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Adicionar um grupo de exercícios</label>
                        <input type="text" class="form-control" placeholder="Adicionar grupo" id="add-group">
                    </div>
                </div>

                <br>

                <div class="row" id="wrap-groups">
                </div>            
            </div>
        </div>

    </fieldset>
    <button type="submit" class="btn btn-danger btn-xs">Cancelar</button>
    <button type="submit" class="btn btn-success">Salvar</button>
<?= $this->Form->end() ?>