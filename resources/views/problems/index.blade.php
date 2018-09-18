@extends('layouts.app')
@section('content')
    @if(isset($sec_items))
        <ul class="nav nav-tabs">
            <li class="active"
                style="padding:5px; border: 1px solid #ddd; border-bottom-color: transparent; border-radius: 4px 4px 0 0;
            "><a data-toggle="tab" href="#items">{{$name}}</a></li>
            <li style="padding: 5px; border: 1px solid #ddd; border-bottom-color: transparent; border-radius: 4px 4px 0 0;
            "><a data-toggle="tab" href="#sec_items">{{$sec_name}}</a></li>
        </ul>
        <div class="tab-content">
        <div id="items" class="tab-pane active" style="padding:15px; border:1px solid lightgray; border-top:none; margin-bottom: 20px;">
    @endif

    <h1>{{$name}}</h1>
    @if(count($items) > 0)
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Title</th>
            </tr>
            </thead>

        @foreach($items as $item)
            <tr>
                <td><a href="/{{$name}}/{{$item->id}}">{{$item->title}}</a></td>
            </tr>
         @endforeach
        </table>
    @else
        <p>There is no {{$name}} to solve.</p>
    @endif

    @if(isset($sec_items))
        </div>
        <div id="sec_items" class="tab-pane fade" style="padding:15px; border:1px solid lightgray; border-top:none; margin-bottom: 20px;">
            <a href="/{{$name}}/create" class="btn btn-primary" style="float: right;">Create new</a>
            <h1>{{$sec_name}}</h1>
            @if(count($sec_items) > 0)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Title</th>
                    </tr>
                    </thead>

                    @foreach($sec_items as $item)
                        <tr>
                            <td><a href="/{{$name}}/{{$item->id}}">{{$item->title}}</a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>There is no {{$name}}.</p>
            @endif
        </div>
     </div>
    @endif
@endsection