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
                        </div>
                        <div class="cart-quantity" style="margin-top: 20px">
                            <div class="quantity-input">
                                <label for="classificationProductModal">Quantity</label>
                                <input type="number" class="form-control" value="1" min="0">
                            </div>
                        </div>
                        <p></p>
                        <button class="btn btn-primary" style="margin-top: 10px">
                            Add to Cart
                        </button>
                    </div><!-- end col-md-4  -->
                </div>
            </div>
        </div>
    </div>
</div>