<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use Spatie\Menu\Html;
use Spatie\Menu\Laravel\Menu;

class BackendMenuComposer {

    public function __construct() {

    }

    public function compose(View $view) {
        $view->with('menu', $this->menuData());
    }

    public function menuData() {
        $menu =  Menu::new()
            ->addItemParentClass('kt-menu__item')
            ->addItemClass('kt-menu__link');
        $menu->add(Html::raw(' <li aria-haspopup="true" class="kt-menu__item  kt-menu__item  kt-menu__item--active">
                    <a href="'.route('backend.home').'" class="kt-menu__link">
                         <i class="kt-menu__link-icon flaticon2-architecture-and-city" style="color:#f5f6ff;"></i>
                        <span class="kt-menu__link-text">الرئيسية</span>
                    </a>
                </li>'));
        foreach ($this->items() as $item) {
            $func = $item['function'];

            $menu->$func(...$item['parameters']);

        }

        return $menu->render();
    }

    public function items() {
        return [
            [
                "function" => "addClass",

                "parameters" => ['kt-menu__nav']
            ],

            [
                "function" => "linkIfCan",

                "parameters" => ['List Payments', route('backend.payments.index'), '<i class="kt-menu__link-icon flaticon2-add"></i><span class="kt-menu__link-text">متابعة السداد']
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Gallery', route('backend.reports.sales'), '<i class="kt-menu__link-bullet fa fa-file"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> تقرير المبيعات'],
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Gallery', route('backend.reports.decors'), '<i class="kt-menu__link-bullet fa fa-file"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> تقرير الكوش المحجوزه'],
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Gallery', route('backend.reports.minus'), '<i class="kt-menu__link-bullet fa fa-file"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> تقرير النواقص'],
            ],

            [
                "function" => "linkIfCan",

                "parameters" => ['List Orders', route('backend.orders.index'), '<i class="kt-menu__link-bullet fa fa-file-invoice"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> العقود']
            ],

            [
                "function" => "linkIfCan",

                "parameters" => ['List Clients', route('backend.clients.index'), '<i class="kt-menu__link-bullet fa fa-users"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> العملاء']
            ],

            [
                "function" => "linkIfCan",

                "parameters" => ['List Category', route('backend.category.index'), '<i class="kt-menu__link-bullet fa fa-folder"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> الفئات']
            ],

            [
                "function" => "linkIfCan",

                "parameters" => ['List Items', route('backend.items.index'), '<i class="kt-menu__link-bullet fa fa-cubes"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> الأصناف']
            ],

            [
                "function" => "linkIfCan",

                "parameters" => ['List Buffets', route('backend.buffets.index'), '<i class="kt-menu__link-bullet flaticon-menu-button"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> البوفيه']
            ],


            [
                "function" => "linkIfCan",

                "parameters" => ['List Buffet Category', route('backend.buffetcategory.index'), '<i class="kt-menu__link-bullet fa flaticon-layers"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> تصنيفات البوفية']
            ],

            [
                "function" => "linkIfCan",

                "parameters" => ['List Departments', route('backend.departments.index'), '<i class="kt-menu__link-bullet fa flaticon-map"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> الإدارات']
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Tasks', route('backend.tasks.index'), '<i class="kt-menu__link-bullet fa flaticon-list"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> مهام الإدارات']
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Slider', route('backend.sliders.index'), '<i class="kt-menu__link-bullet fa fa-image"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> السليدر']
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Tasks', route('backend.ordertasks.index'), '<i class="kt-menu__link-bullet fa flaticon-list"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> المهام الخاصة بى']
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Users', route('backend.users.index'), '<i class="kt-menu__link-bullet fa fa-users"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> المستخدمين']
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Roles', route('backend.roles.index'), '<i class="kt-menu__link-bullet fa fa-lock"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> الصلاحيات']
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Contracts', route('backend.contracts.index'), '<i class="kt-menu__link-bullet fa fa-file-contract"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> العقود']
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Pages', route('backend.pages.index'), '<i class="kt-menu__link-bullet fa fa-file"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> الصفحات']
            ],
            [
                "function" => "linkIfCan",

                "parameters" => ['List Gallery', route('backend.gallery.index'), '<i class="kt-menu__link-bullet fa fa-images"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> معرض الصور']
            ],
            /*[
                "function" => "linkIfCan",
                "parameters" => ['List Gallery', route('backend.reports.daily'), '<i class="kt-menu__link-bullet fa fa-file"></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text"> التقرير اليومى'],
            ],*/
        ];
    }


}
