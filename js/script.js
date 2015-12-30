$(document).ready(function (e) {

	try {
		var discussionIdGet = decodeURIComponent(window.location.search.match(/(\?|&)discussion\=([^&]*)/)[2]);
	}
	catch (e) {var discussionIdGet=""};
	var verif_mail=false;
	var verif_pseudo=false

	$('#inscription_form').on('submit',(function(e){
		e.preventDefault();
		if(verif_mail & verif_pseudo) {
			$.ajax({
						type: 'POST',
						url: 'data.php',
						contentType: false,
						cache: false,
						processData: false,
						data: new FormData(this)
					})
					.done(function (data) {
						if ($("#sprint").is(":checked")) {
							var sprint = "images/tick.png";
						} else {
							var sprint = "images/cross.png";
						}
						;
						if ($("#endurance").is(":checked")) {
							var endurance = "images/tick.png";
						} else {
							var endurance = "images/cross.png";
						}
						;
						if ($("#autre").is(":checked")) {
							var autre = "images/tick.png";
						} else {
							var autre = "images/cross.png";
						}
						;
						var photo = $("#load_photo").attr('src');
						$('#first_line').after(''
								+ '<tr title="' + $("#description").val() + '">'
								+ '<td class="pseudo" align="left">' + $("#pseudo").val() + '</td>'
								+ '<td class="photo"><img src="' + photo + '" height=50></td>'
								+ '<td class="sprint"><img src="' + sprint + '" height=25></td>'
								+ '<td class="endurance"><img src="' + endurance + '" height=25></td>'
								+ '<td class="autre"><img src="' + autre + '" height=25></td>'
								+ '<td align=center><form action="data.php" method="post">'
								+ '<input type="hidden" name="action" value="supprimer">'
								+ '<input type="hidden" name="mail" value="' + $("#mail").val() + '">'
								+ '<input type="submit" value="x">'
								+ '</form></td>'
								+ '</tr><tr><td colspan=5><hr></td></tr>'
						);
					});
		}
		return false;
	}));

	$('#pseudo').focusout((function(e){
		if(this.value=="") {
			$('#pseudo').css("box-shadow", "inset 0px 0px 0px 0px black");
			$('#pseudo').css("border", "1px solid #d3be79");
		}else{
			$.ajax({
				type: 'POST',
				url: 'data.php',
				data: 'action=verification&pseudo=' + this.value
			})
			.done(function (data) {
				if (data >0) {
					$('#pseudo').css("box-shadow", "inset 0px 0px 20px -1px rgba(211, 69, 41, 0.45)");
					$('#pseudo').css("border", "2px solid rgba(211, 69, 41, 1)");
					verif_pseudo=false;
				}
				else {
					$('#pseudo').css("box-shadow", "inset 0px 0px 20px -1px rgba(77, 211, 77, 0.80)");
					$('#pseudo').css("border", "2px solid rgba(77, 211, 77, 1)");
					verif_pseudo=true;
				}
			});
		}
	}));

	$('#mail').focusout((function(e){
		if(this.value=="") {
			$('#mail').css("box-shadow", "inset 0px 0px 0px 0px black");
			$('#mail').css("border", "1px solid #d3be79");
		}else{
			$.ajax({
						type: 'POST',
						url: 'data.php',
						data: 'action=verification_mail&mail=' + this.value
					})
					.done(function (data) {
						if (data >0) {
							$('#mail').css("box-shadow", "inset 0px 0px 20px -1px rgba(211, 69, 41, 0.45)");
							$('#mail').css("border", "2px solid rgba(211, 69, 41, 1)");
							verif_mail=false;
						}
						else {
							$('#mail').css("box-shadow", "inset 0px 0px 0px 0px black");
							$('#mail').css("border", "1px solid #d3be79");
							verif_mail=true;
						}
					});
		}
	}));

	$('.titreOrganisation').click((function(e){
		var id=this.id;
		$.ajax({
			type: 'POST',
			url: 'data.php',
			data: 'action=changeOrganisation&organisationId=' + id
			})
			.done(function (data) {
			$("#organisationSubBlock").html(data);
			$(".titreOrganisation").removeClass("titreOrganisationSelect");
			$("#"+id).addClass("titreOrganisationSelect");
			});
		}));

	// Function to preview image after validation
	$(function() {$("#photo").change(function() {
		var file = this.files[0];
		var imagefile = file.type;
		var match= ["image/jpeg","image/png","image/jpg"];
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
			$('#load_photo').attr('src','photo/origine.png');
			return false;
		}
		else{
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
		}
	});});

	$("#discussion"+discussionIdGet).click();



	function imageIsLoaded(e) {
		$("#photo").css("color","green");
		$('#load_photo').attr('src', e.target.result);
		$('#load_photo').attr('height', '50px');
	};
           
	var jssor_1_SlideshowTransitions = [{$Duration:5000,$Opacity:5}];            
	var jssor_1_options = {
		$AutoPlay: true,
		$SlideshowOptions: {
			$Class: $JssorSlideshowRunner$,
			$Transitions: jssor_1_SlideshowTransitions,
			$TransitionsOrder: 1
		},
		$ArrowNavigatorOptions: {
			$Class: $JssorArrowNavigator$
		},
		$BulletNavigatorOptions: {
			$Class: $JssorBulletNavigator$
		}
	};
            
	var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
	//responsive code begin
	//you can remove responsive code if you don't want the slider scales while window resizes
	function ScaleSlider() {
		var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
		if (refSize) {
			refSize = Math.min(refSize, 4000);
			jssor_1_slider.$ScaleWidth(refSize);
		}
		else {
			window.setTimeout(ScaleSlider, 30);
		}
	}
	ScaleSlider();
	$(window).bind("load", ScaleSlider);
	$(window).bind("resize", ScaleSlider);
	$(window).bind("orientationchange", ScaleSlider);
	//responsive code end
});
