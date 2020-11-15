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
                    <label class="input-group-text" for="fishtype"
                      ><i class="fas fa-fish"></i> &nbsp; Fish Type</label
                    >
                  </div>
                  <select
                    class="custom-select"
                    id="fishtype"
                    v-model="item.name"
                    @change="setQuantities"
                  >
                    <option
                      v-for="(farmProduct, index) in farmProducts"
                      :key="index"
                      :value="farmProduct.product.name"
                    >
                      {{
                        farmProduct.product.name +
                        " (Rs. " +
                        farmProduct.unit_price +
                        "/Kg) "
                      }}
                    </option>
                  </select>
                </div>

                <div class="input-group">
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="orderquantity"
                      ><i class="fas fa-weight-hanging"></i> &nbsp; &nbsp;
                      Quantity</label
                    >
                  </div>
                  <select
                    class="custom-select"
                    id="fishtype"
                    v-model="item.quantity"
                  >
                    <option
                      v-for="(quantity, index) in quantities"
                      :key="index"
                      :value="quantity"
                    >
                      {{ quantity }} Kg
                    </option>
                  </select>
                </div>

                <div class="text-right">
                  <button
                    class="btn mt-2"
                    style="background: #16add6"
                    @click="addToCart"
                    :disabled="buttons.addToCart.disabled"
                  >
                    <i class="fas fa-shopping-basket text-white"></i>
                    <span class="pl-2">{{ buttons.addToCart.text }}</span>
                  </button>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div id="orderSummary">
                <h4>Order Summary</h4>
                <div v-if="authenticated" id="order_items" class="mb-3">
                  <div
                    v-for="(cartItem, index) in cart_items"
                    :key="index"
                    class="row order_item"
                  >
                    <div class="col-3 desc align-self-center">
                      {{ cartItem.farm_product.product.name }}
                    </div>
                    <div class="col-3 quantity align-self-center">
                      <select v-model="cartItem.quantity" @change="updateQuantity(cartItem)">
                        <option :value="product_quantity" v-for="product_quantity in productQuantities(cartItem.farm_product.minimum_order_quantity, cartItem.farm_product.maximum_order_quantity)">{{ product_quantity }}</option>
                      </select>
                      {{
                       
                        " * " +
                        cartItem.farm_product.unit_price
                      }}
                    </div>
                    <div class="col-3 price align-self-center">
                      {{
                        "RS ." +
                        cartItem.quantity * cartItem.farm_product.unit_price
                      }}
                    </div>
                    <div class="col-3 remove align-self-center">
                      <button class="btn btn-danger btn-sm float-right mb-1" @click="removeFromCart(cartItem.id)">{{ buttons.removeFromCart.text }}</button>
                    </div>
                  </div>
                </div>
                <div v-else id="order_items" class="mb-3">
                  <div
                    v-for="(session_item, index) in session_items"
                    :key="index"
                    class="row order_item"
                  >
                    <div class="col-3 desc align-self-center">
                      {{ session_item.farm_product.product.name }}
                    </div>
                    <div class="col-3 quantity align-self-center">
                      <select v-model="session_item.quantity" @change="updateQuantity(session_item)">
                        <option :value="product_quantity" v-for="product_quantity in productQuantities(session_item.farm_product.minimum_order_quantity, session_item.farm_product.maximum_order_quantity)">{{ product_quantity }}</option>
                      </select>
                      {{
                        " * " +
                        session_item.farm_product.unit_price
                      }}
                    </div>
                    <div class="col-3 price align-self-center">
                      {{
                        "RS ." +
                        session_item.quantity *
                          session_item.farm_product.unit_price
                      }}
                    </div>
                    <div class="col-3 remove align-self-center">
                      <button class="btn btn-danger btn-sm float-right mb-1" @click="removeFromCart(session_item.farm_product.id)">{{ buttons.removeFromCart.text }}</button>
                    </div>
                  </div>
                </div>
                <div id="cartTotal" class="p-2">
                  <div class="row">
                    <div class="col-6 text-left desc">Cart Total</div>
                    <div class="col-6 text-right price">
                      Rs. {{ cartTotal }}
                    </div>
                  </div>
                </div>

                <div
                  class="my-3 text-danger text-center"
                  v-if="cartEmptyMessage"
                >
                  {{ cartEmptyMessage }}
                </div>
                <button
                  @click="checkout"
                  class="btn btn-info btn-lg btn-block mt-2 mb-2 text-white"
                  style="background: #16add6"
                >
                  <i class="fas fa-shopping-bag"></i> &nbsp; CHECK OUT
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="proceed_checkout" class="container py-3">
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <label class="input-group-text" for="saved_addresses"
                  ><i class="fas fa-save"></i> &nbsp; Saved
                  Addresses</label
                >
              </div>
              <select
                class="custom-select"
                id="saved_addresses"
                v-model="order.address_id"
              >
                <option
                  v-for="(address, index) in addresses"
                  :key="index"
                  :value="address.id"
                >
                  {{ address.complete_address }}
                </option>
              </select>
            </div>
            <div class="invalid-feedback d-block" v-if="orderErrors['order.address_id']">{{ orderErrors['order.address_id'][0] }}</div>
          </div>
          <div class="col-md-6">
            <button class="btn btn-primary" @click="addNewAddress">
              <i class="fas fa-plus"></i> Add New Address
            </button>
          </div>
        </div>
        <div v-if="add_new_address" class="mb-3">
          <div class="row">
            <div class="col-md-6">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="region"
                    ><i class="fas fa-map-marked"></i> &nbsp; Region</label
                  >
                </div>
                <select
                  class="custom-select"
                  id="region"
                  v-model="address.region"
                  @change="setCities"
                >
                  <option
                    v-for="(region, index) in regions"
                    :key="index"
                    :value="region.id"
                  >
                    {{ region.name }}
                  </option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="city"
                    ><i class="fas fa-city"></i> &nbsp; City</label
                  >
                </div>
                <select class="custom-select" id="city" v-model="address.city">
                  <option
                    v-for="(city, index) in cities"
                    :key="index"
                    :value="city.id"
                  >
                    {{ city.name }}
                  </option>
                </select>
              </div>
              <div class="invalid-feedback d-block" v-if="orderErrors['address.city']">{{ orderErrors['address.city'][0] }}</div>
            </div>
            <div class="col-md-12">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="complete_address"
                    ><i class="fas fa-map-marker-alt"></i> &nbsp; Complete
                    Address</label
                  >
                </div>
                <input
                  type="text"
                  list="complete_address"
                  class="form-control"
                  placeholder="E.g :- Office S09 2nd floor, Goldpoint Mall Waris Khan, Rawalpindi"
                  v-model="address.complete_address"
                />
                <datalist id="complete_address">
                  <option
                    v-for="(address, index) in addresses"
                    :key="index"
                    :value="address.complete_address"
                  ></option>
                </datalist>
              </div>
              <div class="invalid-feedback d-block" v-if="orderErrors['address.complete_address']">{{ orderErrors['address.complete_address'][0] }}</div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div class="row">
            <div class="col-md-6">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="city"
                    ><i class="fas fa-user-tie"></i> &nbsp; Receiver's
                    Name</label
                  >
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
                  <label class="input-group-text" for="city"
                    ><i class="fas fa-phone"></i> &nbsp; Receiver's Mobile</label
                  >
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
        <div class="mb-3">
          <div class="row">
            <div class="col-md-6">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="processing_options"
                    ><i class="fas fa-box-open"></i> &nbsp; Processing Options</label
                  >
                </div>
                <select
                  class="custom-select"
                  id="processing_options"
                  v-model="order.processing_option"
                >
                  <option
                    v-for="(processing_option, index) in processing_options"
                    :key="index"
                    :value="processing_option.text"
                  >
                    {{ processing_option.text }}
                  </option>
                </select>
              </div>
              <div class="invalid-feedback d-block" v-if="orderErrors['order.processing_option']">{{ orderErrors['order.processing_option'][0] }}</div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label class="font-weight-bold">Further Instructions</label>
          <textarea
            class="form-control"
            placeholder="You can add additional instructions here ..."
            v-model="order.further_instructions"
          ></textarea>
        </div>

        <div class="mb-3">
          <button class="btn btn-primary float-right" @click="placeOrder" :disabled="buttons.order.disabled">
            <i class="fas fa-hand-holding-usd"></i> {{ buttons.order.text }}
          </button>
          
        </div>
      </div>
      <!-- Modal -->
      <div
        class="modal fade"
        id="signupOrlogin"
        tabindex="-1"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title font-weight-bold">Login</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                Sign In If you Already have an account.
              </h5>
              <div class="d-flex justify-content-center">
                <router-link class="btn btn-primary mr-3" to="signin"
                  ><span @click="showModal">Sign In</span></router-link
                >
                <router-link class="btn btn-success mr-3" to="signup"
                  ><span @click="showModal">Sign Up</span></router-link
                >
              </div>
            </div>
          </div>
        </div>
      </div>

      <transition
        enter-active-class="animate__animated animate__slideInRight"
        leave-active-class="animate__animated animate__slideOutRight"
      >
        <modal v-show="displayModal" @stopEditing="hideModal"></modal>
      </transition>
    </section>
  </div>
</template>

<script>
export default {
  props: {
    farmProducts: Array,
    cartItems: Array,
    sessionItems: Array,
    authenticated: Number,
    regions: Array,
  },
  data() {
    return {
      quantities: [],
      cart_items: [],
      session_items: [],
      item: {
        name: "Pangasius Fish",
        quantity: "",
      },

      cartTotal: 0,

      buttons: {
        addToCart: {
          text: "Add to Cart",
          disabled: false,
        },
        removeFromCart:{
          text: "Remove",
        },
        order: {
          text: "Place Order",
          disabled: false
        }
      },

      displayModal: false,
      cartEmptyMessage: "",
      proceed_checkout: false,
      displayProcessingOptions: false,
      address: {
        region: 2,
        city: 5,
        complete_address: "",
      },
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
      order: {
        receiver: {
          name: "",
          mobile: "",
        },
        address_id: "",
        processing_option: "",
        further_instructions: "",
      },
      orderErrors: {},
      addresses: [],
      cities: [],

      add_new_address: false
    };
  },
  created() {
    this.setCartItems();
    this.setSessionItems();
    this.setQuantities();
    this.setCartTotal();
  },
  methods: {
    setReceiver() {
      axios
        .get("setReceiver")
        .then((response) => {
          if (response.status == 200) {
            console.log(response.data);
            this.order.receiver.name = response.data.name;
            this.order.receiver.mobile = response.data.mobile;
          } else {
            console.warn(response.data);
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
    addNewAddress() {
      this.add_new_address = true;
      // set cities at add new address button
      this.setCities();
    },
    setCartItems() {
      this.cart_items = this.cartItems;
    },
    setSessionItems() {
      this.session_items = this.sessionItems;
    },
    productQuantities (min, max) {
      let quantities = [];
      for (let index = min; index <= max; index++) {
        quantities.push(index);
      }
      return quantities;
    },
    setQuantities() {
      var minimum = "";
      var maximum = "";
      var quantity_added = 0;
      if (this.authenticated) {
        var quantity_added = this.sumQuantities(this.cartItems);
      } else {
        var quantity_added = this.sumQuantities(this.sessionItems);
      }
      this.farmProducts.forEach((farmProduct) => {
        if (farmProduct.product.name == this.item.name) {
          minimum = farmProduct.minimum_order_quantity - quantity_added;
          if (farmProduct.minimum_order_quantity <= quantity_added) {
             minimum = 1;
          }
          maximum = farmProduct.maximum_order_quantity - quantity_added;
        }
      });
      this.quantities = [];
      for (let index = minimum; index <= maximum; index++) {
        this.quantities.push(index);
      }
      // to set default
      this.item.quantity = minimum;
    },
    sumQuantities(items, quantity_added = 0) {
      items.forEach((item) => {
        if (item.farm_product.product.name == this.item.name) {
          quantity_added += item.quantity;
        }
      });
      return quantity_added;
    },
    doCartTotal(items) {
      items.forEach((item) => {
        let total = item.farm_product.unit_price * item.quantity;
        this.cartTotal += total;
      });
    },
    setCartTotal() {
      this.cartTotal = 0;
      if (this.authenticated) {
        this.doCartTotal(this.cartItems);
      } else {
        this.doCartTotal(this.sessionItems);
      }
    },
    addToCart() {
      this.buttons.addToCart.text = "Adding...";
      this.buttons.addToCart.disable = true;
      let farm_product_id = 0;
      this.farmProducts.forEach((farmProduct) => {
        if (farmProduct.product.name == this.item.name) {
          farm_product_id = farmProduct.id;
        }
      });

      let cartItem = {
        farm_product_id: farm_product_id,
        quantity: this.item.quantity,
      };

      axios
        .post("/cartItem", {
          cartItem: cartItem,
        })
        .then((response) => {
          this.buttons.addToCart.text = "Add to Cart";
          this.buttons.addToCart.disable = false;
          if (response.status == 200) {
            this.cartEmptyMessage = "";
            // authenticated user
            if (this.authenticated) {
              this.updateOrderSummary(this.cartItems, response.data);
              this.setCartItems();
            } else {
              let session_item = {
                farm_product: response.data[0],
                quantity: response.data[1],
              };
              this.updateOrderSummary(this.sessionItems, session_item);
              this.setSessionItems();
            }

            this.setQuantities();
            this.setCartTotal();
          } else {
            console.warn(response.data);
          }
        })
        .catch((error) => {
          // console.error(error);
        });
    },
    updateQuantity(cartItem){
      this.setQuantities();
      this.setCartTotal();
      axios.put("/cartItem", {
          cartItem: cartItem,
        }).then((response) => {
          console.log(response.data);
        }).catch((error) => {
          console.error(error);
        });
    },
    removeFromCart(id){
      this.buttons.removeFromCart.disable = true;
      console.log(id);
      axios.delete('cartItem/' + id).then((response) => {
        if (response.status == 200) {
          console.log(response.data);
          if (this.authenticated) {
            this.cartItems.forEach((item , index, object) => {
              if (item.id == id) {
                object.splice(index, 1);
              }
            });
            this.setCartItems();
          } else {
            this.sessionItems.forEach((item , index, object) => {
              if (item.farm_product.id == id) {
                object.splice(index, 1);
              }
            });
            this.setSessionItems();
          }
          this.setQuantities();
          this.setCartTotal();
        } else {
          console.warn(response.data);
        }
      }).catch((error) => {
        console.error(error);
      });
    },
    updateOrderSummary(items, new_item, already_exist = false) {
      items.forEach((item) => {
        // update quantity of already exist item
        if (
          item.farm_product.product.name == new_item.farm_product.product.name
        ) {
          item.quantity = new_item.quantity;
          already_exist = true;
        }
      });
      // if new product item added
      if (!already_exist) {
        items.push(new_item);
      }
    },
    checkout() {
      if (this.cartItems.length > 0 || this.sessionItems.length > 0) {
        if (this.authenticated) {
          this.proceed_checkout = true;
          this.setSavedAddresses();
          this.setReceiver();
        } else {
          $("#signupOrlogin").modal("show");
        }
      } else {
        this.cartEmptyMessage = "Please add something in Cart.";
      }
    },
    hideModal() {
      this.displayModal = false;
    },
    showModal() {
      this.displayModal = true;
      $("#signupOrlogin").modal("hide");
    },
    setCities() {
      axios
        .get("setCities/" + this.address.region)
        .then((response) => {
          if (response.status == 200) {
            this.cities = response.data;
          } else {
            console.warn(response.data);
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
    setSavedAddresses() {
      axios
        .get("setSavedAddresses")
        .then((response) => {
          if (response.status == 200) {
            console.log(response.data);
            this.addresses = response.data;
          } else {
            console.warn(response.data);
          }
        })
        .catch((error) => {
          console.error(error);
        });
    },
    placeOrder() {
      this.orderErrors = {};
      this.buttons.order.text = "Processing Order...";
      this.buttons.order.disabled = true;

      if (this.address.complete_address) {
        var data = {
          address: this.address,
          order: this.order,
        };
      } else {
        var data = {
          order: this.order,
        };
      }
      axios
        .post("placeOrder", data)
        .then((response) => {
          this.buttons.order.text = "Place Order";
          this.buttons.order.disabled = false;
          if (response.status == 200) {
            console.log(response.data);
            swal({
              title: "Order Placed!",
              text: response.data.message,
              icon: "success",
              buttons: false,
              timer: 3000
            });
            // resets
            this.proceed_checkout = false;
            this.cartItems = [];
            this.setCartItems();
            this.setQuantities();
            this.setCartTotal();
          } else {
            console.warn(response.data);
          }
        })
        .catch((error) => {
          this.buttons.order.text = "Place Order";
          this.buttons.order.disabled = false;
          console.log(error.response.data);
          this.orderErrors = error.response.data.errors;
          swal({
              title: "Some Thing Wrong!",
              text: error.response.data.message,
              icon: "error",
              buttons: false,
              timer: 3000
            });
          console.error(error);
        });
    }
  }
};
</script>

<style>
</style>