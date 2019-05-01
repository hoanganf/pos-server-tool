var imageHost='../pos-upload/';
function reloadFormChangeDetector(){
  $form=$('form');
  $btnEdit=$('#btn_edit');
  $btnAdd=$('#btn_add');
  $btnEdit.prop("disabled", true);
  $btnAdd.prop("disabled", true);
  $form.removeFormChangeDetector();
  $form.addFormChangeDetector().on('onChange',function(){
    $btnEdit.prop("disabled", false);
    $btnAdd.prop("disabled", false);
  }).on('onNoChange',function(){
    $btnEdit.prop("disabled", true);
    $btnAdd.prop("disabled", true);
  });
}
// create event
//category click
$('table tbody').on('click','tr:has(td)',function(){
  var $this=$(this);
  $('input[name=id]').val($this.data('id'));
  $('input[name=name]').val($this.data('name'));
  $('input[name=phone]').val($this.data('phone'));
  $('input[name=address]').val($this.data('address'));
  $('textarea[name=description]').val($this.data('description'));
  $('input[name=available]').prop('checked', ($this.data('available')==1));
  var image=$this.data('image');
  if(image!=null && image.length>0){
    $('img[name=image_displayer]').attr('src',imageHost+image);
    $('input[name=image]').val(image);
    $('input[name=image_uploader]').val('');
  }
  reloadFormChangeDetector();
});
$('img[name=image_displayer]').on('click',function() {
  $('input[name=image_uploader]').trigger('click');
});
//form submit check
reloadFormChangeDetector();
