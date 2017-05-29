@extends('layouts.index')

@section('canonical')

@if($data['pagination']->pag_actual > 1)
<link rel="canonical" href="{{URL::to('/')."/?page=".$data['pagination']->pag_actual}}">
@else
<link rel="canonical" href="{{URL::to('/')."/"}}">
@endif

@if($data['pagination']->pag_actual > 1)
@if(($data['pagination']->pag_actual - 1) === 1)
<link rel="prev" href="{{URL::to('/')."/"}}">
@else
<link rel="prev" href="{{URL::to('/')."/?page=".($data['pagination']->pag_actual - 1)}}">
@endif
@endif

@if($data['pagination']->pag_actual < $data['pagination']->total_pages)
<link rel="next" href="{{URL::to('/')."/?page=".($data['pagination']->pag_actual + 1)}}">
@endif

@endsection

@section('content')

<div class="modal fade" id="modal-map">
    <div class="modal-dialog" role="document" style="height: 90%;width: 100%;margin:0 auto;top:0em;">
        <div class="modal-content l-modal-content" style="height: 100%">
            <div class="modal-body" style="height: 100%">
                <div class="modal-map-close">
                    <span data-dismiss="modal" data-backdrop="false">X</span>
                </div>
                <div class="home-map" id="home-map" style="width: 100%;height: 100%;">

                </div>
            </div>
        </div>
    </div>
</div>

<main class="row main">
    <aside class="col-xs-12 col-sm-12 col-md-3 visible-md visible-lg">
        @component('partials/components/common/filtermenu', ['data' => $data])
        @endcomponent
    </aside>
    <section class="home-section col-xs-12 col-sm-12 col-md-9">
        @component('partials/components/letting/panel-adverts', ['data' => $data])
        @endcomponent
    </section>
    
</main>
<script>home_api.SetUp();</script>
@endsection