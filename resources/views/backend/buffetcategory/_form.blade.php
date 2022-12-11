<div class="row">
    @foreach($siteLocales as $localeKey => $localeName)
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name-{{$localeKey}}">الأسم ({{$localeName}})</label>
            <input required value="{{old('name.'.$localeKey)?old('name.'.$localeKey):isset($buffetcategory)?$buffetcategory->getTranslation('name',$localeKey):''}}" name="name[{{$localeKey}}]" type="name" class="form-control" id="name-{{$localeKey}}" placeholder="Enter Name">
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    @foreach($siteLocales as $localeKey => $localeName)
        <div class="col-lg-6">
            <div class="form-group">
                <label for="{{$localeKey}}_desc">الوصف {{$localeName}})</label>
                <textarea rows="5" name="description[{{$localeKey}}]" class="form-control" id="{{$localeKey}}_desc">{{old('description.'.$localeKey)?old('description.'.$localeKey):isset($buffetcategory)?$buffetcategory->getTranslation('description',$localeKey):''}}</textarea>
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>
                <input @if($buffetcategory->show_in_home) checked @endif name="show_in_home" type="checkbox" class="form-control">
                Show In Home
            </label>
        </div>
    </div>
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
            @if($buffetcategory->id)
            <div class="mt-2">
                <img width="100px" src="{{optional($buffetcategory->getFirstMedia('images'))->getUrl()}}"/>
            </div>
            @endif
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
</div>
