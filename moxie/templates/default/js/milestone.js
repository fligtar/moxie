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
    
    addResource: function(resourcetype, validation_callback) {
        var form = $('#add-resources #panel-' + resourcetype + ' .form');
        
        if (validation_callback) {
            var validation_results = eval(validation_callback + '(form);');
            
            if (validation_results == false) {
                return false;
            }
        }
        
        var deliverable = form.find('select[name="deliverable"] option:selected');
        var deliverable_id = deliverable.val();
        
        if (deliverable_id == '') {
            deliverable.parent().effect('highlight');
            return false;
        }
        
        validation_results.resource.resourcetype = resourcetype;
        validation_results.resource.deliverable = deliverable.text();
        validation_results.resource.deliverable_id = deliverable_id;
        
        var resourceBox = add_resources.queueResource(validation_results.resource);
         
        form.find('input').val('');
        
        var url = 'ajax.php?action=add-resource&resourcetype=' + resourcetype + '&deliverable_id=' + deliverable_id;
        
        $.each(validation_results.fields, function(key, value) {
            url += '&' + key + '=' + encodeURIComponent(value);
        });
         
        $.getJSON(url, function(data) {
            add_resources.resourceAdded(data, resourceBox);
        });
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
    
    addUncategorizedResource: function(resourcetype, title, description, additional_params) {
        var short_desc = description;
        if (short_desc.length > 24) {
            short_desc =  short_desc.substring(0, 23) + '&hellip;';
        }
        
        var li = '<li>';
        li += '<h5><input type="checkbox" checked="checked"/>' + title + '</h5>';
        li += '<p title="' + description + '">' + short_desc + '</p>';
        li += '<p class="assignment uncategorized">uncategorized</p>';
        if (additional_params) {
            li += '<input type="hidden" name="additional_params" value="' + additional_params + '" />';
        }
        li += '</li>';
        
        $('#add-resources #panel-' + resourcetype + ' .uncategorized-box .resource-grid').append(li);
        $('#add-resources #panel-' + resourcetype + ' .uncategorized-box').show();
    },
    
    assignSelectedResources: function(resourcetype) {
        var deliverable = $('#add-resources #panel-' + resourcetype + ' .uncategorized-box select[name="deliverable"]');
        
        $('#add-resources #panel-' + resourcetype + ' .uncategorized-box .resource-grid input[type="checkbox"]:checked').each(function() {
            var resource = $(this).closest('li');
            resource.find('input[type="checkbox"]').remove();
            
            var label = '<span class="deliverable">' + deliverable.find('option:selected').text() + '</span>';
            var hidden = '<input type="hidden" name="deliverable_id" value="' + deliverable.val() + '" />';
            
            resource.find('.assignment').removeClass('uncategorized').html(label + hidden);
            
            resource.clone(true).appendTo('#add-resources #panel-' + resourcetype + ' .ready-box .resource-grid');
            resource.remove();
            
            $('#add-resources #panel-' + resourcetype + ' .ready-box').show();
            
            if ($('#add-resources #panel-' + resourcetype + ' .uncategorized-box .resource-grid').children().size() == 0) {
                $('#add-resources #panel-' + resourcetype + ' .uncategorized-box').hide();
            }
            
            add_resources.incrementReadyCount(resourcetype);
        });
    },
    
    incrementReadyCount: function(resourcetype) {
        add_resources.readyCount++;
        var badge = $('#add-resources .sidebar #tab-' + resourcetype + ' .badge');
        var resourcetype_count = badge.text();
        resourcetype_count = resourcetype_count ? parseInt(resourcetype_count) + 1 : 1;
        
        badge.text(resourcetype_count).show();
        
        $('#add-resources .footer .close-button').hide();
        $('#add-resources .footer .add-button').text('Add ' + add_resources.readyCount + ' Resource' + (add_resources.readyCount == 1 ? '' : 's')).css('display', 'inline-block');
        $('#add-resources .footer .close-link, #addon-resources .footer .clear-queue-link').css('display', 'inline-block');
    },
    
    decrementReadyCount: function(resourcetype) {
        add_resources.readyCount--;
        var badge = $('#add-resources .sidebar #tab-' + resourcetype + ' .badge');
        var resourcetype_count = parseInt(badge.text());
        
        if (resourcetype_count > 1) {
            badge.text(resourcetype_count - 1);
            $('#add-resources .footer .add-button').text('Add ' + add_resources.readyCount + ' Resource' + (add_resources.readyCount == 1 ? '' : 's'));
        }
        else {
            badge.text('').hide();
            $('#add-resources .footer *').hide();
            $('#add-resources .footer .add-more-link, #add-resources .footer .finished-button').css('display', 'inline-block');
        }
    },
    
    addResources: function() {
        $('#add-resources .sidebar .selected, #add-resources .panel .resource-panel.selected').removeClass('selected');
        $('#add-resources #add-panel').addClass('selected');
        
        $('#add-resources .ready-box li').each(function() {
            var loading_item = $(this).clone(true).appendTo('#add-resources #add-panel .resource-grid').addClass('loading');
            
            var url = 'ajax.php?action=add-resource';
            url += '&resourcetype=' + $(this).closest('.resource-panel').find('input[name="resourcetype"]').val();
            url += '&deliverable_id=' + $(this).find('input[name="deliverable_id"]').val();
            url += '&' + $(this).find('input[name="additional_params"]').val();
            
            $.getJSON(url, function(data) {
                loading_item.addClass('loaded').removeClass('loading');
                var html = '<li class="just-added resource ' + data.resourcetype + '" id="resource-' + data.resource_id + '">' + data.link + '</li>';
                $('#deliverable-' + data.deliverable_id + ' .resources').append(html);
                
                add_resources.decrementReadyCount(data.resourcetype);
            });
        });
    },
    
    clearAddQueue: function() {
        add_resources.resetReadyCount();
    },
    
    resetReadyCount: function() {
        add_resources.readyCount = 0;
        $('#add-resources .sidebar .badge').text('').hide();
        $('#add-resources .footer *').hide();
        $('#add-resources .footer .close-button').css('display', 'inline-block');
    },
};