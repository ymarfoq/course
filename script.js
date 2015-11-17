$(document).ready(function (e) {

	$('#inscription_form').on('submit',(function(e){
		e.preventDefault();
		//var form=$("#inscription_form");
		//var pseudo=$("#pseudo").val();
		//var data = {"surnom": surnom};
		//var data = new FormData(this);
		$.ajax({
			type: 'POST',
			url: 'data.php',
			contentType: false,
			cache: false,
			processData: false,
			data: new FormData(this)});
		$('#liste_participants').append(''
			+'<tr>'
				+'<td class="pseudo" align=center>'+$("#pseudo").val()+'</td>'
				+'<td class="photo" align=center><img src="images/participant1.png" width=50 height=50></td>'
				+'<td class="sprint" align=center>oui</td>'
				+'<td class="endurance" align=center>oui</td>'
				+'<td class="autre" align=center>???</td>'
			+'</tr>'
		);
		return false;
	}));
});

/*
// Function to preview image after validation
$(function() {
$("#file").change(function() {
$("#message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$('#previewing').attr('src','noimage.png');
$("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
return false;
}
else
{
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
}
});
});
function imageIsLoaded(e) {
$("#file").css("color","green");
$('#image_preview').css("display", "block");
$('#previewing').attr('src', e.target.result);
$('#previewing').attr('width', '250px');
$('#previewing').attr('height', '230px');
};
});
*/
