<div class="w-full border flex justify-evenly">
   
    <table class=" w-1/2">
        <tr>
            <th id="type">{{$group[0]["itemtype"]}}</th>

        </tr>
        <tr>
            <th id="item_name">{{$group[0]["itemname"]}}</th>
        </tr>
        <tr>
            <td id="item_desc">{{$group[0]["info"]}}</td>
        </tr>
        <tr>
            <td id="tags_"> </td>
        </tr>
    </table>

    <div>
        <img id="single-img"src="/item/{{$group[0]["itemid"]}}/icon">
    </div>

</div>
<div class="w-full flex justify-evenly">
    <label for="Order">Sort: </label>
    <select id="Order">
        <option>A-Z</option>
        <option>Qty</option>
        <option>Rarity</option>
    </select>

    <label for="Filter">Filter: </label>
    <select id="filter-type" onchange="selectFilter()">
        <option value="None" selected>None</option>
        <option>Food</option>
        <option>Faceware</option>
        <option>Bodyware</option>
        <option>Tailware</option>
        <option>Neckware</option>
        <option>Hooveware</option>
    </select>
</div>