<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel"><span id="pName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img id="pImage" class="card-img-top" style="width: 180px; height: 180px;">
                        </div>
                    </div><!-- end col-md-4  -->
                    <div class="col-md-4">
                        <ul class="list-group">
                            <li class="list-group-item">Price: <b id="price"></b> </li>
                            <li class="list-group-item">Code: <b id="pCode"></b></li>
                            <li class="list-group-item">Category: <b id="pCategory"></b></li>
                            <li class="list-group-item">Brand: <b id="pBrand"></b></li>
                            <li class="list-group-item">In stock:
                                <b id="pStock" > </b>
                            </li>
                        </ul>
                    </div><!-- end col-md-4  -->
                    <div class="col-md-4">
                        <div id="optionClassification">
                            <label for="classificationProductModal">Choose</label>
                            <select id="classificationProductModal" class="form-control">
                                <option value="">--Select options--</option>
                            </select>
                            <small id="modalErrorClassification" class="text-danger"></small>
                        </div>
                        <div class="cart-quantity" style="margin-top: 20px">
                            <div class="quantity-input">
                                <label for="classificationProductModal">Quantity</label>
                                <input type="number" id="modalProductQuantity" class="form-control" value="1" min="0">
                            </div>
                            <small id="modalErrorQuantity" class="text-danger"></small>
                        </div>
                        <p></p>
                        <input type="text" id="modalProductId" hidden>
                        <button class="btn btn-primary" style="margin-top: 10px" onclick="addToCart()">
                            Add to Cart
                        </button>
                        <small id="errorQuantity" class="text-danger"></small>
                    </div><!-- end col-md-4  -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var hasClassificationModal;
    var inStockModal;
    $('#modalProductQuantity').on('input',function (){
        let qty = parseInt($('#modalProductQuantity').val());
        if( qty > parseInt(inStockModal)){
            $('#modalProductQuantity').val(inStockModal);
        }else if(qty < 0){
            $('#modalProductQuantity').val(1);
        }
    });

    function productView(id){
        $.ajax({
            url: '{{ url('ajax/product') }}'+'/'+id,
            type: "GET",
            success: function (data){
                let hostUrl = '{{asset('')}}';
                data = JSON.parse(data);
                let price;
                if(data.discount_price != null){
                    price = data.discount_price;
                }else{
                    price = data.selling_price;
                }

                let checkClassification = false;
                let htmlClassification =  '<option value="" hidden>--Select options--</option>';
                data.classification.forEach(el => {
                    htmlClassification += `<option value="${el.id}">${el.name}</option>`;
                    checkClassification = true;
                });

                $('#pImage').attr('src',hostUrl+data.product_thumbnail)
                $('#pName').text(data.product_name);
                $('#pCode').text(data.product_code);
                $('#price').text(price.toLocaleString() + ' ₫');
                $('#pCategory').text(data.sub_sub_category.subsubcategory_name);
                $('#pBrand').text(data.brand.brand_name);
                $('#modalProductId').val(id);
                $('#modalProductQuantity').val(1);
                $('#pStock').html(data.product_quantity);
                inStockModal = data.product_quantity;
                if(checkClassification){
                    $('#optionClassification').show();
                    $('#classificationProductModal').html(htmlClassification);
                    hasClassificationModal = true;
                }else{
                    $('#classificationProductModal').html('');
                    $('#optionClassification').hide();
                    hasClassificationModal = false;
                }

            }
        });
    }

    $('#classificationProductModal').on('change',function (e){
        let id = $('#classificationProductModal').val();
        $('#modalProductQuantity').val(1);
        $.ajax({
            url: '{{ url('ajax/classification') }}'+'/'+id,
            type: "GET",
            success: function (data){
                data = JSON.parse(data)
                $('#pStock').html(data['quantity']);
                inStockModal = data['quantity'];
            }
        });
    });

    function addToCart(){
        let id = $('#modalProductId').val();
        let quantity = $('#modalProductQuantity').val();
        if(quantity == ""){
            $('#modalErrorQuantity').text('Enter quantity');
            return;
        }else if(parseInt(quantity) > parseInt(inStockModal)){
            $('#modalErrorQuantity').text('Not enough in stock');
            return;
        }
        else{
            $('#modalErrorQuantity').text('');
        }
        let data;
        if(hasClassificationModal){
            let classification = $('#classificationProductModal option:selected').val();
            if(classification == ""){
                $('#modalErrorClassification').text('Choose type');
                return;
            }else{
                $('#modalErrorClassification').text('');
            }
            data = { quantity: quantity, classification: classification }
        }else{
            data = { quantity: quantity}
        }

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: data,
            url: "/cart/store/" + id,
            success: function (data){
                toastr.success(data.success);
                miniCart();
            }
        });
    }
</script>