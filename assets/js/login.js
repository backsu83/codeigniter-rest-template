function login( $id, $pw )
{
    if( $id == "" )
    {
        alert( "ID 입력해주세요!" );
        return;
    }else if( $pw == "" )
    {
        alert( "패스워드를 입력해주세요!" );
        return;
    }
    $.ajax({
        url: '/login/auth',
        data: { id: $id, pw : $pw },
        type: "POST",
        success: function(data) {

            if (data === "success") {
                alert('로그인 성공');
                location.replace("/game?mode=BC");
            }
        },
        error: function(){
            alert('로그인 정보를 다시 입력해주세요.');
            $("input").val('');
        }
    });
}

$(window).load(function(e){
    $(document).ready(function(e){
        $( ".btnLogin" ).click(function(){login($("input.n1").val(), $(".input.n2").val())});
    });
});
