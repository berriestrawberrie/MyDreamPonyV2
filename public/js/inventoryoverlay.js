//TABBALE
  $( function() {
    $( "#tabs" ).tabs();
  } );
const typeFilter = document.getElementById("filter-type");

  //CHANGE SINGLE ITEM DISPLAY
function changeDisplay1(id){
    //GET THE CURRENT ITEM INFORMATION
    const itemname = document.getElementById(`itemname${id}`).innerText;
    const itemdesc = document.getElementById(`itemdesc${id}`).innerText;
    const tags = document.getElementById(`tags${id}`).innerHTML;   

    //CHANGE THE SINGLE ITEM DISPLAYED INFORMATION
    document.getElementById("single-img1").src = "/item/"+ id +"/icon";
    document.getElementById("item_name1").innerHTML = itemname;
    document.getElementById("item_desc1").innerHTML = itemdesc;
    document.getElementById("tags_1").innerHTML = tags;
    document.getElementById("foodfed").value = id;
}
function changeDisplay2(id){
    //GET THE CURRENT ITEM INFORMATION
    const itemname = document.getElementById(`itemname${id}`).innerText;
    const itemdesc = document.getElementById(`itemdesc${id}`).innerText;
    const tags = document.getElementById(`tags${id}`).innerHTML;   

    //CHANGE THE SINGLE ITEM DISPLAYED INFORMATION
    document.getElementById("single-img2").src = "/item/"+ id +"/icon";
    document.getElementById("item_name2").innerHTML = itemname;
    document.getElementById("item_desc2").innerHTML = itemdesc;
    document.getElementById("tags_2").innerHTML = tags;
}
function changeDisplay3(id){
    //GET THE CURRENT ITEM INFORMATION
    const itemname = document.getElementById(`itemname${id}`).innerText;
    const itemdesc = document.getElementById(`itemdesc${id}`).innerText;
    const tags = document.getElementById(`tags${id}`).innerHTML;   

    //CHANGE THE SINGLE ITEM DISPLAYED INFORMATION
    document.getElementById("single-img3").src = "/item/"+ id +"/icon";
    document.getElementById("item_name3").innerHTML = itemname;
    document.getElementById("item_desc3").innerHTML = itemdesc;
    document.getElementById("tags_3").innerHTML = tags;
}
function changeDisplay4(id){
    //GET THE CURRENT ITEM INFORMATION
    const itemname = document.getElementById(`itemname${id}`).innerText;
    const itemdesc = document.getElementById(`itemdesc${id}`).innerText;
    const tags = document.getElementById(`tags${id}`).innerHTML;   

    //CHANGE THE SINGLE ITEM DISPLAYED INFORMATION
    document.getElementById("single-img4").src = "/item/"+ id +"/icon";
    document.getElementById("item_name4").innerHTML = itemname;
    document.getElementById("item_desc4").innerHTML = itemdesc;
    document.getElementById("tags_4").innerHTML = tags;
}

//FUNCTIONS WITH FEEDING THE PONY
function feedPet(){
    
    const div = document.getElementById("feedPet");
    const btn = document.getElementById("equip1");

    if(div.classList.contains("hidden")){
        div.classList.remove("hidden");
        btn.innerText = "Cancel";
    }else{
        div.classList.add("hidden");
        btn.innerText = "Feed";
    }

}
function feedWhichPet(){
    const pony = document.getElementById("feedPetSelect");

    document.getElementById("feedPetImg").src = `/pony/image/${pony.value}`;
}


function itemPopUp(id){
    //PARTIAL MATCH TO POPUP
    document.querySelectorAll("[class^='popup']").forEach(
        (e)=>{
            //IF THE POPUP MATCHES ID OF ITEM HOVERED SHOW
            if(e.classList.contains(`popup${id}`)){
                e.classList.remove("hidden");
            }else{
                //OTHERWISE HIDE THE POPUP FOR ALL OTHERS
                e.classList.add("hidden");
            }
        }
    );
}

function closePopUp(){
    //CLOSE ALL THE POPUPS
    document.querySelectorAll("[class^='popup']").forEach(
        (e)=>{
            e.classList.add("hidden");
        });
}