<footer>
</footer>
<!-- The Modal -->
<div id="dialog" class="modal-dialog">
  <!-- Modal content -->
  <div class="modal-dialog__content animate">
    <span class="modal-dialog__close" onClick="closeAlertDialog()">&times;</span>
    <div class="modal-dialog__content__body">
      <h2 class="modal-dialog__content__title">Title</h2>
      <p class="modal-dialog__content__message">message</p>
      <div class="modal-dialog__content__button">
        <button class="modal-dialog__cancel hover--red" onClick="closeAlertDialog()">cancel</button>
        <button class="modal-dialog__ok hover--green" onClick="closeAlertDialog()">ok</button>
      </div>
    </div>
  </div>
</div>
<script>
window.imageUrl='<?php echo IMAGE_DIR; ?>';
window.apiUrl='<?php echo API_DIR; ?>';
window.loginUrl='<?php echo LOGIN_DIR; ?>';
</script>
<script type="text/javascript" src="<?php echo constant('LIB_DIR'); ?>js/jquery.dragBar.js"></script>
<script type="text/javascript" src="<?php echo constant('LIB_DIR'); ?>js/common_script.js"></script>
