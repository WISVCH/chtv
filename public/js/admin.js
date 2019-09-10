$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('document').ready(function(e) {
    $('.datatable').dataTable();

    $('.delete').click(function(e) {
        e.preventDefault();
        let that = this;
        if (confirm("Are you sure you wish to delete this slide?")) {
            $.ajax({
                url: url + $(this).data('id'),
                type: 'DELETE',
                dataType: 'json',
                success: function () {
                    $(that).closest('tr').remove();
                }
            })
        }
    });

    $('.activate').click(function(e) {
        e.preventDefault();
        let active = $(this).parent().parent().find('.active');
        let newValue = 1 - parseInt(active.html());
        let that = this;
        $.ajax({
            url: url + $(this).data('id') + '/activate',
            type: 'GET',
            dataType: 'json',
            data: { active: newValue },
            success: function() {
                if (newValue === 0) {
                    $(that).html("Activate");
                } else {
                    $(that).html("Deactivate");
                }
                active.html(newValue);
            }
        })
    });

    $('.slideTypes .card').click(function(e) {
        location.href = $(this).data('url');
    });
});