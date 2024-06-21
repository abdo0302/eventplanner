@extends('layout')
@section('content')
    <header class="p-3 fixed top-0 bg-slate-100 w-fit">
        <a class="font-bold" href="{{route('back') }}"><img class="w-8" src="{{ url('img/icons8-arrow-pointing-left-24.png') }}" alt=""></a>
    </header>
    <main class="p-3 flex gap-4 justify-center mt-10 bg-slate-100">
        <!--event-->
         @foreach ($event as $item)
             <div class="bg-white w-3/6 ml-5 p-5 shadow-lg shadow-slate-400">
                <h3 class="text-center mb-3 font-semibold">{{$item->title}}</h3>
                <p>{{$item->description}}</p>
                <div class="flex gap-5 flex-wrap justify-evenly mt-6">
                    <h3 class="font-medium text-base">organizer par : <span class="font-normal">
                        @foreach ($users as $it)
                        @if ($it->id == $item->organizer_id)
                            {{$it->name}}
                        @endif
                        @endforeach
                    </span></h3>
                    <h3 class="font-medium text-base">location : <span class="font-normal">{{$item->location}}</span></h3>
                    <h3 class="font-medium text-base">la date : <span class="font-normal">{{$item->date}}</span></h3>
                </div> 
                <div class="flex justify-between mt-5">
                    @if ($item->organizer_id==$info->id || $info->role_id==2)
                        <div class="bg-blue-50 w-56 h-96 flex flex-col items-center gap-3 overflow-y-auto p-2 border border-solid border-slate-600 rounded-lg">
                            <h3 class="text-center">Participants</h3>
                                @foreach ($inscription as $item)
                                <div class="w-full flex flex-col border border-solid border-black px-2 rounded-xl bg-blue-100">
                                    @foreach ($users as $it)
                                    @if ($it->id == $item->user_id)
                                    
                                        <span>{{$it->name}}</span>
                                    <span class="text-sm">{{$it->email}}</span>
                                    @endif
                                    @endforeach
                                </div> 
                                @endforeach
                        </div>
                    @endif
                    
                            <!--evaluation-->
                    <div class="bg-blue-50 w-auto h-96 flex flex-col items-center p-5 pt-1 pb-1 border border-solid border-slate-600 rounded-lg">
                        <h3 class="font-bold text-lg">Evaluation</h3>
                        <div class="w-full h-full pt-4 overflow-y-auto">
                            @foreach ($evaluation as $item)
                                
                                    @foreach ($users as $it)
                                    @if ($it->id == $item->user_id)
                                    <h3>{{$it->name}}:: <span>
                                    @endif
                                    @endforeach   
                                    @for ($i = 0; $i <$item->score ; $i++)
                                        <span>&#x2B50</span>
                                    @endfor
                                </span></h3>
                            @endforeach
                        </div>

                        {{-- button evaluation --}}

                        @php
                        $y=false;
                     @endphp
                     @foreach ($evaluation as $item)
                          @if ($item->user_id==$info->id)  
                              @php
                                 $y=true; 
                              @endphp
                          @endif
                     @endforeach
                         @if (!$y)
                         <div class="">
                            <form method="POST" action="{{route('evaluation') }}" class="w-full flex gap-2">
                                @csrf
                                @foreach ($event as $item)
                                <input class="bg-zinc-300 absolute -z-10" type="text" name="event_id" value="{{$item->id}}">
                                @endforeach
                                <select class="bg-zinc-200 border border-solid border-slate-700 rounded-md w-2/3" name="score">
                                    <option value="1">&#x2B50</option>
                                    <option value="2">&#x2B50 &#x2B50</option>
                                    <option value="3">&#x2B50 &#x2B50 &#x2B50</option>
                                    <option value="4">&#x2B50 &#x2B50 &#x2B50 &#x2B50</option>
                                    <option value="5">&#x2B50 &#x2B50 &#x2B50 &#x2B50 &#x2B50</option>
                                </select>
                                <input class="bg-zinc-200 p-1 rounded-md shadow shadow-gray-900" type="submit" value="sind"> 
                            </form>  
                        </div>
                         @endif
                    </div>
                </div> 
                  
                {{-- button inscrir --}}
                @php
                   $y=false;
                @endphp
                @foreach ($inscription as $item)
                    @if ($item->user_id==$info->id)  
                        @php
                        $y=true; 
                        @endphp
                    @endif
                @endforeach
                @if ($y)
                <div class="w-full flex justify-center mt-8">
                    <span class="text-green-600 font-semibold text-lg">Vous êtes inscrit à l'événement</span>
                </div>
                    
                @else
                  <div class="flex justify-center mt-10">
                    <form form method="POST" action="{{route('inscription') }}">
                        @csrf
                       @foreach ($event as $item)
                       <input class="bg-zinc-300 absolute -z-10" type="text" name="event_id" value="{{$item->id}}">
                       @endforeach
                        <input class="bg-blue-200 p-1 rounded-md" type="submit" value="Rejoint">
                    </form>
                  </div>
                @endif
            </div>
         @endforeach
        
        <!--comment-->
        
        <div class="bg-white w-1/4 h-96 flex flex-col items-center p-5 pt-1 pb-0 shadow-lg shadow-slate-400">
            <h3 class="font-bold text-lg">commentaires</h3>
            <div class="w-full h-80 pt-4 overflow-y-auto">
                @foreach ($comments as $i)
                @foreach ($users as $it)
                @if ($it->id == $i->user_id)
                    <h4>{{$it->name}} :: <span>{{$i->content}}</span></h4>
                @endif
                @endforeach
                @endforeach
            </div>
            <div class="flex gap-1 p-2">
                <form form method="POST" action="{{route('commant') }}" class="flex gap-2">
                    @csrf
                    @foreach ($event as $item)
                    <input class="bg-zinc-300 absolute -z-10" type="text" name="event_id" value="{{$item->id}}">
                    @endforeach
                   <input class="bg-zinc-300 w-40 p-2 border border-solid border-slate-400 rounded-md" type="text" name="content" placeholder="comment">
                <input class="bg-zinc-300 p-3 py-1 rounded-xl" type="submit" value="sind"> 
                </form>
                
            </div>
        </div>
          
    </main>
    <script src="{{ url('js/show.js') }}"></script>
@endsection
@section('title','show details event')