jQuery(document).ready(function(){
    $(".remove_row").click(function(){
        var countDel = jQuery(this).attr('count');
        var indexNow = jQuery("#addRow").attr('count');
        if (countDel == indexNow) {
            indexNow--;
            $("#addRow").attr('count', indexNow);
            $(this).parent().parent().remove();
        } else {
            alert('Please remove lastest !')
        }
    });
    $('#addRow').click(function(){
        var index = $(this).attr('count');
        index++;
        var strHour = 'hours';
        var strVal = 'value';
        var tmp = '<tr id=""><td>' + index +'</td>'
            + '<td><input name="data_new[' + index + '][' + strHour +']" value="" class="form-control input-sm" type="text" placeholder="hours"></td>'
            + '<td><input name="data_new[' + index + '][' + strVal +']" value="" class="form-control input-sm" type="text" placeholder="Coefficient"></td>'
            + '<td><button type="button" count="' + index + '" class="remove_row_' + index + ' btn btn-block btn-danger btn-sm"><i class="fa fa-remove"></i>&nbsp;&nbsp;Delete</button></td>'
            + '</tr>';
        $('#overtime').append(tmp);
        $(this).attr('count', index);
        $(".remove_row_" + index).click(function(){
            var countDel = jQuery(this).attr('count');
            var indexNow = jQuery("#addRow").attr('count');
            if (countDel == indexNow) {
                indexNow--;
                $("#addRow").attr('count', indexNow);
                $(this).parent().parent().remove();
            } else {
                alert('Please remove lastest !')
            }
        });
    })

})