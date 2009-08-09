$(function() {
    $('.resource')
        .attr('draggable', 'true')
        .bind('dragstart', function(ev) {
            var resource = $(ev.target).closest('.resource');
            var dt = ev.originalEvent.dataTransfer;
            dt.setData('text/uri-list', resource.find('a').attr('href'));
            dt.setData('text/x-moxie-resource-id', resource.attr('id'));
            return true;
        })
        .bind('dragend', function(ev) {
            return false;
        });
        
    $('.category')
        .bind('dragenter', function(ev) {
            var category = $(ev.target).closest('.category');
            if (!category) return true;
            
            category.addClass('dragover');
            category.closest('.deliverable').addClass('dragover');
            return false;
        })
        .bind('dragleave', function(ev) {
            var category = $(ev.target).closest('.category');
            if (!category) return true;
            
            category.removeClass('dragover');
            category.closest('.deliverable').removeClass('dragover');
            return false;
        })
        .bind('dragover', function(ev) {
            var category = $(ev.target).closest('.category');
            if (!category) return true;
            return false;
        })
        .bind('drop', function(ev) {
            var category = $(ev.target).closest('.category');
            if (!category) return true;
            
            var dt = ev.originalEvent.dataTransfer;
            var deliverable = category.closest('.deliverable');
            var resource = $('#' + dt.getData('text/x-moxie-resource-id'));
            
            resource.clone(true).appendTo(category.find('.resources')).effect('highlight', {}, 2000);
            category.removeClass('category-hidden');
            //alert('moving resource ' + dt.getData('text/x-moxie-resource-id') + ' to deliverable ' + milestone.getDeliverableID(deliverable.attr('class')) + ', category ' + milestone.getCategoryID(category.attr('class')));
            
            // Remove the old resource node
            var oldcategory = resource.closest('.category');
            resource.remove();
            oldcategory.find('.resources:empty').parent().addClass('category-hidden');
            
            //ev.originalEvent.dataTransfer.clearData();
            ev.stopPropagation();
            return false;
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
        $(a).parent().toggleClass('selected');
    },
    
    showForm: function(a, form_class) {
        $(a).parent().parent().find('a').removeClass('selected');
        $(a).addClass('selected');
        
        var content = $(a).parent().parent().parent().parent();
        content.find('.type-form').removeClass('selected');
        content.find('.type-form.' + form_class).addClass('selected');
    },
    
    addResources: function(button) {
        var typeform = $(button).parent().parent();
        var resourcetype = typeform.find('input[name="resourcetype"]').val();
        // We have to go up to the deliverable box for the id because the addresource template is cached
        var deliverable_id = typeform.parent().parent().parent().find('input[name="deliverable_id"]').val();
        
        // If resourcetype has a custom validator, call it
        if (resourcetype.beforeAddResource) {
            if (!resourcetype.beforeAddResource(typeform)) {
                return false;
            }
        }
        
        typeform.find('.loading').show();
        
        // Start building GET URL
        var url = 'ajax.php?action=add-resource&deliverable_id=' + encodeURIComponent(deliverable_id) + '&resourcetype=' + encodeURIComponent(resourcetype);
        
        // Determine which categories are selected
        typeform.find('.category.selected input[name="category_id"]').each(function() {
            url += '&category_id[]=' + encodeURIComponent($(this).val());
        });
        
        // If the resourcetype has a custom param string builder, use that
        if (resourcetype.buildParamString) {
            url += resourcetype.buildParamString(typeform);
        }
        else {
            // Otherwise, pass all input fields and values
            typeform.find('.form input').each(function() {
                url += '&' + encodeURIComponent($(this).attr('name')) + '=' + encodeURIComponent($(this).val());
            });
        }
        
        $.getJSON(url, function(data) {
            typeform.parent().find('.close a').click();
            
            $.each(data, function(i, resource) {
                var category = $('.deliverable-' + resource.deliverable_id + ' .category-' + resource.category_id);
                category.removeClass('category-hidden');
                category.find('.resources').append('<li class="resource ' + resource.resourcetype + ' resource-' + resource.resource_id + '" id="resource-' + resource.resource_id + '">' + resource.link + '</li>');
            });
        });
    },
    
    refreshDeliverable: function(deliverable_id) {
        var url = "ajax.php?action=refresh-resources&deliverable_id=" + deliverable_id;
        
        $.getJSON(url, function(data) {
            
        });
    }
    
};

var add_resources = {
    hide: function() {
        $('#add-resources').slideUp();
    },
    
    show: function() {
        $('#add-resources').slideDown();
    },
    
    showPanel: function(resourcetype) {
        $('#add-resources .sidebar .selected, #add-resources .panel .resource-panel.selected').removeClass('selected');
        $('#add-resources #tab-' + resourcetype + ', #add-resources #panel-' + resourcetype).addClass('selected');
    }
};