@extends('sales.index')

@section('sales')


    <div class="col-md-7">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-side-menu-option nav-side-menu-option-top">
                    <div class="right-nav-side-menu-tex-align font-weight-b">
                        <div class="row">


                            <div class="col-md-1 col-sm-1">


                                @include('sales.layouts.price_list_model')


                            </div>

                            <div class="col-md-2 col-sm-2">
                                <button style="margin-left: 25px" type="button" class="btn btn-default" data-toggle="modal"
                                        data-target="#Product_model">Item list
                                </button>

                                @include('sales.layouts.product_list')


                            </div>

                            <div class="col-md-5 col-sm-5">
                                <input id="product_autocomplete" type="text" id="form-control-sales-search"
                                       class="form-control sales_search_item" required="required"
                                       placeholder="Start typing item's code or scan barCode...">
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <button onclick="insertForm()" type="button" class="btn btn-default">Select item
                                </button>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#carryModel">Add Carry</button>

                            </div>
                        </div>
                    </div>
                    <br>


                    @include('sales.layouts.error_success_sales')

                    <div class="form-horizontal-option">
                        <div class="row margin-t-b">
                            <div class="col-md-3 col-sm-3 padding-top text-align-r"><b>Product Code : </b></div>
                            <div class="col-md-6 col-sm-6"><input type="text" id="product_id" name="product_id"
                                                                  readonly="readonly" class="form-control"
                                                                  required="required"></div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row margin-t-b">
                            <div class="col-md-3 col-sm-3 padding-top text-align-r"><b>Quantity : </b></div>
                            <div class="col-md-6 col-sm-6"><input id="qty" min="0" name="qty" type="number"
                                                                  onkeyup="ifQuantityChange()"
                                                                  class="form-control input_validation_with_dot"
                                                                  required="required"></div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row margin-t-b">
                            <div class="col-md-3 col-sm-3 padding-top text-align-r"><b>Price : </b></div>
                            <div class="col-md-6 col-sm-6"><input id="price" readonly="readonly" name="price"
                                                                  type="number" class="form-control"
                                                                  required="required"></div>
                            <div class="col-md-3"></div>
                        </div>

                                <div class="row margin-t-b">
                                    <div class="col-md-3 col-sm-3 padding-top text-align-r"><b>Vat : </b></div>
                                    <div class="col-md-6 col-sm-6"><input id="vat" readonly="readonly" name="vat" type="number" class="form-control" required="required"></div>
                                    <div class="col-md-3"></div>
                                </div>

                        <div class="row margin-t-b">
                            <div class="col-md-3 col-sm-3 padding-top text-align-r"><b>Discount :</b></div>
                            <div class="col-md-6 col-sm-6"><input id="dis" onkeyup="ifQuantityChange()" name="dis"
                                                                  type="number"
                                                                  class="form-control input_validation_with_dot"
                                                                  required="required"></div>
                            <div class="col-md-3"></div>
                        </div>


                  
                         
                        
                           
                    

                        <div class="row margin-t-b">
                            <div class="col-md-3 col-sm-3 padding-top text-align-r"><b>Total : </b></div>
                            <div class="col-md-6 col-sm-6"><input id="amount" name="amount" readonly="readonly"
                                                                  type="number" class="form-control"
                                                                  required="required"></div>
                            <div class="col-md-3"></div>
                        </div>
                        <div class="row margin-t-b">
                            <div class="col-md-6 col-sm-6 padding-top"></div>
                            <div class="col-md-3 col-sm-3">

                                <input type="hidden" id="description" name="description" readonly="readonly"
                                       class="form-control">

                                <button id="add_product_button" onclick="AddData()"
                                        class="btn btn-primary btn-primary-option font-weight-b add-item"
                                        style="float: right;" type="button"><b>Add item</b></button>

                            </div>

                            <div class="col-md-3"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <form class="form-horizontal" id="yoyo" role="form" method="POST" action="{{route('sales.store')}}">
            {!! csrf_field() !!}

            <div class="nav-side-menu-option">
                <div class="main-table">
                    <table id="list" class="table-striped" cellpadding="56" width="100%">

                        <thead>
                        <tr class="main-parent">
                            <td class="font-weight-b">Product Code</td>
                            <td class="secend-size font-weight-b">Description</td>
                            <td class="font-weight-b">Qty</td>
                            <td class="font-weight-b">Price</td>
                            <td class="font-weight-b">Discount</td>
                            <td class="font-weight-b">Subtotal</td>
                            <td class="font-weight-b">Close</td>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>

                    </table>

                    <div class="row last-span"
                         style="background-color: #31b0d5;padding: 8px;text-align: center;margin: 0px;">
                        <div class="col-md-6"><h4>Total</h4></div>
                        <div class="col-md-6"><h4 id="total" class="total">0</h4></div>
                    </div>


                </div>
            </div>
    </div><!--End main body right part area-->

    @include('sales.layouts.carry')
    @include('sales.layouts.left_side_menu')



    <script type="text/javascript">


        function AddCarry() {
            var carry_amount = parseFloat(document.getElementById("carry_amount").value);
            var total =  parseFloat($('.total').html());

            if(total === parseFloat(0) ){
                $('.total').html(carry_amount);
            }
            else{
                $('.total').html(total+carry_amount);
            }

        }
        function totalAmount() {
            var t = 0;

            // .amount is a classs
            $('.amount').each(function (i, e) {
                var amt = $(this).val() - 0;

                t += amt;
            });


            var carry_amount = parseFloat(document.getElementById("carry_amount").value);

            if(carry_amount > 0){
                $('.total').html(t+carry_amount);
            }else{
                $('.total').html(t);
            }

        }

        function totalQuantity() {
            var t = 0;
            $('.qty').each(function (i, e) {
                var amt = $(this).val() - 0;

                t += amt;
            });


            $('.total_quantity').html(t);


        }

        function insertForm() {

            document.getElementById("product_id").value = temp_ui.item.id;
            var qty = document.getElementById("qty").value = 1;
            var dis = document.getElementById("dis").value = 0;
            var price = document.getElementById("price").value = temp_ui.item.sell;
            ///var vat = document.getElementById("vat").value = temp_ui.item.vat;

            ///var vat_amount =   (qty*price) * vat / 100;

            document.getElementById("amount").value = qty * price;
            document.getElementById("description").value = temp_ui.item.name;
        }

        var temp_ui = 0;




        function ifQuantityChange() {

            var qty = document.getElementById("qty").value;
            var price = document.getElementById("price").value;
            var dis = document.getElementById("dis").value;
            var vat = document.getElementById("vat").value;

            //Button disable off
            document.getElementById("add_product_button").disabled = false;
            ///Check if product is out of stock using get method
            $.ajax({
                type:'get',
                url:'/product/quantity_check/'+ $('#product_id').val() + '/' + +$('#qty').val(),
                success: function(reply_data){

                    console.log(reply_data);
                   /// $('#t_credit').html(reply_data);

                    if(reply_data=="false"){
                        //Button disable off
                        document.getElementById("add_product_button").disabled = true;
                        alert("Product is out of stock")
                    }
                }
            });




            if (qty == 0) {

                var total = 0;
            }
            else {
                var vat_amount =   (qty*price) * vat / 100;
                var total = (qty * price) - (qty * dis);
               /// total = total + vat_amount;


            }


            var amount = document.getElementById("amount").value = total;

        }

        function discount() {
            var qty = document.getElementById("qty").value;
            var price = document.getElementById("price").value;
            var dis = document.getElementById("dis").value;


            if (qty == 0) {

                var total = (qty * price) - ((qty * price * dis) / 100);
            }
            else {
                var total = (qty * price) - dis;
            }

            var amount = document.getElementById("amount").value = total;


        }


        function AddData() {

            var name = document.getElementById("product_id").value;
            var qty = document.getElementById("qty").value;
            var price = document.getElementById("price").value;
            var dis = document.getElementById("dis").value;
            var amount = document.getElementById("amount").value;
            var description = document.getElementById("description").value;


            var rows = '<tr> <td><input  type="hidden" id="name" readonly="readonly" name="product_id[]" value="' + name + '">' + name + '</td>' +

                '<td>' + description + '</td>' +
                '<td><input id="qty"  name="qty[]" type="hidden" class="qty form-control"  value="' + qty + '">' + qty + '</td>' +
                '<td><input name="price[]" type="hidden" class="form-control" readonly="readonly" value="' + price + '">' + price + '</td>' +
                '<td><input name="dis[]" type="hidden" class="form-control" value="' + dis + '">' + dis + '</td>' +
                '<td><input id="amount"  name="amount[]"  readonly="readonly" type="hidden" class="amount form-control"  value="' + amount + '">' + amount + '</td>' +

                '<td><span class="glyphicon glyphicon-remove close" onclick="deleteRow(this)"></span></td>'
            '</tr>'
            ;


            /* var curent_value = $('.total').html();
             curent_value = parseInt(curent_value);
             amount = parseInt(amount);

             var total = (curent_value + amount);
             $('.total').html(total);*/

            $(rows).appendTo("#list tbody");

            totalAmount();
            totalQuantity();


        }


        function deleteRow(btn) {

            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);

            totalAmount();
            totalQuantity();

        }


        $(document).ready(function () {
            $("body").on("click", ".add-more", function () {
                var html = $(".after-add-more").first().clone();

                //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

                $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");


                $(".after-add-more").last().after(html);

                totalAmount3();

            });

            $("body").on("click", ".remove", function () {
                $(this).parents(".after-add-more").remove();
                totalAmount3();
            });
        });


        function totalAmount3() {


            var t = 0;
            $('.multi_amount').each(function (i, e) {
                var amt = $(this).val() - 0;
                t += amt;

            });


            $('.total_paying').html(t);

            document.getElementById("total_payment").value = t;

            newAdvanceOrdue();

            //// $('.total_payment').val(t).toFixed(2);
        }


        function newAdvanceOrdue() {

            var total = $('.total').html();

            var total_payment = 0;

            $('.multi_amount').each(function (i, e) {

                document.getElementById("due").value = "";
                document.getElementById("advance").value = "";

                var payment_amount = $(this).val() - 0;
                total_payment += payment_amount;


            });

            var t = total_payment - total;

            document.getElementById("due").value = "";
            document.getElementById("advance").value = "";


            if (t < 0) {

                t = t - (2 * t);
                $('.backmoney').val(t).toFixed(2);


            }
            else {
                $('.advance').val(t).toFixed(2);

            }

        };

        $('#employee_autocomplete').autocomplete({

            source: '{!!URL::route('employee_autocomplete')!!}',
            minlenght: 1,
            autoFocus: true,

            select: function (e, ui) {
                ///alert(ui);


            }

        });


        $('#product_autocomplete').autocomplete({

            source: '{!!URL::route('product_autocomplete')!!}',
            minlenght: 1,
            autoFocus: true,

            select: function (e, ui) {
                ///alert(ui);
                ///alert(ui.item.value);

                temp_ui = ui;

                /* document.getElementById("product_id").value = ui.item.value;
                 var qty = document.getElementById("qty").value = 1;
                 var dis = document.getElementById("dis").value = 0;
                 var price = document.getElementById("price").value = ui.item.sell;
                 document.getElementById("amount").value = qty*price;

                  document.getElementById("description").value = ui.item.name;*/


            }

        });


        $('#customer').autocomplete({

            source: '{!!URL::route('customer_autocomplete')!!}',
            minlenght: 1,
            autoFocus: true,

            select: function (e, ui) {

                //// For any Html like, div b,  # = id
                $('b#model_customer_details_name').text("Customer Name : " + ui.item.value);
                $('b#model_customer_details_phone').text("Phone Number : " + ui.item.contact);
                $('b#model_customer_details_address').text("Address : " + ui.item.address);

                $('b#customer_name').text(ui.item.value);

                $('#customer_id').val(ui.item.id);
                $('#create_customer_form_customer_id').val(ui.item.id);


                ///  $('#customer_details_model_name').val(ui.item.value); for input box
                ///alert(ui);
                ///ui.item.value
                ///document.getElementById("customer_details_model_name").value = ui.item.value;

                // $('#customer_details_model_name').val(ui.item.value);


            }

        });


    </script>

@endsection
   

