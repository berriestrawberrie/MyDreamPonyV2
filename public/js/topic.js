const topicBtn = document.getElementById("opentopic");
const cancel = document.getElementById("canceltopic");
const popUp = document.getElementById("topicpop");
const subject = document.getElementById("subject");
const content = document.getElementById("content");


//OPEN NEW TOPIC POPUP
topicBtn.addEventListener("click", ()=>{

    popUp.classList.remove("hidden");


});

//CLOSE POPUP TOPIC
cancel.addEventListener("click", ()=>{

    popUp.classList.add("hidden");
    subject.value ="";
    content.value = "";


});