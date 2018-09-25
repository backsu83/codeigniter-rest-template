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

    </ul>
    </div>
	<!-- content : s -->
	<div id="content">
		<p class="msgTxt">
			당첨 좌석 정보가 변경되었습니다.<br/>
			당첨자 번호가 불일치 합니다.<br/>
			당첨 번호를 생성해주세요.
		</p>
		<a href="" class="btnGenrate">당첨번호 생성</a>

		<div class="stateBox">
			<h3 class="title"> 당첨 예정 번호</h3>
			<span> : </span>
            <p class="txt answer"><?=$seatWin?></p>
            <p class="txt wrg">당첨 번호를 생성해주세요.</p>
		</div>

		<div class="ctrlBtnCnt2">
			<h3 class="title">경품 타입</h3>
			<a href="">A</a>
			<a href="">B</a>
			<a href="">C</a>
		</div>

		<div class="stateBox">
			<h3 class="title">현재 화면 모드</h3>
			<span> : </span>

			<div class="txt modeState">대기</div>
		</div>

		<div class="ctrlBtnCnt">
			<a href="" class="">대기</a>
			<a href="">준비</a>
			<a href="">당첨 1</a>
			<a href="">당첨 2</a>
			<a href="">당첨 3</a>
			<a href="">당첨 4</a>
			<a href="">당첨 5</a>
			<a href="">당첨 6</a>
			<a href="">당첨 7</a>
			<a href="">모두보기</a>

		</div>
	</div>
	<!-- content : e -->
</div>
<!-- wrap : s -->
<div id="gameMode" name="<?=$gameMode?>" style="display: none" ></div>
</body>
</html>
<script>

	Array.prototype.shuffle=function(){
		var len = this.length,temp,i
		while(len){
		i=Math.random()*len-- |0;
		temp=this[len],this[len]=this[i],this[i]=temp;
		}
		return this;
	}

$("document").ready(function(){

    var gameMode = $("#gameMode").attr("name");
	var answerList = "<?=$tableWin?>";
	answerList = answerList.slice(0, -1)
	//console.log(answerList);

	var answerListArray = answerList.split(",");
	//console.log(answerListArray);

	var update_state = <?=$updateState?>;
	var mode_state = <?=$modeState?>;
	var gifttype = <?=$gift?>;

	if( update_state ){
		$(".btnGenrate").css({"display" : "inline-block"});
		$(".msgTxt").css({"display" : "block"});
		$(".answer").css({"display" : "none"});
		$(".wrg").css({"display" : "block"});
	} else {
		$(".btnGenrate").css({"display" : "none"});
		$(".msgTxt").css({"display" : "none"});
		$(".answer").css({"display" : "block"});
		$(".wrg").css({"display" : "none"});
	}

	if( mode_state == 0 ){
		$(".modeState").text("대기");
	} else if( mode_state == 1 ){
		$(".modeState").text("준비");
	}  else if( mode_state == 2 ){
		$(".modeState").text("발표");
	} else {
		$(".modeState").text("데이터가 존재하지 않습니다.");
	}

	$(".ctrlBtnCnt a").eq(mode_state).addClass("on");

	$(".ctrlBtnCnt a").bind("click", function(e){
		var index = $(this).index(".ctrlBtnCnt a");

		if( index == 2 ){
			if( update_state ){
				alert("당첨번호를 생성해주세요!");
				return;
			}
		}

		$.ajax({
			url: './control',
			data: { state:index, mode: gameMode , type: "state" },
			type: "POST",
			success: function(data, e, d) {
				//data = data.split(" ").join("");
				alert('저장 완료!')
				location.href = "control?mode=" + data;
				//console.log(data);
			}
		});
		e.preventDefault();
	});

	$(".ctrlBtnCnt2 a").eq(gifttype).addClass("on");

	$(".ctrlBtnCnt2 a").bind("click", function(e){
		var index = $(this).index(".ctrlBtnCnt2 a");
		console.log(index);
		$.ajax({
			url: './control',
			data: { state: index, mode: gameMode , type: "gift_type" },
			type: "POST",
			success: function(data, e, d) {
				//data = data.split(" ").join("");
				alert('저장 완료!')
				location.href = "control?mode=" + data;
				//console.log(data);
			}
		});
		e.preventDefault();
	});

	$(".btnGenrate").bind("click", function(e){
		answerListArray.shuffle();
		console.log(answerListArray);

		var updateAnswer = [];

		for( var i = 0; i < 7; i++ ){
			if( answerListArray[i] == 0 || answerListArray[i] == undefined ){

			} else {
				updateAnswer.push(answerListArray[i]);
			}
		}
		//console.log( updateAnswer );
		$.ajax({
			url: './control',
			data: { state: updateAnswer, mode: gameMode  , type: "answer" },
			type: "POST",
			success: function(data, e, d) {
				//data = data.split(" ").join("");
				alert('저장 완료!')
				location.href = "control?mode=" + data;
				//console.log(data);
			}
		});
		e.preventDefault();
	});
});
</script>
