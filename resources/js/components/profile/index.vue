<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <VeeForm
              as="div"
              v-slot="{ handleSubmit }"
              class="form-owner"
              @invalid-submit="onInvalidSubmit"
            >
              <form
                method="POST"
                @submit="handleSubmit($event, onSubmit)"
                ref="formData"
                enctype="multipart/form-data"
                :action="data.urlUpdate"
              >
                <Field type="hidden" :value="csrfToken" name="_token" />

                <div class="container">
                  <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="account-settings">
                            <div class="user-profile">
                              <div class="user-avatar">
                                <img
                                  src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                  alt="Maxwell Admin"
                                />
                              </div>
                              <h5 class="user-name">
                                {{ this.data.user.name }}
                              </h5>
                              <h6 class="user-email">
                                {{ this.data.user.email }}
                              </h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                      <div class="card h-100">
                        <div class="card-body">
                          <div class="row gutters">
                            <div
                              class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                            >
                              <h6 class="mb-2 text-primary">
                                Personal Details
                              </h6>
                            </div>
                            <div class="form-group">
                              <div class="form-row">
                                <div class="col-12">
                                  <label class="" require>Name</label>
                                  <Field
                                    type="text"
                                    name="name"
                                    autocomplete="off"
                                    rules="required"
                                    class="form-control"
                                    placeholder="Enter Name"
                                    v-model="model.name"
                                  />

                                  <ErrorMessage class="error" name="name" />
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="form-row">
                                <div class="col-12">
                                  <label class="" require>Email</label>
                                  <Field
                                    type="email"
                                    name="email"
                                    autocomplete="off"
                                    rules="required"
                                    class="form-control"
                                    placeholder="Enter email"
                                    v-model="model.email"
                                  />

                                  <ErrorMessage class="error" name="email" />
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="form-row">
                                <div class="col-12">
                                  <label class="" require>Phone</label>
                                  <Field
                                    type="text"
                                    name="phone"
                                    autocomplete="off"
                                    rules="required"
                                    class="form-control"
                                    placeholder="Enter phone"
                                    v-model="model.phone"
                                  />

                                  <ErrorMessage class="error" name="phone" />
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="form-row">
                                <div class="col-12">
                                  <label class="" require>Address</label>
                                  <Field
                                    type="text"
                                    name="address"
                                    autocomplete="off"
                                    rules="required"
                                    class="form-control"
                                    placeholder="Enter address"
                                    v-model="model.address"
                                  />

                                  <ErrorMessage class="error" name="address" />
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row gutters">
                            <div
                              class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12"
                            >
                              <div class="col-md-12 text-center btn-box">
                                <a
                                  :href="data.urlBack"
                                  class="btn btn-outline-secondary"
                                  style="margin-right: 10px"
                                >
                                  Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                  Submit
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </VeeForm>
          </div>
        </div>
      </div>
    </div>
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
  computed: {},
  props: ["data"],
  data: function () {
    return {
      csrfToken: Laravel.csrfToken,
      model: this.data.user,
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          name: {
            required: "The name field is required.",
          },
          email: {
            required: "The email field is required.",
          },
          phone: {
            required: "The phone field is required.",
          },
          address: {
            required: "The address field is required.",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
    console.log(this.model.email);
  },
  methods: {
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
  },
};
</script>


