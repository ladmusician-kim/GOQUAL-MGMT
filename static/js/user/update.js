$(".select2").select2();
var categoryid = $('#category_id');
console.log(categoryid);
if (categoryid) {
    $('.select2').select2().select2('val', categoryid.val());
}

