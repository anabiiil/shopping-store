@extends('layouts.dashboard')

@section('content')

<div>
    <h2>Category</h2>
</div>

<ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}"> Dashboard</a></li>
    <li class="breadcrumb-item active">Category</li>
    @if (auth()->guard('admin')->user()->hasPermission('create_categories'))
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.create') }}"> Add New Category </a></li>
    @endif
</ul>

<div class="row">

    <div class="col-md-12">

        <div class="tile mb-4">



            <div class="row">
                <div class="col-md-12">
                    @if ($categories !== null)
                    <table class="table table-hover text-right" id=" " dir="rtl">
                        <thead>
                            <tr>
                                <th>تفاصيل الطلب</th>
                                <th>السعر</th>
                                <th>عدد القطع</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>



                                <td>
                                    رشيد المرغنى عمر
                                    --
                                    01149406415
                                    --
                                    ادفو
                                    --
                                    <span class="badge badge-primary"> اسوان</span>

                                    -- سبورت
                                    42 اسود
                                    -- 42 ابيض
                                    -- 43 كحلي
                                </td>

                                <td>405</td>
                                <td>3</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/86" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/86" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="86" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="86"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    احمد الجباس
                                    --
                                    01019198159....01119572715
                                    --
                                    مساكن نسمه بجوار جامع الحجار
                                    --
                                    <span class="badge badge-primary"> القليوبيه</span>

                                    سبورت - اسبود -- كحلي -- 44

                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/87" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/87" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="87" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="87"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    خميس الشيخ
                                    --
                                    01003059163
                                    --
                                    محمد نجيب بجوار مدحت العطار
                                    --
                                    <span class="badge badge-primary"> الإسكندرية</span>
                                    سبورت 41 اسود
                                    -- 43 ابيض
                                    -- 43 فافان

                                </td>

                                <td>405</td>
                                <td>3</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/88" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/88" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="88" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="88"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    محمود رمضان
                                    --
                                    01148324227
                                    --
                                    القرينين.. الباحور
                                    --
                                    <span class="badge badge-primary"> المنوفيه</span>
                                    فاشون هافان 43

                                </td>

                                <td>169</td>
                                <td>1</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/89" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/89" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="89" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="89"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    حسن امين
                                    --
                                    ٠١١٤٢٧٩٦٦١٢
                                    --
                                    ١٩ شارع السيده عائشة عزبه شلبى مسطرد المطريه
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    سبورت 42 ابيض وهافان ورمادي


                                </td>

                                <td>405</td>
                                <td>3</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/90" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/90" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="90" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="90"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    محمد رفعت عبدالحميد الشافعى
                                    --
                                    01092663686
                                    --
                                    كفر الشرفا القبلى مركز شبين القناطر
                                    --
                                    <span class="badge badge-primary"> القليوبيه</span>
                                    سبورت كحلي 42
                                    --
                                    فاشون احمر 41


                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/91" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/91" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="91" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="91"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    عثمان لديد الصياد
                                    --
                                    01144511641
                                    --
                                    المنطقه الحره العامه بمدينه نصر شركه كوكاكولا مصر
                                    --
                                    <span class="badge badge-primary ml-2"> القاهره</span>
                                    سبورت 45 كحلي ورمادي

                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/92" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/92" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="92" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="92"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    نور العزباوى
                                    --
                                    01277551651
                                    --
                                    المقطم شارع 9 عند كشري ابو حنفي بجوار ستوديو فانتازيا
                                    --
                                    <span class="badge badge-primary"> القاهره</span>

                                    سبورت ابيض 41
                                </td>

                                <td>169</td>
                                <td>1</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/93" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/93" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="93" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="93"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    رزق هاشم محمود
                                    --
                                    01028886462
                                    --
                                    مركز بلقاس
                                    --
                                    <span class="badge badge-primary"> الدقهلية</span>
                                    فاشون ابيض واسود 43

                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/94" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/94" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="94" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="94"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    حماده مرعى
                                    --
                                    01206402362
                                    --
                                    مساكن رمله بولاق السبتيه
                                    --
                                    <span class="badge badge-primary"> القاهره</span>

                                    سبورت ابيض 45
                                </td>

                                <td>169</td>
                                <td>1</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/95" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/95" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="95" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="95"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    عماد احمد محمود
                                    --
                                    01095331712
                                    --
                                    مدينه اكتوبر الحى السادس السوق القديم عماره شارع مدخل المستقبل عماره ٤٩ سوبر ماركت الشافعى الدور الرابع
                                    --
                                    <span class="badge badge-primary"> الجيزه</span>

                                    فاشون 41 ابيض -- سبورت 45 اسود
                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/96" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/96" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="96" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="96"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    حنان جمال لبيب
                                    --
                                    ٠١٢٢٣١١٠٦٨٥
                                    --
                                    ٣٤ جمال الدين عفيفي متفرع من حسن مامون النادي الاهلي م/نصر
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    سبورت 41 اسود وكحلي

                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/97" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/97" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="97" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="97"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    احمد هشام محمد
                                    --
                                    01002598214
                                    --
                                    مدينه السلام فاطمه الزهراء الدلتا، 1 بلوك2
                                    --
                                    <span class="badge badge-primary"> القاهره</span>


                                </td>

                                <td>0</td>
                                <td>0</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/98" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/98" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="98" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="98"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    عبدو محمود
                                    --
                                    01156329341... 01200354069
                                    --
                                    مركز ابشواى قريه العجميين
                                    --
                                    <span class="badge badge-primary"> الفيوم</span>

                                    فاشون 41 اسود
                                    -- سبورت 41 اسود
                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/99" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/99" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="99" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="99"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    شريف سيد محمد
                                    --
                                    01004147441
                                    --
                                    شارع الملك فيصل المورطيه عماره ١ شقه ١١
                                    --
                                    <span class="badge badge-primary"> الجيزه</span>
                                    سبورت اسود وهافان 43

                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/100" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/100" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="100" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="100"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    وليد شعبان حلمى
                                    --
                                    01022431459
                                    --
                                    البراجيل عند مصنع الرنجه
                                    --
                                    <span class="badge badge-primary"> الجيزه</span>

                                    سبورت احمر 43 قطعتين
                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/101" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/101" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="101" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="101"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    محمد صالح محمد
                                    --
                                    01069310401
                                    --
                                    8 شارع الوليد مدينة الأمل متفرع من شارع الجمهوريه المرج الجديده
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    سبورت اسود وهافان 41

                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/102" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/102" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="102" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="102"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    وائل محمود محمود
                                    --
                                    ٠١١٥٧٨١٤٠٨٢
                                    --
                                    شارع مسجد التوبه متفرع من شارع الأربعين حديقه بدر جسر السويس
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    سبورت ابيض ورمادي 43

                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/103" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/103" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="103" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="103"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    اسلام جمال ابو زيد
                                    --
                                    01282663904
                                    --
                                    مركز مشتول السوق قريه المنير
                                    --
                                    <span class="badge badge-primary"> الشرقيه</span>
                                    فاشون ابيض واسود 43

                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/104" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/104" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="104" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="104"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    صلاح محمد حنفى
                                    --
                                    01157460031
                                    --
                                    محل الاندليسيه شارع الكابلات المطريه
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    فاشون 45 احمر واسود

                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/105" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/105" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="105" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="105"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    نور السعيد هنداوي
                                    --
                                    01099475438
                                    --
                                    مركز قلين
                                    --
                                    <span class="badge badge-primary"> كفر الشيخ</span>

                                    سبورت 44 ابيض واسود
                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/106" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/106" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="106" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="106"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    على جمال عاشور
                                    --
                                    ٠١٠٢٤٥١٥٥٤٦
                                    --
                                    زهراء مدينه نصر شارع السلاب ثاني عماره بعد المخزن السلاب
                                    --
                                    <span class="badge badge-primary"> القاهره</span>

                                    سبورت 41 كحلي
                                    --
                                    سبورت 43 كحلي واسود
                                </td>

                                <td>405</td>
                                <td>3</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/107" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/107" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="107" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="107"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    عمرو المهدى
                                    --
                                    ٠١٠٢٠٠٩٩٧٥٠
                                    --
                                    فيصل
                                    --
                                    <span class="badge badge-primary"> الجيزه</span>
                                    سبورت 44 كحلي
                                    ---
                                    فاشون 44 ابيض


                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/108" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/108" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="108" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="108"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    نصر سعد
                                    --
                                    01090093993
                                    --
                                    التجمع الاول مدراس مصر 2000الحديثه بجوار الجامعه الكندية جنوب أكاديمية الشرطه شارع خالد بن الوليد
                                    --
                                    <span class="badge badge-primary"> مدنيه نصر</span>


                                </td>

                                <td>0</td>
                                <td>0</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/109" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/109" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="109" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="109"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    فارس السيد
                                    --
                                    01119959268
                                    --
                                    مسطرد ترعة الشابوري الجديد أمام هايبر السويسري
                                    --
                                    <span class="badge badge-primary"> القليوبيه</span>

                                    سبورت 44 كحلي واسود
                                    -- سبورت 45 كحلي واسود

                                </td>

                                <td>530</td>
                                <td>4</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/110" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/110" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="110" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="110"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    احمد الحديدى
                                    --
                                    01110300657
                                    --
                                    السيدة زينب شارع طولون
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    فاشون 42 ابيض


                                </td>

                                <td>169</td>
                                <td>1</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/111" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/111" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="111" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="111"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    نصر سعد
                                    --
                                    01090093993
                                    --
                                    التجمع الاول مدراس مصر 2000الحديثه بجوار الجامعه الكندية جنوب أكاديمية الشرطه شارع خالد بن الوليد
                                    --
                                    <span class="badge badge-primary"> مدنيه نصر</span>


                                </td>

                                <td>0</td>
                                <td>0</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/112" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/112" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="112" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="112"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    محمد عبد اللطيف
                                    --
                                    01111563654.... 01142043055
                                    --
                                    الوراق برطس امام بنزيمة غزال
                                    --
                                    <span class="badge badge-primary"> الجيزه</span>
                                    فاشون 44 ابيض واسود ورمادي

                                </td>

                                <td>405</td>
                                <td>3</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/113" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/113" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="113" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="113"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    يوسف محمد نجيب
                                    --
                                    01008394036
                                    --
                                    التجمع الخامس جاردينيا هايتس١ (ابو الهول ١ سابقا) بجانب النرجس ٨
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    فاشون 45 احمر ورمادي


                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/114" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/114" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="114" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="114"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    نصر سعد
                                    --
                                    01090093993
                                    --
                                    التجمع الاول مدراس مصر 2000الحديثه بجوار الجامعه الكندية جنوب أكاديمية الشرطه شارع خالد بن الوليد
                                    --
                                    <span class="badge badge-primary"> مدنيه نصر</span>


                                </td>

                                <td>0</td>
                                <td>0</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/115" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/115" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="115" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="115"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    ابراهيم طه
                                    --
                                    01204713326
                                    --
                                    شبرا الخيمه الشارع الجديد عند شارع كنتاكي
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    فاشون 41 ابيض واسود


                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/116" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/116" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="116" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="116"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    مصطفى محمود محمد
                                    --
                                    01014352557
                                    --
                                    بعد نفق الشهيد احمد حمدي اول بنزينه وطنيه على اليمين
                                    --
                                    <span class="badge badge-primary"> السويس</span>
                                    سبورت 45 اسود


                                </td>

                                <td>169</td>
                                <td>1</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/117" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/117" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="117" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="117"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    محمد غديرى
                                    --
                                    01125809999
                                    --
                                    التجمع الخامس امام معاهد الكمال الازهرى او فاطمه الشربتلى النرجس عمارات
                                    --
                                    <span class="badge badge-primary"> القاهره الجديده</span>
                                    شوز فاشون 41 ابيض


                                </td>

                                <td>169</td>
                                <td>1</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/118" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/118" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="118" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="118"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    محمد سعيد
                                    --
                                    ٠١١١٩٥١٦٧٥٨
                                    --
                                    المرج محمد نجيب
                                    --
                                    <span class="badge badge-primary"> القاهره</span>

                                    فاشون 42 ابيض
                                </td>

                                <td>169</td>
                                <td>1</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/119" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/119" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="119" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="119"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    محمود على
                                    --
                                    ٠١١٢٨٥٦١٥١١
                                    --
                                    عمارات بدر بجوار كارفور المعادي معرض جوتن للدهانات شارع اديداس
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    فاشون 45 اسود ورمادي

                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/120" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/120" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="120" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="120"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    احمد بدر
                                    --
                                    01149497479
                                    --
                                    الامام الشافعى محطه الجراچ 11 شارب ابو الدبل
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    فاشون 45 ابيض واسود


                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/121" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/121" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="121" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="121"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    عيدفولي كامل البدرمان
                                    --
                                    ٠١١٢٥٣٥٥٧٨٠
                                    --
                                    مركز ديرموس شارع لوقا جعيدي يا مين
                                    --
                                    <span class="badge badge-primary"> المنيا</span>

                                    سبورت 45 ابيض

                                </td>

                                <td>169</td>
                                <td>1</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/122" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/122" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="122" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="122"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    احمد ابراهيم
                                    --
                                    ٠١١٤٦٨٣٦٣١٦
                                    --
                                    مدينة العبور اسكان الشباب اول شارع الشباب
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    سبورت كحلي وهافان 45


                                </td>

                                <td>280</td>
                                <td>2</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/123" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/123" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="123" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="123"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    احمد على عثمان
                                    --
                                    01280889800
                                    --
                                    الوان مدينه الشروق
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    سبورت كحلي 42 و 43 و 44 و 45


                                </td>

                                <td>530</td>
                                <td>4</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/124" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/124" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="124" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="124"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    جاسر جنيد
                                    --
                                    ٠١٠٠٦٠٧٧١٥٠
                                    --
                                    ٨٣ ش عثمان بن عفان الدور الرابع شقه ٨ - سفير النزهه القديمه - بجوار محل عصير العائلات جاسر جنيد
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    فاشون 45 اسود


                                </td>

                                <td>169</td>
                                <td>1</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/125" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/125" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="125" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="125"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    ابو زيد سيد يوسف
                                    --
                                    01144631130..... 01010260101
                                    --
                                    موقع مول القطميه الجديد جمب بنزينه مستر
                                    --
                                    <span class="badge badge-primary"> القاهره</span>
                                    سبورت اسود 42

                                </td>

                                <td>169</td>
                                <td>1</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/126" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/126" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="126" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="126"></i>
                                </td>



                            </tr>


                            <tr>



                                <td>
                                    نصر سعد
                                    --
                                    01090093993
                                    --
                                    التجمع الاول مدراس مصر 2000الحديثه بجوار الجامعه الكندية جنوب أكاديمية الشرطه شارع خالد بن الوليد
                                    --
                                    <span class="badge badge-primary"> مدينه نصر</span>

                                    فاشون اسود وابيض وهافان 44
                                </td>

                                <td>405</td>
                                <td>3</td>

                                <td class="d-none">
                                    <button href="javascript:void(0);" data-href="http://sakran.store/admin/loadorderdetails/127" class="openPopup" data-toggle="modal" data-target="#myModal">عرض</button>
                                    <a href="http://sakran.store/admin/load-order-details-print/127" target="_blank">طباعه</a>
                                    <i class="fas fa-edit" data-toggle="modal" data-target="#edit_order_st" data-edit_order_st_id="127" data-edit_order_ph_id="1"></i> |

                                    <i class="fas fa-trash-alt" data-toggle="modal" data-target="#deleteorder" data-orderid="127"></i>
                                </td>



                            </tr>


                        </tbody>

                    </table>
                    @else
                    <h3 style="font-weight: 400;">Sorry no records found</h3>
                    @endif
                </div>
            </div>
        </div><!-- end of tile -->

    </div><!-- end of col -->

</div><!-- end of row -->

@endsection
