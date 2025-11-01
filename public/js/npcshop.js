// ┌─────────────────────────────┐
// │ LOAD NPC ITEMS IN DIALOG    │
// └─────────────────────────────┘

const dialog = document.getElementById("dialog");

console.log(name);

function changeDialog(id) {
    const item = document.getElementById(id);
    const rarity = item.dataset.rarity;
    const tags = item.dataset.tags;
    const info = item.dataset.info;
    const name = item.dataset.itemname;
    const type = item.dataset.itemtype;
    const buff = item.dataset.buff;
    const debuff = item.dataset.debuff;
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

    dialog.innerHTML = `
        <div class="flex items-center gap-2">
            <div class="w-[120px] flex flex-col items-center ">
                <b class="text-sm text-center">${name}</b>
                <img title="test" class="sm:w-[90px] sm:h-[90px]" src="items/food/${id}.png">
                <span class="${rarityClass}">${rarity}</span>
            </div>
            <div class="">
                <p>${info}</p>
                <span><b>Tags: </b>${tags}</span>
                <div class="w-full flex gap-2 justify-end">
                    <span class="relative border-4 border-amber-400 bg-red-400 p-2 hover:bg-red-500 rounded-2xl">Cancel
                        <img class="absolute w-[10px] top-[3px] right-[3px] opacity-80 " src="site/white-shine.png">
                    </span>                                
                    <span class="relative border-4 border-amber-400 bg-sky-400 p-2 hover:bg-sky-500 rounded-2xl">Buy
                        <img class="absolute w-[10px] top-[3px] right-[3px] opacity-80 " src="site/white-shine.png">
                    </span>

            </div>

            </div>
        </div>
    `;
}
