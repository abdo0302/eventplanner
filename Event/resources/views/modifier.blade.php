@extends('layout')
@section('content')
<!-- cret event start-->
@foreach ($event as $item)
  <section class="bg-black/70 w-full h-screen fixed top-0 flex flex-col justify-center items-center z-30 section_cree_event">
    <form method="POST" action="{{route('update') }}" class="flex flex-col w-2/5 bg-white p-9 items-center rounded-xl">
        @csrf
        @method('PUT')
        <h3 class="text-black font-bold text-xl mb-5">Modifier un événement</h3>
        <label for="" class="w-full ml-3 text-base">title</label>
        <input class="absolute -z-10" type="text" name="id" value="{{$item->id}}">
        <input class="border border-slate-500 w-full p-3 mb-3 rounded-md shadow" type="text" name="title" placeholder="title" value="{{$item->title}}">
        <label for=""  class="w-full ml-3 text-base">description</label>
        <input class="border border-slate-500 w-full p-3 mb-3 rounded-md shadow" type="text" name="description" placeholder="description" value="{{$item->description}}">
        <label for="" class="w-full ml-3 text-base">date</label>
        <input class="border border-slate-500 w-full p-3 mb-3 rounded-md shadow" type="date"  name="date" placeholder="date" value="{{$item->date}}">
        <label for="" class="w-full ml-3 text-base">location</label>
        <input class="border border-slate-500 w-full p-3 mb-3 rounded-md shadow" type="text"  name="location" placeholder="location" value="{{$item->location}}">
        <input class="border border-slate-500w-full p-2 rounded-md shadow bg-neutral-700 text-white hover:bg-neutral-600" type="submit" value="Modifier">
    </form>
  </section>
@endforeach

<!-- cret event end-->
@endsection