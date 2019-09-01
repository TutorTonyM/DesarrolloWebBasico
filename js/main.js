$(document).ready(function(){

    newPost();

    function newPost(){

        if($('#category-selector').val() !== null){
            $('#new-post-fileds').show();
        }

        $('#category-selector').change(function(){
            $('#new-post-fileds').slideDown('medium');
        });
    }

});