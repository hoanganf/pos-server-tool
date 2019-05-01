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

function loadIngredients(cateID) {
  var link="../pos-server-api/ingredient.php";
  if(parseInt(cateID)>0){
    link+="?categoryId="+cateID;
  }
  $.getJSON(link, function(response){

    console.log(response);
    if(response.status === true){
      var $tableBody= $('table tbody');
      $tableBody.empty();
      //title
      $tableBody.append('<tr><th>Ma</th><th class="text-align--center">Anh</th><th>['+response.ingredients.length+']Ten</th><th class="text-align--center">Gia tham khao</th><th class="text-align--center">Tao ngay</th><th class="text-align--center">Sua ngay</th></tr>');
      $.each(response.ingredients, function(i, ingredient){
        console.log(ingredient);

        var $row = $('<tr/>');
        $row.data('id',ingredient.id).data('name',ingredient.name).data('category-id',ingredient.category_id).data('unit-id',ingredient.unit_id)
            .data('reference-price',ingredient.reference_price).data('description',ingredient.description).data('image',ingredient.image);
        $row.append('<td class="text-align--center font-size--normal">'+ingredient.id+'</td>')
            .append('<td class="text-align--center"><img width="64px" height="64px" src="'+imageHost+((ingredient.image!== null && ingredient.image.length>0) ? ingredient.image : 'files/pos/ic_no_image.png')+'"></td>')
            .append('<td class="display--flex flex-wrap--nowrap width--full flex-direction--row;"><div><strong class="color--blue">'+ingredient.name+'</strong>'+
              ((ingredient.description.length>0) ? ('<br/><font size="1em">'+ingredient.description+'</font>') : '')+'</div></td>')
            .append('<td class="white-space--nowrap text-align--right"><span class="rounded background-color--yellow padding">'+formatCurrency(ingredient.reference_price)+'</span></td>')
            .append('<td><div class="rounded background-color--blue padding">'+ingredient.creator+'<br/>'+ingredient.created_date+'</div></td>')
            .append('<td><div class="rounded background-color--blue padding">'+ingredient.updater+'<br/>'+ingredient.last_updated_date+'</div></td>');
        $tableBody.append($row);
      });
      //if ok set pressed on menu
      $(".scroll-menu > *").each(function(){
        $this=$(this);
        if($this.data('id') == cateID) $this.addClass('active');
        else $this.removeClass('active');
      });
    }else{
      if(response.code == 306) location.href='../login?from='+location.href;
      else showAlertDialog('That bai',response.message,false,false);
    }
    /*
    var scrollMenu = $(".scroll-menu");
    var rowCount=menu.childNodes.length;
    var i;
    //clear
    for(i=0;i<rowCount;i++){
      if(menu.childNodes[i].getAttribute("data-id")==cateID){
        menu.childNodes[i].className='active';
      }else{
        menu.childNodes[i].className='';
      }

    }*/
  });

}
// create event
//product click
$('table tbody').on('click','tr:has(td)',function(){
  var $this=$(this);
  $('input[name=id]').val($this.data('id'));
  $('input[name=name]').val($this.data('name'));
  $('textarea[name=description]').val($this.data('description'));
  $('select[name=category_id]').val($this.data('category-id'));
  $('select[name=unit_id]').val($this.data('unit-id'));
  $('input[name=reference_price]').val(formatCurrency($this.data('reference-price')));
  var image=$this.data('image');
  if(image!=null && image.length>0){
    $('img[name=image_displayer]').attr('src',imageHost+image);
    $('input[name=image]').val(image);
    $('input[name=image_uploader]').val('');
  }
  reloadFormChangeDetector();
});
//make number Mask
$priceInput=$('input[name=reference_price]');
$priceInput.on('input',function(){
  $this=$(this);
  if($this.val() === '0') $this.val('');
  else $this.val(formatCurrency($this.val().replace(/,/g,'')));
});

$('img[name=image_displayer]').on('click',function() {
  $('input[name=image_uploader]').trigger('click');
});
//form submit check
$("form").on('submit',function( event ) {
  $element=$('input[name=reference_price]');
  var submitPrice=$element.val().replace(/,/g,'');
  if(!isNaN(submitPrice)){
    $element.val(submitPrice);
    return;
  }else{
    alert('Vui long nhap gia ca bang so');
    event.preventDefault();
  }
});
reloadFormChangeDetector();
