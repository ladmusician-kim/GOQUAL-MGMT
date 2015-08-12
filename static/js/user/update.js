$(".select2").select2();
var categoryid = $('#category_id');
if (categoryid) {
    $('.select2').select2().select2('val', categoryid.val());
}

