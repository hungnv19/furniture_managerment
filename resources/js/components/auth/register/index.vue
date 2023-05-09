<template>
  <section class="vh-100" style="">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img
                  src="https://aothungame.vn/wp-content/uploads/te1baa3i-hc3acnh-ne1bb81n-lmht-yasuo-me1bab7c-c491e1bb8bnh-cho-c491ie1bb87n-thoe1baa1i.png"
                  alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <VeeForm as="div" v-slot="{ handleSubmit }" class="form-owner" @invalid-submit="onInvalidSubmit">
                    <form method="POST" @submit="handleSubmit($event, onSubmit)" ref="formData"
                      enctype="multipart/form-data" :action="data.urlStore">
                      <Field type="hidden" :value="csrfToken" name="_token" />

                      <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                        <span class="h1 fw-bold mb-0">Register</span>
                      </div>

                      <div class="form-group">
                        <label class="" require>Name</label>
                        <Field type="text" name="name" autocomplete="off" v-model="model.name" rules="required|max:128"
                          class="form-control" placeholder="Enter Name" />

                        <ErrorMessage class="error" name="name" />
                      </div>
                      <div class="form-group">
                        <label class="" require>Email</label>
                        <Field type="text" name="email" autocomplete="off" v-model="model.email"
                          rules="required|max:128|email|unique_email" class="form-control" placeholder="Enter email" />

                        <ErrorMessage class="error" name="email" />
                      </div>
                      <div class="form-group">
                        <label class="" require>Password</label>
                        <Field type="password" name="password" autocomplete="off" v-model="model.password"
                          rules="required|max:128" class="form-control" placeholder="Enter password" />

                        <ErrorMessage class="error" name="password" />
                      </div>

                      <div class="pt-1 mb-4">
                        <button class="btn btn-dark btn-lg btn-block" type="submit">Register</button>
                      </div>


                      <a :href="data.urlBack" class="small text-muted">Back home</a>

                    </form>
                  </VeeForm>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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

      model: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  created() {
    let messError = {
      en: {
        fields: {
          name: {
            required: "The name field is required.",
            max: "The name may not be greater than 128.",
          },
          email: {
            required: "The email field is required.",
            max: "The email may not be greater than 128.",
            unique_email: "The email already exists",
            email: "The Email must be a valid email address.",
          },
          password: {
            required: "The password field is required.",
            max: "The password may not be greater than 128.",
          },
        },
      },
    };
    configure({
      generateMessage: localize(messError),
    });
    let that = this;
    defineRule("unique_email", (value) => {
      return axios
        .post(that.data.urlCheckEmail, {
          value: value,

        })
        .then(function (response) {
          return response.data.valid
        })
        .catch((error) => { });
    });
  },
  methods: {
    updateSelected(e) {
      let array = [];
      e.map((x) => {
        array.push(x.value);
      });
      array = [...new Set(array)];
      this.skill = array;
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
  },
};
</script>

<style>
.error {
  color: red;
}
</style>

