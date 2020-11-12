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
                    :disabled="buttons.addToCart.disable"
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
                      {{
                        cartItem.quantity +
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
                      {{
                        session_item.quantity +
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
                    <div class="col-6 text-left desc">Grand Total</div>
                    <div class="col-6 text-right price">
                      Rs. {{ grandTotal }}
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
                  ><i class="fas fa-map-marked"></i> &nbsp; Saved
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
            </div>
            <div class="col-md-6">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="city"
                    ><i class="fas fa-phone"></i> &nbsp; Receiver's Mobile</label
                  >
                </div>
                <input
                  type="text"
                  class="form-control"
                  placeholder="Receiver's Mobile"
                  v-model="order.receiver.mobile"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <div>
            <label class="font-weight-bold">Processing Options</label>
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              v-model="order.processing_option"
              id="simple"
              value="Simply Clean and Pack"
            />
            <label class="form-check-label" for="simple"
              >Simply Clean and Pack</label
            >
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              v-model="order.processing_option"
              id="grill"
              value="Clean and Deep cuts for Grill"
            />
            <label class="form-check-label" for="grill"
              >Clean and Deep cuts for Grill</label
            >
          </div>
          <div class="form-check form-check-inline">
            <input
              class="form-check-input"
              type="radio"
              v-model="order.processing_option"
              id="slice"
              value="Clean and Make Regular Slices"
            />
            <label class="form-check-label" for="slice"
              >Clean and Make Regular Slices</label
            >
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
          <button class="btn btn-primary float-right" @click="placeOrder">
            <i class="fas fa-hand-holding-usd"></i> Place Order
          </button>
          
        </div>
      </div>
      <div class="container">
        <h3 class="text-success text-center" v-if="order_placed_message">{{ order_placed_message }}</h3>
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

      subTotal: 0,
      firstOrderDiscount: 0,
      deliveryFee: 0,
      grandTotal: 0,

      buttons: {
        addToCart: {
          text: "Add to Cart",
          disable: false,
        },
        removeFromCart:{
          text: "Remove",
          disable: false,
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
      order: {
        receiver: {
          name: "",
          mobile: "",
        },
        address_id: "",
        processing_option: "",
        further_instructions: "",
      },

      addresses: [],
      cities: [],

      add_new_address: false,
      order_placed_message: ''
    };
  },
  created() {
    this.setCartItems();
    this.setSessionItems();
    this.setQuantities();
    this.setSubTotal();
    this.setGrandTotal();
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
    setSubTotal() {
      this.subTotal = 0;

      if (this.authenticated) {
        this.doSubtotal(this.cartItems);
      } else {
        this.doSubtotal(this.sessionItems);
      }
    },
    doSubtotal(items) {
      items.forEach((item) => {
        let total = item.farm_product.unit_price * item.quantity;
        this.subTotal += total;
      });
    },
    setGrandTotal() {
      this.grandTotal =
        this.subTotal + this.firstOrderDiscount + this.deliveryFee;
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
            this.setSubTotal();
            this.setGrandTotal();
          } else {
            console.warn(response.data);
          }
        })
        .catch((error) => {
          // console.error(error);
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
            this.setSessionItems();
          } else {
            this.sessionItems.forEach((item , index, object) => {
              if (item.farm_product.id == id) {
                object.splice(index, 1);
              }
            });
            this.setSessionItems();
          }
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
          this.order_placed_message = '';
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
          if (response.status == 200) {
            console.log(response.data);
            this.order_placed_message = response.data.message;

            // resets
            this.proceed_checkout = false;
            this.cartItems = [];
            this.setCartItems();
            this.setQuantities();
          } else {
            console.warn(response.data);
          }
        })
        .catch((error) => {
          console.error(error);
        });
    }
  }
};
</script>

<style>
</style>