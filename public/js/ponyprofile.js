//TABBALE
  $( function() {
    $( "#tabs" ).tabs();
  } );

  function selectMate(){
    const selected = document.getElementById("breeder2");
    const img = document.getElementById("breeder-img");

    img.src = `/ponys/adult/${selected.value}.png`;


  }
 //TOOLTIPS
  $( function() {
    $( document ).tooltip();
  } );

