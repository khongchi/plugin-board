<div class="board_write">
    <form method="post" id="board_form" class="__board_form" action="{{ $urlHandler->get('store') }}" enctype="multipart/form-data" data-rule="board">
    <input type="hidden" name="_token" value="{{{ Session::token() }}}" />
    <input type="hidden" name="parentId" value="{{$item->parentId}}" />
    <input type="hidden" name="head" value="{{$item->head}}" />
    <input type="hidden" name="queryString" value="{{ http_build_query(Input::except('parentId')) }}" />

    <div class="write_header">
        @if(DynamicField::has($config->get('documentGroup'), 'category'))
        <div class="write_category form-group">
            {!! DynamicField::get($config->get('documentGroup'), 'category')->getSkin()->create(Input::all()) !!}
        </div>
        @endif
        <div class="write_title">
            {!! uio('titleWithSlug', [
            'title' => Input::old('title', $item->title),
            'slug' => '',
            'titleClassName' => 'bd_input',
            'config' => $config
            ]) !!}
        </div>
    </div>

    <div class="write_body">
        <div class="write_form_editor __xe_content __xe_temp_container">
            {!! uio('editor', [
              'content' => Input::old('content', $item->content),
              'editorConfig' => [
                'fileUpload' => [
                  'upload_url' => $urlHandler->get('upload'),
                  'source_url' => $urlHandler->get('source'),
                  'download_url' => $urlHandler->get('download'),
                ],
                'suggestion' => [
                  'hashtag_api' => $urlHandler->get('hashTag'),
                  'mention_api' => $urlHandler->get('mention'),
                ],
              ]
            ]) !!}
        </div>
    </div>

    <div class="write_footer">

        @foreach ($formColumns as $columnName)
        @if (($fieldType = DynamicField::get($config->get('documentGroup'), $columnName)) != null && $columnName != 'category')
            <div class="__xe_{{$columnName}} __xe_section">
                @if($item->id === null)
                    {!! $fieldType->getSkin()->create(Input::all()) !!}
                @else
                    {!! $fieldType->getSkin()->edit($item->getAttributes()) !!}
                @endif
            </div>
        @endif
        @endforeach

        @if (Auth::guest() === true)
        <div class="write_form_input">
            <input type="text" name="writer" class="bd_input" placeholder="{{ xe_trans('xe::writer') }}" title="{{ xe_trans('xe::writer') }}" value="{{ Input::old('writer', $item->writer) }}">
            <input type="password" name="certifyKey" class="bd_input" placeholder="{{ xe_trans('xe::password') }}" title="{{ xe_trans('xe::password') }}">
            <input type="email" name="email" class="bd_input v2" placeholder="{{ xe_trans('xe::email') }}" title="{{ xe_trans('xe::email') }}" value="{{ Input::old('email', $item->email) }}">
        </div>
        @endif

        <div class="write_form_option">
            @if($isManager === true)
            <input type="checkbox" id="notice" name="status" value="{{\Xpressengine\Document\DocumentEntity::STATUS_NOTICE}}" /><label for="notice">{{xe_trans('xe::notice')}}</label>
            @endif
        </div>
        <div class="write_form_btn">
            @if (Auth::guest() !== true)
            <a href="#" class="bd_btn btn_temp_save __xe_temp_btn_load">{{ xe_trans('comment_service::tempLoad') }}</a>
            <a href="#" class="bd_btn btn_preview __xe_temp_btn_save">{{ xe_trans('comment_service::tempSave') }}</a>
            @endif

            <a href="#" class="bd_btn btn_preview __xe_btn_preview">{{ xe_trans('xe::preview') }}</a>
            <a href="#" class="bd_btn btn_submit __xe_btn_submit">{{ xe_trans('xe::submit') }}</a>

            <a href="{{ $urlHandler->get('index', Input::except('id', 'parentId')) }}" class="bd_btn btn_cancel"><i class="xi-undo"></i> {{ xe_trans('xe::back') }}</a>
        </div>

        <!-- 게시판 addon -->


    </div>
    </form>
</div>

{{ Frontend::css('/assets/vendor/core/css/temporary.css')->load() }}
{{ Frontend::js('assets/vendor/core/js/temporary.js')->appendTo('body')->load() }}
<script>
    $(function() {
        var form = $('#board_form');
        var temporary = $('textarea', form).temporary({
            key: 'document|{{$boardId}}',
            btnLoad: $('.__xe_temp_btn_load', form),
            btnSave: $('.__xe_temp_btn_save', form),
            container: $('.__xe_temp_container', form),
            withForm: true,
            callback: function (data) {
                console.log(data);
                if (xe3CkEditors['xeContentEditor']) {
                    xe3CkEditors['xeContentEditor'].setData($('textarea', this.dom).val());
                }
            }
        });
    });


    {{--$(function() {--}}
        {{--$('.board-container .__xe_btn_temporary').bind('click', function() {--}}
            {{--var f = $('#board_form').clone();--}}

            {{--var status = $('<input>').attr('name', 'status').attr('type', 'hidden').val('temp');--}}
            {{--f.append(status);--}}
            {{--f.attr('action', '{{ $urlHandler->get('temporary') }}');--}}
            {{--f.submit();--}}
        {{--});--}}


        {{--new Temporary($('#board_form [name="content"]'), 'board|{{$boardId}}}', function (data) {--}}
            {{--form.editorSync();--}}
        {{--}, true);--}}
    {{--});--}}
</script>
