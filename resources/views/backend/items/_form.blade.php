<div class="row">
    @foreach($siteLocales as $localeKey => $localeName)
    <div class="col-lg-6">
        <div class="form-group">
            <label for="name-{{$localeKey}}">اﻷسم ({{$localeName}})</label>
            <input required value="{{old('name.'.$localeKey)?old('name.'.$localeKey):(isset($item)?$item->getTranslation('name',$localeKey):'')}}" name="name[{{$localeKey}}]" type="name" class="form-control" id="name-{{$localeKey}}" placeholder="Enter Name">
        </div>
    </div>
    @endforeach
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="category">الفئة</label>
            <select required class="form-control select2" id="category" name="category_id">
                <option value="">--- إختر الفئة ---</option>
                @foreach($categoryList as $cat)
                    <option {{$cat->id==$item->category_id?'selected':''}} value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="type">Item Type</label>
            <select required class="form-control" id="type" name="type">
                <option {{$item->type=="products"?'selected':''}} value="products">منتجات</option>
                <option {{$item->type=="equipments"?'selected':''}} value="equipments">معدات</option>
                <option {{$item->type=="decor"?'selected':''}} value="decor">ديكورات</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="form-group">
            <label for="has_price">
                <input @if($item->has_price) checked @endif type="checkbox" name="has_price"  id="has_price" class="form-control custom-checkbox">
                له سعر
            </label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="has_qty">
                <input @if($item->has_qty) checked @endif type="checkbox" name="has_qty"  id="has_qty" class="form-control custom-checkbox">
                له كمية
            </label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="observe_qty">
                <input @if($item->observe_qty) checked @endif type="checkbox" name="observe_qty"  id="observe_qty" class="form-control custom-checkbox">
                مراقبة الكمية مع الفواتير
            </label>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="is_visible">
                <input @if($item->is_visible) checked @endif type="checkbox" name="is_visible"  id="is_visible" class="form-control custom-checkbox">
                إظهاره فى العرض
            </label>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <label for="price">السعر</label>
            <input type="number" name="price" value="{{$item->price??old('price')}}" id="price" min="1" step="1" class="form-control price" placeholder="@lang('tr.Price')">
        </div>
    </div>
    <div class="col-lg-6">
        <div class="form-group">
            <label for="quantity">الكمية</label>
            <input type="number" name="qty" value="{{$item->qty??old('qty')}}" id="quantity" min="1" step="1" class="form-control price" placeholder="@lang('tr.Quantity')">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Logo">الصورة الاساسية</label>
            <div class="input-group">
                <div class="custom-file">
                    <input name="image" type="file" class="custom-file-input" id="Logo">
                    <label class="custom-file-label" for="Logo">إختر الصورة</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">تحميل</span>
                </div>
            </div>
            @if($item->id)
            <div class="mt-2">
                <img width="100px" src="{{optional($item->getFirstMedia('images'))->getUrl()}}"/>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
            <label for="Logo">صور إضافية</label>
            <div class="input-group">
                <div class="custom-file">
                    <input name="extraimages[]" multiple type="file" class="custom-file-input" id="Logo">
                    <label class="custom-file-label" for="Logo">إختر الصور</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text">تحميل</span>
                </div>
            </div>
            @if($item->id)
                <div class="row">
                    @foreach($item->getMedia('extraimages') as $m)
                        <div class="mt-2 col-md-2 imageContainer">
                            <a href="{{$m->getUrl()}}" target="_blank">
                                <img width="100px" src="{{$m->getUrl()}}"/>
                            </a>
                            <a class="redbutton deleteImg" rel="{{ $m->id }}" href="#"><i class="fa fa-trash close_button"></i></a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>



<div class="row">
    @foreach($siteLocales as $localeKey => $localeName)
        <div class="col-lg-6">
            <div class="form-group">
                <label for="{{$localeKey}}_desc">Descriptions ({{$localeName}})</label>
                <textarea name="description[{{$localeKey}}]" class="form-control" id="{{$localeKey}}_desc">{{old('description.'.$localeKey)?old('description.'.$localeKey):(isset($item)?$item->getTranslation('description',$localeKey):'')}}</textarea>
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
