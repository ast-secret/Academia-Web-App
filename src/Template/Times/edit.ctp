<script>
    $(function(){
        $('input#add-time').inputmask('hh:mm', {
            clearIncomplete: true,
            onKeyDown: function (a, b, c,d ) {
                if (a.keyCode == 13) {
                    var $this = $(this);

                    var value = b.join('');
                    var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/
                        .test(value);
                    if (isValid) {
                        var time = '<span class="label label-primary" style="float: left">' + $this.val() + ' <a href="#" id="delete-tag">x</a></span>';
                        $this
                            .parent('div')
                            .next('div')
                            .children('#times-container')
                            .append(time);
                        $this.val('');
                    }
                }
            }
        });
        $(document).on('click', '#delete-tag', function(){
            $(this).parent('span').remove();
        });
        $('input#add-time').keypress(function(e){
            // var $this = $(this);
            // if(e.which == 13) {
            //     var isValid = inputmask.isValid("23/03/1973", { alias: "dd/mm/yyyy"});
            //     var time = '<span class="label label-primary" style="float: left">' + $this.val() + ' <a href="#" id="delete-tag">x</a></span>';
            //     $this
            //         .parent('div')
            //         .next('div')
            //         .children('#times-container')
            //         .append(time);
            //     $this.val('');
            // }
        });
    });
</script>
<?php
$this->assign('title', ' - Configuração de horários');

echo '<br>';
$this->Html->addCrumb('Aulas', ['controller' => 'services', 'action' => 'index']);
$this->Html->addCrumb('Configurações de hoários');
echo $this->Html->getCrumbList();
echo '<br>';

$weekdays = $this->Weekdays->getAll();
?>
<div class="row">
    <?php foreach ($weekdays as $weekday): ?>
        <div class="col-md-12">
            <?= $weekday['name'] ?>
            <div class="row">
                <div class="col-md-2">
                    <input type="text"
                    placeholder="horário" id="add-time" class="form-control">
                </div>
                <div class="col-md-6">
                    <div id="times-container"></div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>