@extends('layouts.index')


@section('content')


<div class="l-landlord">
    <div class="l-landlord-body">
        <div class="l-landlord-img">
            {{Html::image('img/slides/M_4.jpg',null,['class'=>'img-responsive'])}}
        </div>
        <div class="l-landlord-title">
            <p>
                Whether you need full and ongoing property management or are looking for us to find the perfect tenant, our tailor made packages provide the exact level of service you need.
            </p>
        </div>
        <div class="l-landlord-data">
            <div>
                <ul>
                    <li>TENANT FIND ONLY</li>
                    <li>internet marketing</li>
                    <li>distinctive to let board</li>
                    <li>tenant database</li>
                    <li>tenant referencing</li>
                    <li>preparation of tenancy agreement</li>
                    <li>arranging gas/electrical/epc inspection</li>
                </ul>
            </div>
            <div>
                <p></p>
                <ul>
                    <li>FULL MANAGEMENT</li>
                    <li>internet marketing</li>
                    <li>distinctive to let board</li>
                    <li>tenant database</li>
                    <li>tenant referencing</li>
                    <li>preparation of tenancy agreement</li>
                    <li>transfer of rent</li>
                    <li>inventory</li>
                    <li>utility transfer</li>
                    <li>check in</li>
                    <li>check out</li>
                    <li>periodic inspection and report</li>
                    <li>repairs and maintenance</li>
                    <li>arranging for gas/electrical and epc inspection</li>
                    <li>holding deposit (DPS)</li>
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection