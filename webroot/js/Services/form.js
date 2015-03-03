$(function(){

    $('#add-time').inputmask({
        'mask': 'h:s',
        'clearIncomplete': true
    });
    $('#add-duration').inputmask({
        'mask': '9{+}',
        'clearIncomplete': true
    });

    $('#btn-add').click(function(){
        var $weekday = $('#add-weekday'); 
        var $time = $('#add-time');
        var $duration = $('#add-duration');

        var weekday = $weekday.val();
        var time = $time.val();
        var duration = $duration.val();

        var timeValue = $( "#add-weekday option:selected" ).text();

        if (weekday === ''){
            $weekday.parent('.form-group').addClass('has-error');
            $weekday.focus();
            return false;
        } else {
            $weekday.parent('.form-group').removeClass('has-error');
        }

        if (time === ''){
            $time.parent('.form-group').addClass('has-error');
            $time.focus();
            return false;
        } else {
            $time.parent('.form-group').removeClass('has-error');
        }

       if (duration === ''){
            $duration.parent('.form-group').addClass('has-error');
            $duration.focus();
            return false;
        } else {
            $duration.parent('.form-group').removeClass('has-error');
        }

        $('#text-exercises-empty').hide();

        // Faz isso para as index nao misturarem com a carregada pelo PHP
        var fieldIndex = $('#list-times li').length;

        $itemWeekdayTime = $('<li/>')
            .addClass('list-group-item')
            .html('<strong>'+ timeValue + '</strong> às <strong>' + time + '</strong> com <strong>' + duration + '</strong> minutos de duração.')
            .appendTo('#list-times');

        $inputHour = $('<input/>')
            .attr({'name': "times["+fieldIndex+"][start_hour]", 'type' : 'hidden'})
            .val(time)
            .appendTo($itemWeekdayTime); 
        $inputWeekday = $('<input/>')
            .attr({'name': "times["+fieldIndex+"][weekday_id]", 'type' : 'hidden'})
            .val(weekday)
            .appendTo($itemWeekdayTime); 
        $inputDuration = $('<input/>')
            .attr({'name': "times["+fieldIndex+"][duration]", 'type' : 'hidden'})
            .val(duration)
            .appendTo($itemWeekdayTime); 

        $deleteButton = $('<button/>')
            .attr({type: 'button', id: 'btn-deletar',})
            .addClass('btn btn-default btn-xs pull-right')
            .css('display', 'none')
            .html('<span class="glyphicon glyphicon-remove"></span>')
            .appendTo($itemWeekdayTime);

        $time.val('').focus();
        $duration.val('');

        i++;
    });

    $(document).on('click', '#btn-deletar', function(){
        if (confirm('Você realmente deseja deletar este horário?')) {

            var idToDelete = $(this).parent('li').find('input#timesId').val();
            $('#timesdelete').val($('#timesdelete').val() + idToDelete + ';');

            $(this).parent('li').fadeOut(function(){
                $(this).remove();
            });
        }
    });

    $(document).on({
        mouseenter: function () {
            $(this).children('button').stop().fadeIn();
        },
        mouseleave: function () {
            $(this).children('button').stop().fadeOut();
        }
    }, 'ul#list-times li');

});