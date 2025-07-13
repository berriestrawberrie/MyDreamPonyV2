const postBtn = document.getElementById("newpost");
const cancelPost = document.getElementById("cancelpost");
const form = document.getElementById("post-form");
const content = document.getElementById("post-content");

//OPEN NEW POST FORM 
postBtn.addEventListener("click", ()=>{
    form.classList.remove("hidden");
    postBtn.classList.add("hidden");
});

//CLOSE POST FORM
cancelPost.addEventListener("click", ()=>{
    form.classList.add("hidden");
    postBtn.classList.remove("hidden");
    content.value="";
});

//CONVERT EACH POST TO HTML
document.querySelectorAll(".post").forEach((e)=>{

    e.innerHTML = e.innerText;

});

  $( function() {
    $( ".spoiler" ).accordion({
        collapsible: true ,
        active: false
    });
  } );