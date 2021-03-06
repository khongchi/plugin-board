@foreach ($docs as $doc)
<div>
    Revision NO : {{ $doc->revisionNo }}
    /
    Update date : {{ $doc->updatedAt }}
</div>

<div class="board-contents">
    @foreach ($formColumns as $columnName)
        @if ($columnName == 'title')

            <h2 class="page-header">
                <p>[{{ $doc->instanceId }}]</p>
                {!! $doc->title !!}
                <small class="pull-right">Date: {{$doc->updatedAt}}</small>
            </h2>
            <div class="content-right">
                <span class="xe-user" data-id="{{$doc->getUserId()}}">{!! $doc->writer !!}</span>
            </div>
        @elseif ($columnName == 'content')
            <div class="content" style="min-height: 300px;">
                {!! $doc->content !!}
            </div>
        @elseif (($fieldType = DynamicField::get($config->get('documentGroup'), $columnName)) != null)
            <div>
                {!! $fieldType->getSkin()->show($fieldType->getConfig(), $doc->getAttributes()) !!}
            </div>
        @else
            <dt>이건 뭔데!!!!</dt>
            <dd>{{ $columnName }}이건 뭐냐?</dd>
        @endif
    @endforeach
</div>
@endforeach