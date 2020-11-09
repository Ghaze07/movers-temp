<template>
    <div>
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
                                    <select class="custom-select" id="fishtype" v-model="item.name" @change="setQuantities">
                                        <option v-for="(farmProduct, index) in farmProducts" :key="index" :value="farmProduct.product.name">{{ farmProduct.product.name + ' (Rs. ' + farmProduct.unit_price + '/Kg) ' }}</option>
                                    </select>
                                </div>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="orderquantity"><i class="fas fa-weight-hanging"></i> &nbsp; &nbsp; Quantity</label>
                                    </div>
                                    <select class="custom-select" id="fishtype" v-model="item.quantity">
                                            <option v-for="(quantity, index) in quantities" :key="index" :value="quantity">{{ quantity }} Kg</option>
                                    </select>
                                </div>

                                <div class="text-right">
                                    <button class="btn mt-2" style="background: #16ADD6;" @click="addToCart" :disabled="buttons.addToCart.disable"><i class="fas fa-shopping-basket text-white"></i> <span class="pl-2">{{ buttons.addToCart.text }}</span></button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div id="orderSummary">
                                <h4>Order Summary</h4>
                                <div v-if="authenticated" id="order_items" class="mb-3">
                                    <div v-for="(cartItem, index) in cart_items" :key="index" class="row order_item">
                                        <div class="col-4 desc">
                                            {{ cartItem.farm_product.product.name }}
                                        </div>
                                        <div class="col-4 quantity">
                                            {{cartItem.quantity + ' * ' + cartItem.farm_product.unit_price }} 
                                        </div>
                                        <div class="col-4 price">
                                            {{ 'RS .' + cartItem.quantity * cartItem.farm_product.unit_price }}
                                        </div>
                                    </div>
                                    
                                </div>
                                <div v-else id="order_items" class="mb-3">
                                    <div v-for="(session_item, index) in session_items" :key="index"  class="row order_item">
                                        <div class="col-4 desc">
                                            {{ session_item.farm_product.product.name }}
                                        </div>
                                        <div class="col-4 quantity">
                                            {{ session_item.quantity + ' * ' + session_item.farm_product.unit_price }} 
                                        </div>
                                        <div class="col-4 price">
                                            {{ 'RS .' + session_item.quantity * session_item.farm_product.unit_price }}
                                        </div>
                                    </div>
                                </div>

                                <!-- <div id="subtotal" class="p-2">
                                    <div class="row">
                                        <div class="col-6 text-left desc">
                                            Subtotal
                                        </div>
                                        <div class="col-6 text-right price">
                                            Rs. {{ subTotal }}
                                        </div>
                                    </div>
                                </div>

                                <div id="balance" class="p-2">
                                    <div class="row">
                                        <div class="col-6 text-left desc">
                                            First Order Discount
                                        </div>
                                        <div class="col-6 text-right price">
                                            Rs. {{ firstOrderDiscount }}
                                        </div>
                                    </div>
                                </div>

                                <div id="deliverycharges" class="p-2">
                                    <div class="row">
                                        <div class="col-6 text-left desc">
                                            Delivery Fee
                                        </div>
                                        <div class="col-6 text-right price">
                                            Rs. {{ deliveryFee }}
                                        </div>
                                    </div>
                                </div> -->

                                <div id="grandtotal" class="p-2">
                                    <div class="row">
                                        <div class="col-6 text-left desc">
                                            Grand Total
                                        </div>
                                        <div class="col-6 text-right price">
                                            Rs. {{ grandTotal }}
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
    </div>
</template>

<script>
export default {
    props:{
        farmProducts: Array,
        cartItems : Array,
        sessionItems :Array,
        authenticated : Number
    },
    data() {
        return {
            quantities: [],
            cart_items: [],
            session_items: [],
            item:{
                name: 'Pangasius Fish',
                quantity: ''
            },

            subTotal: 0,
            firstOrderDiscount: 0,
            deliveryFee: 0,
            grandTotal: 0,

            buttons: {
                addToCart: {
                    text: 'Add to Cart',
                    disable: false
                }
            }
        }
    },
    created () {
        this.setCartItems();
        this.setSessionItems();
        this.setQuantities();
        this.setSubTotal();
        this.setGrandTotal();
    },
  
    methods: {
        setCartItems () {
            this.cart_items = this.cartItems;
        },
        setSessionItems () {
            this.session_items = this.sessionItems;
        },
        setQuantities () {
            var minimum = '';
            var maximum = '';
            
            if (this.authenticated) {
                var quantity_added = this.sumQuantities(this.cartItems);
            } else {
                var quantity_added = this.sumQuantities(this.sessionItems);
            }
            this.farmProducts.forEach(farmProduct => {
                if ( farmProduct.product.name == this.item.name ) {
                    minimum = farmProduct.minimum_order_quantity;
                    maximum = farmProduct.maximum_order_quantity - quantity_added;
                }
            });
            this.quantities = [];
            for ( let index = minimum; index <= maximum; index++ ) {
                this.quantities.push(index);
            }
            // to set default
            this.item.quantity = minimum;
        },
        sumQuantities (items, quantity_added = 0) {
            items.forEach(item => {
                if (item.farm_product.product.name == this.item.name) {
                    quantity_added += item.quantity;
                }
            });
            return quantity_added;
        },
        setSubTotal(){
            this.subTotal = 0;
            
            if (this.authenticated) {
                this.doSubtotal(this.cartItems);
            } else {
                this.doSubtotal(this.sessionItems);
            }
        },
        doSubtotal (items) {
            items.forEach(item => {
                let total = item.farm_product.unit_price * item.quantity;
                this.subTotal += total;
            });
        },
        setGrandTotal() {
            this.grandTotal = this.subTotal + this.firstOrderDiscount + this.deliveryFee;
        },

        addToCart () {
            this.buttons.addToCart.text = 'Adding...';
            this.buttons.addToCart.disable = true;
            let farm_product_id = 0;
            this.farmProducts.forEach(farmProduct => {
                if (farmProduct.product.name == this.item.name) {
                    farm_product_id = farmProduct.id;
                }
            });

            let cartItem = {
                farm_product_id: farm_product_id,
                quantity: this.item.quantity
            }

            axios.post('/cartItem', {
                cartItem: cartItem
            }).then((response) => {
                this.buttons.addToCart.text = 'Add to Cart';
                this.buttons.addToCart.disable = false;
                if (response.status == 200) {
                    // authenticated user
                    if (this.authenticated) {
                        this.updateOrder(this.cartItems, response.data);
                        this.setCartItems();
                    } else {
                        let session_item = {
                            farm_product: response.data[0],
                            quantity: response.data[1]
                        };
                        this.updateOrder(this.sessionItems, session_item);
                        this.setSessionItems();
                    }
                    
                    this.setQuantities();
                    this.setSubTotal();
                    this.setGrandTotal();
                } else {
                    console.log(response.data);
                }
            }).catch((error) => {
                console.log(error);
            });
        },
        updateOrder (items, new_item, already_exist = false) {
            items.forEach(item => {
                // update quantity of already exist item
                if (item.farm_product.product.name == new_item.farm_product.product.name) {
                    item.quantity = new_item.quantity;
                    already_exist = true;
                }
            });
            // if new product item added
            if (!already_exist) {
                items.push(new_item);
            }
        }
    }
}
</script>

<style>
    
</style>