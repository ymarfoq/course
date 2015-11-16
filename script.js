$('#submit').click(function(){
	
	var surnom=$("#surnom").val();
	var data = {"surnom": surnom};
	var request = $.ajax({
		type: 'POST',
		url: 'data.php',
		dataType: "String",
		data: data});
		$('#liste_participants').append('<li>' + surnom + '</li>');
	return false;
});
