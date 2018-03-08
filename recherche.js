  
$(document).ready(function()
		 {
		 	 
 
$("#recheche").on("click",function()
{
  
	  name = $("#ajax").val();
 
	   
	   

	    
	   
  alert("vous allez envoyer une requete "+name+"  ..............");
     
   

 $.ajax(
 {
 	url:'actions1.php',
 	type:'POST',
 	data:  {annee:name} ,

 	beforeSend:function(hxr){
console.log('beforSend: Requete en cours.............');
// $("#resultatAjax").html(' Working in ................');
 
 	},
 	success:function(data,status, xhr){
console.log('SUUCCESS DATA ='+data +' -- status = '+ status +'-- xhr = '+ xhr );
console.log( data );
 		 

$("#resultatAjax").html(data);

 	},
 	error:function(xhr,status, error){

console.log("ERROR:Erreur execution requete ajax");
console.log("jqXhr ="+ xhr

+"-- textStatut="+status
+"-- errorThrown="+error);
 	},
 	complete : function(xhr, status){
console.log('COMPLETE hxr='+ xhr +'-- status = '+ status );

 	},
 	statusCode: {
404 :function(){

	console.log("STATUSCODE: 404 : Page not found !!!!!!!!!!!!");
}
 	} 

 });

	});

	});


function downloadCSV(csv,filename){
	var csvFile;

    var downloadLink;
 
    // CSV file
    csvFile = new Blob([csv], {type: 'text/csv;charset = utf-8;\uFEFF" + downloadLink'} );

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}
 	 

function exportTableToCSV(filename){
 var csv = [];
 
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row =[] , cols = rows[i].querySelectorAll("td, th");
     
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(";"));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
 