function reloadFormChangeDetector(){
  $form=$('#unit_form');
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
$('#unit_table tbody').on('click','tr:has(td)',function(){
  var $this=$(this);
  $('input[name=id]').val($this.data('id'));
  $('input[name=name]').val($this.data('name'));
  $('textarea[name=description]').val($this.data('description'));
  $('input[name=available]').prop('checked', ($this.data('available')==1));
  $('select[name=type]').val($this.data('type'));
  reloadFormChangeDetector();
});
//form submit check
reloadFormChangeDetector();
