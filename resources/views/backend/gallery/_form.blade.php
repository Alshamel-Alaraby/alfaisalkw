<div class="row">
    @foreach($siteLocales as $localeKey => $localeName)
    <div class="col-lg-6">
        <div class="form-group">
            <label for="title-{{$localeKey}}">العنوان ({{$localeName}})</label>
            <input required value="{{old('title.'.$localeKey)?old('title.'.$localeKey):isset($gallery)?$gallery->getTranslation('title',$localeKey):''}}" name="title[{{$localeKey}}]" type="text" class="form-control" id="title-{{$localeKey}}">
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Logo">الصورة</label>
            <div class="input-group">
                <div class="custom-file">
                    <input name="image" type="file" class="custom-file-input" id="Logo">
                    <label class="custom-file-label" for="Logo">إختر الصورة</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">تحميل</span>
                </div>
            </div>
            @if($gallery->id)
                <div class="mt-2">
                    <img width="100px" src="{{optional($gallery->getFirstMedia('images'))->getUrl()}}"/>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>
                <input @if($gallery->show_in_home) checked @endif name="show_in_home" type="checkbox" class="form-control">
                Show In Home
            </label>
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
</div>
