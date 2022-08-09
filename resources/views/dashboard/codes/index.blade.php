@extends('layouts.backend')
@section('content')
<div class="content-wrapper">
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">اكواد الخصم</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">

                                <br>
                                <table class="table table-striped table-bordered zero-configuration">
                                    <a data-toggle="modal" data-target="#myModal3" class="btn btn-info mb-2 ">
                                        اضف كود خصم   
                                    </a>

                                    <br>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> اسم المتجر</th>
                                            <th> اسم كود الخصم </th>
                                            <th>اسم المشهور</th>
                                            <th>نسبة كود الخصم</th>
                                            <th>فايدة اسخدام الكود</th>
                                            <th>نسبة كودك</th>
                                            <th>نسبة المشهور</th>
                                            <th>الاجراءات</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>1</td>
                                            <td>متجر قيس</td>
                                            <td>QQQ</td>
                                            <td>محمود </td>
                                            <td>50%</td>
                                            <td>25%</td>
                                            <td>-50%</td>
                                            <td>-50%</td>
                                            <td><button class="btn btn-info" data-toggle="modal" data-target="#myModal4"><i
                                                class="fa fa-edit"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>متجر اناس </td>
                                            <td>AAA</td>
                                            <td>ايهاب </td>
                                            <td>50%</td>
                                            <td>25%</td>
                                            <td>-50%</td>
                                            <td>-50%</td>
                                            <td><button class="btn btn-info" data-toggle="modal" data-target="#myModal4"><i
                                                class="fa fa-edit"></i></button></td>
                                        </tr>




                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <div class="modal" id="myModal4">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"> تعديل كود خصم</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">

                    <form action="">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> المتجر :</label>
                                    <select name="" class="form-control" id="">
                                    <option value="" selected>متجر قيس</option>
                                    <option value="">متجر اناس</option>
                                    <option value="">متجر فور ايفر</option>
                
                                </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> المشهور :</label>
                                    <select name="" class="form-control" id="">
                                    <option value="" selected>محمود </option>
                                    <option value="">ايهاب </option>
                                    <option value="">خالد  </option>
                                    <option value="">محمد  </option>
                                    <option value="">سالم  </option>
                
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> اسم كود الخصم  :</label>
                                    <input type="text" value="QQQ" class="form-control" id="email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> نسبة كود الخصم :</label>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input step="5" max="100" min="5" type="number" class="form-control form-control-lg input-lg" id="iconLeft2" placeholder="">
                                        <div class="form-control-position">
                                            %
                                        </div>

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> فايدة استخدام الكود     :</label>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input step="5" max="100" min="5" type="number" class="form-control form-control-lg input-lg" id="iconLeft2" placeholder="">
                                        <div class="form-control-position">
                                            %
                                        </div>

                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> نسبة كودك  :</label>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input step="5" max="100" min="5" type="number" class="form-control form-control-lg input-lg" id="iconLeft2" placeholder="">
                                        <div class="form-control-position">
                                            %
                                        </div>

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"> نسبة المشهور     :</label>
                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input step="5" max="100" min="5" type="number" class="form-control form-control-lg input-lg" id="iconLeft2" placeholder="">
                                        <div class="form-control-position">
                                            %
                                        </div>

                                    </fieldset>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-default">حفظ</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>

            </div>
        </div>
    </div>

</div>
</div>
<div class="modal" id="myModal3">
<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">تعديل كود خصم </h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body ">
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"> المتجر :</label>
                            <select name="" class="form-control" id="">
                            <option value="">متجر قيس</option>
                            <option value="">متجر اناس</option>
                            <option value="">متجر فور ايفر</option>
        
                        </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"> المشهور :</label>
                            <select name="" class="form-control" id="">
                            <option value="">محمود </option>
                            <option value="">ايهاب </option>
                            <option value="">خالد  </option>
                            <option value="">محمد  </option>
                            <option value="">سالم  </option>
        
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"> اسم كود الخصم  :</label>
                            <input type="text" class="form-control" id="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"> نسبة كود الخصم :</label>
                            <input type="text" class="form-control percentage" value="%" id="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"> فايدة استخدام الكود     :</label>
                            <input type="text" class="form-control percentage" value="%" id="email">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"> نسبة كودك  :</label>
                            <input type="text" class="form-control percentage" value="%" id="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"> نسبة المشهور     :</label>
                            <input type="text" class="form-control percentage" value="%" id="email">
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-default">اضافة</button>
            </form>

        </div>


        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
        </div>

    </div>
</div>

</div>
@endsection