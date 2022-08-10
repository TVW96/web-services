<html>
<head>
<title>Bond Web Service Demo</title>
<style type="text/css">
  body{
    background-image: url('https://e2.365dm.com/18/06/2048x1152/skysports-mankind-mick-foley_4348633.jpg')
  }
</style>
<style>
	body {font-family:georgia;}

    .bigYellow {
      font-size: 25px;
      color: #f5e90c;
    }
  
    .poster img{
      position: center;
      max-width: 200px;
    }
    .container2{
      background-color: #c31818;
      border:10px solid #f5e90c;
      border-radius: 20px;
      padding: 10px;
      margin-bottom:5px;
      position:relative; 
    }

   .container{
    background-color: #2824a3;
    border:1px solid #5e1294;
    border-radius: 5px;
    padding: 50px;
    margin-bottom:30px;
    position:relative;   
   }
   
  
   .film{
    color: #000000;
    border:10px solid #5e1294;
    background-color: #FFFFFF;
    border-radius: 5px;
    padding: 50px;
    margin-bottom:5px;
    position:relative;   
  }

 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

  .pic img{
	max-width:200px;
}

</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>
  
<script type="text/javascript">

function bondTemplate(film){

  return `
        <div class="container">
        <div class="film">
        <b>Wrestler</b>: ${film.Name}<br />
        <b>BodyPart</b>: ${film.BodyPart}<br />
        <b>Year</b>: ${film.Year}<br />
        <b>Brand</b>: ${film.Brand}<br />
        <b>Details</b>: ${film.Details}<br />
      </div>
        <div class="pic"><img src="thumbnails/${film.Image}" /></div>
      </div>
  `;
  
}


  
$(document).ready(function() { 
 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);

//let myData = JSON.stringify(data,null,4);
  //  myData = "<pre>" + myData + "</pre>";
    //$("#output").html(myData);

//use data.title to show the order of films
    $("#filmtitle").html(data.title);

//clear the previous films
     $("#films").html("");


  //loop through data.films and add to #films div
    $.each(data.films,function(i,item){
      let myFilm = bondTemplate(item);
      $("<div></div>").html(myFilm).appendTo("#films");
    });

  



   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
 
  });
}); 


</script>
</head>
	<body>
  <div class="container2">
	<h1>Most Notable Wrestling Injuries</h1>
  </div>
    <div class="poster"><img src="images/Pose.jpg" /></div>
    
    <div class="container2">
    <div class="bigYellow">
		<a href="year" class="category">Injuries By Year</a><br />
		<a href="box" class="category">Injuries by Body Part</a>
    <div>
		<h3 id="filmtitle">This is a Web Service</h3>
    
		<div id="films">
    </div>
    </div>

      <div id="output">By, Troy Washington</div>
	</body>
</html>