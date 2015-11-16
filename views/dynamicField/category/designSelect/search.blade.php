<input type="hidden" name="{{$config->get('id') . 'ItemId'}}" value="{{ $itemId }}" />
<a href="#" class="bd_select __xe_select_box_show">{{ $item ? xe_trans($item->word) : xe_trans($config->get('label')) }}</a>
<div class="bd_select_list" data-name="{{$config->get('id') . 'ItemId'}}">
    <ul>
        <li><a href="#" data-value="">{{xe_trans($config->get('label'))}}</a></li>
        @foreach ($items as $item)
            <li><a href="#" data-value="{{$item->id}}">{{xe_trans($item->word)}}</a></li>
        @endforeach
    </ul>
</div>