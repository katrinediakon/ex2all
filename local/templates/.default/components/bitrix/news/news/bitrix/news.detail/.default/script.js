function complaint(id)
{
  var currentLocation = window.location;
  var id;
  $.ajax({
    type: 'POST',
    url: currentLocation,
    async: false,
    data: "COMPLAINT=Y",
    success: function(data){
      alert(data);
      id=data;
    }
  });


document.getElementById('complaint').firstChild.data = "Ваше мнение учтено, "+id;


}
