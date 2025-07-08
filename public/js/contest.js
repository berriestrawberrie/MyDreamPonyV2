const selected = document.getElementById("selectcontest");
const splits = document.getElementById("adultsplit");
const unlimit = document.getElementById("adultunlimited");
const baby = document.getElementById("babies");
const btnBaby = document.getElementById("btnBaby");
const allSplit = document.getElementById("adultsplits5");
const allUnl = document.getElementById("adultunlimit5");
const allBaby = document.getElementById("baby5");

//ACCORDION

  $( function() {
    $( "#accordion" ).accordion({
        collapsible: true ,
        active: false
    });
  } );

$( function() {
    $( "#accordion2" ).accordion({
        collapsible: true ,
        active: false
    });
    } );





function displayContest(){

    if(selected.value === "split"){
        
        splits.classList.remove("hidden");
        unlimit.classList.add("hidden");
        //CLEAR THE UNLIMITED CHECKS
        document.querySelectorAll("[id^='adultunlimit']").forEach(
            (e)=>{
                e.checked = false;
            });

    }else if(selected.value === "unlimit"){

        splits.classList.add("hidden");
        unlimit.classList.remove("hidden");
        //CLEAR THE SPLITS CHECKS
        document.querySelectorAll("[id^='adultsplits']").forEach(
        (e)=>{
            e.checked = false;
        });


    }else{
        splits.classList.add("hidden");
        unlimit.classList.add("hidden");
    }

}

//HIDE AND SHOW BABY CONTESTS
btnBaby.addEventListener("click", ()=>{

    if(baby.classList.contains("hidden")){
        btnBaby.innerHTML = '<i class="fa-solid fa-minus"></i> Remove Babies';
        baby.classList.remove("hidden");
        document.querySelectorAll("[id^='baby']").forEach(
            (e)=>{
                e.checked = false;
            });

    }else{
        btnBaby.innerHTML = '<i class="fa-solid fa-plus"></i> Baby Contests';
        baby.classList.add("hidden");
    }

});

//CHECK ALL SPLITS
allSplit.addEventListener("click", ()=>{
    if(allSplit.checked){
        document.querySelectorAll("[id^='adultsplits']").forEach(
            (e)=>{
                e.checked = true;
            });
    }else{
                document.querySelectorAll("[id^='adultsplits']").forEach(
            (e)=>{
                e.checked = false;
            });
    }
});

//CHECK ALL UNLIMITED
allUnl.addEventListener("click", ()=>{
    if(allUnl.checked){
        document.querySelectorAll("[id^='adultunlimit']").forEach(
            (e)=>{
                e.checked = true;
            });
    }else{
                document.querySelectorAll("[id^='adultunlimit']").forEach(
            (e)=>{
                e.checked = false;
            });
    }
});

//CHECK ALL BABIES
allBaby.addEventListener("click", ()=>{
    if(allBaby.checked){
        //CHECK ALL INPUTS
        document.querySelectorAll("[id^='baby']").forEach(
            (e)=>{
                e.checked = true;
            });
    }else{
        //UNCHECK ALL INPUTS
        document.querySelectorAll("[id^='baby']").forEach(
            (e)=>{
                e.checked = false;
            });
    }
});

//SIGNUP ALL ADULTS FOR CONTEST
document.getElementById("massAdult").addEventListener("click", ()=>{
    document.querySelectorAll('input[type="checkbox"]').forEach((e)=>{
        e.checked=true;
    })
});