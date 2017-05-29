@if($pagination->total_pages > 1)
    <div class="l-pagination">
        <nav>
            <ul class="pagination">
                @if(1 < $pagination->limit_inf)
                <li class="page-item"><a data-page="1" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=1"}}">First</a></li>
                @endif
                @if($pagination->pag_actual > 1)
                <li class="page-item"><a data-page="{{intval($pagination->pag_actual) - 1}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".(intval($pagination->pag_actual) - 1)}}">Prev</a></li>
                @endif
                @for($i=$pagination->limit_inf; $i <= $pagination->limit_sup; $i++)
                @if($i == $pagination->pag_actual)
                <li class="page-item"><a data-page="{{$i}}" class="page-link actual-page" href="{{action('Web\LettingController@FilterLettings')."?page=".$i}}" id="page_link">{{$i}}</a></li>
                @else
                <li class="page-item"><a data-page="{{$i}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".$i}}" id="page_link">{{$i}}</a></li>
                @endif
                @endfor
                @if($pagination->limit_sup != $pagination->total_pages)
                <li class="page-item"><a data-page="{{intval($pagination->limit_sup) + 1}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".(intval($pagination->limit_sup) + 1)}}">...</a></li>
                @endif
                @if($pagination->pag_actual < $pagination->total_pages)
                <li class="page-item"><a data-page="{{intval($pagination->pag_actual) + 1}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".(intval($pagination->pag_actual) + 1)}}">Next</a></li>
                @endif
                @if($pagination->limit_sup < $pagination->total_pages)
                <li class="page-item"><a data-page="{{$pagination->total_pages}}" class="page-link" href="{{action('Web\LettingController@FilterLettings')."?page=".$pagination->total_pages}}">Last</a></li>
                @endif
            </ul>
        </nav>		
    </div>
    @endif