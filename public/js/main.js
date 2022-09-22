var url ='http://blog.local/';

window.addEventListener("load", function (){

    $('.btn-like').css('cursor','pointer');
    $('.btn-dislike').css('cursor','pointer');

    //boton de like
    function like(){
        $('.btn-like').unbind('click').click(function (){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src',url+'img/corazon-rojo.png');

            $.ajax({
                url: url+'/like/'+ $(this).data('id'),
                type: 'GET',
                success: function (response){
                    if (response.like){
                        console.log('has dado like');
                    }else{
                        console.log('error like');
                    }

                }
            });
            dislike();
        });
    }
    like();

    //boton de dislike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function (){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src',url+'img/hearts-64.png');

            $.ajax({
                url: url+'/dislike/'+ $(this).data('id'),
                type: 'GET',
                success: function (response){
                    if (response.like){
                        console.log('has dado dislike');
                    }else{
                        console.log('error dislike');
                    }

                }
            });
            like();
        });
    }
    dislike();


    //buscador
    $('#buscador').submit(function (e){
        $(this).attr('action',url+'/gente/'+$('#buscador #search').val());

    })
});
