//TABBALE
$(function () {
    $("#tabs").tabs();
});
const typeFilter = document.getElementById("filter-type");

const basepath = "http://localhost:8000/items/food";

//CHANGE SINGLE ITEM DISPLAY
function changeDisplay1(id) {
    //GET THE CURRENT ITEM INFORMATION
    const itemname = document.getElementById(`itemname${id}`).innerText;
    const itemdesc = document.getElementById(`itemdesc${id}`).innerText;
    const tags = document.getElementById(`tags${id}`).innerHTML;
    const actionBtn = document.getElementById("equip1");

    //CHANGE THE SINGLE ITEM DISPLAYED INFORMATION
    document.getElementById("single-img1").src = `${basepath}/${id}.png`;
    document.getElementById("item_name1").innerHTML = itemname;
    document.getElementById("item_desc1").innerHTML = itemdesc;
    document.getElementById("tags_1").innerHTML = tags;
    document.getElementById("foodfed").value = id;

    //TOGGLE THE FEED BUTTON
    if (itemname == "Item Name") {
        actionBtn.classList.add("hidden");
    } else {
        actionBtn.classList.remove("hidden");
    }
}
function changeDisplay2(id) {
    //GET THE CURRENT ITEM INFORMATION
    const itemname = document.getElementById(`itemname${id}`).innerText;
    const itemdesc = document.getElementById(`itemdesc${id}`).innerText;
    const tags = document.getElementById(`tags${id}`).innerHTML;
    const actionBtn = document.getElementById("equip2");

    //CHANGE THE SINGLE ITEM DISPLAYED INFORMATION
    document.getElementById("single-img2").src = `${basepath}/${id}.png`;
    document.getElementById("item_name2").innerHTML = itemname;
    document.getElementById("item_desc2").innerHTML = itemdesc;
    document.getElementById("tags_2").innerHTML = tags;
    document.getElementById("petdress").value = id;

    //TOGGLE THE FEED BUTTON
    if (itemname == "Item Name") {
        actionBtn.classList.add("hidden");
    } else {
        actionBtn.classList.remove("hidden");
    }
}
function changeDisplay3(id) {
    //GET THE CURRENT ITEM INFORMATION
    const itemname = document.getElementById(`itemname${id}`).innerText;
    const itemdesc = document.getElementById(`itemdesc${id}`).innerText;
    const tags = document.getElementById(`tags${id}`).innerHTML;
    const actionBtn = document.getElementById("equip3");

    //CHANGE THE SINGLE ITEM DISPLAYED INFORMATION
    document.getElementById("single-img3").src = `${basepath}/${id}.png`;
    document.getElementById("item_name3").innerHTML = itemname;
    document.getElementById("item_desc3").innerHTML = itemdesc;
    document.getElementById("tags_3").innerHTML = tags;

    //TOGGLE THE FEED BUTTON
    if (itemname == "Item Name") {
        actionBtn.classList.add("hidden");
    } else {
        actionBtn.classList.remove("hidden");
    }
}
function changeDisplay4(id) {
    //GET THE CURRENT ITEM INFORMATION
    const itemname = document.getElementById(`itemname${id}`).innerText;
    const itemdesc = document.getElementById(`itemdesc${id}`).innerText;
    const tags = document.getElementById(`tags${id}`).innerHTML;
    const actionBtn = document.getElementById("equip4");

    //CHANGE THE SINGLE ITEM DISPLAYED INFORMATION
    document.getElementById("single-img4").src = `${basepath}/${id}.png`;
    document.getElementById("item_name4").innerHTML = itemname;
    document.getElementById("item_desc4").innerHTML = itemdesc;
    document.getElementById("tags_4").innerHTML = tags;
    //TOGGLE THE FEED BUTTON
    if (itemname == "Item Name") {
        actionBtn.classList.add("hidden");
    } else {
        actionBtn.classList.remove("hidden");
    }
}

//FUNCTIONS WITH FEEDING THE PONY
function actionPet(action, desc, cancel) {
    const div = document.getElementById(action);
    const itemDesc = document.getElementById(desc);
    const cancelBtn = document.getElementById(cancel);

    //TOGGLE THE PONY SELECTION
    if (div.classList.contains("hidden")) {
        div.classList.remove("hidden");
        itemDesc.classList.add("hidden");
    }

    //ACTION THE CANCEL BUTTON
    cancelBtn.addEventListener("click", () => {
        div.classList.add("hidden");
        itemDesc.classList.remove("hidden");
    });
}

function actionWhichPet(id) {
    const select = id + "Select";
    const img = id + "Img";
    const pony = document.getElementById(select);
    //GET THE PONY AGE AND ID FROM SELECT VALUE
    let ponyArray = JSON.parse("[" + pony.value + "]");
    console.log(img);
    if (ponyArray[1] >= 14) {
        const test = (document.getElementById(
            img
        ).src = `/ponys/adult/${ponyArray[0]}.png`);
        console.log(test);
    } else {
        const test = (document.getElementById(
            img
        ).src = `/ponys/baby/${ponyArray[0]}.png`);
        console.log(test);
    }
}

function itemPopUp(id) {
    //PARTIAL MATCH TO POPUP
    document.querySelectorAll("[class^='popup']").forEach((e) => {
        //IF THE POPUP MATCHES ID OF ITEM HOVERED SHOW
        if (e.classList.contains(`popup${id}`)) {
            e.classList.remove("hidden");
        } else {
            //OTHERWISE HIDE THE POPUP FOR ALL OTHERS
            e.classList.add("hidden");
        }
    });
}

function closePopUp() {
    //CLOSE ALL THE POPUPS
    document.querySelectorAll("[class^='popup']").forEach((e) => {
        e.classList.add("hidden");
    });
}

//FUNCTION LOADING SCREEN UNTIL IMAGES LOAD
let imagesLoaded = 0;
const totalImages = document.querySelectorAll("img").length;
const lottieReady = { loaded: false };

function checkAllLoaded() {
    if (imagesLoaded === totalImages && lottieReady.loaded) {
        overlay.style.display = "none";
    }
}

document.querySelectorAll("img").forEach((img) => {
    if (img.complete) {
        imagesLoaded++;
        checkAllLoaded();
    } else {
        img.addEventListener("load", () => {
            imagesLoaded++;
            checkAllLoaded();
        });
    }
});
