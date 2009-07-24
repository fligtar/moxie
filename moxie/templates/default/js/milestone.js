$(function() {
    $('.resources').sortable({
        placeholder: 'ui-state-highlight'
    });
});

var milestone = {
    showAddPanel: function(a) {
        $(a).addClass('selected');
        var panel = $(a).parent().parent().parent().find('.add-resource');
        panel.find('.type-selector ul li:first-child a').click();
        milestone.resetAddPanel(panel);
        panel.slideDown();
    },
    
    hideAddPanel: function(a) {
        var panel = $(a).parent().parent().parent();
        panel.slideUp();
        panel.parent().find('.deliverable-menu .add').removeClass('selected');
    },
    
    resetAddPanel: function(panel) {
        panel.find('.loading').hide();
        panel.find('input[type="text"]').val('');
        panel.find('.categories li a').removeClass('selected');
        panel.find('.preview li').remove();
    },
    
    selectCategory: function(a) {
        $(a).toggleClass('selected');
    },
    
    showForm: function(a, form_class) {
        $(a).parent().parent().find('a').removeClass('selected');
        $(a).addClass('selected');
        
        var content = $(a).parent().parent().parent().parent();
        content.find('.type-form').removeClass('selected');
        content.find('.type-form.' + form_class).addClass('selected');
    },
    
    bugLookup: function(button) {
        var form = $(button).parent();
        var bugnumbers = form.find('.bug_number').val();
        if (bugnumbers == '') return;
        
        form.find('.loading').show();
        
        var url = 'ajax.php?action=bug-lookup&bugtracker_id=' + form.find('.bugtracker_id').val() + '&bug_numbers=' + milestone.formatBugNumberString(bugnumbers);
        
        $.getJSON(url, function(data) {
            form.find('.loading').hide();
            
            $.each(data, function(i, bug) {
               form.find('.preview').append('<li><label><input type="checkbox" name="bug_id" value="' + bug.id + '" checked="checked" />' + bug.number + ' - ' + milestone.truncateSummary(bug.summary) + '</label></li>'); 
            });
            
            form.parent().find('.categories,.submit').show();
            form.find('.bug_number').val('');
            
        });
    },
    
    truncateSummary: function(summary) {
        if (summary.length > 50) {
            summary =  summary.substring(0, 50) + '...';
        }
        
        return summary;
    },
    
    formatBugNumberString: function(bugnumbers) {
        bugnumbers = bugnumbers.replace(/\s*[\,\;\s]+\s*/g, ',');
        
        return bugnumbers;
    },
    
    addResources: function(button) {
        
    }
    
};