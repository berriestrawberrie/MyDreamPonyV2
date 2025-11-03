// ┌─────────────────────────────┐
// │ LOAD NPC ITEMS IN DIALOG    │
// └─────────────────────────────┘

const dialog = document.getElementById("dialog");
const basepath = "http://localhost:8000/items/food";
const npc = document.getElementById("npc-talk");

function changeDialog(id) {
    const item = document.getElementById(id);
    const rarity = item.dataset.rarity;
    const tags = item.dataset.tags;
    const info = item.dataset.info;
    const name = item.dataset.itemname;
    const type = item.dataset.itemtype;
    const price = item.dataset.price;
    const buff = item.dataset.buff;
    const debuff = item.dataset.debuff;
    const user = item.dataset.user;
    let rarityClass;
    switch (rarity) {
        case "common":
            rarityClass =
                "text-xs font-bold text-gray-400 border border-gray-400 px-2 py-1 bg-gray-100 rounded-2xl";
            break;
        case "uncommon":
            rarityClass =
                "text-xs font-bold text-green-600 border border-green-600 px-2 py-1 bg-green-100 rounded-2xl";
            break;
        case "rare":
            rarityClass =
                "text-xs font-bold text-blue-500 border border-blue-500 px-2 py-1 bg-blue-100 rounded-2xl";
            break;
        case "crystal":
            rarityClass =
                "text-xs font-bold text-cyan-500 border border-cyan-500 px-2 py-1 bg-cyan-100 rounded-2xl";
            break;
        case "seasonal":
            rarityClass =
                "text-xs font-bold text-orange-500 border border-orange-500 px-2 py-1 bg-orange-100 rounded-2xl";
            break;
        case "legendary":
            rarityClass =
                "text-xs font-bold text-purple-700 border border-purple-700 px-2 py-1 bg-purple-100 rounded-2xl";
            break;
        case "mythic":
            rarityClass =
                "text-xs font-bold text-yellow-400 border border-yellow-400 px-2 py-1 bg-yellow-100 rounded-2xl";
            break;
        default:
            rarityClass = "";
    }
    //SET THE FORM ACTION FOR THAT ITEM
    document
        .getElementById("itemForm")
        .setAttribute("action", `/purchase/item/${id}/${price}/${user}`);
    //OPEN THE DIALOG BOX
    dialog.classList.remove("hidden");
    dialog.classList.add("flex");
    npc.classList.add("hidden");
    //UPDATE THE INFO
    document.getElementById("title").innerText = name;
    document.getElementById("title2").innerText = name;
    document.getElementById("info").innerText = info;
    document.getElementById("image").src = `${basepath}/${id}.png`;
    document.getElementById("tags").innerHTML = `<b>Tags: </b> ${tags}`;
    document.getElementById("rarity").classList.add(...rarityClass.split(" "));
    document.getElementById("rarity").innerText = rarity;
}

function cancelSale() {
    dialog.classList.add("hidden");
    dialog.classList.remove("flex");
    npc.classList.remove("hidden");
}
