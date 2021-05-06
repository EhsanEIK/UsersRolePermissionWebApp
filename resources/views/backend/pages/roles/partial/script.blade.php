<script>

    //Check AllCheckBox and all checkbox is going to be checked in front-end
    $('#checkPermissionAll').click(function(){
        if($(this).is(':checked')){
            //check all checkbox
            $('input[type=checkbox]').prop('checked', true);
        }
        else{
            //uncheck all checkbox
            $('input[type=checkbox]').prop('checked', false);
        }
    });

    //Check Permission Group and all permissions on this group is going to be checked in front-end
    function checkPermissionByGroup(className, checkThis){
        const groupId = $("#"+checkThis.id);
        const classCheckBox = $('.'+ className +' input');
        if(groupId.is(':checked')){
            //check all checkbox
            classCheckBox.prop('checked', true);
        }
        else{
            //uncheck all checkbox
            classCheckBox.prop('checked', false);
        }
        implementAllChecked();
    }

    //Group Check Box select & deselect in front-end
    function checkSinglePermission(groupClassName, groupID, countTotalPermission){
        const groupClassCheckBox = $('.'+groupClassName+' input');
        const groupIDCheckBox = $('#'+groupID);
        if($('.'+groupClassName+' input:checked').length==countTotalPermission){
            groupIDCheckBox.prop('checked', true);
        }
        else{
            groupIDCheckBox.prop('checked', false);
        }
        implementAllChecked();
    }

    //All Check Box select & deselect in front-end
    function implementAllChecked(){
        const countPermission = {{ count($allPermissions) }};
        const countPermissionGroup = {{ count($permissionGroups) }};

        if($(' input[type=checkbox]:checked').length==countPermission+countPermissionGroup)
        {
            $('#checkPermissionAll').prop('checked', true);
        }
        else
        {
            $('#checkPermissionAll').prop('checked', false);
        }
    }
</script>