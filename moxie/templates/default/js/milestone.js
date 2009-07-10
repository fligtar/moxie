$(function() {
    $('.resources').sortable({
        placeholder: 'ui-state-highlight'
    });
});

var milestone = {
    showAddPanel: function(a) {
        $(a).addClass('selected');
        var box = $(a).parent().parent().parent();
        box.find('.add-resource').slideDown();
    },
    
    selectCategory: function(a) {
        $(a).toggleClass('selected');
    },
    
    showForm: function(a, formType, formtype_id) {
        $(a).parent().parent().find('a').removeClass('selected');
        $(a).addClass('selected');
        
        var content = $(a).parent().parent().parent().parent();
        content.find('.type-form .form').removeClass('selected');
        content.find('.type-form .' + formType).addClass('selected');
        
        if (formtype_id) {
            content.find('.type-form .' + formType + ' .' + formType + '_id').val(formtype_id);
        }
    },
    
    bugLookup: function(button) {
        var form = $(button).parent();
        form.find('.loading').show();
        
        var url = 'ajax.php?action=bug-lookup&bugtracker_id=' + form.find('.bugtracker_id').val() + '&bug_number=' + form.find('.bug_number').val();
        
        $.getJSON(url, function(data) {
            alert(data.summary);
            form.find('.loading').hide();
            
        });
    }
    
};