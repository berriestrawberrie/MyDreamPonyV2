<div class="w-full" id="tabs">
  <!-- Tab Buttons -->
  <div class="flex flex-wrap gap-2" id="tab-buttons">
    <button class="tab-button px-4 py-2 tabBtn bg-blue-100 text-blue-800 active" data-tab="tab-1">Profile</button>
    <button class="tab-button px-4 py-2 tabBtn bg-blue-100 text-blue-800" data-tab="tab-2">Inventory</button>
    <button class="tab-button px-4 py-2 tabBtn bg-blue-100 text-blue-800" data-tab="tab-3">Lineage</button>
    <button class="tab-button px-4 py-2 tabBtn bg-blue-100 text-blue-800" data-tab="tab-4">Breeding</button>
    <button class="tab-button px-4 py-2 tabBtn bg-blue-100 text-blue-800" data-tab="tab-5">Competition</button>
    <button class="tab-button clearBtn" data-tab="tab-6"><i class="text-2xl fa-solid fa-pen"></i></button>
  </div>

  <!-- Tab Content -->
  <div id="tab-1" class="tab-content hidden">
    <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus...</p>
  </div>
  <div id="tab-2" class="tab-content hidden">
    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante...</p>
  </div>
  <div id="tab-3" class="tab-content hidden">
    @include('pony.components.tabs.lineage')
  </div>
  <div id="tab-4" class="tab-content hidden">
    @include('pony.components.tabs.breeding')
  </div>
  <div id="tab-5" class="tab-content hidden">
    <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti...</p>
  </div>
    <div id="tab-6" class="tab-content block ">
    @include('pony.components.tabs.edit')
  </div>
</div>

