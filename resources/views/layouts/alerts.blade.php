 @if(session()->has('success'))
    <div class='w-full md:w-3/4 mx-auto mb-4 bg-green-200 border border-green-500 text-center'>
        <p>{{session('success')}}</p>
    </div>
@endif

@if(session()->has('error'))
    <div class='w-full md:w-3/4 mx-auto mb-4 bg-red-200 border border-red-500 text-center'>
    <p>{{session('error')}}</p>
    </div>
@endif

