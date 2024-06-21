@extends('layout')
@section('content')

   

{{--header--}}
<header class="flex justify-between px-14 border-b border-solid border-slate-300 items-center fixed top-0 w-full bg-white">
    <h3 class="font-bold text-2xl flex"><img class="w-8" src="{{ url('img/icons8-schedule.gif') }}" alt=""> Event<span class="font-semibold text-blue-700">Planner</span></h3>
    <div class="flex items-center">
         <span class="Créer_événement hover:text-slate-500 p-4 rounded-full Creer_evenement">Créer un événement</span>
        <div class="mr-3 ml-28 flex items-center gap-2 relative navprofile">
            <h4 class="text-sm font-medium">{{$info->name}}</h4>
                {{-- img --}}
            <div class="w-10 h-10 rounded-full bg-blue-400 flex justify-center items-center">
                <span class="text-center">
                    @php
                        echo $info->name[0] . $info->name[1];
                    @endphp
                </span>
            </div>
            {{-- nav bar pofile --}}
            <div class="bg-slate-50 absolute -right-4 top-10 p-5 shadow shadow-slate-700 z-auto navbar">
                <a href="/logout" class="bg-slate-200 hover:bg-slate-300 p-2 text-center rounded-xl">Déconnexion</a>
            </div>
        </div>
        
    </div>
</header>
{{--header end--}}
{{--main start--}}
<main class="pt-2 mt-20">
    <!--event start-->
    <h3 class="text-center mb-12 font-bold text-3xl">Tous les évènements</h3>
    <div class=" flex gap-3 flex-wrap justify-center continar_events">
        <!--card-->
        @isset($events)
                @foreach ($events as $it)  
                <a href="/show/{{$it->id}}">
                    <div class="w-52 min-h-56 p-5 rounded-2xl border border-solid border-slate-400 shadow-md hover:shadow-sm shadow-zinc-500 bg-white relative z-10">
                        <h3 class="text-center mb-3 font-semibold">{{$it->title}}</h3>
                        <p class="text-sm mb-4">{{$it->description}}</p>
                        <div class="flex flex-col gap-3">
                            <h3 class="font-medium text-base">organizer par : <span class="font-normal">
                                @foreach ($users as $item)
                                @if ($item->id == $it->organizer_id)
                                    {{$item->name}}
                                @endif
                                @endforeach
                            </span></h3>
                            <h3 class="flex items-center gap-1"><img width="20" src="{{ url('img/icons8-location.gif') }}" alt="">  <span class="font-normal"> {{  $it->location}}</span></h3>
                            <h3 class="flex items-center gap-1"><img width="25" src="{{ url('img/icons8-date.gif') }}" alt="">  <span class="font-normal"> {{  $it->date}}</span></h3>
                        </div>
                            @if ($info->id==$it->organizer_id)
                                {{--mini menu--}}
                            <div class="absolute top-0 right-2 botton_more z-50  p-2 flex flex-col items-end">
                                <i class="fa-solid fa-ellipsis-vertical text-slate-600"></i>
                                <nav class="mini_menu bg-slate-100 p-3 border border-solid border-slate-400 rounded-md shadow shadow-slate-400">
                                    <a href="/supprimer/{{$it->id}}" class="bg-slate-300 p-1 rounded-md text-sm hover:bg-slate-400 cursor-pointer">supprimer</a>
                                    <a href="modifier/{{$it->id}}" class="bg-slate-300 p-1 rounded-md text-center text-sm hover:bg-slate-400 cursor-pointer">modifier</a>
                                </nav>
                            </div>
                            @endif
                   </div>
                </a>               
            
            @endforeach 
        @endisset
        
    </div>
   <!--event end--> 
</main>
{{--main end--}}
<!-- cret event start-->
<section class="bg-black/70 w-full h-screen fixed top-0 flex flex-col justify-center items-center z-30 section_cree_event">
    <div class="absolute top-3 right-5"><i class="fa-solid fa-x text-white button_close hover:bg-slate-300 p-4 rounded-full"></i></div>
    <form method="POST" action="{{route('store') }}" class="flex flex-col w-1/3 bg-white p-9 items-center gap-2 rounded-xl">
        @csrf
        <h3 class="text-black font-bold text-xl mb-5">Créer un événement</h3>
        <input class="border border-slate-500 w-4/5 p-1 rounded-md shadow" type="text" name="title" placeholder="title">
        <input class="border border-slate-500 w-4/5 p-1 rounded-md shadow" type="text" name="description" placeholder="description">
        <input class="border border-slate-500 w-4/5 p-1 rounded-md shadow" type="date"  name="date" placeholder="date">
        <input class="border border-slate-500 w-4/5 p-1 rounded-md shadow" type="text"  name="location" placeholder="location">
        <input class="border border-slate-500 w-4/5 p-1 rounded-md shadow bg-neutral-700 text-white hover:bg-neutral-600" type="submit" value="submit">
    </form>
</section>
<!-- cret event end-->
<script src="{{ url('js/profile.js') }}"></script>
@endsection

@section('title','profile | ' .$info->name)