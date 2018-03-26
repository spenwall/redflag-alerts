@extends('layout.layout')


@section('content')
<div class="jumbotron">
    <h1>Here are your current Alerts</h1>
    @foreach ($alerts as $alert)
    <div class="Rtable Rtable--4cols Rtable--collapse js-RtableAccordions">
  
        <button class="Accordion" role="tab" aria-selected="true">Ned</button>
        <div class="Rtable-cell  Rtable-cell--head"><h3>Eddard Stark</h3></div>
        <div class="Rtable-cell">Has a sword named Ice</div>
        <div class="Rtable-cell">No direwolf</div>
        <div class="Rtable-cell  Rtable-cell--foot"><strong>Lord of Winterfell</strong></div>

</div>
</div>

@endsection