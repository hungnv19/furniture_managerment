<template>
  <div class="container-fluid">
    <section class="shopping-cart spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="shopping__cart__table">
              <table>
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="po in data.pos" :key="po.id">
                    <td class="product__cart__item">
                      <div class="product__cart__item__text">
                        <div class="pro-qty-2">
                          <h5>{{ po.product_name }}</h5>
                        </div>
                      </div>
                    </td>
                    <td class="quantity__item">
                      <div class="quantity">
                        <div class="pro-qty-2">
                          <h5>{{ number_format(po.product_price) }}</h5>
                        </div>
                      </div>
                    </td>
                    <td class="quantity__item">
                      <div class="quantity">
                        <div class="pro-qty-2">
                          <h5>{{ po.product_quantity }}</h5>
                          <!-- <input type="text" v-model="po.product_quantity" /> -->
                        </div>
                      </div>
                    </td>

                    <td class="cart__price">
                      {{ number_format(po.sub_total) }}
                    </td>
                    <td class="cart__close">
                      <button class="btn btn-primary">
                    <td>
                      <a @click="deleteItem(po.id)">Xóa</a>
                    </td>
                    </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div v-show="data.pos.length == 0">
                <data-empty></data-empty>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="continue__btn">
                  <a href="/">Tiếp tục mua sắm</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="cart__discount">
              <h6>Discount codes</h6>
              <form action="#">
                <input type="text" placeholder="Coupon code" />
                <button type="submit">Apply</button>
              </form>
            </div>
            <div class="">
              <VeeForm as="div" v-slot="{ handleSubmit }" class="col-12" @invalid-submit="onInvalidSubmit">
                <form method="POST" @submit="handleSubmit($event, onSubmit)" ref="formData" enctype="multipart/form-data"
                  :action="data.urlStore">
                  <Field type="hidden" :value="csrfToken" name="_token" />

                  <div class="col-md-12 summary">
                    <div class="card-footer">
                      <div class="order-md-2 mb-4">
                        <ul class="list-group mb-3">
                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                              <h6 class="my-0">Total Quantity</h6>
                            </div>
                            <span class="text-muted">{{ qty1 }}</span>
                            <Field type="hidden" v-model="qty" name="qty" />
                          </li>
                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                              <h6 class="my-0">Sub Total</h6>
                            </div>
                            <span class="text-muted">{{
                              number_format(sub_total1)
                            }}</span>
                            <Field type="hidden" v-model="sub_total" name="sub_total" />
                          </li>

                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                              <h6 class="my-0">Vat</h6>
                            </div>
                            <span class="text-muted">{{ this.data.extra.vat }}%</span>
                            <Field type="hidden" v-model="vat" name="vat" />
                          </li>
                          <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                              <h6 class="my-0">Total</h6>
                            </div>
                            <span class="text-success">{{
                              number_format(total1)
                            }}</span>
                            <Field type="hidden" v-model="total" name="total" />
                          </li>
                          <li v-if="giftCardId" class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                              <h6 class="my-0">Gift Card</h6>
                            </div>
                            <span class="text-muted">
                              - {{ number_format(total) }}</span>
                            <Field type="hidden" :value="total" name="total" />
                          </li>
                        </ul>
                        <div class="form-group">
                          <label for="exampleFormControlSelect2">Pay By</label>
                          <Field class="form-select" id="exampleFormControlSelect2" name="payBy" as="select"
                            v-model="payBy" rules="required">
                            <option value disabled selected>
                              Chose Pay By
                            </option>
                            <option value="handCash">Hand Cash</option>
                            <option value="giftCard">Gift Card</option>
                          </Field>

                          <ErrorMessage class="error" name="payBy" />
                        </div>

                        <div v-if="payBy === 'giftCard'" class="form-group">
                          <label for="exampleFormControlSelect2">Gift Card</label>
                          <Select2 @select="selectGiftCard($event)" :options="giftCardOptions"
                            placeholder="select_card" />
                          <Field type="hidden" name="gift_card_id" v-model="giftCardId" rules="required" />
                          <ErrorMessage class="error" name="gift_card_id" />
                        </div>
                        <div v-if="payBy === 'handCash'">
                          <div class="form-group">
                            <label for="exampleFormControlInput1">Pay</label>
                            <Field type="text" class="form-control" v-model="pay" rules="required|numeric" name="pay"
                              id="exampleFormControlInput1" @keyup="calculatorDue" />

                            <ErrorMessage class="error" name="pay" />
                          </div>
                          <div class="form-group">
                            <div class="d-flex justify-content-between">
                              <label for="exampleFormControlInput2">Due</label>
                              <label for="">{{
                                this.number_format(pay - this.total1)
                              }}</label>
                            </div>
                            <input type="hidden" class="form-control" v-model="due" name="due"
                              id="exampleFormControlInput2" />
                          </div>
                        </div>

                        <button class="primary-btn col-12" type="submit">
                          Đặt hàng
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </VeeForm>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import {
  Form as VeeForm,
  Field,
  ErrorMessage,
  defineRule,
  configure,
} from "vee-validate";
import { localize } from "@vee-validate/i18n";
import * as rules from "@vee-validate/rules";
import $ from "jquery";
export default {
  setup() {
    Object.keys(rules).forEach((rule) => {
      if (rule != "default") {
        defineRule(rule, rules[rule]);
      }
    });
  },
  components: {
    VeeForm,
    Field,
    ErrorMessage,
  },
  created() {
    let messError = {
      en: {
        fields: {
          qty: {
            required: "Please select at least 1 product.",
            min_value: "Please select at least 1 product.",
          },

          pay: {
            required: "The pay field is required.",
            numeric: "Please enter a number.",
          },
          due: {
            numeric: "Please enter a number.",
            min_value: "Please enter a number greater than 0.",
          },
          payBy: {
            required: "The pay by field is required.",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
    console.log(this.qt);
  },
  props: ["data"],
  mounted() {
    this.cartProducts();
  },

  data() {
    return {
      csrfToken: Laravel.csrfToken,
      pos: [],
      cartProduct: [],

      vat: this.data.extra.vat,
      qty: "",
      sub_total: "",
      total: "",
      pay: "",
      due: "",
      payBy: "",
    };
  },

  computed: {
    qty1() {
      let sum = 0;
      for (let i = 0; i < this.cartProduct.length; i++) {
        sum += parseFloat(this.cartProduct[i].product_quantity);
      }

      return (this.qty = sum);
    },
    sub_total1() {
      let sum = 0;
      for (let i = 0; i < this.cartProduct.length; i++) {
        sum += parseFloat(this.cartProduct[i].sub_total);
      }

      return (this.sub_total = sum);
    },

    total1() {
      let tot = 0;
      tot += parseFloat(
        this.number_format(
          Math.round(
            ((this.sub_total1 * this.data.extra.vat) / 100 + this.sub_total1) *
            100
          ) / 100
        )
          .replace(/\./g, "")
          .replace("₫", "")
      );
      return (this.total = tot);
    },
  },

  methods: {
    cartProducts() {
      axios
        .get("/cart-product")
        .then(({ data }) => (this.cartProduct = data,
          console.log(this.cartProduct)
        ))
        .catch();
    },
    onInvalidSubmit({ values, errors, results }) {
      let firstInputError = Object.entries(errors)[0][0];
      this.$el.querySelector("input[name=" + firstInputError + "]").focus();
      $("html, body").animate(
        {
          scrollTop:
            $("input[name=" + firstInputError + "]").offset().top - 150,
        },
        500
      );
    },
    onSubmit() {
      this.$refs.formData.submit();
    },

    number(string) {
      return string;
    },
    deleteItem(id) {
      axios
        .get("/cart/delete/" + id)
        .then(() => {
          location.reload();
          this.$toaster.success("Successfully done! ");
        })
        .catch();
    },
    number_format(value) {
      return new Intl.NumberFormat("vi-VN", {
        style: "currency",
        currency: "VND",
      }).format(value);
    },
  },
};
</script>




