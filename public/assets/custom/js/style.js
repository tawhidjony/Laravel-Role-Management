
$.widget.bridge('uibutton', $.ui.button)

jQuery(document).ready(function () {
    var cbTree = $('.checkbox-tree').checkboxTree({
        checkChildren: true,
        singleBranchOpen: true,
        openBranches: []
    });
    $('#tree-expand').on('click', function (e) {
        cbTree.expandAll();
    });
    $('#tree-collapse').on('click', function (e) {
        cbTree.collapseAll();
    });

    $('#tree-deselect-all').on('click', function (e) {
        cbTree.uncheckAll();
    });
    /*$('.checkbox-tree').on('checkboxTicked', function (e) {
        console.log('checkbox tick', e.currentTarget);
        var checkedCbs = $(e.currentTarget).find("input[type='checkbox']:checked");
        console.log('checkbox tick', checkedCbs.length);
    });*/

    $('#select-all').on('click', function (e) {
        console.log(this.checked);
        if (this.checked) {
            $(':checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function () {
                this.checked = false;
            });
        }
    });

    $('.parent').click(function (event) {
        if (this.checked) {
            // Iterate each checkbox
            $(this).siblings('.menu').find('li').children(':checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $(this).siblings('.menu').find('li').children(':checkbox').each(function () {
                this.checked = false;
            });
        }
    });

   /* if($(document).find("input:checked").parents(".parent-menu").find("input[type='checkbox']")){
        // checked parent checkbox
        // $(document).find("input:checked").parents(".parent-menu").find("input[type='checkbox']").attr('checked', true);
    }*/
});