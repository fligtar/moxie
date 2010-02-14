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
    toggleEditing: function() {
        $('.deliverables').addClass('editable');
        
        // Deliverable name editing
        $('.deliverable h3').dblclick(milestone.editDeliverableName);
        
        // Resource name editing
        $('.resource a').click(function() { return false; }).dblclick(milestone.editResourceName);
    },
    
    editDeliverableName: function() {
        var current = $(this).text();
        $(this).html('<input type="text" value="' + current + '"/>');
        
        var saveChanges = function() {
            var newtext = $(this).val();
            
            if (newtext == '') {
                $(this).closest('h3').text(current);
            }
            else {
                $(this).closest('h3').text(newtext);
            }
        }
        
        $(this).find('input').focus().blur(saveChanges).keypress(function(e) {
            if (e.which == 13) {
                saveChanges();
                return false;
            }
        });
    },
    
    editResourceName: function() {
        var current = $(this).text();
        $(this).html('<input type="text" value="' + current + '"/>');
        
        var saveChanges = function() {
            var newtext = $(this).val();
            
            if (newtext == '') {
                $(this).closest('a').text(current);
            }
            else {
                $(this).closest('a').text(newtext);
            }
        }
        
        $(this).find('input').focus().blur(saveChanges).keypress(function(e) {
            if (e.which == 13) {
                saveChanges();
                return false;
            }
        });
    },
    
    refreshResources: function() {
        var url = 'ajax.php?action=refresh-resources&milestone_id=' + milestone_id;
        
        $.getJSON(url, function(data) {
            $.each(data, function(i, resource) {
                $('#resource-' + resource.resource_id).html(resource.link).effect('highlight', {}, 4000);
            });
        });
    }
};

var add_resources = {
    readyCount: 0,
    
    hide: function() {
        $('#add-resources').slideUp();
        
        $('.just-added').effect('highlight', {}, 4000).removeClass('just-added');
    },
    
    show: function() {
        add_resources.showMain();
        $('#add-resources').slideDown();
    },
    
    showPanel: function(resourcetype) {
        $('#add-resources .sidebar .selected, #add-resources .panel .resource-panel.selected').removeClass('selected');
        $('#add-resources #tab-' + resourcetype + ', #add-resources #panel-' + resourcetype).addClass('selected');
    },
    
    showMain: function() {
        $('#add-resources .sidebar .selected, #add-resources .panel .resource-panel.selected').removeClass('selected');
        $('#add-resources #main-panel').addClass('selected');
    },
    
    createResourceBox: function(resource, additional_params) {
        var short_desc = resource.description;
        if (short_desc.length > 24) {
            short_desc =  short_desc.substring(0, 23) + '&hellip;';
        }
        
        var li = '<li>';
        li += '<h5>';
        if (!resource.deliverable) {
            li += '<input type="checkbox" checked="checked"/>';
        }
        li += resource.title + '</h5>';
        li += '<p title="' + resource.description + '">' + short_desc + '</p>';
        if (resource.deliverable) {
            li += '<p class="assignment"><span class="deliverable">' + resource.deliverable + '</span>';
        }
        if (resource.deliverable_id) {
            li += '<input type="hidden" name="deliverable_id" value="' + resource.deliverable_id + '" /></p>';
        }
        else {
            li += '<p class="assignment uncategorized">uncategorized</p>';
        }
        if (additional_params) {
            li += '<input type="hidden" name="additional_params" value="' + additional_params + '" />';
        }
        li += '</li>';
        
        return li;
    },
    
    addSingle: function(resourcetype, validation_callback) {
        var form = $('#add-resources #panel-' + resourcetype + ' .form');
        
        if (validation_callback) {
            var valid = eval(validation_callback + '(form);');
            
            if (!valid) {
                return false;
            }
        }
        
        var deliverable = form.find('select[name="deliverable"] option:selected');
        
        if (deliverable.val() == '') {
            add_resources.markInvalid(form, 'select[name="deliverable"]');
            return false;
        }
        
        var resource = {
            'title': form.find('.resource-title').val(),
            'description': form.find('.resource-description').val(),
            'deliverable': deliverable.text(),
            'deliverable_id': deliverable.val(),
            'resourcetype': resourcetype
        };
        
        var resourceBox = add_resources.queueResource(resource);
        
        add_resources.addResource(resourcetype, resourceBox);
        
        form.find('input').val('');
    },
    
    addResource: function(resourcetype, resourceBox) {
        var form = $('#add-resources #panel-' + resourcetype + ' .form');
        
        var deliverable = form.find('select[name="deliverable"] option:selected');
        
        var url = 'ajax.php?action=add-resource&resourcetype=' + resourcetype + '&deliverable_id=' + deliverable.val();
        
        var fields = add_resources.getFields(form);
        
        $.each(fields, function(key, value) {
            url += '&' + key + '=' + encodeURIComponent(value);
        });
        
        var additional_params = resourceBox.find('input[name="additional_params"]').val();
        if (additional_params) {
            url += '&' + additional_params;
        }
        
        $.getJSON(url, function(data) {
            add_resources.resourceAdded(data, resourceBox);
        });
    },
    
    addMultiple: function(resourcetype) {
        var uncategorizedBox = $('#add-resources #panel-' + resourcetype + ' .uncategorized-box');
        var deliverable = uncategorizedBox.find('select[name="deliverable"]');
        
        uncategorizedBox.find('.resource-grid input[type="checkbox"]:checked').each(function() {
            var resource = $(this).closest('li');
            resource.find('input[type="checkbox"]').remove();
            
            var label = '<span class="deliverable">' + deliverable.find('option:selected').text() + '</span>';
            var hidden = '<input type="hidden" name="deliverable_id" value="' + deliverable.val() + '" />';
            
            resource.find('.assignment').removeClass('uncategorized').html(label + hidden);
            
            resource.clone(true).appendTo('#add-resources #panel-' + resourcetype + ' .ready-box .resource-grid');
            resource.remove();
            
            var newBox = $('#add-resources #panel-' + resourcetype + ' .ready-box .resource-grid li:last-child');
            newBox.addClass('loading');
            
            $('#add-resources #panel-' + resourcetype + ' .ready-box').show();
            
            if ($('#add-resources #panel-' + resourcetype + ' .uncategorized-box .resource-grid').children().size() == 0) {
                $('#add-resources #panel-' + resourcetype + ' .uncategorized-box').hide();
            }
            
            add_resources.addResource(resourcetype, newBox);
        });
    },
    
    getFields: function(form) {
        var fields = {};
        
        form.find('.field').each(function() {
            var field = $(this);
            
            if (this.tagName == 'TEXTAREA') {
                fields[field.attr('name')] = field.text();
            }
            else {
                fields[field.attr('name')] = field.val();
            }
        });
        
        return fields;
    },
    
    queueResource: function(resource, additional_params) {
        var resourceBox = add_resources.createResourceBox(resource, additional_params);
        
        $('#add-resources #panel-' + resource.resourcetype + ' .ready-box .resource-grid').append(resourceBox);
        $('#add-resources #panel-' + resource.resourcetype + ' .ready-box').show();
        
        var newBox = $('#add-resources #panel-' + resource.resourcetype + ' .ready-box .resource-grid li:last-child');
        newBox.addClass('loading');
        
        return newBox;
    },
    
    resourceAdded: function(data, resourceBox) {
        // Move resource box to added
        resourceBox.clone().removeClass('loading').addClass('loaded').appendTo('#add-resources #panel-' + data.resourcetype + ' .added-box .resource-grid');
        resourceBox.remove();
        if ($('#add-resources #panel-' + data.resourcetype + ' .ready-box .resource-grid').children().size() == 0) {
            $('#add-resources #panel-' + data.resourcetype + ' .ready-box').hide();
        }
        $('#add-resources #panel-' + data.resourcetype + ' .added-box').show();
        
        // Add resource link to deliverable
        var html = '<li class="just-added resource ' + data.resourcetype + '" id="resource-' + data.resource_id + '">' + data.link + '</li>';
        $('#deliverable-' + data.deliverable_id + ' .resources').append(html);
    },
    
    addUncategorizedResource: function(resource, additional_params) {
        var resourceBox = add_resources.createResourceBox(resource, additional_params);
        
        $('#add-resources #panel-' + resource.resourcetype + ' .uncategorized-box .resource-grid').append(resourceBox);
        $('#add-resources #panel-' + resource.resourcetype + ' .uncategorized-box').show();
        
        add_resources.incrementReadyCount(resource.resourcetype);
    },
    
    incrementReadyCount: function(resourcetype) {
        add_resources.readyCount++;
        var badge = $('#add-resources .sidebar #tab-' + resourcetype + ' .badge');
        var resourcetype_count = badge.text();
        resourcetype_count = resourcetype_count ? parseInt(resourcetype_count) + 1 : 1;
        
        badge.text(resourcetype_count).show();
    },
    
    decrementReadyCount: function(resourcetype) {
        add_resources.readyCount--;
        var badge = $('#add-resources .sidebar #tab-' + resourcetype + ' .badge');
        var resourcetype_count = parseInt(badge.text());
        
        if (resourcetype_count > 1) {
            badge.text(resourcetype_count - 1);
        }
        else {
            badge.text('').hide();
        }
    },
    
    clearAddQueue: function() {
        add_resources.resetReadyCount();
    },
    
    resetReadyCount: function() {
        add_resources.readyCount = 0;
    },
    
    markInvalid: function(form, selector) {
        form.find(selector).effect('highlight');
    }
};