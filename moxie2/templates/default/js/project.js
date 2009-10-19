var project = {
    hideDeliverableGoodies: function(a) {
        var deliverable = $(a).closest('.deliverable');
        deliverable.find('.goodies').hide();
        deliverable.find('.show-goodies').show();
    },
    
    showDeliverableGoodies: function(a) {
        var deliverable = $(a).closest('.deliverable');
        deliverable.find('.goodies').show();
        deliverable.find('.show-goodies').hide();
    }
};