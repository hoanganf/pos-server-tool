function loadProducts(cateID) {
  var link=window.apiUrl+"product.php?detail=ingredient";
  if(parseInt(cateID)>0){
    link+="&categoryId="+cateID;
  }
  $.getJSON(link, function(response){
    if(response.status === true){
      $tableBody.empty();
      //title
      $tableBody.append('<tr><th>Ma</th><th class="text-align--center">Anh</th><th class="width-full">Ten['+response.products.length+']</th></tr>');
      $.each(response.products, function(i, product){
        var $row = $('<tr/>');
        var productIngredientBlock='';
        $.each(product.ingredients, function(i, ingredient){
          productIngredientBlock+=ingredient.name+': '+ingredient.count+' '+ingredient.unit_name+'<br/>';
        });
        $row.data('id',product.id).data('name',product.name).data('ingredients',product.ingredients);
        $row.append('<td class="text-align--center font-size--normal">'+product.id+'</td>')
            .append('<td class="text-align--center"><img width="64px" height="64px" src="'+window.imageUrl+((product.image!== null && product.image.length>0) ? product.image : 'files/pos/ic_no_image.png')+'"></td>')
            .append('<td valign="top" class="width--full"><div><strong class="color--blue">'+product.name+'</strong>'+
              ((productIngredientBlock.length>0) ? ('<br/><font size="1em">'+productIngredientBlock+'</font>') : '')+'</div></td>');
        $tableBody.append($row);
      });

      //if ok set pressed on menu
      $productCategory.find("> *").each(function(){
        $this=$(this);
        if($this.data('id') == cateID) $this.addClass('active');
        else $this.removeClass('active');
      });
    }else{
      if(response.code == 306) location.href=window.loginUrl+'?from='+location.href;
      else showAlertDialog('That bai',response.message,false,false);
    }
  });
}
function loadIngredients(cateID) {
  var link=window.apiUrl+"ingredient.php";
  if(parseInt(cateID)>0){
    link+="?categoryId="+cateID;
  }
  console.log(link);
  $.getJSON(link, function(response){
    if(response.status === true){
      $ingredientList.empty();
      $.each(response.ingredients, function(i, ingredient){
        $ingredientList.append('<div id="ingredient_'+ingredient.id+'" onclick="onIngredientClick('+ingredient.id+',\''+ingredient.name+'\',\''+ingredient.unit_name+'\');return false;" class="hover--green">'+ingredient.name+'</div>');
      });
      //if ok set pressed on menu
      $ingredientCategory.find("> *").each(function(){
        $this=$(this);
        if($this.data('id') == cateID) $this.addClass('active');
        else $this.removeClass('active');
      });
      //hide choosed item
      $productIngredients=$choosedIngredientContainer.find('input[name^=ingredient]').each(function(){
        console.log($(this).attr('name'));
        $('#'+$(this).attr('name')).addClass('hide');
      });
    }else{
      if(response.code == 306) location.href=window.loginUrl+'?from='+location.href;
      else showAlertDialog('That bai',response.message,false,false);
    }
  });

}
function onRemove(element){
  $('#ingredient_'+$(element).data('id')).removeClass('hide');
  onNotifiClose(element);
}
function onIngredientClick(id,name,unitName,count=0){
  $('#ingredient_'+id).addClass('hide');
  $choosedIngredientContainer.append('<div class="alert background-color--blue margin">'
          +'<span class="alert__closebtn" data-id="'+id+'" onclick="onRemove(this)">&times;</span>'
          +'<label class="display--block">'+name+'<input type="number" name="ingredient_'+id+'" value="'+count+'" class="width--auto margin" placeholder="So luong" required>'
          +unitName+'</label></div>');
}
function showError(message){
  $message.prepend('<div class="alert background-color--red rounded">'
     +'<span class="alert__closebtn" onclick="onNotifiClose(this)">&times;</span>'
     +'<strong>Loi!</strong>'+message+'</div>');
}
function showSuccess(message){
  $message.prepend('<div class="alert background-color--green rounded">'
     +'<span class="alert__closebtn" onclick="onNotifiClose(this)">&times;</span>'
     +message+'</div>');
}
// create event
//product click
var $tableBody=$('table tbody');
var $choosedIngredientContainer=$('#choosed_ingredients');
var $ingredientList=$('#ingredient_list');
var $ingredientCategory=$('#ingredient_category');
var $productCategory=$('#product_category');
var $message=$('#message');
$tableBody.on('click','tr:has(td)',function(){
  var $this=$(this);
  $('input[name=id]').val($this.data('id'));
  $('h2[name=name]').text($this.data('name'));
  //remove current focus
  $tableBody.find('.pressed--forcus').removeClass('pressed--forcus');
  //set new focus
  $this.addClass('pressed--forcus');

  var $productIngredients=$this.data('ingredients');
  //reset ingredient list -> show all ingredients
  $choosedIngredientContainer.empty();
  $ingredientList.find('.hide').each(function(){
    $(this).removeClass('hide');
  });
  // proccess
  $.each($productIngredients, function(i, ingredient){
    onIngredientClick(ingredient.id,ingredient.name,ingredient.unit_name,ingredient.count);
  });
});

$('#btn_edit').on('click',function(){
  console.log($('input[name=id]'));
  var productId=$('input[name=id]').val();
  if(!productId){
    showError('Sua cong thuc that bai: Xin vui long chon mon');
    return;
  }
  var ingredients = {product_id:productId};
  ingredients.ingredients=[];
  var canAdd=true;

  $choosedIngredientContainer.find('input[name^=ingredient]').each(function(){
    $row=$(this);
    if($row.val().length<1 || parseFloat($row.val())<=0){
      showError('Sua cong thuc that bai: Xin vui long dien so luong vao');
      canAdd=false;
      return canAdd;
    }
    var ingredient={
      id:$row.attr('name').replace('ingredient_', ''),
      count:$row.val()
    }
    ingredients.ingredients.push(ingredient);
  });
  if(canAdd){
    var dbParam, xmlhttp;
    dbParam = JSON.stringify(ingredients);
    console.log(dbParam);
    $.ajax({
         url: window.apiUrl+"productRecipe.php",
         type : "POST",
         contentType : 'application/json',
         data : dbParam,
         success : function(result) {
           var response=JSON.parse(result);
             console.log(response);
           if(response.status === true){
             //remove current focus
             $tableBody.find('.pressed--forcus').removeClass('pressed--forcus');
             $choosedIngredientContainer.empty();
             $ingredientList.find('.hide').each(function(){
               $(this).removeClass('hide');
             });
             var tenmon=$('h2[name=name]').text();
             $('h2[name=name]').text('Ten mon');
             $('input[name=id]').val('');
             $productCategory.find(".active").trigger('click');
             showSuccess('Sua cong thuc thanh cong: '+tenmon);
           }else{
             if(response.code == 306) location.href=window.loginUrl+'?from='+location.href;
             else showError('Sua cong thuc that bai: '+response.message);
           }
         },
         error: function(xhr, resp, text){
           showError('Sua cong thuc that bai: '+text);
         }
     });
   }
});
