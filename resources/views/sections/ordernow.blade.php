<!-- Order Now -->
<section id="ordernow">
    <a name="ordernow"></a>
    <div class="container-fluid wrapper">
        <div class="container pt-3 pb-3">
            <div class="row align-items-start content">
                <div class="col-md-6">
                    <div id="order">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="fishtype"><i class="fas fa-fish"></i> &nbsp; Fish Type</label>
                            </div>
                            <select class="custom-select" id="fishtype">
                                <option value="1">Pangasius Fish (Rs. 375/Kg)</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="orderquantity"><i class="fas fa-weight-hanging"></i> &nbsp; &nbsp; Quantity</label>
                            </div>
                            <select class="custom-select" id="fishtype">
                                @for($i=5; $i<=40; $i++)
                                    <option value="{{ $i }}">{{ $i }} Kg</option>
                                @endfor
                            </select>
                        </div>

                        <div class="text-right">
                            <button class="btn mt-2" style="background: #16ADD6;"><i class="fas fa-shopping-basket text-white"></i> <span class="pl-2">Add to Cart</span></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="orderSummary">
                        <h4>Order Summary</h4>
                        <div id="order_items">
                            <div class="row order_item">
                                <div class="col-4 desc">
                                    Pangasius
                                </div>
                                <div class="col-4 quantity">
                                    5 x 375
                                </div>
                                <div class="col-4 price">
                                    Rs. 1875.00
                                </div>
                            </div>
                        </div>

                        <div id="subtotal" class="p-2">
                            <div class="row">
                                <div class="col-6 text-left desc">
                                    Subtotal
                                </div>
                                <div class="col-6 text-right price">
                                    Rs. 1875.00
                                </div>
                            </div>
                        </div>

                        <div id="balance" class="p-2">
                            <div class="row">
                                <div class="col-6 text-left desc">
                                    Outstanding Balance
                                </div>
                                <div class="col-6 text-right price">
                                    Rs. -200.00
                                </div>
                            </div>
                        </div>

                        <div id="deliverycharges" class="p-2">
                            <div class="row">
                                <div class="col-6 text-left desc">
                                    Delivery Fee
                                </div>
                                <div class="col-6 text-right price">
                                    Rs. 100.00
                                </div>
                            </div>
                        </div>

                        <div id="grandtotal" class="p-2">
                            <div class="row">
                                <div class="col-6 text-left desc">
                                    Grand Total
                                </div>
                                <div class="col-6 text-right price">
                                    Rs. 1775.00
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-info btn-lg btn-block mt-2 mb-2 text-white"  style="background: #16ADD6;"><i class="fas fa-shopping-bag"></i> &nbsp; CHECK OUT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>