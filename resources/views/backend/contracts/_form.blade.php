<div class="row">
    @foreach($siteLocales as $localeKey => $localeName)
    <div class="col-lg-6">
        <div class="form-group">
            <label for="title-{{$localeKey}}">العنوان ({{$localeName}})</label>
            <input required value="{{old('title.'.$localeKey)?old('title.'.$localeKey):isset($contract)?$contract->getTranslation('title',$localeKey):''}}" name="title[{{$localeKey}}]" type="text" class="form-control" id="title-{{$localeKey}}">
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    @foreach($siteLocales as $localeKey => $localeName)
        <div class="col-lg-12">
            <div class="form-group">
                <label for="content-{{$localeKey}}">المحتوى ({{$localeName}})</label>
                <textarea name="content[{{$localeKey}}]" id="content-{{$localeKey}}" cols="30" rows="10" class="form-control">{{old('content.'.$localeKey)?old('content.'.$localeKey):isset($contract)?$contract->getTranslation('content',$localeKey):''}}</textarea>
            </div>
        </div>
    @endforeach
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
</div>
@push('js')
    <script src="{{asset('backend/ckeditor.js')}}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#content-en' ) );
        ClassicEditor
            .create( document.querySelector( '#content-ar' ) );
    </script>
@endpush
