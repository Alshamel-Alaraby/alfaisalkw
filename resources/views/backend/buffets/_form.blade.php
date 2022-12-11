<div class="row">
    @foreach($siteLocales as $localeKey => $localeName)
        <div class="col-lg-6">
            <div class="form-group">
                <label for="title-{{$localeKey}}">اﻷسم ({{$localeName}})</label>
                <input required value="{{old('title.'.$localeKey)?old('title.'.$localeKey):isset($buffet)?$buffet->getTranslation('title',$localeKey):''}}" name="title[{{$localeKey}}]" type="text" class="form-control" id="title-{{$localeKey}}" placeholder="Enter Title">
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    @foreach($siteLocales as $localeKey => $localeName)
        <div class="col-lg-6">
            <div class="form-group">
                <label for="{{$localeKey}}_desc">الوصف ({{$localeName}})</label>
                <textarea name="description[{{$localeKey}}]" id="{{$localeKey}}_desc" cols="30" rows="10" class="form-control">{{old('description.'.$localeKey)?old('description.'.$localeKey):isset($buffet)?$buffet->getTranslation('description',$localeKey):''}}</textarea>
            </div>
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="category">الفئة</label>
            <select required class="form-control select2" id="category" name="category_id">
                <option value="">---إختر الفئة ---</option>
                @foreach($categoryList as $cat)
                    <option {{$cat->id==$buffet->category_id?'selected':''}} value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="price">السعر</label>
            <input type="number" name="price" value="{{$buffet->price??old('price')}}" id="price" min="1" step="1" class="form-control price" placeholder="@lang('tr.Price')">
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-group">
            <label for="number_attendence">عدد الحضور</label>
            <input type="number" name="number_attendence" value="{{$buffet->number_attendence??old('number_attendence')}}" id="number_attendence" min="1" step="1" class="form-control" placeholder="@lang('tr.Number Of Attendence')">
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
            @if($buffet->id)
                <div class="mt-2">
                    <img width="100px" src="{{optional($buffet->getFirstMedia('images'))->getUrl()}}"/>
                </div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <ul class="nav  nav-pills" role="tablist">
            <li>
                <a class="nav-link active" data-toggle="pill" href="#items-list">اﻷصناف</a>
            </li>
            <li>
                <a class="nav-link" data-toggle="pill" href="#decor-list">الديكورات</a>
            </li>
            <li>
                <a class="nav-link" data-toggle="pill" href="#equipment-list">المعدات</a>
            </li>
            <li><input type="text" class="form-control p-2" style="margin-left: 10px;" id="searchInput" placeholder="كلمة البحث ..."></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="items-list" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
                    @php $i=0 ;$sel = array();$selected=false; @endphp
                    @if(isset($selectedProd))
                        @foreach($selectedProd as $item)
                            @php $i++ ;$sel[]=$item->id;$selected=true; @endphp
                            @include('backend.buffets._item')
                        @endforeach
                    @endif
                    @php $selected=false; @endphp
                    @if($products)
                        @foreach($products->whereNotIn('id',$sel) as $item)
                            @php $i++ ; @endphp
                            @include('backend.buffets._item')
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="decor-list">
                <div class="row">
                    @php $sel = array();$selected=false; @endphp
                    @if(isset($selectedDocor))
                        @foreach($selectedDocor as $item)
                            @php $i++ ;$sel[]=$item->id;$selected=true; @endphp
                            @include('backend.buffets._item')
                        @endforeach
                    @endif
                    @php $selected=false; @endphp
                    @if($decors)
                        @foreach($decors->whereNotIn('id',$sel) as $item)
                            @php $i++ ; @endphp
                            @include('backend.buffets._item')
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="tab-pane fade"id="equipment-list">
                <div class="row">
                    @php $sel = array();$selected=false; @endphp
                    @if(isset($selectedEq))
                        @foreach($selectedEq as $item)
                            @php $i++ ;$sel[]=$item->id;$selected=true; @endphp
                            @include('backend.buffets._item')
                        @endforeach
                    @endif
                    @php $selected=false; @endphp
                    @if($equipments)
                        @foreach($equipments->whereNotIn('id',$sel) as $item)
                            @php $i++ ; @endphp
                            @include('backend.buffets._item')
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="form-group">
    <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i>&nbsp;حفظ
    </button>
</div>
@push('js')
    <script>
        $(document).on("change","#client_id",function(e){
            if($(this).val() != ''){
                var mobile = $(this).find('option:selected').attr('mobile');
                var address = $(this).find('option:selected').attr('address');
                $("#mobile").val(mobile);
                $("#address").val(address);
            }
        });
        $(document).on("change",".buffetItemChk",function(e){

            if( $(this).is(":checked") ){
                $(this).closest(".item-row").find('.itemPrice').attr('disabled',false);
                $(this).closest(".item-row").find('.itemQty').attr('disabled',false);
                $(this).closest(".item-row").find('.RecivedQty').attr('disabled',false);
            }else{
                $(this).closest(".item-row").find('.itemPrice').attr('disabled',true);
                $(this).closest(".item-row").find('.itemQty').attr('disabled',true);
                $(this).closest(".item-row").find('.RecivedQty').attr('disabled',true);
            }
        });
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".tab-content .produtItem").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    </script>
@endpush
