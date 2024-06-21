@extends('layout')
@section('content')

<header class="flex justify-between px-14 py-3 border-b border-solid border-slate-300 items-center fixed w-full bg-white z-10">
    <h3 class="font-bold text-2xl flex"><img class="w-8" src="{{ url('img/icons8-schedule.gif') }}" alt=""> Event<span class="font-semibold text-blue-700">Planner</span></h3>
    <div class="flex items-center">

        <div class="mr-3">
            <h4 class="text-sm font-medium">{{$info->name}}</h4>
            <span class="text-xs">{{$info->email}}</span>
        </div>
        {{-- img --}}
        <div class="w-10 h-10 rounded-full bg-blue-400 flex justify-center items-center">
            <span class="text-center">
                @php
                    echo $info->name[0] . $info->name[1];
                @endphp
            </span>

        </div>
    </div>
</header>
<main class= "flex bg-slate-100">
    <aside class="flex flex-col fixed h-full border-r border-solid border-slate-300 px-4 py-9 justify-between mt-16 bg-white">
       <nav class="flex flex-col text-center gap-3 mt-8">
            <span class="Utilisateurs bg-slate-100 hover:bg-slate-300 p-2 rounded-lg flex justify-center gap-1"><img class="w-6" src="{{ url('img/pngwing.com.png') }}" alt=""> Utilisateurs</span>
           <span class="evenements bg-slate-100 hover:bg-slate-300 p-2 rounded-lg flex justify-center gap-1 items-center"><img class="w-10" src="{{ url('img/58-588807_animaciones-social-events-icon-png-transparent-png-removebg-preview.png') }}" alt=""> événements</span>
           <span class="Creer_evenement bg-slate-100 hover:bg-slate-300 p-2 rounded-lg flex justify-center gap-1 items-center"><img class="w-10" src="{{ url('img/image-removebg-preview.png') }}" alt=""> Créer un événement</span>
       </nav>
        <nav class="mb-20 text-center">
            <a href="/logout" class="bg-slate-100 hover:bg-slate-300 p-2 rounded-lg flex justify-center gap-1 items-center"><img class="w-8" src="{{ url('img/images-removebg-preview.png') }}" alt=""> Déconnexion</a>
        </nav>
       
    </aside>

    <section class="ml-52 pt-24 p-3 w-full h-screen bg-slate-100 flex flex-col items-center">
        
        <div class="continar_users flex justify-evenly w-full">
          <div class="flex flex-col h-96 justify-evenly items-center">  
            <div class="flex h-fit bg-white p-5 gap-2 items-center shadow-lg shadow-slate-400">
                    <img width="60px" src="{{ url('img/icons8-event.gif') }}" alt="">
                    <span class="font-semibold text-2xl">{{count($events)}}</span>
                    <img width="60px" class="ml-6" src="{{ url('img/icons8-users (1).gif') }}" alt="">
                    <span class="font-semibold text-2xl">{{count($users)}}</span>
                    
            </div>
            <div class="flex w-96 h-fit bg-white p-1 shadow-lg shadow-slate-400">
                <canvas id="myChart"></canvas>
                
            </div>
          </div>  
        <!--users start-->
        <div class="flex flex-col h-fit bg-white p-1 shadow-lg shadow-slate-400">
            @php
            $r = [];
         @endphp
        
         @foreach ($users as $item)
            @php
                $t = 0;
            @endphp
        
            @foreach ($events as $a)
                @if ($item->id == $a->organizer_id)
                    @php
                        $t++;
                    @endphp
                @endif
            @endforeach
        
            @php
                $r[$item->id] = $t;
            @endphp
         @endforeach
        
         @php
            // Prepare the data for Chart.js
            $chartData = [
                'labels' => array_keys($r), // User IDs
                'data' => array_values($r)  // Event counts
            ];
         @endphp
        
         <script>
            var chartData = @json($chartData);
         </script>
    
            <div class="flex border-2">
                <h3 class="w-20 bg-slate-300 text-center">id</h3>
                <h3 class="w-32 bg-slate-400 text-center">name</h3>
                <h3 class="w-48 bg-slate-300 text-center">email</h3>
                <h3 class="w-20 bg-slate-300 text-center">Actions</h3>
            </div>
                 @isset($users)
                        @foreach ($users as $item)
                    <div class="flex border-2">
                    <h3 class="w-20 bg-slate-300 text-center p-2">{{ $item->id}}</h3>
                    <h3 class="w-32 bg-slate-400 text-center p-2">{{ $item->name}}</h3>
                    <h3 class="w-48 bg-slate-300 text-center p-2">{{ $item->email}}</h3>
                    <h3 class="w-20 bg-slate-300 text-center py-2"><a href="/supprimeruser/{{ $item->id}}" class="bg-slate-400 shadow shadow-black">supprimer</a></h3>
                    </div>
                    @endforeach
                 @endisset
                
        </div>
     </div>
       <!--users end-->

       <!--event start-->
        <div class=" flex gap-2 flex-wrap justify-center continar_events">
            <!--card-->
            @isset($events)
                    @foreach ($events as $it)
                    <a href="/show/{{$it->id}}" class="">
                        <div class="w-52 min-h-56 p-5 rounded-2xl border border-solid border-slate-400 shadow-md hover:shadow-sm shadow-zinc-500 bg-white relative">
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
                            {{--mini menu--}}
                            <div class="absolute top-0 right-2 botton_more z-50  p-2 flex flex-col items-end">
                                <i class="fa-solid fa-ellipsis-vertical text-slate-600"></i>
                                <nav class="mini_menu bg-slate-100 p-3 border border-solid border-slate-400 rounded-md shadow shadow-slate-400">
                                    <a href="/supprimer/{{$it->id}}" class="bg-slate-300 p-1 rounded-md text-sm hover:bg-slate-400 cursor-pointer">supprimer</a>
                                    <a href="modifier/{{$it->id}}" class="bg-slate-300 p-1 rounded-md text-center text-sm hover:bg-slate-400 cursor-pointer">modifier</a>
                                </nav>
                            </div>
                       </div>
                    </a>                  
                
                @endforeach 
            @endisset
            
        </div>
       <!--event end-->       
    </section>
</main>
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
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: '# of Events',
                data: chartData.data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script src="{{ url('js/admin.js') }}"></script>
@endsection

@section('title','admin')