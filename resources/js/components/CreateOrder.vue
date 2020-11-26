<template>
    <div>
        <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createOrder">Create</button>
              <!-- Modal -->
            <div class="modal fade" id="createOrder" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Create Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="users">Users</label>
                                        </div>
                                        <select class="custom-select" id="users" v-model="order.user_id" @change="showAddresses">
                                            <option v-for="(user, index) in users_data" :key="index" :value="user.id">{{ user.name +'( '+ user.email +' )' }}</option>
                                        </select>
                                      </div>
                                      <div class="invalid-feedback d-block" v-if="addressErrors['address.user_id']">{{ addressErrors['address.user_id'][0] }}</div>
                                      <div class="invalid-feedback d-block" v-if="orderErrors['order.user_id']">{{ orderErrors['order.user_id'][0] }}</div>
                                </div>

                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary" @click="showUserInputs">Create New User</button>
                                </div>
                            </div>

                            <div class="row" v-if="show_user_inputs">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="name"><i class="fas fa-user"></i></label>
                                        </div>
                                        <input type="text" class="form-control" id="name" placeholder="Your Full Name" v-model="user.name">
                                    </div>
                                    <div class="invalid-feedback d-block" v-if="userErrors['user.name']">{{ userErrors['user.name'][0] }}</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="email"><i class="fas fa-at"></i></label>
                                        </div>
                                        <input type="email" class="form-control" id="email" placeholder="Your Email Address" v-model="user.email">
                                    </div>
                                     <div class="invalid-feedback d-block" v-if="userErrors['user.email']">{{ userErrors['user.email'][0] }}</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="mobile">+92</label>
                                        </div>
                                        <input type="number" class="form-control" id="mobile" placeholder="3xxxxxxxxx" v-model="user.mobile">
                                    </div>
                                    <div class="invalid-feedback d-block" v-if="userErrors['user.mobile']">{{ userErrors['user.mobile'][0] }}</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end" v-if="show_user_inputs">
                                <button class="btn btn-success btn-sm mb-3" @click="createUser" :disabled="buttons.createUser.disabled">{{ buttons.createUser.text }}</button>
                            </div>

                            <div class="row" v-if="show_addresses">
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="saved_addresses"><i class="fas fa-map-marked-alt"></i>Saved Addresses</label>
                                        </div>
                                        <select class="custom-select" id="saved_addresses" v-model="order.address_id" @change="showFarms">
                                            <option v-for="(address, index) in addresses" :key="index" :value="address.id">{{ address.complete_address }}</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback d-block" v-if="orderErrors['order.address_id']">{{ orderErrors['order.address_id'][0] }}</div>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-success" @click="showNewAddressInputs">Add New Address</button>
                                </div>
                            </div> 

                            <div class="row" v-if="show_new_address_inputs">   
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="regions"><i class="fas fa-map-marked-alt"></i>Region</label>
                                        </div>
                                        <select class="custom-select" id="regions" v-model="address.region_id" @change="getCities(address.region_id)">
                                            <option v-for="(region, index) in regions" :key="index" :value="region.id">{{ region.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="cities"><i class="fas fa-city"></i>City</label>
                                        </div>
                                        <select class="custom-select" id="cities" v-model="address.city_id">
                                            <option v-for="(city, index) in cities" :key="index" :value="city.id">{{ city.name }}</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback d-block" v-if="addressErrors['address.city']">{{ addressErrors['address.city'][0] }}</div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="complete_address"><i class="fas fa-map-marker-alt"></i>Complete Address</label>
                                        </div>
                                        <input type="text" class="form-control" id="complete_address" v-model="address.complete_address" placeholder="Complete Address">
                                    </div>
                                    <div class="invalid-feedback d-block" v-if="addressErrors['address.complete_address']">{{ addressErrors['address.complete_address'][0] }}</div>
                                </div>
                            </div>

                            
                            <div class="d-flex justify-content-end" v-if="show_new_address_inputs">
                                <button class="btn btn-success btn-sm mb-3" @click="createAddress" :disabled="buttons.createAddress.disabled">{{ buttons.createAddress.text }}</button>
                            </div>

                            <div class="row" v-if="show_farms">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="regions"><i class="fas fa-map-marked-alt"></i>Farm</label>
                                        </div>
                                        <select class="custom-select" id="regions" v-model="order.farm_id" @change="getFarmProducts">
                                            <option v-for="(farm, index) in farms" :key="index" :value="farm.id">{{ farm.name }}</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback d-block" v-if="orderErrors['order.farm_id']">{{ orderErrors['order.farm_id'][0] }}</div>
                                </div>
                            </div>
                            <div class="row" v-if="show_farm_products">
                                <div class="col-md-5">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="regions"><i class="fas fa-map-marked-alt"></i>Farm Product</label>
                                        </div>
                                        <select class="custom-select" id="regions" v-model="cart_item.farm_product_id" @change="setQuantities">
                                            <option v-for="(farmProduct, index) in farmProducts" :key="index" :value="farmProduct.id">{{ farmProduct.product.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="regions"><i class="fas fa-map-marked-alt"></i>Quantity</label>
                                        </div>
                                        <select class="custom-select" id="regions" v-model="cart_item.quantity">
                                            <option v-for="(quantity, index) in quantities" :key="index" :value="quantity">{{ quantity+ ' KG' }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-success" @click="addToCart" :disabled="buttons.addToCart.disabled">{{ buttons.addToCart.text }}</button>
                                     
                                </div>
                            </div>

                            <div class="container-fluid border border-warning rounded py-3 mb-3" v-if="cart_items.length > 0">
                                <div class="row" v-for="(cart_item, index) in cart_items" :key="index">
                                    <div class="col-3 product-name">
                                        {{ cart_item.farm_product.product.name }}
                                    </div>
                                    <div class="col-3 quantity">
                                        {{cart_item.quantity + ' * ' + cart_item.farm_product.unit_price }}
                                    </div>
                                    <div class="col-3 sub-total">
                                        {{cart_item.farm_product.unit_price * cart_item.quantity}}
                                    </div>
                                    <div class="col-3 action">
                                        <button class="btn btn-danger btn-sm" @click="removeFromCart(cart_item.id)">Remove</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row" v-if="cart_items.length > 0">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-success float-right mb-3" @click="checkOut">Check Out</button>
                                </div>
                            </div>
                            <div class="mb-3" v-if="show_receiver">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fas fa-user-tie"></i> &nbsp; Receiver's Name</label>
                                        </div>
                                        <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Receiver's Name"
                                        v-model="order.receiver.name"
                                        />
                                    </div>
                                    <div class="invalid-feedback d-block" v-if="orderErrors['order.receiver.name']">{{ orderErrors['order.receiver.name'][0] }}</div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                        <label class="input-group-text"><i class="fas fa-phone"></i> &nbsp; Receiver's Mobile</label>
                                        </div>
                                        <input
                                        type="number"
                                        class="form-control"
                                        placeholder="Receiver's Mobile"
                                        v-model="order.receiver.mobile"
                                        />
                                    </div>
                                    <div class="invalid-feedback d-block" v-if="orderErrors['order.receiver.mobile']">{{ orderErrors['order.receiver.mobile'][0] }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="show_processing_options">
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <label class="input-group-text" for="processing_option"><i class="fas fa-map-marked-alt"></i>Processing Options</label>
                                        </div>
                                        <select class="custom-select" id="processing_option" v-model="order.processing_option">
                                            <option v-for="(processing_option, index) in processing_options" :key="index" :value="processing_option.text">{{ processing_option.text }}</option>
                                        </select>
                                    </div>
                                    <div class="invalid-feedback d-block" v-if="orderErrors['order.processing_option']">{{ orderErrors['order.processing_option'][0] }}</div>
                                </div>
                            </div>

                            <div class="row" v-if="show_further_instructions">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="further_instructions">Further Instructions</label>
                                        <textarea class="form-control" id="further_instructions" rows="3" v-model="order.further_instructions" placeholder="You can add additional instructions here ..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-if="show_place_order">
                                <div class="col-md-12">
                                     <button type="button" class="btn btn-success float-right" @click="adminCreateOrder" :disabled="buttons.placeOrder.disabled">{{ buttons.placeOrder.text }}</button>
                                </div>
                            </div>
                        </div> <!-- container-fluid -->
                    </div>
                </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    props:{
        users: Array,
        farms: Array,
        regions: Array
    },

    data() {
        return {
            // user
            show_user_inputs: false,
            users_data:[],
            user: {
                name: '',
                email: '',
                mobile: ''
            },

            // address
            show_addresses: false,
            show_new_address_inputs: false,
            cities: [],
            addresses: [],
            address: {
                user_id: '',
                region_id: 2,
                city_id: 5,
                complete_address: ''
            },

            // farm
            show_farms: false,
            show_farm_products: false,
            farmProducts: [],
            quantities:[],

            // cart
            cart_item: {
                farm_product_id: '',
                quantity: '',
                user_id: ''
            },
            cart_items: [],

            show_receiver : false,
            show_processing_options: false,

            processing_options: [
                {
                    text: 'Simply Clean and Pack'
                },
                {
                    text: 'Clean and Deep cuts for Grill'
                },
                {
                    text: 'Clean and Make Regular Slices'
                },
            ],

            show_further_instructions: false,
            show_place_order: false,

            // order
            order: {
                user_id: '',
                farm_id: '',
                address_id: '',
                processing_option: 'Clean and Make Regular Slices',
                further_instructions: '',
                receiver: {
                    name: '',
                    mobile: ''
                }
            },


            buttons: {
                createUser: {
                    text: "Create User",
                    disabled: false,
                },
                createAddress: {
                    text: "Create Address",
                    disabled: false,
                },
                addToCart: {
                    text: "Add to Cart",
                    disabled: false,
                },
                removeFromCart:{
                    text: "Remove",
                    disabled: false,
                },
                placeOrder: {
                    text: "Place Order",
                    disabled: false
                }
            },

            userErrors: {},
            addressErrors: {},
            orderErrors: {},

            
        }
    },

    created() {
        this.setUserData();
        this.getCities(this.address.region_id);
    },

    methods: {
        resetAll(){
            this.show_user_inputs = false;
            this.user = {
                name: '',
                email: '',
                mobile: ''
            };

            // address
            this.show_addresses = false;
            this.show_new_address_inputs = false;

            // farm
            this.show_farms = false;
            this.show_farm_products = false;
            this.farmProducts = [];
            this.quantities = [];

            // cart
            this.cart_item = {
                farm_product_id: '',
                quantity: '',
                user_id: ''
            };
            this.cart_items = [];

            this.show_receiver = false;
            this.show_processing_options = false;

            this.show_further_instructions = false;
            this.show_place_order = false;

            // order
            this.order = {
                user_id: '',
                farm_id: '',
                address_id: '',
                processing_option: 'Clean and Make Regular Slices',
                further_instructions: '',
                receiver: {
                    name: '',
                    mobile: ''
                }
            };
        },
        setUserData() {
            this.users_data = this.users;
        },
        getCities(region_id) {
            axios.get('getCities/'+ region_id).then((response) => {
                if (response.status == 200) {
                    this.cities = response.data;
                } else {
                    console.warn(response.data);
                }
            }).catch((error) => {
                console.error(error);
            });
        },
        showUserInputs() {
            this.show_user_inputs = true;
        },
        showAddresses() {
            this.show_addresses = true;
            this.getAddresses();
        },
        showFarms(){
            this.show_farms = true;
        },
        showFarmProducts(){
            this.show_farm_products = true;
        },
        showNewAddressInputs() {
            this.show_new_address_inputs = true;
        },
        getAddresses() {
            axios.get('getAddresses/'+ this.order.user_id).then((response) => {
                if (response.status == 200) {
                    console.log(response.data);
                    this.addresses = response.data;
                } else {
                    console.warn(response.data);
                }
            }).catch((error) => {
                console.error(error);
            });
        },
        createUser() {
            this.buttons.createUser.text = 'Creating...';
            this.buttons.createUser.disabled = true;
            axios.post('createUser', {
                user: this.user
            }).then((response) => {
                this.buttons.createUser.text = 'Create User';
                this.buttons.createUser.disabled = false;
                if (response.status == 200) {
                    console.log(response.data);
                    this.users_data.push(response.data);
                    this.order.user_id = response.data.id;
                    this.show_user_inputs = false;
                    this.showAddresses();
                    this.showNewAddressInputs();
                } else {
                    console.warn(response.data);
                }
            }).catch((error) => {
                this.buttons.createUser.text = 'Create User';
                this.buttons.createUser.disabled = false;
                console.error(error);
                this.userErrors = error.response.data.errors;
            });
        },
        createAddress() {
            this.buttons.createAddress.text = 'Creating...';
            this.buttons.createAddress.disabled = true;
            this.address.user_id = this.order.user_id;
            axios.post('createAddress', {
                address: this.address
            }).then((response) => {
                this.buttons.createAddress.text = 'Create Address';
                this.buttons.createAddress.disabled = false;
                if (response.status == 200) {
                    console.log(response.data);
                    this.addresses.push(response.data);
                    this.order.address_id = response.data.id;
                    this.show_new_address_inputs = false;
                    this.showFarms();
                } else {
                    console.warn(response.data);
                }
            }).catch((error) => {
                this.buttons.createAddress.text = 'Create Address';
                this.buttons.createAddress.disabled = false;
                console.error(error);
                this.addressErrors = error.response.data.errors;
            });
        },

        getFarmProducts() {
            axios.get('getFarmProducts/'+ this.order.farm_id).then((response) => {
                if (response.status == 200) {
                    console.log(response.data);
                    this.farmProducts = response.data;
                    this.showFarmProducts();

                    // setting farms default product first product
                    this.cart_item.farm_product_id = this.farmProducts[0].id;
                    this.setQuantities();

                    // setting product default quantity first quantity
                    this.cart_item.quantity = this.quantities[0];

                    
                } else {
                    console.warn(response.data);
                }
            }).catch((error) => {
                console.error(error);
            });
            this.getCartItems();
            
        },

        getCartItems () {
            axios.get('getCartItems/'+ this.order.user_id).then((response) => {
                if (response.status == 200) {
                    console.log(response.data);
                    this.cart_items = response.data;
                    if (this.cart_items.length > 0) {
                        this.buttons.addToCart.text = 'Update Cart';
                    } else {
                        this.buttons.addToCart.text = 'Add to Cart';
                    }
                } else {
                    console.warn(response.data);
                }
            }).catch((error) => {
                console.error(error);
            });
        },

        setQuantities() {
            var minimum = "";
            var maximum = "";
            this.quantities = [];
            this.farmProducts.forEach((farmProduct) => {
                if (farmProduct.id == this.cart_item.farm_product_id) {
                    minimum = farmProduct.minimum_order_quantity;
                    maximum = farmProduct.maximum_order_quantity;
                }
            });
            for (let index = minimum; index <= maximum; index++) {
                this.quantities.push(index);
            }
        },

        addToCart() {
            if (this.cart_items.length > 0) {
                this.buttons.addToCart.text = 'Updating...';
            } else {
                this.buttons.addToCart.text = 'Adding...';
            }
            
            this.buttons.addToCart.disabled = true;
            this.cart_item.user_id = this.order.user_id;
            axios.post('addToCart', {
                cart_item: this.cart_item
            }).then((response) => {
                this.buttons.addToCart.disabled = false;
                if (response.status == 200) {
                    console.log(response.data);
                    this.cart_items = response.data;
                    if (this.cart_items.length > 0) {
                        this.buttons.addToCart.text = 'Update Cart';
                    } else {
                        this.buttons.addToCart.text = 'Add to Cart';
                    }
                } else {
                    console.warn(response.data);
                }
            }).catch((error) => {
                if (this.cart_items.length > 0) {
                    this.buttons.addToCart.text = 'Update Cart';
                } else {
                    this.buttons.addToCart.text = 'Add to Cart';
                }
                this.buttons.addToCart.disabled = false;
                console.error(error);
            });
        },
        removeFromCart (cart_item_id) {
            axios.delete('removeFromCart/'+ cart_item_id).then((response) => {
                if (response.status == 200) {
                    console.log(response.data);
                    this.cart_items = this.cart_items.filter(function (cart_item) {
                        return cart_item.id !== cart_item_id;
                    });

                    if (this.cart_items.length > 0) {
                        this.buttons.addToCart.text = 'Update Cart';
                    } else {
                        this.buttons.addToCart.text = 'Add to Cart';
                    }
                } else {
                    console.warn(response.data);
                }
            }).catch((error) => {
                console.error(error);
            });
        },
        checkOut () {
            this.show_receiver = true;
            this.show_processing_options = true;
            this.show_further_instructions = true;
            this.show_place_order = true;
            this.users.forEach((user) => {
                if (user.id == this.order.user_id) {
                    this.order.receiver.name = user.name;
                    this.order.receiver.mobile = user.mobile;
                }
            });
        },
        adminCreateOrder () {
            this.buttons.placeOrder.text = 'Placing...';
            this.buttons.placeOrder.disabled = true;
            axios.post('adminCreateOrder', {
                order: this.order
            }).then((response) => {
                this.buttons.placeOrder.text = 'Place Order';
                this.buttons.placeOrder.disabled = false;
                if (response.status == 200) {
                    console.log(response.data);
                    $('#createOrder').modal('hide');
                    this.resetAll();
                    swal({
                        title: "Order Placed!",
                        text: response.data.message,
                        icon: "success",
                        buttons: false,
                        timer: 3000
                    });
                    location.reload();
                } else {
                    console.warn(response.data);
                }
            }).catch((error) => {
                this.buttons.placeOrder.text = 'Place Order';
                this.buttons.placeOrder.disabled = false;
                console.error(error);
                this.orderErrors = error.response.data.errors;
                swal({
                    title: "Some Thing Wrong!",
                    text: error.response.data.message,
                    icon: "error",
                    buttons: false,
                    timer: 3000
                });
            });
        }
    },
}
</script>