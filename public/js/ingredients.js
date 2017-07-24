var ing=0;
$('#add-ing').click(function() {
    ing++;
    if(ing!=0){
        $('.title-ing').css('display','block');
    }
    var ing_id = ID();
    $('<div id="'+ing_id+'" class="form-group ingredient-counter"><div class="col-md-6"><input class="form-control auto-ing" type="text" name="ingredients[]" required></div><div class="col-md-5"><input type="text" class="form-control" name="count_ing[]" required></div><div class="col-md-1"><a href="javascript:void(0)" onclick="delete_ing(\''+ing_id+'\')" class="btn btn-danger btn-sm"><i class="fa fa-minus-square-o" aria-hidden="true"></i></a></div></div>').fadeIn('slow').appendTo('.block-of-ingredients');
});

$('#form-recipe').submit(function(){
    var count_ing = $('.ingredient-counter').length;
    if( count_ing == 0){
    $('<p class="alert alert-danger">Добавьте ингредиент(ы)!<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>').fadeIn('slow').appendTo('.block-of-ingredients');
        return false;
    }
});

function delete_ing(id) {
    $('#'+id).remove();
}

var ID = function () {
    return '_' + Math.random().toString(36).substr(2, 9);
};

