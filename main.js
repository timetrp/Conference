$(document).ready(function() {

    console.log('ready');

    $('#searchForm').submit(function(e){
        e.preventDefault();
        let query = $('#searchTerm').val();
        let Url = './server.php';

       
        $.post(Url, { query:query})
        .done(function( data ) {
            
            console.log(data);
            debugger;
            alert( "Data Loaded: " + data );
          });

    })

   
   



})


function showHint(str) {
    console.log(str);
    
  
}


