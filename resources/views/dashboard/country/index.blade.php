@extends('layouts.backend_new')
@section('content')
  
<div class="row">

    <div class="col-2">
      <h2>الدول   </h2>
    </div>
    <div class="col-2 p-0 ms-auto flex-column flex-center justify-content-between p-4">
      <a class="btn btn-primary btn-lg w-100 add" data-bs-toggle="modal" data-bs-target="#addStore">
        <img src="{{asset('new_dash/images/icons/add-vendor.png')}}" alt="" class="me-1" />
        اضافة دولة
      </a>

    </div>


  </div>
  
  <div class="content mt-5">
    <div class="border-top border-secondary">
        @include('dashboard.parts._error')
        @include('dashboard.parts._success')
        <table id="example" class="display compact" style="width:100%" id="storestable">


            <br>
            <thead>
                <tr>
                    <th class="text-right">#</th>
                    <th class="text-right">علم الدولة  </th>
                    <th class="text-right">اسم الدولة  </th>
                    <th class="text-right">رمز الدولة  </th>
                    <th class="text-right">الاجراءات</th>

                </tr>
            </thead>
            <tbody id="stores">
                @foreach ($country as $key => $item)
                    <tr>
                        <td class="text-right">{{ $key + 1 }}</td>
                        <td class="text-right"><img src="{{ asset('uploads/' . $item->flag) }}" width="100"
                            height="70" alt=""></td>
                 
                        <td class="text-right">{{ $item->title }} </td>
                        <td class="text-right">{{ $item->code }} </td>

                        <td class="text-right">
                            @if(auth()->user()->hasRole('Admin'))
                            <button class="btn btn-inf" data-toggle="modal" data-target="#myModal4"
                            onclick="make('{{ $item->id }}')"><img src="{{asset('new_dash/images/icons/edit.png')}}" class="pointer"
                            alt=""></button>
                            <form style="display: inline" action="{{ route('country.destroy',$item->id) }}" method="post">
                                @method('delete') @csrf
                                <button type="submit"  class="btn  delete-confirm"><img src="{{asset('new_dash/images/icons/delete.png')}}" class="pointer"
                                    alt=""></button>
                            </form>
                            @else 
                            _
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
    
  </div>
  <div class="modal fade" id="addStore" tabindex="-1" aria-labelledby="addStoreLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStoreLabel">
            <img src="{{asset('new_dash/images/icons/vendors.png')}}" alt="" class="me-1"> إضافة دولة
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="form-errors" class="text-center"></div>
            <div id="form-errors" class="text-center"></div>
            <div id="success" class="text-center"></div>
            <form class="form" method="post" action="{{ route('country.store') }}"  enctype="multipart/form-data">
            @csrf
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>اسم الدولة </label>
                        <input type="text" name="title_en" autocomplete="off"
                            data-country-id="0" class="form-control" id="country"
                            placeholder="اضف الدولة  ">
                    </div>
                    <div id="full_data"></div>


                </div>
                <br>
                <div class="col-md-3" id="country_info"></div>

                <br>


            </div>
            
                
              
            
                <div class="input-item">
                    <button class="btn text-end add-store">+ اضافة دولة</button>
                </div>
            
            </form>
        </div>

      </div>
    </div>
  </div>



  <div class="modal fade" id="updateStore" class="modal-open" tabindex="-1" aria-labelledby="updateStoreLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateStoreLabel">
            <img src="{{asset('new_dash/images/icons/vendors.png')}}" alt="" class="me-1"> تعديل الدولة
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="company_edit">
          
        </div>

      </div>
    </div>
  </div>
@endsection

@section('script')

    <script>
        $('#sendmemessage').on('submit', function(e) {
            e.preventDefault();
            var frm = $('#sendmemessage');
            var formData = new FormData(frm[0]);
            
            var data = $(this).serialize();

            $.ajax({
                url: "{{ route('famoustype.store') }}",
                type: "post",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // var table = $('#stores').DataTable();
                   
                    var t = $('#storestable').DataTable();
                    const tr = $(data);
                    t.row.add(tr).draw(false);
                    
                    
                        document.getElementById("sendmemessage").reset();
                        $('#myModal').modal('hide')
                        swal(
                            '',
                            ' تم الاضافة بنجاح ',
                            'success'
                        )
                        setTimeout(function() {
                    window.location.reload();
                }, 1000);


                },
                error: function(data) {
                    var errors = data.responseJSON;
                    var errors = data.responseJSON;
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors.errors, function(k, v) {
                        errorsHtml += '<li>' + v + '</li>';
                    });
                    errorsHtml += '</ul></di>';
                    $('#form-errors').html(errorsHtml);
                },
            });
        });
        
        
        function make(id) {
            // $("#updateStore").show();
            $('#updateStore').modal('show');
            // $('#staticBackdrop').modal();

            $.ajax({
                type: 'post',
                url: "{{ route('get_form_country') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id': id
                },
                beforeSend: function() {},
                success: function(data) {
                    $('#company_edit').html(data);


                }
            });

        }
      
    </script>
    <script>
        function autocomplete(inp, arr, fullarr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/

                        b = document.createElement("a");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' data-country-id=" + i + " value='" + arr[i] + "'>";
                        b.innerHTML += "<br>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            // $('#country').data('country-id', 200);

                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            inp.dataset.countryId = this.getElementsByTagName("input")[0].dataset
                                .countryId;

                            var txt = document.getElementById("full_data");
                            txt.innerHTML = '';
                            var country_info = document.getElementById("country_info");
                            country_info.innerHTML = '';


                            txt.innerHTML += "<input type='hidden' name='flag' value='" + fullarr[inp
                                .dataset.countryId].flag + "'>";
                            txt.innerHTML += "<input type='hidden' name='alpha2Code' value='" + fullarr[
                                inp.dataset.countryId].alpha2Code + "'>";
                            txt.innerHTML += "<input type='hidden' name='alpha3Code' value='" + fullarr[
                                inp.dataset.countryId].alpha3Code + "'>";
                            txt.innerHTML += "<input type='hidden' name='code' value='" +
                                fullarr[inp.dataset.countryId].callingCodes[0] + "'>";
                            txt.innerHTML += "<input type='hidden' name='title_ar' value='" + fullarr[
                                inp.dataset.countryId].nativeName + "'>";
                            txt.innerHTML += "<input type='hidden' name='lat' value='" + parseFloat(
                                fullarr[inp.dataset.countryId].latlng[0]) + "'>";
                            txt.innerHTML += "<input type='hidden' name='lng' value='" + fullarr[inp
                                .dataset.countryId].latlng[1] + "'>";
                            txt.innerHTML += "<input type='hidden' name='name' value='" + fullarr[inp
                                .dataset.countryId].name + "'>";

                            country_info.innerHTML += `
                    <div class="card">
                        <div class="header">
                          <h2>Country Info</h2>
                        </div>
                        <div class="body text-center">
                            <div class="circle">
                                <img style="max-width: 150px;" src="` + fullarr[inp.dataset.countryId].flag + `" alt="">
                            </div>
                            <h6 class="mt-3 mb-0">` + fullarr[inp.dataset.countryId].name + ` | ` + fullarr[inp.dataset
                                .countryId].nativeName + `</h6>
                            <div>country code ` + fullarr[inp.dataset.countryId].alpha2Code + `</div>
                            <div>phone code ` + fullarr[inp.dataset.countryId].callingCodes[0] + `</div>
                            <div>lat ` + (fullarr[inp.dataset.countryId].latlng[0]) + `</div>
                            <div>lat ` + fullarr[inp.dataset.countryId].latlng[1] + `</div>
                        </div>
                    </div>`;


                            inp.parentNode.insertBefore(txt, inp.nextSibling);

                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            var allData = null;

            $.ajax({
                'type': "GET",
                'dataType': 'json',
                'async': false,
                'url': "https://restcountries.com/v2/all",
                'success': function(data) {
                    allData = data;
                }
            });
            console.log(allData);
            countries = [];
            $.each(allData, function(i) {
                countries[i] = allData[i].nativeName;
            });

            // /*An array containing all the country names in the world:*/
            // var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua & Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia & Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre & Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts & Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad & Tobago","Tunisia","Turkey","Turkmenistan","Turks & Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

            // /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
            autocomplete(document.getElementById("country"), countries, allData);

            $('body form').on('submit', function() {

            });
            var msg = "{{ Session::get('success_msg') }}";
            var exist = "{{ Session::has('success_msg') }}";
            if (exist) {
                alertify.success(msg);
            }
        });
    </script>
@endsection
