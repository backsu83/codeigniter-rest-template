<body>
<!-- wrap : s -->
<div id="wrap">
    <div class="userBox">
    	<span>admin님이 로그인 했습니다.</span> <a href="logout" target="_self" class="btnC">로그아웃</a>
    </div>
    <div>
    <ul class="menu">
        <li><a href="game?mode=<?=$_GET['mode']?>" target="_self">당첨 좌석 관리</a></li>
        <li><a href="control?mode=<?=$_GET['mode']?>" target="_self">화면 제어</a></li>
    </ul>
    <ul class="menu">
        <? foreach ($gameModeAll as $key => $value) { ?>
        <li style="<?=($value==$gameMode)?'font-weight:bold':''?>"><a href="game?mode=<?=$value?>" target="_self">[<?=$value?>]</a></li>
        <? } ?>
    </ul>
    </div>
    <!-- content : s -->
        <div id="content">
        	<div class="tableList">
                <? foreach($table as $game => $seats) {?>
                <div class="tableCnt">
                    <div class="btnCntL">
                        <a href="" class="btnSave">저장</a>
                    </div>
            		<h3 class="tableNum"><?=$game?></h3>
            		<ul>
                        <? foreach($seats as $num => $seat) { ?>
            			<li><a href="" table-seat-num=<?=$seat['view']?> class="<?=($seat['win']==1)?'on':''?>"><?=$num;?></a></li>
                        <? } ?>
            		</ul>
            	</div>
             <? } ?>
        	</div>
        </div>
    <!-- content : e -->
    </div>
<div id="gameMode" name="<?=$gameMode?>" style="display: none" ></div>
<!-- wrap : s -->
</body>
</html>
<script>

$(".tableCnt ul li a").bind("click", function(e){
    if( $(this).hasClass("on") ){
        $(this).removeClass("on");
    } else {
        $(this).addClass("on");
    }
    e.preventDefault();
});

$(".tableCnt .btnSave").bind("click", function(e){
    var emIndex = $(".tableList .btnSave").index( $(this) );
    var emUl = $(".tableList ul").eq( emIndex );
    var emTalbeNum = $(".tableList .tableNum").eq( emIndex ).text();
    var gameMode = $("#gameMode").attr("name");

    var addArray = "";
    var removeArray = "";

    for( var i = 0; i < emUl.find("li").length; i++ ){
        var clickEm = emUl.find("li").eq( i ).find("a");

        if( emUl.find("li").eq( i ).find("a").hasClass("on") ){
            //console.log( "add", clickEm.text() )
            addArray += clickEm.attr("table-seat-num") + ",";
        } else {
            //console.log( "remove", clickEm.text() )
            removeArray += clickEm.attr("table-seat-num") + ",";
        }
    }

    //console.log(addArray)
    //console.log(removeArray)

    $.ajax({
        url: './game',
        data: { add: addArray, remove: removeArray , mode:gameMode},
        type: "POST",
        success: function(data, e, d) {
            //data = data.split(" ").join("");
            location.href = "./game?mode=" + data;
            //console.log(data);
            alert('저장 완료!')
        }
    });
    e.preventDefault();
});
</script>
