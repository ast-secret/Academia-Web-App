$(function(){
    var currentCol = 0;
    var visibility = 'text';

    $('#add-exercise').autocomplete({
        source: '../../../autocomplete/exercicios.json'
    });

    $('.submit-form').click(function(){
        $('#form-exercises').submit();
    });

    $('.custom-col').click(function(){
        var $this = $(this);
        $('.custom-col').removeClass('col-selected');
        $this.addClass('col-selected');
        currentCol = $this.data('index');
        var group = $this.data('label');
        $('.label-group-name').text(group);
        $('#add-exercise').focus();
    });
    $('.wrap-sortable').sortable({
        connectWith: '.wrap-sortable',
        receive: function(event, ui){
            var $target = $(event.target);
            var index = $(event.target).parent('div').data('index');
            ui.item.children('.exercise-column').hide();
            console.log(index);
        }
    }).disableSelection();

    /**
     * Mostra e esconde botão de deletar
     */
    $(document).on({
        mouseenter: function () {
            //stuff to do on mouse enter
            $(this).find('button.btn-remove-exercise').stop().fadeIn('fast');
        },
        mouseleave: function () {
            //stuff to do on mouse leave
            $(this).find('button.btn-remove-exercise').stop().fadeOut('fast');
        }
    }, 'div.exercise');

    $(document).on('click', '.btn-remove-exercise', function(){
        var $col = $(this).parents('div.exercise');
        $col.remove();
    });

    $('#form-add-exercise').submit(function(event) {
        var $this = $(this);
        var $inputAddExercise = $('#add-exercise');
        var value = $inputAddExercise.val();

        var totalExercises = $('.exercise').length;
        var newId = totalExercises + 1;
        console.log(newId);

        var $col = $("div[data-index='"+currentCol+"'] .wrap-sortable");

        var $div = $('<div/>')
            .addClass('exercise')
            .appendTo($col);

        var $row = $('<div/>').addClass('row').appendTo($div);
        var $col12 = $('<div/>').addClass('col-md-12').appendTo($row);

        var $input = $('<input/>')
            .attr('id', 'input-exercise-' + newId)
            .data('id', newId)
            .attr('name', 'exercises[' + newId + '][name]')
            .attr('type', visibility)
            .addClass('form-control input-exercise')
            .val(value)
            .appendTo($col12);
        var $inputExerciseColumn = $('<input/>')
            .attr('name', 'exercises[' + newId + '][exercise_column]')
            .attr('type', visibility)
            .addClass('form-control exercise-column')
            .val(currentCol)
            .appendTo($col12);

        var $text = $('<span/>')
            .attr('id', 'text-exercise-' + newId)
            .data('id', newId)
            .addClass('text-exercise')
            .text(value)
            .appendTo($col12);

        var $btnRemove = $('<button>')
            .attr('type', 'button')
            .addClass('btn btn-default btn-remove-exercise btn-xs')
            .html('<span class="glyphicon glyphicon-remove"></span>')
            .appendTo($col12);

        $inputAddExercise.val('');

        return false;
    });
});