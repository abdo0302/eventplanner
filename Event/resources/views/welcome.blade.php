{{--comant--}}
@extends('layout')
@section('content')
@if(session()->has('login'))
<section class="bg-black/60 absolute w-full h-screen flex justify-center items-center z-50 continar_notif">
  <div class="absolute top-3 right-5"><i class="fa-solid fa-x text-white button_close_notif hover:bg-slate-300 p-4 rounded-full"></i></div>
  <div class="border border-slate-400 bg-slate-100 p-10">
    {{session('login')}}
 </div>
</section>
@endif

@error('name')
<section class="bg-black/60 absolute w-full h-screen flex justify-center items-center z-50 continar_notif">
  <div class="absolute top-3 right-5"><i class="fa-solid fa-x text-white button_close_notif hover:bg-slate-300 p-4 rounded-full"></i></div>
  <div class="border border-slate-400 bg-slate-100 p-10">
    {{$message}}
 </div>
</section>
@enderror

@error('email')
<section class="bg-black/60 absolute w-full h-screen flex justify-center items-center z-50 continar_notif">
  <div class="absolute top-3 right-5"><i class="fa-solid fa-x text-white button_close_notif hover:bg-slate-300 p-4 rounded-full"></i></div>
  <div class="border border-slate-400 bg-slate-100 p-10">
    {{$message}}
 </div>
</section>
@enderror
@error('password')
<section class="bg-black/60 absolute w-full h-screen flex justify-center items-center z-50 continar_notif">
  <div class="absolute top-3 right-5"><i class="fa-solid fa-x text-white button_close_notif hover:bg-slate-300 p-4 rounded-full"></i></div>
  <div class="border border-slate-400 bg-slate-100 p-10">
    {{$message}}
 </div>
</section>
@enderror
{{--header start--}}
<header class="flex justify-between px-14 border-b border-solid border-slate-300 items-center fixed top-0 w-full bg-slate-50 z-30">
  <h3 class="font-bold text-2xl flex"><img class="w-8" src="{{ url('img/icons8-schedule.gif') }}" alt=""> Event<span class="font-semibold text-blue-700">Planner</span></h3>
  <div class="flex items-center">
       <span class="evenements hover:text-slate-500 m-4 rounded-full connexion">connexion</span>
       <span class="Créer_événement hover:text-slate-500 my-4 rounded-full Creer_evenement inscription">inscription</span>
  </div>
</header>
{{--header end--}}

{{--home start--}}
<section class="bg-white">
  <div style="background-color: #213343;" class="h-screen text-white px-10 flex flex-col justify-center">
    <h2 class="font-bold text-3xl w-2/4 mb-10 z-10">Rejoignez le monde des événements passionnants</h2>
    <p class="w-3/4 z-10">Bienvenue sur notre plateforme de création et d'organisation d'événements ! Que vous planifiez une conférence, un atelier, une fête ou tout autre type de rassemblement, nous sommes là pour vous aider à faire de votre événement une expérience inoubliable. Découvrez une large gamme d'outils et de ressources qui vous permettent de concevoir vos événements avec facilité et professionnalisme, et de les partager avec le public approprié.</p>
     <button style="color: #213343;" class="bg-white w-40 p-2 rounded-2xl mt-5 flex justify-center gap-2 hover:bg-slate-100 z-20 button_inscription_home">inscription <img src="{{ url('img/icons8-inscription-24.png') }}" alt=""></button>
       <div class="absolute flex justify-end mr-5">
               <img width="50%" class="opacity-60" src="{{ url('img/event-2319.png') }}" alt="">
       </div>
   </div>
</section>
{{--home end--}}

{{--sign in start--}}
<div class="flex flex-col justify-center items-center font-[sans-serif] text-[#333] sm:h-screen p-4 fixed top-0 left-0 right-0 bg-black/65 w-full z-40 continar_sin_in">
  <div class="absolute top-3 right-5"><i class="fa-solid fa-x text-white button_close_form_connexion hover:bg-slate-300 p-4 rounded-full"></i></div>
  <div class="bg-white border border-gray-300 rounded-md p-6 max-w-md shadow-[0_2px_22px_-4px_rgba(93,96,127,0.2)] max-md:mx-auto">
      <form method="POST" action="{{route('connexion') }}" class="space-y-6">
        @csrf
        <div class="mb-10">
          <h3 class="text-3xl font-extrabold text-center">connexion</h3>
          <p class="text-sm mt-4">Connectez-vous à votre compte et explorez un monde de possibilités. Votre voyage commence ici.</p>
        </div>
        <div>
          <label class="text-sm mb-2 block">Email</label>
          <div class="relative flex items-center">
            <input name="email" type="text" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#333]" placeholder="Entrez le email" />
          </div>
        </div>
        <div>
          <label class="text-sm mb-2 block">Password</label>
          <div class="relative flex items-center">
            <input name="password" type="password" required class="w-full text-sm border border-gray-300 px-4 py-3 rounded-md outline-[#333]" placeholder="Entrez le password" />
          </div>
        </div>
        <div class="!mt-10">
          <input type="submit" value="connexion" class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-blue-500 hover:bg-blue-400 focus:outline-none">
        </div>
      </form>
  </div>
</div>
{{--sign in end--}}
{{--sin up start--}}
<div class="flex flex-col justify-center font-[sans-serif] text-[#333] sm:h-screen p-4 fixed top-0 left-0 right-0 bg-black/65 w-full z-40 continar_sin_up">
  <div class="absolute top-3 right-5"><i class="fa-solid fa-x text-white button_close hover:bg-slate-300 p-4 rounded-full"></i></div>
   <div class="max-w-md w-full mx-auto border border-gray-300 rounded-md p-6 bg-white">
      <div class="text-center mb-12">
        <h3 class="text-2xl font-extrabold text-center">Bienvenue sur Planner Event</h3>
      </div>
      <form method="POST" action="{{route('signin') }}">
        @csrf
        <div class="space-y-6">
          <div>
            <label class="text-sm mb-2 block">Name</label>
            <input name="name" type="text" class="bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Entrez le nom" />
          </div>
          <div>
            <label class="text-sm mb-2 block">Email</label>
            <input name="email" type="text" class="bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Entrez le Email" />
          </div>
          <div>
            <label class="text-sm mb-2 block">Password</label>
            <input name="password" type="password" class="bg-white border border-gray-300 w-full text-sm px-4 py-3 rounded-md outline-blue-500" placeholder="Entrez le password" />
          </div>
        </div>
        <div class="!mt-10">
          <input type="submit" value="création d'un compte" class="w-full py-3 px-4 text-sm font-semibold rounded text-white bg-blue-500 hover:bg-blue-600 focus:outline-none">
        </div>
      </form>
    </div>
</div>
{{--sin up end--}}
<main class="my-8 bg-white">
  <!--event start-->
  <h3 class="text-center mb-6 font-bold text-3xl">Tous les évènements</h3>
  <div class=" flex gap-5 flex-wrap justify-center continar_events">
     
      <!--card-->
      @isset($events)
              @foreach ($events as $it)  
                <div class="w-52 min-h-56 p-5 rounded-2xl border border-solid border-slate-400 shadow-md hover:shadow-sm shadow-zinc-500 bg-white ">
                    <h3 class="text-center mb-3 font-semibold">{{$it->title}}</h3>
                    <p class="text-sm mb-4">{{$it->description}}</p>
                    <div class="flex flex-col gap-3">
                        <h3 class="font-medium text-base">organizer par <span class="font-normal">{{$it->organizer_id}}</span></h3>
                        <h3 class="flex items-center gap-1"><img width="20" src="{{ url('img/icons8-location.gif') }}" alt="">  <span class="font-normal"> {{  $it->location}}</span></h3>
                        <h3 class="flex items-center gap-1"><img width="25" src="{{ url('img/icons8-date.gif') }}" alt="">  <span class="font-normal"> {{  $it->date}}</span></h3>
                    </div>
               </div>             
          @endforeach 
      @endisset
      
  </div>
 <!--event end--> 
</main>
<script src="{{ url('js/main.js') }}"></script>
@endsection

@section('title','EventPlanner')