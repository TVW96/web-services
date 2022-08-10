<html>
<head>
<title>Bond Web Service Demo</title>
<style>
	body {font-family:georgia;}

   .film{
    border:1px solid #E77DC2;
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
	max-width:100px;
}


</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>
  
<script type="text/javascript">

function bondTemplate(film){

  return `
        <div class="film">
        <b>BodyPart</b>: ${film.BodyPart}<br />
        <b>Year</b>: ${film.Year}<br />
        <b>Wrestler</b>: ${film.Name}<br />
        <b>Brand</b>: ${film.Brand}<br />
        <b>Details</b>: ${film.Details}<br />
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
	<h1>Most Notable Wrestling Injuries</h1>
		<a href="year" class="category">Injuries By Year</a><br />
		<a href="box" class="category">Injuries by Body Part</a>
		<h3 id="filmtitle">This is a Web Service</h3>
		<div id="films">
      
      <!--
		  <div class="film">
        <b>Film</b>: 1<br />
        <b>Title</b>: Dr. No<br />
        <b>Year</b>: 1962<br />
        <b>Director</b>: Terence Young<br />
        <b>Producers</b>: Harry Saltzman and Albert R. Broccoli<br />
        <b>Writers</b>: Richard Maibaum, Johanna Harwood and Berkely Mather<br />
        <b>Composer</b>: Monty Norman<br />
        <b>Bond</b>: Sean Connery<br />
        <b>Budget</b>: $1,000,000.00<br />
        <b>BoxOffice</b>: $59,567,035.00<br />
        <div class="pic"><img src="thumbnails/dr-no.jpg" /></div>
      </div>
      -->
    </div>
		<div id="output">By, Troy Washington</div>
	</body>
</html>