$(".cell").sortable({
    cursor: "move",
    stop: function( event, ui ) {
        var elm = ui.item;
        var cur_dasboard_id = elm.attr('data-dasboard_id');

        //var prevElm = elm.prev();
        var next_dasboard_id = elm.next().attr('data-dasboard_id');
        if (next_dasboard_id === undefined) {
            next_dasboard_id = 0;
        }

        $.ajax({
            url: '/admin/dashboard/manage-dashboard/sort-widget',
            type: 'POST',
            dataType: 'json',
            data: {'cur_dasboard_id': cur_dasboard_id, 'next_dasboard_id': next_dasboard_id},
        })
        .done(function (response) {
            if (response == 'success') {
            } else {
                $( this ).sortable( "cancel" );
            }
        })
        .fail(function (err) {
            console.log(err);
        });
    }
});