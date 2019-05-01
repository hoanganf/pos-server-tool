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
  $('input[name=user_name]').val($this.data('user-name'));
  $('input[name=name]').val($this.data('name'));
  $('textarea[name=description]').val($this.data('description'));
  $('input[name=available]').prop('checked', ($this.data('available')==1));
  $('select[name=role]').val($this.data('role'));
  $('select[name=salary_type]').val($this.data('salary-type'));
  reloadFormChangeDetector();
});
//form submit check
reloadFormChangeDetector();
